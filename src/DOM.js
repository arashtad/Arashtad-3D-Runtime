import { applyProperties } from './Properties.js';
import { parseValue } from './Parser.js';
import { create } from './Creator.js';
import {
    register,
    resolveReference,
    clearRegistry,
    getReferences,
    registerData
} from './Registry.js';
import { bindEvents } from './Events.js';
import { executeActions } from './ActionHandler.js';
import { getRuntimeTag, runtimeTag } from './Tags.js?v=2';

const elements = new WeakMap();
const physicsBodies = new WeakMap();

function executeLoadError(element, error, scene, engine) {
    if (!element) return;

    const callback = element.getAttribute('OnLoadError');

    if (!callback) return;

    new Function(
        'error',
        'scene',
        'engine',
        'element',
        callback
    )(
        error,
        scene,
        engine,
        element
    );
}

/*
 * Execute an OnLoadProgress expression if one exists.
 *
 * Available variables inside the HTML expression:
 *
 *   progress
 *   scene
 *   engine
 *   element
 */
function executeLoadProgress(
    element,
    progress,
    scene,
    engine
) {
    if (!element) return;

    const callback = element.getAttribute('OnLoadProgress');

    if (!callback) return;

    new Function(
        'progress',
        'scene',
        'engine',
        'element',
        callback
    )(
        progress,
        scene,
        engine,
        element
    );
}

