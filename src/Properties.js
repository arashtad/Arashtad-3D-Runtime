import { definitions } from './Definitions.js';
import { parseValue } from './Parser.js';
import { resolveReference } from './Registry.js';

function resolveProperty(object, name, allowed = []) {
    for (
        let current = object;
        current;
        current = Object.getPrototypeOf(current)
    ) {
        const property = Object.getOwnPropertyNames(current).find(
            key => key.toLowerCase() === name.toLowerCase()
        );

        if (property) return property;
    }

    for (const key of Reflect.ownKeys(object)) {
        if (
            typeof key === 'string' &&
            key.toLowerCase() === name.toLowerCase()
        ) {
            return key;
        }
    }

    return allowed.find(
        key => key.toLowerCase() === name.toLowerCase()
    ) ?? null;
}

function resolveNestedProperty(object, name) {
    const parts = name.split('.');
    let target = object;

    for (let i = 0; i < parts.length - 1; i++) {
        let property = null;

        for (
            let current = target;
            current;
            current = Object.getPrototypeOf(current)
        ) {
            property = Object.getOwnPropertyNames(current).find(
                key => key.toLowerCase() === parts[i].toLowerCase()
            );

            if (property) break;
        }

        if (!property || target[property] == null) {
            return null;
        }

        target = target[property];
    }

    const finalName = parts[parts.length - 1];

    let property = null;

    for (
        let current = target;
        current;
        current = Object.getPrototypeOf(current)
    ) {
        property = Object.getOwnPropertyNames(current).find(
            key => key.toLowerCase() === finalName.toLowerCase()
        );

        if (property) break;
    }

    if (!property) {
        return null;
    }

    return {
        target,
        property
    };
}

export function applyProperties(
    object,
    element,
    excluded = [],
    context = {}
) {
    const type = element.getAttribute('type');
    const allowed = definitions[type]?.properties || [];

    const attributes = Array.from(element.attributes);

    // First pass: normal properties.
    // This ensures properties such as useAutoRotationBehavior
    // are initialized before nested properties are processed.
    for (const attribute of attributes) {
        const name = attribute.name;

        if (
            excluded.includes(name) ||
            name.includes('.')
        ) {
            continue;
        }

        const property = resolveProperty(object, name, allowed);

        if (!property) continue;

        const reference = resolveReference(attribute.value);

        object[property] =
            reference ?? parseValue(attribute.value, context);
    }

    // Second pass: nested properties.
    for (const attribute of attributes) {
        const name = attribute.name;

        if (
            excluded.includes(name) ||
            !name.includes('.')
        ) {
            continue;
        }

        const nested = resolveNestedProperty(object, name);

        if (!nested) {
            console.warn(
                `Unable to resolve nested property "${name}"`,
                object
            );
            continue;
        }

        const reference = resolveReference(attribute.value);

        nested.target[nested.property] =
            reference ?? parseValue(attribute.value, context);
    }
}
