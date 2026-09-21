export function executeAction(action, context = {}) {
    if (!action) return;

    if (typeof action === 'function') {
        return action(context);
    }

    if (typeof action !== 'object') {
        return;
    }

    switch (action.type) {
        case 'highlight': {
            const result = context.interactions.highlight(
                context.mesh,
                action.options ?? {}
            );
        
            return result;
        }

        case 'unhighlight':
            return context.interactions.unhighlight(
                context.mesh
            );

        case 'card': {
            const result = context.interactions.showCard(
                context.mesh,
                action.content ?? '',
                action.options ?? {}
            );
        
            return result;
        }

        case 'hideCard':
            return context.interactions.hideCard(
                context.mesh
            );

        case 'navigate':
            return context.interactions.navigateTo(
                action.target ?? context.mesh,
                action.options ?? {}
            );

        case 'point': {
            if (!context.point) {
                return;
            }
        
            return context.interactions.createPoint(
                context.point,
                action.options ?? {}
            );
        }

        default:
            console.warn('Unknown interaction action:', action.type);
    }
}