const handlers = {
    camera(element, scene, canvas) {
        const camera = create(element, scene);
        camera.attachControl(canvas, true);
        scene.activeCamera = camera;
        return camera;
    },

    light(element, scene) {
        return create(element, scene);
    },

    async model(element, scene, canvas, engine, loading) {
        const src = element.getAttribute('src');

        if (!src) {
            throw new Error('<model> requires src');
        }

        /*
         * Each model gets its own loading state.
         *
         * Nothing is logged here.
         *
         * If the model has:
         *
         * OnLoadProgress="console.log('Model:', progress + '%')"
         *
         * that expression receives the individual model progress.
         */
        const modelState = {
            loaded: 0,
            total: 0,
            progress: 0
        };

        loading.models.push({
            element,
            state: modelState
        });

        let result;

        try {
            result = await BABYLON.SceneLoader.ImportMeshAsync(
                '',
                '',
                src,
                scene,
                event => {
                    let progress = modelState.progress;

                    if (
                        event.lengthComputable &&
                        event.total > 0
                    ) {
                        modelState.loaded = event.loaded;
                        modelState.total = event.total;

                        progress = Math.round(
                            (event.loaded / event.total) * 100
                        );
                    } else {
                        /*
                        * When the browser cannot provide total byte size,
                        * keep the last known percentage.
                        */
                        progress = modelState.progress;
                    }

                    /*
                    * Never decrease progress.
                    */
                    if (progress < modelState.progress) {
                        progress = modelState.progress;
                    }

                    modelState.progress = Math.min(
                        100,
                        progress
                    );

                    /*
                    * Individual model progress.
                    *
                    * Only executes when the model itself has
                    * OnLoadProgress.
                    */
                    executeLoadProgress(
                        element,
                        modelState.progress,
                        scene,
                        engine
                    );

                    /*
                    * Update aggregate scene progress.
                    */
                    updateSceneProgress(
                        loading,
                        scene,
                        engine
                    );
                }
            );
        } catch (error) {
            executeLoadError(
                element,
                error,
                scene,
                engine
            );

            throw error;
        }

        /*
         * ImportMeshAsync has completely resolved.
         * Therefore this model is fully loaded.
         */
        modelState.progress = 100;

        /*
         * Give the individual model its final 100%.
         */
        executeLoadProgress(
            element,
            100,
            scene,
            engine
        );

        updateSceneProgress(
            loading,
            scene,
            engine
        );

        registerData(
            element.id,
            result
        );

        for (const mesh of result.meshes) {
            if (mesh.name) {
                register(
                    mesh.name,
                    mesh
                );
            }
        }

        /*
         * Imported GLB/GLTF animation groups.
         */
        const animationGroups =
            result.animationGroups ?? [];

        /*
         * Create a root node for the imported model.
         */
        const root = new BABYLON.TransformNode(
            `${element.id || 'model'}-root`,
            scene
        );

        root.metadata = {
            modelMeshes: result.meshes,
            animationGroups
        };

        /*
         * Resolve an animation by:
         *
         * - numeric index
         * - exact name
         * - partial name
         */
        const resolveAnimation = value => {
            if (
                typeof value === 'number' ||
                /^\d+$/.test(String(value))
            ) {
                return (
                    animationGroups[
                        Number(value)
                    ] ?? null
                );
            }

            return (
                animationGroups.find(
                    animation =>
                        animation.name === value
                ) ??
                animationGroups.find(
                    animation =>
                        animation.name.includes(value)
                ) ??
                null
            );
        };

        /*
         * Return all available animation names.
         *
         * Example:
         *
         * target.getAnimations()
         */
        root.getAnimations = () => {
            return animationGroups.map(
                animation => animation.name
            );
        };

        /*
         * Play / switch animation.
         *
         * Accepts:
         *
         * - index
         * - exact name
         * - partial name
         */
        root.playAnimation = value => {
            const group =
                resolveAnimation(value);

            if (!group) {
                console.warn(
                    `Animation not found: ${value}`
                );
                return;
            }

            /*
             * Stop all other animations.
             */
            for (const animation of animationGroups) {
                if (animation !== group) {
                    animation.stop();
                }
            }

            group.start(true);
        };

        /*
         * Pause an animation.
         *
         * Without a name/index:
         * pause all animations.
         */
        root.pauseAnimation = value => {
            if (value == null) {
                for (const group of animationGroups) {
                    group.pause();
                }

                return;
            }

            const group =
                resolveAnimation(value);

            if (!group) {
                console.warn(
                    `Animation not found: ${value}`
                );
                return;
            }

            group.pause();
        };

        /*
        * Resume an animation.
        *
        * Without a name/index:
        * resume all animations.
        */
        root.resumeAnimation = value => {
            if (value == null) {
                for (const group of animationGroups) {
                    group.play();
                }

                return;
            }

            const group =
                resolveAnimation(value);

            if (!group) {
                console.warn(
                    `Animation not found: ${value}`
                );
                return;
            }

            group.play();
        };

        /*
         * Stop an animation.
         *
         * Without a name/index:
         * stop all animations.
         */
        root.stopAnimation = value => {
            if (value == null) {
                for (const group of animationGroups) {
                    group.stop();
                }

                return;
            }

            const group =
                resolveAnimation(value);

            if (!group) {
                console.warn(
                    `Animation not found: ${value}`
                );
                return;
            }

            group.stop();
        };

        /*
         * Set animation playback speed.
         *
         * Without a name/index:
         * change speed of all animations.
         */
        root.setAnimationSpeed = (
            speed,
            value = null
        ) => {
            const numericSpeed =
                Number(speed);

            if (!Number.isFinite(numericSpeed)) {
                console.warn(
                    `Invalid animation speed: ${speed}`
                );
                return;
            }

            if (value == null) {
                for (
                    const group
                    of animationGroups
                ) {
                    group.speedRatio =
                        numericSpeed;
                }

                return;
            }

            const group =
                resolveAnimation(value);

            if (!group) {
                console.warn(
                    `Animation not found: ${value}`
                );
                return;
            }

            group.speedRatio =
                numericSpeed;
        };

        /*
         * Parent imported meshes to the model root.
         */
        for (const mesh of result.meshes) {
            if (!mesh.parent) {
                mesh.parent = root;
            }
        }

        return root;
    }
};

