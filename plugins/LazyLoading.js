const observers = new WeakMap();

export function enableLazyLoading(element, callback, options = {}) {
    if (!element || observers.has(element)) {
        console.log('LAZY TEST: STOPPED');
        return;
    }

    const observer = new IntersectionObserver(
        entries => {
            for (const entry of entries) {
                if (!entry.isIntersecting) {
                    continue;
                }

                observer.disconnect();
                observers.delete(element);

                callback();

                break;
            }
        },
        {
            rootMargin: options.rootMargin ?? '500px',
            threshold: 0
        }
    );

    observers.set(element, observer);
    observer.observe(element);
}