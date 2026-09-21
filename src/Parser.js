export function parseValue(value, context = {}) {
    const names = Object.keys(context);
    const values = Object.values(context);

    return new Function(
        ...names,
        `return (${value})`
    )(...values);
}