function updateSceneProgress(
    loading,
    scene,
    engine
) {
    if (!loading.models.length) {
        return;
    }

    let total = 0;
    let loaded = 0;

    let haveByteTotals = false;

    for (const model of loading.models) {
        const state = model.state;

        if (state.total > 0) {
            haveByteTotals = true;
            total += state.total;
            loaded += Math.min(
                state.loaded,
                state.total
            );
        }
    }

    let progress;

    if (haveByteTotals && total > 0) {
        progress = Math.round(
            (loaded / total) * 100
        );
    } else {
        /*
         * Fallback for resources where byte totals are unavailable.
         */
        const completed = loading.models.filter(
            model => model.state.progress >= 100
        ).length;

        const active = loading.models.reduce(
            (sum, model) => sum + model.state.progress,
            0
        );

        progress = Math.round(
            active / loading.models.length
        );

        /*
         * If every model has completed, force 100.
         */
        if (completed === loading.models.length) {
            progress = 100;
        }
    }

    /*
     * Scene progress must never go backwards.
     */
    if (progress < loading.progress) {
        progress = loading.progress;
    }

    loading.progress = Math.min(
        100,
        progress
    );

    /*
     * Do NOT execute the scene callback with 100 here.
     *
     * Final scene 100 is deliberately emitted only once
     * by processCanvas() after EVERYTHING has completed.
     */
    if (loading.progress >= 100) {
        loading.progress = 99;
    }

    executeLoadProgress(
        loading.runtimeElement,
        loading.progress,
        scene,
        engine
    );
}

async function createElement(
    element,
    scene,
    canvas,
    engine,
    parent = null,
    loading = null
) {
    const tag = getRuntimeTag(element);

    if (tag === 'runtime') {
        for (const attribute of element.attributes) {
            const name = attribute.name.toLowerCase();

            if (name === 'resize') {
                window.addEventListener('resize', () => {
                    new Function(
                        'engine',
                        'scene',
                        attribute.value
                    )(engine, scene);
                });
            }

            if (name === 'onloadprogress') {
                loading.runtimeElement = element;
            }

            if (name === 'environment') {
                loading.environment = attribute.value;
            }
            
            if (name === 'environmentintensity') {
                loading.environmentIntensity = Number(attribute.value);
            }
            
            if (name === 'environmentbackground') {
                loading.environmentBackground =
                    attribute.value.toLowerCase() !== 'false';
            }
            
            if (name === 'environmentbackgroundblur') {
                loading.environmentBackgroundBlur =
                    Number(attribute.value);
            }
            
            if (name === 'environmentrotationy') {
                loading.environmentRotationY =
                    Number(attribute.value);
            }
        }

        return null;
    }

    if (tag === 'physics') {
        return null;
    }

    if (
        tag === 'action' ||
        element.hasAttribute('ref')
    ) {
        return null;
    }

    const handler = handlers[tag];

    const object = handler
        ? handler(
            element,
            scene,
            canvas,
            engine,
            loading
        )
        : create(element, scene);

    if (!object) return null;

    const resolved =
        object instanceof Promise
            ? await object
            : object;

    elements.set(element, resolved);

    register(
        element.id,
        resolved
    );

    for (const child of element.children) {
        await createElement(
            child,
            scene,
            canvas,
            engine,
            resolved,
            loading
        );
    }

    return resolved;
}

function applyParent(object, element) {
    const id = element.getAttribute('parent');

    if (!id) return;

    const parent = resolveReference(id);

    if (!parent) {
        throw new Error(
            `Unknown parent: ${id}`
        );
    }

    if (
        parent instanceof BABYLON.GUI.AdvancedDynamicTexture &&
        object instanceof BABYLON.GUI.Control
    ) {
        parent.addControl(object);
        return;
    }

    object.parent = parent;
}

