import { resolveReference } from './Registry.js';

const constraintBuilders = {
    BALL_AND_SOCKET: buildBallAndSocket,
    HINGE: buildHinge,
    DISTANCE: buildDistance,
    SLIDER: buildSlider,
    '6DOF': buildSixDof
};

function parseVector(value, fallback) {
    if (value == null || value === '') return fallback;

    const parts = String(value).split(',').map(part => Number(part.trim()));

    if (parts.length !== 3 || parts.some(Number.isNaN)) {
        return fallback;
    }

    return new BABYLON.Vector3(parts[0], parts[1], parts[2]);
}

export function createJoint(element, parentBody, scene) {
    const type = (element.getAttribute('type') || 'BALL_AND_SOCKET').toUpperCase();
    const otherId = element.getAttribute('body');

    if (!otherId) {
        throw new Error('<arashtad-joint> requires a body attribute');
    }

    const otherMesh = resolveReference(otherId);
    const otherBody = otherMesh?.metadata?.physicsAggregate?.body;

    if (!otherBody) {
        throw new Error(`Unable to resolve joint body: ${otherId}`);
    }

    const pivotSelf = parseVector(
        element.getAttribute('pivot'),
        BABYLON.Vector3.Zero()
    );

    const pivotOther = parseVector(
        element.getAttribute('pivotOther'),
        BABYLON.Vector3.Zero()
    );

    const axis = parseVector(
        element.getAttribute('axis'),
        BABYLON.Vector3.Up()
    );

    const collision = element.getAttribute('collision') === 'true';

    const builder = constraintBuilders[type];

    if (!builder) {
        throw new Error(`Unknown joint type: ${type}`);
    }

    const joint = builder({
        element,
        pivotSelf,
        pivotOther,
        axis,
        collision,
        scene
    });

    parentBody.addConstraint(otherBody, joint);

    return joint;
}

function buildBallAndSocket({ pivotSelf, pivotOther, collision, scene }) {
    const options = {
        pivotA: pivotSelf,
        pivotB: pivotOther,
        axisA: BABYLON.Vector3.Right(),
        axisB: BABYLON.Vector3.Right(),
        collision
    };

    if (typeof BABYLON.BallAndSocketConstraint === 'function') {
        return new BABYLON.BallAndSocketConstraint(
            pivotSelf,
            pivotOther,
            options.axisA,
            options.axisB,
            scene
        );
    }

    /*
     * Fallback to 6DOF with three angular axes locked and three linear
     * axes free — equivalent to a spherical joint.
     */
    return new BABYLON.Physics6DoFConstraint(
        options,
        [
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_X, minLimit: 0, maxLimit: 0 },
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_Y, minLimit: 0, maxLimit: 0 },
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_Z, minLimit: 0, maxLimit: 0 },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_X, minLimit: null, maxLimit: null },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_Y, minLimit: null, maxLimit: null },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_Z, minLimit: null, maxLimit: null }
        ],
        scene
    );
}

function buildHinge({ pivotSelf, pivotOther, axis, collision, scene }) {
    /*
     * Babylon's HingeConstraint constructor varies between versions. The
     * most reliable form uses a 6DOF with two angular axes locked and
     * one angular axis free plus three linear axes locked.
     */
    const limits = [];

    const angularAxes = ['ANGULAR_X', 'ANGULAR_Y', 'ANGULAR_Z'];
    const lockedAxis = axisDominantIndex(axis);
    const freeAngular = angularAxes[lockedAxis];

    for (const name of angularAxes) {
        if (name === freeAngular) {
            limits.push({
                axis: BABYLON.PhysicsConstraintAxis[name],
                minLimit: null,
                maxLimit: null
            });
        } else {
            limits.push({
                axis: BABYLON.PhysicsConstraintAxis[name],
                minLimit: 0,
                maxLimit: 0
            });
        }
    }

    for (const name of ['LINEAR_X', 'LINEAR_Y', 'LINEAR_Z']) {
        limits.push({
            axis: BABYLON.PhysicsConstraintAxis[name],
            minLimit: 0,
            maxLimit: 0
        });
    }

    return new BABYLON.Physics6DoFConstraint(
        {
            pivotA: pivotSelf,
            pivotB: pivotOther,
            axisA: axis,
            axisB: axis,
            collision
        },
        limits,
        scene
    );
}

function buildDistance({ pivotSelf, pivotOther, collision, element, scene }) {
    const distance = Number(element.getAttribute('distance') ?? 1);
    const min = Number(element.getAttribute('min') ?? distance);
    const max = Number(element.getAttribute('max') ?? distance);

    return new BABYLON.Physics6DoFConstraint(
        {
            pivotA: pivotSelf,
            pivotB: pivotOther,
            axisA: BABYLON.Vector3.Right(),
            axisB: BABYLON.Vector3.Right(),
            collision
        },
        [
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_X, minLimit: null, maxLimit: null },
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_Y, minLimit: null, maxLimit: null },
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_Z, minLimit: null, maxLimit: null },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_X, minLimit: min, maxLimit: max },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_Y, minLimit: min, maxLimit: max },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_Z, minLimit: min, maxLimit: max }
        ],
        scene
    );
}

function buildSlider({ element, pivotSelf, pivotOther, axis, collision, scene }) {
    const min = Number(element.getAttribute('min') ?? -1);
    const max = Number(element.getAttribute('max') ?? 1);

    return new BABYLON.Physics6DoFConstraint(
        {
            pivotA: pivotSelf,
            pivotB: pivotOther,
            axisA: axis,
            axisB: axis,
            collision
        },
        [
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_X, minLimit: 0, maxLimit: 0 },
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_Y, minLimit: 0, maxLimit: 0 },
            { axis: BABYLON.PhysicsConstraintAxis.ANGULAR_Z, minLimit: 0, maxLimit: 0 },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_X, minLimit: min, maxLimit: max },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_Y, minLimit: min, maxLimit: max },
            { axis: BABYLON.PhysicsConstraintAxis.LINEAR_Z, minLimit: min, maxLimit: max }
        ],
        scene
    );
}

function buildSixDof({ element, pivotSelf, pivotOther, axis, collision, scene }) {
    const limits = [];

    const axisNames = [
        'LINEAR_X', 'LINEAR_Y', 'LINEAR_Z',
        'ANGULAR_X', 'ANGULAR_Y', 'ANGULAR_Z'
    ];

    for (const name of axisNames) {
        const spec = element.querySelector(
            `arashtad-limit[axis="${name}"]`
        );

        if (!spec) {
            limits.push({
                axis: BABYLON.PhysicsConstraintAxis[name],
                minLimit: null,
                maxLimit: null
            });

            continue;
        }

        limits.push({
            axis: BABYLON.PhysicsConstraintAxis[name],
            minLimit: spec.hasAttribute('min') ? Number(spec.getAttribute('min')) : null,
            maxLimit: spec.hasAttribute('max') ? Number(spec.getAttribute('max')) : null
        });
    }

    return new BABYLON.Physics6DoFConstraint(
        {
            pivotA: pivotSelf,
            pivotB: pivotOther,
            axisA: axis,
            axisB: axis,
            collision
        },
        limits,
        scene
    );
}

function axisDominantIndex(vector) {
    const abs = [Math.abs(vector.x), Math.abs(vector.y), Math.abs(vector.z)];
    const max = Math.max(...abs);

    if (max === abs[0]) return 0;
    if (max === abs[1]) return 1;

    return 2;
}