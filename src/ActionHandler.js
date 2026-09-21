import { getReferences } from './Registry.js';

export function executeActions(
    target,
    value,
    scene,
    event,
    modelMeshes = []
) {
    const refs = getReferences();

    new Function(
        'target',
        'scene',
        'BABYLON',
        'refs',
        'event',
        'meshes',
        'mesh',
        `
        with (refs) {
            with (target) {
                ${value}
            }
        }
        `
    )(
        target,
        scene,
        BABYLON,
        refs,
        event,
        modelMeshes,
        target
    );
}