function applyMaterial(object, element) {
    const id = element.getAttribute('material');

    if (!id) return;

    const material = resolveReference(id);

    if (!material) {
        throw new Error(
            `Unknown material reference: ${id}`
        );
    }

    object.material = material;
}

async function applyElement(
    element,
    scene,
    canvas,
    parent = null
) {
    const tag = getRuntimeTag(element);
    if (tag === 'runtime') {
        return null;
    }

    if (tag === 'action') {
        if (!parent) {
            throw new Error(
                '<action> requires a parent'
            );
        }
    
        bindEvents(
            parent,
            element
        );
    
        return null;
    }

    if (tag === 'physics') {
        await processPhysics(
            element,
            scene,
            parent
        );

        return null;
    }

    if (tag === 'shadow') {
        const light = resolveReference(
            element.getAttribute('light')
        );
    
        if (!light) {
            throw new Error(
                `Unable to resolve shadow light: ${element.getAttribute('light')}`
            );
        }
    
        const generator =
            new BABYLON.ShadowGenerator(
                Number(
                    element.getAttribute('mapSize') || 1024
                ),
                light
            );
    
        const darkness =
            element.getAttribute('darkness');
    
        if (darkness !== null) {
            generator.darkness =
                Number(darkness);
        }
    
        const shadowProperties = [
            'shadowMinZ',
            'shadowMaxZ',
            'orthoLeft',
            'orthoRight',
            'orthoTop',
            'orthoBottom'
        ];
    
        for (const property of shadowProperties) {
            const attribute =
                property === 'shadowMinZ'
                    ? 'minZ'
                    : property === 'shadowMaxZ'
                        ? 'maxZ'
                        : property;
    
            const value =
                element.getAttribute(attribute);
    
            if (value !== null) {
                light[property] = Number(value);
            }
        }
    
        for (const child of element.children) {
            const childTag = getRuntimeTag(child);
        
            if (childTag === 'generator') {
                const booleanProperties = [
                    'useBlurExponentialShadowMap',
                    'useBlurCloseExponentialShadowMap',
                    'useKernelBlur'
                ];
        
                for (const property of booleanProperties) {
                    const value = child.getAttribute(property);
        
                    if (value !== null) {
                        generator[property] =
                            value.toLowerCase() === 'true';
                    }
                }
        
                for (const property of [
                    'blurKernel',
                    'blurScale'
                ]) {
                    const value = child.getAttribute(property);
        
                    if (value !== null) {
                        generator[property] =
                            Number(value);
                    }
                }
        
                continue;
            }
        
            const target = resolveReference(
                child.getAttribute('ref')
            );
        
            if (!target) {
                throw new Error(
                    `Unable to resolve shadow reference: ${
                        child.getAttribute('ref')
                    }`
                );
            }
        
            if (childTag === 'caster') {
                const meshes =
                    target.metadata?.modelMeshes ??
                    target.getChildMeshes?.() ??
                    [target];
        
                for (const mesh of meshes) {
                    generator.addShadowCaster(mesh);
                }
            }
        
            if (childTag === 'receiver') {
                target.receiveShadows = true;
            }
        }
    
        return generator;
    }

    const ref = element.getAttribute('ref');

    const object = ref
        ? resolveReference(ref)
        : elements.get(element);

    if (!object) {
        throw new Error(
            `Unable to resolve <${tag}>`
        );
    }

    applyProperties(
        object,
        element,
        [
            'ref',
            'parent',
            'material',
            'manager',
            'imgUrl',
            'capacity',
            'cellSize'
        ],
        { scene }
    );

    if (!ref) {
        applyParent(
            object,
            element
        );
    }

    applyMaterial(
        object,
        element
    );

    /*
    * Events
    *
    * <model> events apply to ALL meshes belonging
    * to that model.
    *
    * <mesh ref="..."> events apply ONLY to the
    * specifically referenced mesh.
    */
    if (tag === 'model') {
        const modelMeshes =
            object.metadata?.modelMeshes ?? [];
    
        for (const mesh of modelMeshes) {
            bindEvents(
                mesh,
                element,
                modelMeshes
            );
        }
    } else {
        bindEvents(
            object,
            element
        );
    }

    if (
        tag === 'material' &&
        parent
    ) {
        parent.material = object;
    }

    if (
        tag === 'particlesystem'
    ) {
        object.start();
    }

    for (const child of element.children) {
        await applyElement(
            child,
            scene,
            canvas,
            object
        );
    }

    return object;
}

