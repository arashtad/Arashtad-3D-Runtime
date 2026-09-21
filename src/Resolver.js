export function resolve(type) {
    return (
        globalThis.BABYLON?.[type] ??
        globalThis.BABYLON?.GUI?.[type] ??
        null
    );
}