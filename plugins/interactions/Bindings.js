import { executeAction } from './Actions.js';

const bindings = new WeakMap();

export function createBinding(interactions, targets, config = {}) {
    if (!targets || !config) return null;

    const meshes = Array.isArray(targets) ? targets : [targets];
    const handlers = {};

    for (const [event, action] of Object.entries(config)) {
        if (event === 'target') {
            continue;
        }

        handlers[event] = context => {
            return executeAction(action, {
                ...context,
                interactions
            });
        };
    }

    if (!Object.keys(handlers).length) return null;

    for (const mesh of meshes) {
        for (const [event, handler] of Object.entries(handlers)) {
            interactions.on(mesh, event, handler);
        }
    
        if (!bindings.has(mesh)) {
            bindings.set(mesh, []);
        }
    
        bindings.get(mesh).push({
            interactions,
            handlers
        });
    }

    return {
        meshes,

        destroy() {
            for (const mesh of meshes) {
                const records = bindings.get(mesh);

                if (!records) continue;

                const index = records.findIndex(record => record.handlers === handlers);

                if (index !== -1) {
                    const record = records[index];

                    for (const [event, handler] of Object.entries(record.handlers)) {
                        record.interactions.unbind(mesh, event, handler);
                    }

                    records.splice(index, 1);
                }

                if (!records.length) {
                    bindings.delete(mesh);
                }
            }
        }
    };
}

export function removeBindings(mesh) {
    const records = bindings.get(mesh);

    if (!records) return;

    for (const record of records) {
        for (const [event, handler] of Object.entries(record.handlers)) {
            record.interactions.unbind(mesh, event, handler);
        }
    }

    bindings.delete(mesh);
}

export const removeBinding = removeBindings;