const PREFIX = 'arashtad-';

export function getRuntimeTag(element) {
    const tag = element?.tagName?.toLowerCase() || '';
    return tag.startsWith(PREFIX) ? tag.slice(PREFIX.length) : null;
}

export function runtimeTag(name) {
    return PREFIX + name;
}
