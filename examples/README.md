# Arashtad 3D Runtime Examples

A comprehensive collection of practical examples for **Arashtad 3D Runtime** and its plugins.

This repository serves simultaneously as:

- Documentation
- API reference
- Integration test suite
- Feature showcase
- Learning resource
- Production-oriented reference
- Demonstration of what can be built with Arashtad 3D Runtime

The examples progress from the simplest possible scene to complete, application-level 3D experiences.

There is **no fixed number of examples**. Examples are added whenever necessary to properly demonstrate a runtime feature, API, property, combination, or practical use case.

---

## What Is Arashtad 3D Runtime?

**Arashtad 3D Runtime** is a declarative Babylon.js runtime for building interactive 3D scenes using HTML.

Instead of creating every object through JavaScript, scene elements can be declared directly in HTML:

```html
<canvas id="scene">

    <arashtad-camera
        type="ArcRotateCamera"
        alpha="1.57"
        beta="1.2"
        radius="10"
        target="new BABYLON.Vector3(0, 0, 0)">
    </arashtad-camera>

    <arashtad-light
        type="HemisphericLight"
        direction="new BABYLON.Vector3(0, 1, 0)">
    </arashtad-light>

    <arashtad-mesh
        type="Box"
        id="box"
        size="2">
    </arashtad-mesh>

</canvas>
```

The runtime converts these declarations into Babylon.js objects and manages their relationships, properties, events, loading, rendering, physics, shadows, and other supported functionality.

JavaScript remains available for application logic, runtime APIs, events, and plugins.

## Project Goals

These examples are designed to be much more than visual demonstrations.

**The collection is intended to provide:**

- A practical documentation system
- A working API reference
- A regression and integration test suite
- A feature-by-feature demonstration
- Progressive learning material
- Real implementation patterns
- Production-oriented application examples

Every example should demonstrate something that actually exists in the runtime or plugin implementation.

The examples are built against the real APIs rather than hypothetical or conceptual APIs.

Example Philosophy
Start Simple

When a new feature is introduced, the first example demonstrates the simplest meaningful use of that feature.

## Progressively Increase Complexity

### Later examples introduce:

- Additional properties
- Multiple objects
- References
- Parent/child relationships
- Events
- JavaScript
- Multiple features
- Plugin integration
- Complete application patterns

**Example Progression**

The collection follows this general progression:

Basic Scene & Runtime
        ↓
Cameras
        ↓
Lights
        ↓
Models
        ↓
Meshes
        ↓
Materials
        ↓
Particle Systems
        ↓
GUI
        ↓
Environment
        ↓
Events & Actions
        ↓
Shadows
        ↓
Physics
        ↓
Generic Runtime Construction
        ↓
Runtime Integration & API
        ↓
Plugin System
        ↓
Models Plugin
        ↓
Lazy Loading Plugin
        ↓
Scroll Lock Plugin
        ↓
Touch Controls Plugin
        ↓
Interactions Plugin
        ↓
Plugin Combinations
        ↓
Production Examples

The exact number and grouping of examples may grow as the runtime evolves.

## Runtime Features Covered

The runtime examples progressively cover the supported functionality, including:

- Canvas and scene initialization
- Runtime configuration
- Canvas resizing
- Loading progress
- Loading errors
- JavaScript expressions
- Object references
- Constructor arguments
- Generic properties
- Nested properties
- Parent/child relationships
- Cameras
- Lights
- Models
- Meshes
- Materials
- Particle systems
- GUI
- Environments
- Events
- Actions
- Shadows
- Physics
- Runtime JavaScript API
- Cameras

**The currently explicitly supported camera types are:**

- UniversalCamera
- FreeCamera
- ArcRotateCamera

Each camera type is introduced through a basic example and a full configuration example.

**Additional examples demonstrate:**

- Multiple cameras
- Camera references
- Camera properties
- Nested camera properties
- Cameras with models
- Cameras with multiple models
- Camera-related events
- Advanced camera scenes
- Lights

The currently explicitly supported light types are:

- HemisphericLight
- DirectionalLight

Each light type is introduced through a basic example and a full configuration example.

**Additional examples demonstrate:**

- Multiple lights
- Light references
- Light properties
- Lights with meshes
- Lights with materials
- Lights with shadows
- Advanced lighting scenes
- Models

Model examples cover the complete runtime model-loading workflow.

### Topics include:

- Basic model loading
- Multiple models
- Model IDs
- Model references
- Loading progress
- Loading errors
- Model roots
- Imported mesh registration
- Model metadata
- Animation groups
- Animation playback
- Animation selection
- Animation speed
- Multiple animated models
- Advanced model scenes

The runtime also provides model information through the plugin system.

## Meshes

The runtime provides declarative access to Babylon.js MeshBuilder.

**Examples cover supported MeshBuilder-based scene construction, including:**

