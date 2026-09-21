export function resolveTargets(scene, target) {
    if (!scene || !target) return [];

    if (Array.isArray(target)) {
        return [...new Set(target.flatMap(item => resolveTargets(scene, item)))];
    }

    if (typeof target === 'string') {
        return scene.meshes.filter(mesh => mesh.name === target);
    }

    if (target instanceof RegExp) {
        return scene.meshes.filter(mesh => {
            target.lastIndex = 0;
            return target.test(mesh.name);
        });
    }

    if (target.getChildMeshes) {
        return [target, ...target.getChildMeshes(false)];
    }

    return [];
}