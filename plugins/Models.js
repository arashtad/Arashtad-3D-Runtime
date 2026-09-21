import { resolveData } from '../src/Registry.js';

export function getModelData(id) {
    return resolveData(id);
}

export function getModelMeshes(id) {
    return getModelData(id)?.meshes ?? [];
}

export function getModelAnimations(id) {
    return getModelData(id)?.animationGroups ?? [];
}

export function getModelSkeletons(id) {
    return getModelData(id)?.skeletons ?? [];
}

export function getModelParticleSystems(id) {
    return getModelData(id)?.particleSystems ?? [];
}