- Box
- Sphere
- Plane
- Ground
- Cylinder
- Disc
- Torus
- Torus Knot
- Lines
- Tube
- Polygon
- Lathe
- Extrusion
- Ribbon
- Other mesh types available from the loaded Babylon.js MeshBuilder API

**Advanced mesh examples demonstrate:**

- IDs
- References
- Position
- Rotation
- Scaling
- Visibility
- Enabled state
- Rendering properties
- Parenting
- Materials
- Nested properties
- Constructor options
- Multiple meshes
- Mesh composition
- Materials

**Material examples demonstrate:**

- Material creation
- Material references
- Material assignment
- Material properties
- Nested properties
- Multiple materials
- Materials across multiple meshes
- Advanced material scenes
- Particle Systems

**Particle examples cover:**

- ParticleSystem creation
- Capacity
- Particle textures
- ParticleSystem properties
- Multiple particle systems
- Particle systems with lights
- Particle systems with models
- Advanced particle scenes
- GUI

**The runtime currently provides dedicated GUI creation for:**

AdvancedDynamicTexture
Button

**Examples demonstrate:**

- Basic GUI creation
- GUI buttons
- Button text
- GUI properties
- GUI parenting
- Multiple GUI controls
- Runtime references
- GUI and scene integration
- Advanced GUI scenes
- Environment

**Environment examples cover:**

- Basic environments
- HDR environments
- Prefiltered environments
- Environment intensity
- Environment background
- Environment background blur
- Environment rotation
- Environments without displayed backgrounds
- Environments with models
- Environments with lighting
- Advanced environment scenes

The runtime supports .hdr environments and Babylon.js prefiltered environment data.

## Events & Actions

The runtime provides several ways to connect scene behavior to JavaScript.

**Examples cover:**

- Immediate actions
- Native canvas DOM events
- Pointer observables
- Babylon observables
- Babylon ActionManager triggers
- Action targets
- Runtime references
- Scene access
- Babylon.js access
- Event data
- Imported model meshes
- Multiple events
- Multiple actions

**Runtime action code has access to:**

- target
- scene
- BABYLON
- refs
- event
- meshes
- mesh
- Shadows

**Shadow examples cover:**

- Shadow creation
- Shadow generators
- Shadow map size
- Shadow darkness
- Light shadow properties
- Shadow casters
- Shadow receivers
- Multiple casters
- Multiple receivers
- Multiple shadow generators
- Shadows with multiple lights
- Advanced shadow scenes
- Physics

Physics examples demonstrate the runtime's Havok integration.

**Topics include:**

- Havok initialization
- Physics aggregates
- Physics shape types
- Physics options
- Static bodies
- Dynamic bodies
- Kinematic bodies
- Linear velocity
- Angular velocity
- Impulses
- Forces
- Contact positions
- Motion types
- Collision start events
- Collision end events
- Multiple collision types
- Multiple physics objects
- Physics with meshes
- Physics with models
- Physics with actions
- Advanced physics scenes
- Generic Runtime Construction

The runtime includes generic Babylon.js and Babylon.GUI constructor resolution.

**Examples demonstrate:**

- Generic Babylon constructors
- Constructor arguments
- Generic GUI constructors
- References
- Properties
- JavaScript expressions
- Parent relationships
- Material assignment
- Advanced generic runtime construction
- Runtime JavaScript API

The runtime exposes a small public JavaScript API.
```javascript
import {
    ready,
    loadModel
} from './lib/arashtad/arashtad-3d-runtime.1.0.0.min.js';
ready()

Initializes a canvas and returns its Babylon.js scene.

const scene = await ready(canvas);
```

**Examples demonstrate:**

- Basic initialization
- Scene retrieval
- Scene caching
- Repeated initialization
- Declarative scene + JavaScript integration
- loadModel()

Loads a model into an existing runtime scene.
```javascript
await loadModel(scene, url, id);
```

**Examples demonstrate:**

- Basic programmatic model loading
- Custom model IDs
- Model registry integration
- Model animation
- Multiple models
- Programmatic + declarative scene integration
- Plugins

After the runtime itself has been covered, the examples move to the plugin system.

Currently implemented plugins are:

* Models
* Lazy Loading
* Scroll Lock
* Touch Controls
* Interactions

**The repository also contains plugin modules reserved for future functionality:**

* Cameras
* Materials
* Animations
* Scene
* Hotspots
* AR
* Annotations

Reserved modules are not documented as implemented features until functionality actually exists.

## Models Plugin

The Models plugin provides access to information registered for loaded models.

**Available APIs:**

- getModelData(id)
- getModelMeshes(id)
- getModelAnimations(id)
- getModelSkeletons(id)
- getModelParticleSystems(id)

Examples demonstrate how these APIs can be used with runtime scenes and other plugins.

## Lazy Loading Plugin

The Lazy Loading plugin uses IntersectionObserver to delay initialization until an element approaches the viewport.

API:
```javascript
enableLazyLoading(element, callback, options)
```

**Supported functionality includes:**

