export function raycast(
    scene,
    x,
    y,
    predicate = null
) {
    if (!scene) {
        return null;
    }

    return scene.pick(
        x,
        y,
        predicate
    );
}

export function raycastMesh(
    scene,
    x,
    y
) {
    const result =
        raycast(scene, x, y);

    return result?.pickedMesh ?? null;
}

export function raycastPoint(
    scene,
    x,
    y
) {
    const result =
        raycast(scene, x, y);

    return result?.pickedPoint ?? null;
}