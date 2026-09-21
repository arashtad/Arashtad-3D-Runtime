export function navigateTo(target, options = {}) {
    if (!target) return;

    const scene = target.getScene?.();

    if (!scene) return;

    const camera = scene.activeCamera;

    if (!camera) return;

    if (options.position) {
        camera.position.copyFrom(options.position);
    }

    if (options.target) {
        if (typeof camera.setTarget === 'function') {
            camera.setTarget(options.target);
        } else {
            camera.target = options.target;
        }
    }

    if (options.radius !== undefined && 'radius' in camera) {
        camera.radius = Number(options.radius);
    }

    if (options.alpha !== undefined && 'alpha' in camera) {
        camera.alpha = Number(options.alpha);
    }

    if (options.beta !== undefined && 'beta' in camera) {
        camera.beta = Number(options.beta);
    }

    return camera;
}