- Intersection-based loading
- Custom rootMargin
- Loading callbacks
- Multiple lazy-loaded scenes
- Integration with models
- Integration with interactions

**Default rootMargin:**

- 500px
- Scroll Lock Plugin

The Scroll Lock plugin controls page scrolling while interacting with 3D canvases.

**APIs:**

- enableScrollLock()
- disableScrollLock()

It targets:
```javascript
.canvas-wrapper.scrolllock
```

and prevents:

- wheel
- mousewheel

scrolling.

## Touch Controls Plugin

The Touch Controls plugin provides touch-specific interaction behavior.

**APIs:**

- enableTouchControls(element, options)
- disableTouchControls(element)

- enableTouchControlsForAll(selector)
- disableTouchControlsForAll(selector)

**Supported behavior includes:**

- Touch movement
- Scroll prevention
- Double tap
- Long press
- 3D touch movement
- Multiple canvas support

**Custom events include:**

- touchlongpress
- touchmove3d
- touchdoubletap

**Default options:**

- preventScroll: true
- doubleTapDelay: 300
- longPressDelay: 500
- Interactions Plugin

The Interactions plugin provides application-level interaction functionality for Babylon.js scenes.

**Initialize it with:**
```javascript
const interactions = enableInteractions(scene, canvas);
```

**It provides:**

- Raycasting
- Picking
- Pointer events
- Mesh targeting
- Regular-expression targeting
- Hierarchy targeting
- Event binding
- Event unbinding
- Highlighting
- Information cards
- Camera navigation
- Interaction points
- Built-in actions
- Custom JavaScript actions
- Configuration-driven bindings

The Interactions plugin is separate from the runtime's core declarative scene engine.

## Interaction Events

**Supported interaction events:**

- pick
- pointerover
- pointerout
- pointermove
- pointerdown
- pointerup

**The plugin also emits canvas custom events:**

- interaction:pick
- interaction:pointerover
- interaction:pointerout
- interaction:pointermove
- interaction:pointerdown
- interaction:pointerup
- Interaction Targets

**Targets can be:**

- Babylon meshes/nodes
- Exact mesh names
- Multiple meshes with the same name
- Regular expressions
- Arrays of targets
- Mesh hierarchies
- Interaction Actions

**Built-in actions include:**

- highlight
- unhighlight
- card
- hideCard
- navigate
- point

Actions can also be custom JavaScript functions.

Repository Structure

The exact structure may evolve as the example collection grows.

A typical structure is:
```text
examples/
├── index.php
├── assets/
├── examples/
│   ├── 01-basic-scene/
│   ├── 02-canvas/
│   ├── 03-basic-runtime/
│   └── ...
├── lib/
│   ├── arashtad/
│   └── babylon/
└── README.md
```

## Running the Examples

The examples require a web server.

For local development, PHP's built-in server can be used:
```bash
php -S localhost:8000
```

Then open:
```bash
http://localhost:8000/
```

The examples should not be opened directly with:
```bash
file://
```

because browser module loading and other runtime functionality require an HTTP(S) origin.

## Babylon.js

Arashtad 3D Runtime is built on Babylon.js.

The examples use the Babylon.js files bundled with the project rather than relying on a CDN.

**This keeps the examples:**

- Self-contained
- Reproducible
- Version-controlled
- Independent of external CDN availability
- Development

The example collection is intended to remain synchronized with the runtime and plugins.

**When functionality changes:**

- Update affected examples.
- Add examples for newly introduced capabilities.
- Verify existing examples against the current implementation.
- Update documentation where behavior changes.
- Keep examples focused on the actual supported API.

Examples must not document functionality that the current runtime or plugin implementation does not provide.

Testing

The example collection also functions as a practical integration test suite.

**Examples should be checked for:**

- Correct runtime initialization
- Correct HTML structure
- Correct JavaScript integration
- Correct asset loading
- Correct Babylon.js behavior
- Correct plugin behavior
- Browser console errors
- Loading failures
- Interaction failures
- Responsive canvas behavior

A feature is properly demonstrated only when its example works against the current implementation.

Contributing

**When adding an example:**

- Identify the runtime or plugin feature being demonstrated.
- Make the first example for a feature as simple as possible.
- Introduce additional properties progressively.
- Avoid combining unrelated features prematurely.
- Use the actual runtime or plugin APIs.
- Keep the example focused and reproducible.
- Update the example index.
- Update documentation when necessary.

Do not add speculative or undocumented APIs to examples.

License

Arashtad 3D Runtime is released under the `MIT License`.

See the LICENSE file for the complete license text.

`Arashtad`

`Arashtad` is an independent software project focused on practical 3D technologies for the web.

`Arashtad 3D Runtime` provides the foundation for declarative `Babylon.js` scenes.

Its plugins provide higher-level functionality for building interactive 3D applications.

This repository brings the two together through working examples that function as documentation, integration tests, API references, and production-oriented demonstrations.