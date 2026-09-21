const highlights = new WeakMap();

export function highlight(mesh, options = {}) {
    if (!mesh) {
        return null;
    }

    if (highlights.has(mesh)) {
        return highlights.get(mesh);
    }

    const state = {
        renderOutline: mesh.renderOutline,
        outlineColor: mesh.outlineColor?.clone?.() ?? new BABYLON.Color3(1, 1, 1),
        outlineWidth: mesh.outlineWidth ?? 0.02
    };

    mesh.renderOutline = true;
    mesh.outlineColor = options.color ?? new BABYLON.Color3(1, 1, 1);
    mesh.outlineWidth = Number(options.width ?? 1);

    highlights.set(mesh, state);

    return mesh;
}

export function unhighlight(mesh) {
    const state = highlights.get(mesh);

    if (!state) {
        return;
    }

    mesh.renderOutline = state.renderOutline;
    mesh.outlineColor = state.outlineColor;
    mesh.outlineWidth = state.outlineWidth;

    highlights.delete(mesh);
}

export function clearHighlights(scene) {
    if (!scene) {
        return;
    }

    scene.meshes.forEach(mesh => {
        if (highlights.has(mesh)) {
            unhighlight(mesh);
        }
    });
}