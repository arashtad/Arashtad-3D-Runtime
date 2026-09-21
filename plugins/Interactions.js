import { initializeEvents, destroyEvents } from './interactions/Events.js';
import { raycast, raycastMesh, raycastPoint } from './interactions/Raycast.js';
import { highlight, unhighlight, clearHighlights } from './interactions/Highlight.js';
import { showCard, hideCard } from './interactions/Cards.js';
import { navigateTo } from './interactions/Navigation.js';
import { createPoint, removePoint, clearPoints } from './interactions/Points.js';
import { createBinding, removeBindings } from './interactions/Bindings.js';
import { resolveTargets } from './interactions/Targets.js';

const instances = new WeakMap();

export function enableInteractions(scene, canvas) {
    if (!scene || !canvas) {
        throw new Error('Interactions: scene and canvas are required.');
    }

    if (instances.has(scene)) {
        return instances.get(scene);
    }

    const events = initializeEvents(scene, canvas);

    const instance = {
        scene,
        canvas,

        raycast(x, y, predicate = null) {
            return raycast(scene, x, y, predicate);
        },

        raycastMesh(x, y) {
            return raycastMesh(scene, x, y);
        },

        raycastPoint(x, y) {
            return raycastPoint(scene, x, y);
        },

        highlight(mesh, options = {}) {
            return highlight(mesh, options);
        },

        unhighlight(mesh) {
            return unhighlight(mesh);
        },

        clearHighlights() {
            return clearHighlights(scene);
        },

        showCard(mesh, content, options = {}) {
            return showCard(mesh, content, options);
        },

        hideCard(mesh) {
            return hideCard(mesh);
        },

        navigateTo(target, options = {}) {
            return navigateTo(target, options);
        },

        createPoint(position, options = {}) {
            return createPoint(scene, position, options);
        },
        
        removePoint(point) {
            return removePoint(point);
        },
        
        clearPoints() {
            return clearPoints();
        },

        bind(mesh, event, callback) {
            return events.bind(mesh, event, callback);
        },

        bindAll(mesh, handlers) {
            return events.bindAll(mesh, handlers);
        },

        bindName(name, event, callback) {
            return events.bindName(name, event, callback);
        },

        bindNameAll(name, event, callback) {
            return events.bindNameAll(name, event, callback);
        },

        bindNamePattern(pattern, event, callback) {
            return events.bindNamePattern(pattern, event, callback);
        },

        bindHierarchy(root, event, callback) {
            return events.bindHierarchy(root, event, callback);
        },
        
        unbind(mesh, event, callback) {
            return events.unbind(mesh, event, callback);
        },

        unbindAll(mesh, event = null) {
            return events.unbindAll(mesh, event);
        },

        unbindNamePattern(pattern, event = null) {
            return events.unbindNamePattern(pattern, event);
        },

        bindConfig(config = {}) {
            const targets = resolveTargets(scene, config.target);
            return createBinding(this, targets, config);
        },
        
        removeBindings(mesh) {
            return removeBindings(mesh);
        },
        
        unbindHierarchy(root, event = null) {
            return events.unbindHierarchy(root, event);
        },

        resolveTargets(target) {
            return resolveTargets(scene, target);
        },

        on(mesh, event, callback) {
            return events.on(mesh, event, callback);
        },

        onAll(mesh, handlers) {
            return events.onAll(mesh, handlers);
        },

        disable() {
            destroyEvents(scene);
            clearHighlights(scene);
            instances.delete(scene);
        }
    };

    instances.set(scene, instance);

    return instance;
}