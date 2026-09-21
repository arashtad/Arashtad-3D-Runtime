import { executeActions } from './ActionHandler.js';
import { resolveReference } from './Registry.js';
import { getRuntimeTag } from './Tags.js';

function resolveObservable(object, attributeName) {
    const lowerName = attributeName.toLowerCase();

    for (
        let current = object;
        current;
        current = Object.getPrototypeOf(current)
    ) {
        const property = Object.getOwnPropertyNames(current).find(
            key =>
                key.toLowerCase() === lowerName &&
                current[key] &&
                typeof current[key].add === 'function'
        );

        if (property) {
            return current[property];
        }
    }

    for (const key of Reflect.ownKeys(object)) {
        if (
            typeof key !== 'string' ||
            key.toLowerCase() !== lowerName
        ) {
            continue;
        }

        const observable = object[key];

        if (
            observable &&
            typeof observable.add === 'function'
        ) {
            return observable;
        }
    }

    return null;
}

function isObservableAttribute(target, name) {
    const lowerName = name.toLowerCase();

    if (
        !lowerName.startsWith('on') ||
        !lowerName.endsWith('observable')
    ) {
        return false;
    }

    return !!resolveObservable(target, lowerName);
}

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
     * <arashtad-action execute="...">
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
         *
         * on-click
         * on-wheel
         * on-dblclick
         * on-mouseenter
         * etc.
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
         * Babylon.js Observable
         *
         * Examples:
         *
         * onPointerObservable
         * onPointerDownObservable
         * onPointerUpObservable
         * onBeforeRenderObservable
         * onAfterRenderObservable
         *
         * HTML attributes are case-insensitive, so the lookup
         * resolves the actual Babylon property dynamically.
         */
        if (isObservableAttribute(target, name)) {
            const observable =
                resolveObservable(target, lowerName);

            if (!observable) {
                continue;
            }

            observable.add(
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
         * Babylon ActionManager triggers
         *
         * Examples:
         *
         * OnPickTrigger
         * OnPointerOverTrigger
         * OnPointerOutTrigger
         * etc.
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