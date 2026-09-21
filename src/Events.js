import { executeActions } from './ActionHandler.js';
import { resolveReference } from './Registry.js';
import { getRuntimeTag } from './Tags.js';

export function bindEvents(target, element, modelMeshes = []) {
    const targetName =
        getRuntimeTag(element) === 'action'
            ? element.getAttribute('target')
            : null;

    if (targetName) {
        target = resolveReference(targetName);

        if (!target) {
            throw new Error(
                `Unknown target: ${targetName}`
            );
        }
    }

    const scene = target.getScene?.();
    const canvas =
        scene?.getEngine()?.getRenderingCanvas();

    /*
     * Immediate action
     *
     * <action execute="...">
     */
    if (
        getRuntimeTag(element) === 'action' &&
        element.hasAttribute('execute')
    ) {
        executeActions(
            target,
            element.getAttribute('execute'),
            scene,
            null,
            modelMeshes
        );
    }

    for (const attribute of element.attributes) {
        const name = attribute.name;
        const lowerName = name.toLowerCase();
        const value = attribute.value;

        /*
         * Native JavaScript / DOM events
         */
        if (lowerName.startsWith('on-')) {
            const eventName = name.slice(3);

            if (!canvas) continue;

            canvas.addEventListener(
                eventName,
                event => {
                    executeActions(
                        target,
                        value,
                        scene,
                        event,
                        modelMeshes
                    );
                }
            );

            continue;
        }

        /*
         * Babylon GUI observables
         */
        if (
            lowerName.startsWith('onpointer') &&
            !lowerName.endsWith('trigger')
        ) {
            let observableName = null;
            let current = target;

            while (current && !observableName) {
                observableName =
                    Object.getOwnPropertyNames(current)
                        .find(
                            key =>
                                key.toLowerCase() ===
                                `${lowerName}observable`
                        );

                current =
                    Object.getPrototypeOf(current);
            }

            if (
                observableName &&
                target[observableName]?.add
            ) {
                target[observableName].add(
                    event => {
                        executeActions(
                            target,
                            value,
                            scene,
                            event,
                            modelMeshes
                        );
                    }
                );
            }

            continue;
        }

        /*
         * Babylon ActionManager triggers
         */
        const triggerName =
            Object.keys(BABYLON.ActionManager)
                .find(
                    key =>
                        key.toLowerCase() ===
                        lowerName
                );

        if (!triggerName) continue;

        const trigger =
            BABYLON.ActionManager[triggerName];

        target.actionManager ??=
            new BABYLON.ActionManager(scene);

        target.actionManager.registerAction(
            new BABYLON.ExecuteCodeAction(
                trigger,
                event => {
                    executeActions(
                        target,
                        value,
                        scene,
                        event,
                        modelMeshes
                    );
                }
            )
        );
    }
}