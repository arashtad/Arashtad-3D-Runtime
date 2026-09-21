const instances = new WeakMap();

export function initializeEvents(scene, canvas) {
    if (!scene || !canvas) {
        throw new Error('Interactions: scene and canvas are required.');
    }

    if (instances.has(scene)) {
        return instances.get(scene);
    }

    const state = {
        scene,
        canvas,
        hoveredMesh: null,
        pointerObserver: null,
        bindings: new Map()
    };

    function getPickInfo(event) {
        const rect = canvas.getBoundingClientRect();
        return scene.pick(event.clientX - rect.left, event.clientY - rect.top, mesh => mesh?.isPickable !== false);
    }

    function emit(name, detail = {}) {
        canvas.dispatchEvent(new CustomEvent(`interaction:${name}`, {
            detail: {
                scene,
                canvas,
                ...detail
            }
        }));
    }

    function trigger(name, mesh, detail) {
        if (!mesh) return;

        const bindings = state.bindings.get(mesh);

        if (!bindings) return;

        const callbacks = bindings.get(name);

        if (!callbacks) return;

        for (const callback of callbacks) {
            callback({
                scene,
                canvas,
                mesh,
                ...detail
            });
        }
    }

    function bind(mesh, event, callback) {
        if (!mesh || typeof callback !== 'function') return;

        if (!state.bindings.has(mesh)) {
            state.bindings.set(mesh, new Map());
        }

        const events = state.bindings.get(mesh);

        if (!events.has(event)) {
            events.set(event, new Set());
        }

        events.get(event).add(callback);
    }

    function bindAll(mesh, handlers) {
        if (!mesh || !handlers) return;
    
        for (const [event, callback] of Object.entries(handlers)) {
            bind(mesh, event, callback);
        }
    }

    function bindName(name, event, callback) {
        const mesh = scene.getMeshByName(name);
    
        if (!mesh) {
            throw new Error(`Interactions: mesh not found: ${name}`);
        }
    
        bind(mesh, event, callback);
    
        return mesh;
    }

    function bindNameAll(name, event, callback) {
        const meshes = scene.meshes.filter(mesh => mesh.name === name);
    
        for (const mesh of meshes) {
            bind(mesh, event, callback);
        }
    
        return meshes;
    }

    function bindNamePattern(pattern, event, callback) {
        const regex =
            pattern instanceof RegExp
                ? pattern
                : new RegExp(pattern);
    
        const meshes = scene.meshes.filter(mesh => {
            regex.lastIndex = 0;
            return regex.test(mesh.name);
        });
    
        for (const mesh of meshes) {
            bind(mesh, event, callback);
        }
    
        return meshes;
    }

    function bindHierarchy(root, event, callback) {
        if (!root) return [];
    
        const meshes = [root, ...root.getChildMeshes(false)];
    
        for (const mesh of meshes) {
            bind(mesh, event, callback);
        }
    
        return meshes;
    }

    function unbind(mesh, event, callback) {
        const events = state.bindings.get(mesh);

        if (!events) return;

        const callbacks = events.get(event);

        if (!callbacks) return;

        if (callback) {
            callbacks.delete(callback);
        } else {
            callbacks.clear();
        }

        if (!callbacks.size) {
            events.delete(event);
        }

        if (!events.size) {
            state.bindings.delete(mesh);
        }
    }

    function unbindAll(mesh, event = null) {
        const events = state.bindings.get(mesh);
    
        if (!events) return;
    
        if (event) {
            events.delete(event);
        } else {
            events.clear();
        }
    
        if (!events.size) {
            state.bindings.delete(mesh);
        }
    }

    function unbindNamePattern(pattern, event = null) {
        const regex =
            pattern instanceof RegExp
                ? pattern
                : new RegExp(pattern);
    
        const meshes = scene.meshes.filter(mesh => {
            regex.lastIndex = 0;
            return regex.test(mesh.name);
        });
    
        for (const mesh of meshes) {
            unbindAll(mesh, event);
        }
    
        return meshes;
    }
    
    function unbindHierarchy(root, event = null) {
        if (!root) return [];
    
        const meshes = [root, ...root.getChildMeshes(false)];
    
        for (const mesh of meshes) {
            unbindAll(mesh, event);
        }
    
        return meshes;
    }

    function on(mesh, event, callback) {
        return bind(mesh, event, callback);
    }

    function onAll(mesh, handlers) {
        return bindAll(mesh, handlers);
    }

    function pointerMove(event) {
        const pickInfo = getPickInfo(event);
        const mesh = pickInfo?.pickedMesh ?? null;

        if (mesh !== state.hoveredMesh) {
            if (state.hoveredMesh) {
                trigger('pointerout', state.hoveredMesh, { event, pickInfo: null });
                emit('pointerout', { event, mesh: state.hoveredMesh, pickInfo: null });
            }

            state.hoveredMesh = mesh;

            if (mesh) {
                trigger('pointerover', mesh, { event, pickInfo });
                emit('pointerover', { event, mesh, pickInfo });
            }
        }

        trigger('pointermove', mesh, { event, pickInfo });
        emit('pointermove', { event, mesh, pickInfo });
    }

    function pointerDown(event) {
        const pickInfo = getPickInfo(event);
        const mesh = pickInfo?.pickedMesh ?? null;

        trigger('pointerdown', mesh, { event, pickInfo });
        emit('pointerdown', { event, mesh, pickInfo });
    }

    function pointerUp(event) {
        const pickInfo = getPickInfo(event);
        const mesh = pickInfo?.pickedMesh ?? null;

        trigger('pointerup', mesh, { event, pickInfo });
        emit('pointerup', { event, mesh, pickInfo });
    }

    function pick(event) {
        const pickInfo = getPickInfo(event);
        const mesh = pickInfo?.pickedMesh ?? null;

        trigger('pick', mesh, {
            event,
            pickInfo,
            point: pickInfo?.pickedPoint ?? null
        });

        emit('pick', {
            event,
            mesh,
            point: pickInfo?.pickedPoint ?? null,
            pickInfo
        });
    }

    state.pointerObserver = scene.onPointerObservable.add(pointerInfo => {
        const event = pointerInfo.event;

        if (!event) return;

        switch (pointerInfo.type) {
            case BABYLON.PointerEventTypes.POINTERMOVE:
                pointerMove(event);
                break;

            case BABYLON.PointerEventTypes.POINTERDOWN:
                pointerDown(event);
                break;

            case BABYLON.PointerEventTypes.POINTERUP:
                pointerUp(event);
                break;

            case BABYLON.PointerEventTypes.POINTERPICK:
                pick(event);
                break;
        }
    });

    const instance = {
        scene,
        canvas,

        bind,
        bindAll,
        bindName,
        bindNameAll,
        bindNamePattern,
        bindHierarchy,
        unbind,
        unbindAll,
        unbindNamePattern,
        unbindHierarchy,
        on,
        onAll,

        pick(event) {
            return getPickInfo(event);
        },

        emit,

        disable() {
            if (state.pointerObserver) {
                scene.onPointerObservable.remove(state.pointerObserver);
                state.pointerObserver = null;
            }

            state.bindings.clear();
            state.hoveredMesh = null;

            instances.delete(scene);
        }
    };

    instances.set(scene, instance);

    return instance;
}

export function destroyEvents(scene) {
    const instance = instances.get(scene);

    if (instance) {
        instance.disable();
    }
}