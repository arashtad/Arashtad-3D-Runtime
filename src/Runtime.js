
import { processCanvas, loadModel as loadModelElement } from './DOM.js?v=2';

const scenes = new WeakMap();
const pending = new WeakMap();

export function ready(canvas) {
    if (!canvas)
        throw new Error('Runtime: canvas is required.');

    if (scenes.has(canvas))
        return Promise.resolve(scenes.get(canvas));

    if (pending.has(canvas))
        return pending.get(canvas);

    const promise = new Promise((resolve, reject) => {
        const init = async () => {
            try {
                const scene = await processCanvas(canvas);

                if (!scene)
                    throw new Error('Runtime: scene was not created.');

                scenes.set(canvas, scene);
                pending.delete(canvas);

                resolve(scene);
            } catch (error) {
                pending.delete(canvas);
                reject(error);
            }
        };

        if (document.readyState === 'loading')
            document.addEventListener('DOMContentLoaded', init, { once: true });
        else
            init();
    });

    pending.set(canvas, promise);

    return promise;
}

export async function loadModel(scene, url, id = 'runtime-model')
{
    if (!scene)
        throw new Error('Runtime: scene is required.');

    if (!url)
        throw new Error('Runtime: model URL is required.');

    return loadModelElement(scene, url, id);
}