export async function processCanvas(canvas) {
    clearRegistry();

    const engine = new BABYLON.Engine(
        canvas,
        true,
        {
            alpha: true,
            premultipliedAlpha: false,
            audioEngine: true
        }
    );

    const scene = new BABYLON.Scene(engine);

    const loading = {
        runtimeElement: null,
        environment: null,
        environmentIntensity: null,
        environmentBackground: null,
        environmentBackgroundBlur: null,
        environmentRotationY: null,
        models: [],
        progress: 0,
        completed: false
    };

    applyProperties(
        scene,
        canvas,
        [],
        { scene }
    );
    
    for (const element of canvas.children) {
        await createElement(
            element,
            scene,
            canvas,
            engine,
            null,
            loading
        );
    }
    
    for (const element of canvas.children) {
        if (
            element.tagName.toLowerCase() ===
            'arashtad-runtime'
        ) {
            continue;
        }
    
        await applyElement(
            element,
            scene,
            canvas
        );
    }
    
    if (!loading.completed) {
        loading.completed = true;
        loading.progress = 100;

        if (loading.environment) {
            let env;

            if (loading.environment.toLowerCase().endsWith('.hdr')) {
                env = new BABYLON.HDRCubeTexture(
                    loading.environment,
                    scene,
                    512
                );
            } else {
                env = BABYLON.CubeTexture.CreateFromPrefilteredData(
                    loading.environment,
                    scene
                );
            }

            scene.environmentTexture = env;

            if (loading.environmentIntensity !== null) {
                scene.environmentIntensity =
                    loading.environmentIntensity;
            }

            if (loading.environmentRotationY !== null) {
                env.rotationY =
                    loading.environmentRotationY;
            }

            if (loading.environmentBackground !== false) {
                scene.createDefaultSkybox(
                    env,
                    true,
                    1000,
                    loading.environmentBackgroundBlur ?? 0
                );
            }
        }

        executeLoadProgress(
            loading.runtimeElement,
            100,
            scene,
            engine
        );
    }

    engine.runRenderLoop(() => scene.render());

    return scene;
}

async function processPhysics(element, scene, parent) {
    if (!parent) {
        throw new Error('<physics> requires a parent object');
    }

    if (!scene.isPhysicsEnabled()) {
        if (typeof HavokPhysics !== 'function')
            throw new Error('Physics requires HavokPhysics.');

        const havokInstance = await HavokPhysics();

        const plugin = new BABYLON.HavokPlugin(
            undefined,
            havokInstance
        );

        scene.enablePhysics(
            new BABYLON.Vector3(0, -9.81, 0),
            plugin
        );
    }

    const type = element.getAttribute('type') || 'BOX';
    const options = {};

    for (const attr of element.attributes) {
        if (attr.name === 'type')
            continue;

        options[attr.name] = parseValue(attr.value, {
            scene,
            parent
        });
    }

    const aggregate = new BABYLON.PhysicsAggregate(
        parent,
        BABYLON.PhysicsShapeType[type],
        options,
        scene
    );

    physicsBodies.set(parent, aggregate);

    parent.metadata = {
        ...(parent.metadata ?? {}),
        physicsAggregate: aggregate
    };

    for (const child of element.children) {
        processPhysicsBody(child, aggregate, scene, parent);
    }

    return aggregate;
}

