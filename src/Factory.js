import { parseValue } from './Parser.js';

export function createFactoryObject(element, scene, namespace) {
    const type = element.getAttribute('type');
    const factory = namespace?.[`Create${type}`];

    if (typeof factory !== 'function') {
        throw new Error(`Unknown factory type: ${type}`);
    }

    const options = {};

    for (const attribute of element.attributes) {
        const { name, value } = attribute;

        if (name === 'type' || name === 'id' || name === 'parent' || name === 'material' || name === 'target' || name.startsWith('on')) continue;

        options[name] = parseValue(value);
    }

    return factory(element.id || type, options, scene);
}