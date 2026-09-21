import { resolve } from './Resolver.js';
import { definitions } from './Definitions.js';
import { parseValue } from './Parser.js';
import { getReferences, resolveReference } from './Registry.js';

export function createObject(element, scene) {
    const type = element.getAttribute('type');
    const Type = resolve(type);

    if (!Type) {
        throw new Error(`Unknown Babylon type: ${type}`);
    }

    const argsAttribute = element.getAttribute('args');

    if (argsAttribute) {
        const references = getReferences();

        const context = {
            scene,
            engine: scene.getEngine()
        };

        for (const [name, value] of Object.entries(references)) {
            if (/^[A-Za-z_$][A-Za-z0-9_$]*$/.test(name)) {
                context[name] = value;
            }
        }

        const args = parseValue(`[${argsAttribute}]`, context);

        return new Type(
            element.id || type,
            ...args
        );
    }

    const definition = definitions[type];
    const args = [element.id || type];

    for (const name of definition?.args || []) {
        const value = element.getAttribute(name);

        if (value === null) {
            args.push(undefined);
            continue;
        }

        const reference = resolveReference(value);

        args.push(
            reference ?? parseValue(value, { scene })
        );
    }

    if (definition?.scene !== false) {
        args.push(scene);
    }

    return new Type(...args);
}