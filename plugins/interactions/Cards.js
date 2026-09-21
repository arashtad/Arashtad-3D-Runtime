const cards = new Map();

export function showCard(mesh, content, options = {}) {
    if (!mesh) return null;

    hideCard(mesh);

    const card = document.createElement('div');

    card.className =
        options.className ?? 'arashtad-interaction-card';

    card.innerHTML = content;

    card.style.position = 'fixed';
    card.style.left = `${options.x ?? 100}px`;
    card.style.top = `${options.y ?? 100}px`;
    card.style.zIndex = String(options.zIndex ?? 10000);

    document.body.appendChild(card);

    cards.set(mesh, card);

    return card;
}

export function hideCard(mesh) {
    const card = cards.get(mesh);

    if (!card) return;

    card.remove();
    cards.delete(mesh);
}