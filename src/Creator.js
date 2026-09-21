import { createObject } from './Constructor.js';
import { createFactoryObject } from './Factory.js';
import { resolveReference } from './Registry.js';
import { getRuntimeTag } from './Tags.js';

export function create(element, scene) {
    const ref = element.getAttribute('ref');

    if (ref) {
        const object = resolveReference(ref);
        if (!object) throw new Error(`Unknown reference: ${ref}`);
        return object;
    }

    const value = element.getAttribute('value');

    if (value) {
        return new Function(
            'scene',
            'BABYLON',
            `return (${value})`
        )(scene, BABYLON);
    }

    const tag = getRuntimeTag(element);
    const type = element.getAttribute('type');

    if (tag === 'mesh') {
        return createFactoryObject(element, scene, BABYLON.MeshBuilder);
    }

    if (tag === 'model') {
        const src = element.getAttribute('src');
        if (!src) throw new Error('Model requires src');
        return BABYLON.SceneLoader.ImportMeshAsync('', '', src, scene);
    }

    if (tag === 'texture') {
        return null;
    }

    if (tag === 'gui') {
        if (type === 'AdvancedDynamicTexture') {
            return BABYLON.GUI.AdvancedDynamicTexture.CreateFullscreenUI(
                element.id,
                true,
                scene
            );
        }
    
        if (type === 'Button') {
            return BABYLON.GUI.Button.CreateSimpleButton(
                element.id,
                element.getAttribute('text') ?? ''
            );
        }
    }

    if (!type) return null;

    return createObject(element, scene);
}