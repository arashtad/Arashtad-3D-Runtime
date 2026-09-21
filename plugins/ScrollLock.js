export function enableScrollLock() {
    document.querySelectorAll('.canvas-wrapper.scrolllock').forEach(wrapper => {
        wrapper.onwheel = function(event) {
            event.preventDefault();
        };

        wrapper.onmousewheel = function(event) {
            event.preventDefault();
        };
    });
}

export function disableScrollLock() {
    document.querySelectorAll('.canvas-wrapper.scrolllock').forEach(wrapper => {
        wrapper.onwheel = null;
        wrapper.onmousewheel = null;
    });
}