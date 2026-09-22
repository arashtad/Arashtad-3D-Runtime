# Arashtad 3D Runtime

**Runtime Version: 1.1.0**
**Plugins Version: 1.0.0**

Arashtad 3D Runtime is a declarative HTML layer for [Babylon.js](https://www.babylonjs.com/) that allows interactive 3D scenes to be described directly in HTML while preserving full access to the underlying Babylon.js scene, objects, APIs, and JavaScript runtime.

Cameras, lights, models, meshes, materials, particle systems, GUI elements, environments, events, actions, shadows, physics, and other supported Babylon.js functionality can be declared through semantic `arashtad-*` elements.

The runtime does not replace Babylon.js. Babylon.js remains the underlying 3D engine and rendering framework.

Arashtad 3D Runtime provides the declarative layer between HTML and Babylon.js while remaining extensible through JavaScript and plugins.

---

## Features

- Declarative 3D scenes using HTML
- Babylon.js integration
- Runtime object references
- JavaScript expressions in attributes
- Runtime constructor resolution
- Babylon.js constructor resolution
- Babylon.GUI constructor resolution
- Supported constructor arguments
- Dynamic object properties
- Nested properties
- Case-insensitive property resolution
- Parent/child relationships
- Material relationships
- Model loading
- Multiple model loading
- Model loading progress
- Model loading error handling
- Imported model mesh registration
- Model roots and metadata
- Model animation information
- Model animation control
- Runtime loading progress
- Environment and HDR support
- Environment intensity
- Environment background control
- Environment background blur
- Environment rotation
- Native DOM events
- Babylon.js observable events
- Babylon.js ActionManager triggers
- Runtime JavaScript actions
- Shadows
- Havok physics integration
- GUI
- Particle systems
- Public JavaScript API
- Plugin architecture
- Local Babylon.js distribution
- No CDN dependency

---

# Architecture

Arashtad 3D Runtime is designed around a simple principle:

> HTML describes the scene, Babylon.js remains the engine, and JavaScript remains available whenever direct control is required.

Conceptually, the runtime sits between declarative HTML and Babylon.js:

```text
                         HTML
                           │
                           ▼
                  Arashtad 3D Runtime
                           │
          ┌────────────────┼────────────────┐
          │                │                │
   Declarative        Core Scene       Runtime API
    Processing         Systems              │
          │                │                │
          └────────────────┼────────────────┘
                           │
                           ▼
                    Babylon.js Scene
                           │
              ┌────────────┴────────────┐
              │                         │
        Core Runtime               Plugin Layer
              │                         │
              └────────────┬────────────┘
                           ▼
                         WebGL
```

The core runtime is responsible for declarative scene construction and core scene processing.

The plugin layer provides higher-level application functionality without requiring those application concepts to become part of the core scene language.

---

# Declarative HTML

A basic scene can be defined directly inside a canvas:

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

The runtime is initialized from JavaScript:

```javascript
import {
    ready
} from './lib/arashtad/arashtad-3d-runtime.1.1.0.min.js';

const canvas = document.getElementById('scene');

const scene = await ready(canvas);
```

Initialization creates or retrieves the runtime associated with the canvas, processes the declarative elements, creates the required Babylon.js objects, establishes relationships, applies properties, binds supported events and actions, and starts rendering.

The returned value is the Babylon.js `Scene`.

---

# Runtime Tags

The runtime recognizes semantic `arashtad-*` elements including:

```
arashtad-runtime
arashtad-camera
arashtad-light
arashtad-model
arashtad-mesh
arashtad-texture
arashtad-gui
arashtad-material
arashtad-particlesystem
arashtad-physics
arashtad-action
arashtad-shadow
arashtad-generator
arashtad-caster
arashtad-receiver
arashtad-velocity
arashtad-impulse
arashtad-force
arashtad-body
arashtad-collision
```

Not every tag represents a standalone Babylon.js object.

Some elements are semantic configuration elements processed by other runtime systems. For example, shadow, physics, action, caster, receiver, velocity, impulse, force, body, and collision elements participate in higher-level runtime processing.

---

# Cameras

The runtime explicitly defines constructor support for:

```javascript
UniversalCamera
FreeCamera
ArcRotateCamera
```

Example:

```html
<arashtad-camera
    type="ArcRotateCamera"
    id="camera"
    alpha="1.57"
    beta="1.2"
    radius="12"
    target="new BABYLON.Vector3(0, 0, 0)">
</arashtad-camera>
```

The camera becomes associated with the runtime scene and is assigned as the active scene camera.

Camera properties can subsequently be configured through runtime attributes or JavaScript.

---

# Lights

The runtime explicitly defines support for:

```javascript
HemisphericLight
DirectionalLight
```

Example:

```html
<arashtad-light
    type="DirectionalLight"
    id="light"
    direction="new BABYLON.Vector3(0, -1, -2)">
</arashtad-light>
```

Multiple lights can be declared in the same scene.

Additional Babylon.js light types should only be used through the generic constructor system when their constructor requirements are compatible with the runtime's generic construction mechanism.

---

# Models

Models can be loaded declaratively:

```html
<arashtad-model
    id="model"
    src="assets/model.glb">
</arashtad-model>
```

The runtime uses Babylon.js `SceneLoader.ImportMeshAsync()` for model loading.

Model processing provides:

- Individual model loading progress
- Aggregate scene loading progress
- Loading error handling
- Imported mesh registration
- Model metadata
- Model root nodes
- Animation groups
- Animation control

Each imported model receives a runtime model root.

Imported meshes are registered so that individual model meshes can be addressed through runtime references.

For example:

```html
<arashtad-mesh
    ref="black"
    material="accent-material">
</arashtad-mesh>
```

Here, `black` can refer to a mesh registered from an imported model.

---

## Model Animation

The runtime model system exposes animation functionality including:

```javascript
getAnimations()

playAnimation(value)

pauseAnimation(value?)

stopAnimation(value?)

setAnimationSpeed(speed, value?)
```

Animations can be selected by supported identifiers such as:

- Animation index
- Exact animation name
- Partial animation name

The runtime also exposes model animation information through the Models plugin.

---

# Meshes

Meshes are created declaratively through Babylon.js `MeshBuilder`.

Example:

```html
<arashtad-mesh
    type="Box"
    id="box"
    size="2">
</arashtad-mesh>
```

The runtime resolves mesh factories dynamically using the Babylon.js `MeshBuilder.Create<Type>()` API available in the loaded Babylon.js version.

For example:

```html
type="Box"
```

resolves to the corresponding:

```javascript
BABYLON.MeshBuilder.CreateBox(...)
```

Mesh construction therefore follows the MeshBuilder implementation supplied by the Babylon.js version distributed with or loaded by the application.

---

# Materials

Materials can be created through the runtime's constructor system and assigned through references.

Example:

```html
<arashtad-material
    type="StandardMaterial"
    id="material">
</arashtad-material>

<arashtad-mesh
    type="Box"
    id="box"
    material="material">
</arashtad-mesh>
```

Properties can be assigned directly through HTML attributes:

```html
<arashtad-material
    type="StandardMaterial"
    id="material"
    diffuseColor="new BABYLON.Color3(0.15, 0.64, 0.55)"
    specularColor="new BABYLON.Color3(0.8, 0.8, 0.8)">
</arashtad-material>
```

Nested properties can use dot notation where supported by the target object:

```html
<arashtad-material
    type="StandardMaterial"
    id="material"
    diffuseColor.r="0.15"
    diffuseColor.g="0.64"
    diffuseColor.b="0.55">
</arashtad-material>
```

---

# Particle Systems

Particle systems are explicitly supported.

Example:

```html
<arashtad-particlesystem
    type="ParticleSystem"
    id="particles"
    capacity="1000"
    particleTexture="new BABYLON.Texture('../../textures/flare.png', scene)">
</arashtad-particlesystem>
```

The runtime creates and starts supported particle systems after processing their configuration.

Particle system properties can be supplied through runtime attributes using the same property-processing system used by other runtime objects.

---

# GUI

The runtime provides dedicated creation support for Babylon GUI objects.

Currently documented dedicated GUI creation includes:

```javascript
AdvancedDynamicTexture
Button
```

Create a fullscreen GUI texture:

```html
<arashtad-gui
    type="AdvancedDynamicTexture"
    id="ui">
</arashtad-gui>
```

Create a button:

```html
<arashtad-gui
    type="Button"
    id="button"
    text="Click Me">
</arashtad-gui>
```

A GUI control can be associated with an `AdvancedDynamicTexture`:

```html
<arashtad-gui
    type="Button"
    id="button"
    parent="ui"
    text="Click Me">
</arashtad-gui>
```

GUI properties can be configured through runtime attributes.

For example:

```html
<arashtad-gui
    type="Button"
    id="button"
    parent="ui"
    text="CLICK ME"
    width="'200px'"
    height="'60px'"
    color="'white'"
    background="'blue'"
    fontSize="24"
    cornerRadius="10">
</arashtad-gui>
```

The runtime also supports generic Babylon.GUI constructor resolution where the required constructor is compatible with the generic construction system.

---

# Environment

The runtime supports Babylon.js environment textures through the `environment` attribute.

Example:

```html
<arashtad-runtime
    environment="assets/environment.hdr"
    environmentIntensity="1"
    environmentBackground="true"
    environmentBackgroundBlur="0.2"
    environmentRotationY="0">
</arashtad-runtime>
```

Supported environment settings include:

```javascript
environment
environmentIntensity
environmentBackground
environmentBackgroundBlur
environmentRotationY
```

The environment can provide image-based scene illumination and reflections and can optionally be rendered as the scene background.

For HDR environments, the runtime uses Babylon.js environment texture support.

The environment path is a normal resource path:

```javascript
environment="../../environments/room.hdr"
```

It should not be wrapped in additional JavaScript-string quoting.

---

# Environment Intensity

`environmentIntensity` controls the strength of the environment contribution.

Example:

```html
<arashtad-runtime
    environment="../../environments/room.hdr"
    environmentIntensity="1">
</arashtad-runtime>
```

Higher values increase the environment's contribution to the scene.

---

# Environment Background

`environmentBackground` controls whether the environment is rendered as the visible scene background.

```javascript
environmentBackground="true"
```

The environment can therefore remain active for lighting and reflections while the visible background is disabled:

```html
<arashtad-runtime
    environment="../../environments/room.hdr"
    environmentIntensity="1"
    environmentBackground="false">
</arashtad-runtime>
```

When the environment background is disabled, the canvas clear color can be used as the visible background.

---

# Environment Background Blur

`environmentBackgroundBlur` controls the amount of blur applied to the visible environment background.

Example:

```html
<arashtad-runtime
    environment="../../environments/room.hdr"
    environmentIntensity="1"
    environmentBackground="true"
    environmentBackgroundBlur="0.35">
</arashtad-runtime>
```

---

# Environment Rotation

`environmentRotationY` rotates the environment around the Y axis.

Example:

```html
<arashtad-runtime
    environment="../../environments/room.hdr"
    environmentIntensity="1"
    environmentBackground="true"
    environmentRotationY="1">
</arashtad-runtime>
```

The rotation value is expressed in radians.

Environment intensity, background visibility, background blur, and rotation can be combined in the same runtime configuration.

---

# References

Runtime objects can be registered and referenced by ID.

For example:

```html
<arashtad-light
    type="DirectionalLight"
    id="mainLight"
    direction="new BABYLON.Vector3(0, -1, -2)">
</arashtad-light>
```

Another runtime element can reference the object:

```html
<arashtad-shadow
    light="mainLight">
</arashtad-shadow>
```

References are maintained through the runtime registry.

The registry can also contain imported model meshes and model information.

This allows declarative elements and runtime actions to address objects without requiring a separate JavaScript lookup system.

---

# JavaScript Expressions

Runtime attributes can contain JavaScript expressions.

For example:

```html
<arashtad-mesh
    type="Box"
    id="box"
    size="2"
    position="new BABYLON.Vector3(0, 1, 0)">
</arashtad-mesh>
```

Expressions can access the JavaScript environment provided by the runtime, including Babylon.js and registered references where applicable.

This allows complex Babylon.js values to be expressed without requiring a separate parser for every possible Babylon.js type.

JavaScript expressions are one of the mechanisms that allow the declarative syntax to remain close to the underlying Babylon.js API.

---

# Properties

Runtime attributes are applied dynamically to created objects.

Property resolution supports:

- Own object properties
- Prototype properties
- Case-insensitive property resolution
- Nested properties
- Runtime references
- Parsed JavaScript values

Nested properties can use dot notation where supported by the target object.

For example:

```javascript
diffuseColor.r="0.15"
diffuseColor.g="0.64"
diffuseColor.b="0.55"
```

The runtime resolves the property path and applies the resulting value to the target object.

---

# Constructor Arguments

Some runtime-defined object types provide explicit constructor argument mappings.

For example, the runtime defines the constructor parameters for `ArcRotateCamera` as:

```javascript
alpha
beta
radius
target
```

A camera can therefore be constructed using:

```html
<arashtad-camera
    type="ArcRotateCamera"
    args="1.57, 1.2, 12, new BABYLON.Vector3(0, 0, 0)">
</arashtad-camera>
```

Constructor arguments are evaluated through the runtime expression system.

Constructor argument support depends on the constructor definition registered by the runtime. It should not be interpreted as a guarantee that arbitrary Babylon.js constructors can accept arbitrary `args` strings.

---

# Generic Babylon.js Construction

In addition to explicitly defined runtime object types, the runtime can resolve compatible Babylon.js constructors dynamically.

The generic constructor system can resolve Babylon.js constructors through the Babylon.js API and, where applicable, Babylon GUI constructors.

Conceptually, constructor resolution can use:

```javascript
BABYLON[type]
```

and:

```javascript
BABYLON.GUI[type]
```

This provides an extensible bridge between declarative HTML and the Babylon.js API.

Generic construction does not guarantee that every Babylon.js class can be instantiated automatically. Constructor requirements, runtime definitions, and the object's relationship to a Babylon.js scene determine whether a particular type can be constructed successfully.

---

# Parent and Child Relationships

Runtime objects can establish relationships using references.

For example:

```html
<arashtad-gui
    id="ui"
    type="AdvancedDynamicTexture">
</arashtad-gui>

<arashtad-gui
    id="button"
    type="Button"
    parent="ui"
    text="CLICK ME">
</arashtad-gui>
```

The same reference mechanism is used throughout the runtime for supported parent, material, manager, light, model, and other relationships.

---

# Events

The runtime supports multiple event mechanisms.

## Native DOM Events

Supported runtime event processing can connect HTML event attributes to JavaScript action execution.

The event object is made available to the runtime action context.

Example:

```html
<arashtad-action
    target="box"
    on-click="console.log(event)">
</arashtad-action>
```

Native event behavior depends on the event and runtime element being processed.

---

## Babylon.js Observables

Runtime event attributes can connect to compatible Babylon.js observable properties.

Observable resolution is performed against the Babylon.js object associated with the runtime element.

---

## ActionManager Triggers

The runtime can resolve compatible Babylon.js `ActionManager` triggers dynamically from the loaded Babylon.js API.

This allows runtime actions to respond to supported Babylon.js ActionManager events without requiring every trigger to be hard-coded into the runtime.

---

# Actions

Runtime actions execute JavaScript with a runtime-provided context.

The action context can expose:

```javascript
target
scene
BABYLON
refs
event
meshes
mesh
```

Example:

```html
<arashtad-action
    target="box"
    execute="target.rotation.y += 0.5">
</arashtad-action>
```

Actions can interact with:

- The target object
- The associated scene
- The Babylon.js API
- Registered references
- Event information
- Imported model meshes

### GUI Action Context

GUI controls require special care because the GUI control's object hierarchy is different from ordinary scene objects.

When a GUI action needs the actual Babylon.js `Scene`, the GUI target can provide access to its scene through Babylon.js APIs such as:

```javascript
target.getScene()
```

Code should not assume that the action context's `scene` variable is always the Babylon.js `Scene` when the action is attached to a GUI control.

---

# Shadows

The runtime provides declarative shadow configuration.

Shadow-related runtime elements can configure supported shadow functionality including:

- Shadow generators
- Shadow map configuration
- Shadow darkness
- Light shadow properties
- Shadow casters
- Shadow receivers

Example:

```html
<arashtad-shadow
    light="mainLight"
    mapSize="2048"
    darkness="0.3">
</arashtad-shadow>
```

Caster and receiver elements allow shadow participation to be declared separately from the underlying mesh declaration.

---

# Physics

Arashtad 3D Runtime integrates Babylon.js Havok physics.

Physics support is implemented through the runtime's physics-related semantic elements and supporting systems.

The runtime tag family includes:

```
arashtad-physics
arashtad-generator
arashtad-caster
arashtad-receiver
arashtad-velocity
arashtad-impulse
arashtad-force
arashtad-body
arashtad-collision
```

Physics functionality includes support for concepts such as:

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
- Collision events

Collision systems can respond to supported collision-start and collision-end notifications.

The exact structure of a physics declaration depends on the physics elements involved and the Babylon.js/Havok configuration required by the scene.

---

# Loading Progress

The runtime tracks loading progress for model-based scenes.

Individual model progress can be monitored and combined into aggregate scene progress.

Aggregate progress is monotonic: it does not decrease during loading.

The runtime reserves the final `100%` state for completion.

The runtime exposes loading callbacks including:

```javascript
OnLoadProgress
OnLoadError
```

through the runtime configuration.

---

# Public JavaScript API

The core public API is intentionally small.

## `ready(canvas)`

Initializes the runtime for a canvas and returns the associated Babylon.js `Scene`.

```javascript
import {
    ready
} from './lib/arashtad/arashtad-3d-runtime.1.1.0.min.js';

const canvas = document.getElementById('scene');

const scene = await ready(canvas);
```

The runtime initialization process handles the runtime setup associated with the canvas and returns the resulting Babylon.js scene.

---

## `loadModel(scene, url, id)`

Loads a model programmatically into an existing runtime scene.

```javascript
import {
    ready,
    loadModel
} from './lib/arashtad/arashtad-3d-runtime.1.1.0.min.js';

const scene = await ready(canvas);

await loadModel(
    scene,
    'assets/model.glb',
    'product'
);
```

This provides a JavaScript alternative to declarative `<arashtad-model>` elements.

---

# Plugin Architecture

Arashtad 3D Runtime separates core scene processing from higher-level application functionality.

The core runtime focuses on:

- Scene creation
- Declarative object construction
- Properties
- References
- Events
- Actions
- Loading
- Rendering
- Core scene systems

Plugins provide higher-level functionality without requiring application-specific concepts to become part of the core runtime language.

The plugin distribution is:

```
lib/arashtad/arashtad-3d-runtime-plugins.1.0.0.min.js
```

The core runtime and plugin layer are distributed as separate bundles.

This architecture allows applications to use the core runtime independently and add higher-level capabilities when required.

---

# Models Plugin

The Models plugin provides access to model information registered by the runtime.

Public APIs include:

```javascript
getModelData(id)

getModelMeshes(id)

getModelAnimations(id)

getModelSkeletons(id)

getModelParticleSystems(id)
```

The plugin operates on model information maintained by the runtime.

The Models plugin therefore provides a programmatic model-data layer while the core runtime remains responsible for declarative model loading and registration.

---

# Lazy Loading Plugin

The Lazy Loading plugin uses `IntersectionObserver` to trigger loading when an element approaches the viewport.

The primary API is:

```javascript
enableLazyLoading(element, callback, options)
```

Supported configuration currently includes:

```javascript
{
    rootMargin: '500px'
}
```

The callback is executed on the first intersection and the observer is then removed.

---

# Scroll Lock Plugin

The Scroll Lock plugin provides:

```javascript
enableScrollLock()

disableScrollLock()
```

It targets:

```javascript
.canvas-wrapper.scrolllock
```

and prevents wheel-based page scrolling while the target canvas is being interacted with.

---

# Touch Controls Plugin

The Touch Controls plugin provides:

```javascript
enableTouchControls(element, options)

disableTouchControls(element)

enableTouchControlsForAll(selector)

disableTouchControlsForAll(selector)
```

Supported touch behavior includes:

- Scroll prevention
- Double tap
- Long press
- Touch movement
- Custom 3D touch movement events

Generated custom events include:

```javascript
touchlongpress
touchmove3d
touchdoubletap
```

---

# Interactions Plugin

The Interactions plugin provides higher-level interaction functionality for Babylon.js scenes.

Initialize it with:

```javascript
const interactions = enableInteractions(
    scene,
    canvas
);
```

The API includes:

```javascript
raycast()
raycastMesh()
raycastPoint()
highlight()
unhighlight()
clearHighlights()
showCard()
hideCard()
navigateTo()
createPoint()
removePoint()
clearPoints()
bind()
bindAll()
bindName()
bindNameAll()
bindNamePattern()
bindHierarchy()
unbind()
unbindAll()
unbindNamePattern()
unbindHierarchy()
bindConfig()
removeBindings()
resolveTargets()
on()
onAll()
disable()
```

Supported interaction events include:

```javascript
pick
pointerover
pointerout
pointermove
pointerdown
pointerup
```

Built-in interaction actions include:

```javascript
highlight
unhighlight
card
hideCard
navigate
point
```

Custom JavaScript functions can also be used as interaction actions.

---

# Why the Plugin Layer Exists

The core runtime provides the declarative foundation for Babylon.js scenes.

Plugins provide higher-level application behavior.

This separation makes it possible to build systems such as:

- Interactive product viewers
- Product configurators
- 3D annotations
- Hotspots
- Interactive maps
- Architectural viewers
- Technical documentation
- Educational models
- 3D presentations
- Information systems

without requiring these application concepts to become part of the core runtime scene language.

The runtime therefore remains a general-purpose Babylon.js declarative layer while plugins provide specialized functionality.

---

# Project Structure

The source repository is organized around the runtime core, plugins, distributed builds, and examples:

```
arashtad-runtime/

├── src/
│   ├── ActionHandler.js
│   ├── Constructor.js
│   ├── Creator.js
│   ├── Definitions.js
│   ├── DOM.js
│   ├── Events.js
│   ├── Factory.js
│   ├── Parser.js
│   ├── Properties.js
│   ├── Registry.js
│   ├── Resolver.js
│   ├── Runtime.js
│   └── Tags.js
│
├── plugins/
│   ├── Animations.js
│   ├── Annotations.js
│   ├── AR.js
│   ├── Cameras.js
│   ├── Hotspots.js
│   ├── Interactions.js
│   ├── LazyLoading.js
│   ├── Materials.js
│   ├── Models.js
│   ├── Plugins.js
│   ├── Scene.js
│   ├── ScrollLock.js
│   └── TouchControls.js
│
├── lib/
│   ├── arashtad/
│   │   ├── arashtad-3d-runtime.1.1.0.min.js
│   │   └── arashtad-3d-runtime-plugins.1.0.0.min.js
│   │
│   └── babylon/
│
├── examples/
│
├── LICENSE
│
└── README.md
```

The exact contents of the source and plugin directories may evolve as the runtime develops. The two files under `lib/arashtad/` represent the versioned distributed runtime builds.

---

# Distribution

Arashtad 3D Runtime is distributed as two primary JavaScript bundles:

```
lib/arashtad/arashtad-3d-runtime.1.1.0.min.js
lib/arashtad/arashtad-3d-runtime-plugins.1.0.0.min.js
```

The core runtime and plugin bundle are independent layers.

Babylon.js dependencies are distributed locally with the project.

No CDN is required for normal runtime operation.

Applications may therefore deploy the runtime and its Babylon.js dependencies as part of their own project without depending on a third-party CDN.

---

# Babylon.js Dependencies

The runtime distribution includes the Babylon.js libraries required by the supported examples and runtime functionality.

Typical example pages load Babylon.js locally:

```html
<script src="../../lib/babylon/babylon.js"></script>
```

Examples that use Babylon GUI additionally load:

```html
<script src="../../lib/babylon/gui/babylon.gui.min.js"></script>
```

Examples that load external 3D model formats additionally load the Babylon.js loaders:

```html
<script src="../../lib/babylon/loaders/babylonjs.loaders.min.js"></script>
```

The required Babylon.js modules should be loaded before functionality that depends on them.

---

# Browser Usage

A minimal HTML page can look like:

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arashtad 3D Runtime</title>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        canvas {
            width: 100%;
            height: 100%;
            display: block;
        }
    </style>
</head>

<body>

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

<script src="./lib/babylon/babylon.js"></script>

<script type="module">

    import {
        ready
    } from './lib/arashtad/arashtad-3d-runtime.1.1.0.min.js';

    const canvas = document.getElementById('scene');

    await ready(canvas);

</script>

</body>
</html>
```

The exact Babylon.js auxiliary modules required by an application depend on the features being used.

---

# Local Development

A web server is required for normal browser module loading and resource access.

Using PHP:

```bash
php -S localhost:8000
```

Then open:

```bash
http://localhost:8000/
```

Do not rely on opening the project directly through `file://` URLs.

Using a local HTTP server also provides behavior closer to a normal deployed web environment.

---

# Examples

The `examples/` directory contains progressively more advanced demonstrations of the runtime and its plugins.

The examples serve several purposes:

- Documentation
- API demonstrations
- Integration tests
- Feature demonstrations
- Learning material
- Portfolio demonstrations
- Production references

The collection progresses from basic runtime initialization through cameras, lights, models, meshes, materials, particle systems, GUI, environments, events, actions, shadows, physics, runtime integration, plugins, interactions, plugin combinations, and complete production-oriented examples.

There is no fixed example count.

New examples can be added as runtime functionality grows or existing functionality requires additional coverage.

Each example should remain independently useful as documentation and as a practical reference.

---

# Development Principles

Arashtad 3D Runtime follows several core principles.

## Declarative First

Scene construction should be possible through HTML wherever the runtime provides a declarative representation.

JavaScript remains available for functionality that requires direct programmatic control.

---

## Babylon.js Compatible

Babylon.js remains the underlying 3D engine.

The runtime should expose Babylon.js functionality rather than unnecessarily replacing Babylon.js APIs.

Applications retain access to the underlying Babylon.js scene and objects.

---

## Small Core

The runtime core should remain focused on:

- Scene construction
- Object creation
- Properties
- References
- Events
- Actions
- Loading
- Rendering
- Core scene systems

Higher-level application functionality belongs in plugins whenever it does not need to be part of the core declarative language.

---

## Extensible

The constructor, property, reference, event, action, and plugin systems provide extension points without requiring a separate runtime implementation for every Babylon.js class or application concept.

Generic construction provides an additional bridge to compatible Babylon.js and Babylon.GUI APIs.

---

## No Unnecessary Dependencies

Required Babylon.js libraries are distributed locally with the project.

Normal runtime operation does not require a third-party CDN.

---

## Direct Babylon.js Access

The runtime is not intended to hide Babylon.js.

The declarative layer and JavaScript API are complementary.

Applications can use HTML for scene declaration and JavaScript for advanced runtime control, integration, custom behavior, and direct Babylon.js operations.

---

# Versioning

Runtime distributions use explicit versioned filenames:

```
arashtad-3d-runtime.1.1.0.min.js
arashtad-3d-runtime-plugins.1.0.0.min.js
```

This makes the runtime and plugin versions explicit and allows applications to control exactly which distributed build they load.

Versioned filenames can also help prevent accidental replacement of a runtime build by an incompatible version.

---

# Compatibility

Arashtad 3D Runtime is designed for modern browsers supporting the technologies required by the runtime and the Babylon.js version distributed with the project.

The baseline environment includes:

- ES modules
- JavaScript classes
- WebGL
- Modern DOM APIs
- Modern Babylon.js browser requirements

Features that depend on additional browser or platform capabilities may have additional requirements.

For example:

- Lazy Loading uses `IntersectionObserver`.
- Babylon.js Havok physics may require WebAssembly and the capabilities required by the corresponding Babylon.js/Havok build.
- WebGL rendering capabilities depend on the browser, device, GPU, and Babylon.js version.

Actual rendering and feature availability therefore depend on the browser and device environment in which the application runs.

---

# Security Considerations

Runtime expressions and actions are intentionally capable of executing JavaScript.

For example:

```html
<arashtad-action
    target="box"
    execute="target.rotation.y += 0.1">
</arashtad-action>
```

This capability is fundamental to the runtime's design because it allows declarative HTML to interact directly with Babylon.js and application code.

Runtime scene markup should therefore be treated as trusted application code.

Do not process arbitrary untrusted user-supplied runtime HTML as though it were inert data.

Applications that allow users to create or modify runtime markup should implement their own validation, sanitization, authorization, and execution boundaries appropriate to their security model.

---

# License

Arashtad 3D Runtime is released under the MIT License.

See the `LICENSE` file for the complete license text.

---

# Arashtad

**Arashtad 3D Runtime** is part of the Arashtad software ecosystem.

It provides a reusable declarative runtime layer for Babylon.js and serves as the foundation for higher-level 3D applications, integrations, and plugins.

Built by **Arashtad**.

# Changelog

**1.1.0**

1. **Features:**  added two lines: `Physics joints (ball and socket, hinge, distance, slider, 6DOF)` and `Physics constraints`.
2. **Runtime Tags:**  added `arashtad-joint` and `arashtad-limit` to the tag list, added `joint` and `limit` to the semantic-elements paragraph, and added a sentence about the joint processing pass.
3. **Physics section:**  added the new **Physics Joints** subsection with a full example, joint attributes, `<arashtad-limit>` details, and the fallback behavior note.
4. **Project Structure:**  added `Joints.js` to `src/` in alphabetical position.
5. **Versioning:**  added a sentence clarifying independent versioning between runtime and plugins.
6. **GUI section:**  added a note that dedicated GUI creation is currently provided for `AdvancedDynamicTexture` and `Button`.