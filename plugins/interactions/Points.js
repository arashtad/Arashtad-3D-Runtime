const points = new Set();

export function createPoint(scene, position, options = {}) {
    const diameter = Number(options.diameter ?? 0.05);
    const point = BABYLON.MeshBuilder.CreateSphere(options.name ?? 'interaction-point', { diameter }, scene);

    point.position.copyFrom(position);

    if (options.material) {
        point.material = options.material;
    }

    points.add(point);

    return point;
}

export function removePoint(point) {
    if (!point) return;

    points.delete(point);
    point.dispose();
}

export function clearPoints() {
    for (const point of points) {
        point.dispose();
    }

    points.clear();
}