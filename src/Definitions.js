export const definitions = {
    UniversalCamera: {
        args: ['position'],
        scene: true
    },

    FreeCamera: {
        args: ['position'],
        scene: true
    },

    ArcRotateCamera: {
        args: ['alpha', 'beta', 'radius', 'target'],
        scene: true
    },

    HemisphericLight: {
        args: ['direction'],
        scene: true
    },

    DirectionalLight: {
        args: ['direction'],
        scene: true
    },

    SpriteManager: {
        args: ['imgUrl', 'capacity', 'cellSize'],
        scene: true
    },

    Sprite: {
        args: ['manager'],
        scene: false
    },

    ParticleSystem: {
        args: ['capacity'],
        properties: ['particleTexture'],
        scene: true
    }
};