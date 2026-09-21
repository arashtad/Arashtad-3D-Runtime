const controls = new WeakMap();

export function enableTouchControls(element, options = {}) {
    if (!element || controls.has(element)) {
        return;
    }

    const state = {
        touches: new Map(),
        options: {
            preventScroll: options.preventScroll ?? true,
            doubleTapDelay: options.doubleTapDelay ?? 300,
            longPressDelay: options.longPressDelay ?? 500
        },
        lastTap: 0,
        longPressTimer: null
    };

    const onTouchStart = event => {
        if (state.options.preventScroll) {
            event.preventDefault();
        }

        for (const touch of event.changedTouches) {
            state.touches.set(touch.identifier, {
                x: touch.clientX,
                y: touch.clientY,
                startX: touch.clientX,
                startY: touch.clientY
            });
        }

        if (event.touches.length === 1) {
            state.longPressTimer = setTimeout(() => {
                element.dispatchEvent(
                    new CustomEvent('touchlongpress', {
                        detail: {
                            touch: event.touches[0]
                        }
                    })
                );
            }, state.options.longPressDelay);
        }
    };

    const onTouchMove = event => {
        if (state.options.preventScroll) {
            event.preventDefault();
        }

        for (const touch of event.changedTouches) {
            const previous = state.touches.get(touch.identifier);

            if (!previous) {
                continue;
            }

            const detail = {
                touch,
                x: touch.clientX,
                y: touch.clientY,
                deltaX: touch.clientX - previous.x,
                deltaY: touch.clientY - previous.y,
                startX: previous.startX,
                startY: previous.startY,
                touches: event.touches.length
            };

            previous.x = touch.clientX;
            previous.y = touch.clientY;

            element.dispatchEvent(
                new CustomEvent('touchmove3d', {
                    detail
                })
            );
        }

        clearTimeout(state.longPressTimer);
    };

    const onTouchEnd = event => {
        if (state.options.preventScroll) {
            event.preventDefault();
        }

        clearTimeout(state.longPressTimer);

        for (const touch of event.changedTouches) {
            state.touches.delete(touch.identifier);
        }

        if (event.touches.length === 0) {
            const now = Date.now();

            if (
                now - state.lastTap <=
                state.options.doubleTapDelay
            ) {
                element.dispatchEvent(
                    new CustomEvent('touchdoubletap', {
                        detail: {
                            touch: event.changedTouches[0]
                        }
                    })
                );

                state.lastTap = 0;
            } else {
                state.lastTap = now;
            }
        }
    };

    const onTouchCancel = event => {
        clearTimeout(state.longPressTimer);

        for (const touch of event.changedTouches) {
            state.touches.delete(touch.identifier);
        }
    };

    element.addEventListener(
        'touchstart',
        onTouchStart,
        { passive: false }
    );

    element.addEventListener(
        'touchmove',
        onTouchMove,
        { passive: false }
    );

    element.addEventListener(
        'touchend',
        onTouchEnd,
        { passive: false }
    );

    element.addEventListener(
        'touchcancel',
        onTouchCancel,
        { passive: false }
    );

    controls.set(element, {
        state,
        onTouchStart,
        onTouchMove,
        onTouchEnd,
        onTouchCancel
    });
}

export function disableTouchControls(element) {
    const control = controls.get(element);

    if (!control) {
        return;
    }

    element.removeEventListener(
        'touchstart',
        control.onTouchStart
    );

    element.removeEventListener(
        'touchmove',
        control.onTouchMove
    );

    element.removeEventListener(
        'touchend',
        control.onTouchEnd
    );

    element.removeEventListener(
        'touchcancel',
        control.onTouchCancel
    );

    clearTimeout(control.state.longPressTimer);

    controls.delete(element);
}

export function enableTouchControlsForAll(
    selector = '.canvas-wrapper'
) {
    document.querySelectorAll(selector).forEach(element => {
        enableTouchControls(element);
    });
}

export function disableTouchControlsForAll(
    selector = '.canvas-wrapper'
) {
    document.querySelectorAll(selector).forEach(element => {
        disableTouchControls(element);
    });
}