function processPhysicsBody(
    element,
    aggregate,
    scene,
    parent
) {
    const tag = getRuntimeTag(element);
    const body = aggregate.body;

    switch (tag) {
        case 'velocity': {
            const linear =
                element.getAttribute(
                    'linear'
                );

            const angular =
                element.getAttribute(
                    'angular'
                );

            if (linear) {
                body.setLinearVelocity(
                    parseValue(
                        linear,
                        {
                            scene,
                            parent
                        }
                    )
                );
            }

            if (angular) {
                body.setAngularVelocity(
                    parseValue(
                        angular,
                        {
                            scene,
                            parent
                        }
                    )
                );
            }

            break;
        }

        case 'impulse': {
            const impulse =
                element.getAttribute(
                    'value'
                );

            const contact =
                element.getAttribute(
                    'contact'
                );

            if (!impulse) {
                throw new Error(
                    '<impulse> requires a value'
                );
            }

            body.applyImpulse(
                parseValue(
                    impulse,
                    {
                        scene,
                        parent
                    }
                ),
                contact
                    ? parseValue(
                        contact,
                        {
                            scene,
                            parent
                        }
                    )
                    : parent.getAbsolutePosition()
            );

            break;
        }

        case 'force': {
            const force =
                element.getAttribute(
                    'value'
                );

            const contact =
                element.getAttribute(
                    'contact'
                );

            if (!force) {
                throw new Error(
                    '<force> requires a value'
                );
            }

            body.applyForce(
                parseValue(
                    force,
                    {
                        scene,
                        parent
                    }
                ),
                contact
                    ? parseValue(
                        contact,
                        {
                            scene,
                            parent
                        }
                    )
                    : parent.getAbsolutePosition()
            );

            break;
        }

        case 'body': {
            const type =
                element.getAttribute(
                    'type'
                );

            if (type !== null) {
                body.setMotionType(
                    BABYLON.PhysicsMotionType[type]
                );
            }

            break;
        }

        case 'collision': {
            const onCollide =
                element.getAttribute(
                    'on-collide'
                );

            const onEnd =
                element.getAttribute(
                    'on-end'
                );

            if (!onCollide && !onEnd) {
                throw new Error(
                    '<collision> requires on-collide and/or on-end'
                );
            }

            if (onCollide) {
                body.setCollisionCallbackEnabled(
                    true
                );

                const types = (
                    element.getAttribute(
                        'type'
                    ) || 'started'
                )
                    .split(',')
                    .map(
                        type =>
                            `COLLISION_${type.trim().toUpperCase()}`
                    );

                body
                    .getCollisionObservable()
                    .add(event => {
                        if (
                            !types.includes(
                                event.type
                            )
                        ) {
                            return;
                        }

                        executeActions(
                            parent,
                            onCollide,
                            scene,
                            event
                        );
                    });
            }

            if (onEnd) {
                body.setCollisionEndedCallbackEnabled(
                    true
                );

                body
                    .getCollisionEndedObservable()
                    .add(event => {
                        executeActions(
                            parent,
                            onEnd,
                            scene,
                            event
                        );
                    });
            }

            break;
        }
    }
}

export async function loadModel(scene, url, id = 'runtime-model')
{
    if (!scene || !url)
        return null;

    const canvas = scene.getEngine()?.getRenderingCanvas();

    if (!canvas)
        throw new Error('Runtime: scene canvas was not found.');

    const element = document.createElement(runtimeTag('model'));

    element.id = id;
    element.setAttribute('src', url);

    const engine = scene.getEngine();

    const loading = {
        runtimeElement: null,
        environment: null,
        environmentIntensity: null,
        environmentBackground: null,
        environmentBackgroundBlur: null,
        environmentRotationY: null,
        models: [],
        progress: 0,
        completed: false
    };

    const object = await createElement(
        element,
        scene,
        canvas,
        engine,
        null,
        loading
    );

    await applyElement(
        element,
        scene,
        canvas
    );

    return object;
}