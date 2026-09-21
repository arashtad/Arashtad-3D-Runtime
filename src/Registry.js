const objects = new Map();

export function register(id, object) {
    if (id) objects.set(id, object);
}

export function resolveReference(id) {
    return objects.get(id) ?? null;
}

export function getReferences() {
    return Object.fromEntries(objects);
}

export function registerData(id, data) {
    if (id) {
        objects.set(`${id}:data`, data);
    }
}

export function resolveData(id) {
    return objects.get(`${id}:data`) ?? null;
}

export function clearRegistry() {
    objects.clear();
}