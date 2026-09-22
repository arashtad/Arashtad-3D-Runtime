<?php

// $categories = [
//     [
//         'number' => '01',
//         'title' => 'Basic Scene & Runtime',
//         'description' => 'Start with the essential building blocks of an Arashtad 3D Runtime scene.',
//         'examples' => [
//             ['01', 'Basic Scene', 'Create the simplest complete Arashtad 3D Runtime scene.', ['Scene', 'Runtime']],
//             ['02', 'Canvas', 'Create and prepare the HTML canvas used by the runtime.', ['Canvas']],
//             ['03', 'Basic Runtime', 'Initialize the Arashtad 3D Runtime on a canvas.', ['Runtime']],
//             ['04', 'Runtime Resize', 'Control runtime canvas resizing.', ['Runtime', 'Canvas']],
//             ['05', 'Runtime Loading Progress', 'Display runtime loading progress.', ['Runtime', 'Loading']],
//             ['06', 'Runtime Loading Error Handling', 'Handle runtime loading errors.', ['Runtime', 'Loading', 'Errors']],
//             ['07', 'Advanced Runtime Configuration', 'Configure the runtime with its advanced settings.', ['Runtime', 'Configuration']],
//             ['08', 'Runtime JavaScript Expressions', 'Use JavaScript expressions in runtime attributes.', ['Runtime', 'JavaScript']],
//             ['09', 'Runtime Object References', 'Reference runtime objects from other elements.', ['Runtime', 'References']],
//             ['10', 'Runtime Constructor Arguments', 'Pass custom constructor arguments to runtime objects.', ['Runtime', 'Constructors']],
//             ['11', 'Runtime Properties', 'Control object properties through runtime attributes.', ['Runtime', 'Properties']],
//         ],
//     ],
//     [
//         'number' => '02',
//         'title' => 'Cameras',
//         'description' => 'Learn every explicitly supported camera type from basic setup through advanced configuration.',
//         'examples' => [
//             ['14', 'UniversalCamera — Basic', 'Create a basic UniversalCamera.', ['Camera', 'UniversalCamera']],
//             ['15', 'UniversalCamera — Full Configuration', 'Explore the full runtime configuration of a UniversalCamera.', ['Camera', 'UniversalCamera', 'Advanced']],
//             ['16', 'FreeCamera — Basic', 'Create a basic FreeCamera.', ['Camera', 'FreeCamera']],
//             ['17', 'FreeCamera — Full Configuration', 'Explore the full runtime configuration of a FreeCamera.', ['Camera', 'FreeCamera', 'Advanced']],
//             ['18', 'ArcRotateCamera — Basic', 'Create a basic ArcRotateCamera.', ['Camera', 'ArcRotateCamera']],
//             ['19', 'ArcRotateCamera — Full Configuration', 'Explore the full runtime configuration of an ArcRotateCamera.', ['Camera', 'ArcRotateCamera', 'Advanced']],
//             ['20', 'Multiple Cameras', 'Create and manage multiple cameras in one scene.', ['Camera', 'Multiple']],
//             ['21', 'Camera References', 'Reference cameras from other runtime elements.', ['Camera', 'References']],
//             ['22', 'Camera Properties and Nested Properties', 'Configure camera properties and nested properties.', ['Camera', 'Properties']],
//             ['23', 'Camera + Model', 'Combine a camera with a loaded model.', ['Camera', 'Models']],
//             ['24', 'Camera + Multiple Models', 'View multiple models with a camera system.', ['Camera', 'Models']],
//             ['25', 'Camera + Runtime Events', 'Connect camera scenes to runtime events.', ['Camera', 'Events']],
//             ['26', 'Advanced Camera Scene', 'Build a complete advanced camera-driven scene.', ['Camera', 'Advanced', 'Scene']],
//         ],
//     ],
//     [
//         'number' => '03',
//         'title' => 'Lights',
//         'description' => 'Build lighting scenes from individual lights through advanced multi-light setups.',
//         'examples' => [
//             ['27', 'HemisphericLight — Basic', 'Create a basic HemisphericLight.', ['Lighting', 'HemisphericLight']],
//             ['28', 'HemisphericLight — Full Configuration', 'Explore the full runtime configuration of a HemisphericLight.', ['Lighting', 'HemisphericLight', 'Advanced']],
//             ['29', 'DirectionalLight — Basic', 'Create a basic DirectionalLight.', ['Lighting', 'DirectionalLight']],
//             ['30', 'DirectionalLight — Full Configuration', 'Explore the full runtime configuration of a DirectionalLight.', ['Lighting', 'DirectionalLight', 'Advanced']],
//             ['31', 'Multiple Lights', 'Compose a scene using multiple lights.', ['Lighting', 'Multiple']],
//             ['32', 'Light References', 'Reference lights from other runtime elements.', ['Lighting', 'References']],
//             ['33', 'Light Properties', 'Configure light properties through runtime attributes.', ['Lighting', 'Properties']],
//             ['34', 'Light + Meshes', 'Combine lights with runtime meshes.', ['Lighting', 'Mesh']],
//             ['35', 'Light + Materials', 'Combine lighting with materials.', ['Lighting', 'Materials']],
//             ['36', 'Light + Shadows', 'Combine lights with the runtime shadow system.', ['Lighting', 'Shadows']],
//             ['37', 'Advanced Lighting Scene', 'Build a complete advanced lighting scene.', ['Lighting', 'Advanced', 'Scene']],
//         ],
//     ],
//     [
//         'number' => '04',
//         'title' => 'Models',
//         'description' => 'Load, register, inspect and control 3D models and their animations.',
//         'examples' => [
//             ['38', 'Basic Model', 'Load a basic 3D model into the runtime.', ['Models']],
//             ['39', 'Multiple Models', 'Load multiple models into one scene.', ['Models', 'Multiple']],
//             ['40', 'Model IDs and References', 'Identify and reference loaded models.', ['Models', 'References']],
//             ['41', 'Model Loading Progress', 'Display progress for model loading.', ['Models', 'Loading']],
//             ['42', 'Multiple Model Loading Progress', 'Track loading progress across multiple models.', ['Models', 'Loading']],
//             ['43', 'Model Loading Errors', 'Handle model loading errors.', ['Models', 'Errors']],
//             ['44', 'Model Root', 'Work with the runtime-generated model root.', ['Models', 'Hierarchy']],
//             ['45', 'Model Mesh Registration', 'Access meshes registered from a loaded model.', ['Models', 'Meshes']],
//             ['46', 'Model Metadata', 'Access metadata associated with a loaded model.', ['Models', 'Metadata']],
//             ['47', 'Model Animations', 'Access animation groups contained in a model.', ['Models', 'Animation']],
//             ['48', 'Play Animation by Index', 'Play a model animation by index.', ['Models', 'Animation']],
//             ['49', 'Play Animation by Exact Name', 'Play a model animation by exact name.', ['Models', 'Animation']],
//             ['50', 'Play Animation by Partial Name', 'Find and play an animation by partial name.', ['Models', 'Animation']],
//             ['51', 'Pause Animation', 'Pause model animations.', ['Models', 'Animation']],
//             ['52', 'Stop Animation', 'Stop model animations.', ['Models', 'Animation']],
//             ['53', 'Set Animation Speed', 'Control model animation speed.', ['Models', 'Animation']],
//             ['54', 'Multiple Animated Models', 'Control animations across multiple models.', ['Models', 'Animation']],
//             ['55', 'Advanced Model Scene', 'Build a complete advanced model scene.', ['Models', 'Advanced', 'Scene']],
//         ],
//     ],
//     [
//         'number' => '05',
//         'title' => 'Meshes',
//         'description' => 'Create Babylon.js meshes through the runtime and progressively explore mesh configuration.',
//         'examples' => [
//             ['56', 'Basic Mesh', 'Create the simplest runtime mesh.', ['Mesh']],
//             ['57', 'Box', 'Create a box with MeshBuilder.', ['Mesh', 'Box']],
//             ['58', 'Sphere', 'Create a sphere with MeshBuilder.', ['Mesh', 'Sphere']],
//             ['59', 'Plane', 'Create a plane with MeshBuilder.', ['Mesh', 'Plane']],
//             ['60', 'Ground', 'Create a ground mesh with MeshBuilder.', ['Mesh', 'Ground']],
//             ['61', 'Cylinder', 'Create a cylinder with MeshBuilder.', ['Mesh', 'Cylinder']],
//             ['62', 'Disc', 'Create a disc with MeshBuilder.', ['Mesh', 'Disc']],
//             ['63', 'Torus', 'Create a torus with MeshBuilder.', ['Mesh', 'Torus']],
//             ['64', 'Torus Knot', 'Create a torus knot with MeshBuilder.', ['Mesh', 'TorusKnot']],
//             ['65', 'Line-Based Mesh', 'Create a line-based mesh with MeshBuilder.', ['Mesh', 'Lines']],
//             ['66', 'Tube', 'Create a tube mesh with MeshBuilder.', ['Mesh', 'Tube']],
//             ['67', 'Polygon', 'Create a polygon mesh with MeshBuilder.', ['Mesh', 'Polygon']],
//             ['68', 'Lathe', 'Create a lathed mesh with MeshBuilder.', ['Mesh', 'Lathe']],
//             ['69', 'Extruded Shape', 'Create an extruded shape with MeshBuilder.', ['Mesh', 'Extrusion']],
//             ['70', 'Ribbon', 'Create a ribbon mesh with MeshBuilder.', ['Mesh', 'Ribbon']],
//             ['71', 'Other MeshBuilder Types Available in Babylon.js', 'Explore additional mesh types exposed by the loaded Babylon.js MeshBuilder API.', ['Mesh', 'MeshBuilder']],
//             ['72', 'Mesh IDs and References', 'Identify and reference runtime meshes.', ['Mesh', 'References']],
//             ['73', 'Mesh Position', 'Control mesh position.', ['Mesh', 'Transform']],
//             ['74', 'Mesh Rotation', 'Control mesh rotation.', ['Mesh', 'Transform']],
//             ['75', 'Mesh Scaling', 'Control mesh scaling.', ['Mesh', 'Transform']],
//             ['76', 'Mesh Visibility', 'Control mesh visibility.', ['Mesh', 'Properties']],
//             ['77', 'Mesh Enabled State', 'Control whether a mesh is enabled.', ['Mesh', 'Properties']],
//             ['78', 'Mesh Rendering Properties', 'Explore mesh rendering properties.', ['Mesh', 'Rendering']],
//             ['79', 'Mesh Parent', 'Build mesh hierarchies using parenting.', ['Mesh', 'Hierarchy']],
//             ['80', 'Mesh Material', 'Assign a material to a mesh.', ['Mesh', 'Materials']],
//             ['81', 'Mesh Nested Properties', 'Control nested mesh properties.', ['Mesh', 'Properties']],
//             ['82', 'Mesh Constructor Options', 'Pass MeshBuilder constructor options through the runtime.', ['Mesh', 'MeshBuilder']],
//             ['83', 'Multiple Meshes', 'Create multiple meshes in one scene.', ['Mesh', 'Multiple']],
//             ['84', 'Mesh Combinations', 'Combine different mesh types into one scene.', ['Mesh', 'Composition']],
//             ['85', 'Advanced Mesh Scene', 'Build a complete advanced mesh scene.', ['Mesh', 'Advanced', 'Scene']],
//         ],
//     ],
//     [
//         'number' => '06',
//         'title' => 'Materials',
//         'description' => 'Create, configure and assign materials through the runtime.',
//         'examples' => [
//             ['86', 'Basic Material', 'Create a basic runtime material.', ['Materials']],
//             ['87', 'Material Reference', 'Reference an existing material.', ['Materials', 'References']],
//             ['88', 'Assigning Material to Mesh', 'Assign a material to a runtime mesh.', ['Materials', 'Mesh']],
//             ['89', 'Material Properties', 'Configure material properties.', ['Materials', 'Properties']],
//             ['90', 'Nested Material Properties', 'Configure nested material properties.', ['Materials', 'Properties']],
//             ['91', 'Multiple Materials', 'Use multiple materials in one scene.', ['Materials', 'Multiple']],
//             ['92', 'Materials + Multiple Meshes', 'Assign materials across multiple meshes.', ['Materials', 'Mesh']],
//             ['93', 'Advanced Materials Scene', 'Build a complete advanced material scene.', ['Materials', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '07',
//         'title' => 'Particle Systems',
//         'description' => 'Create and configure runtime particle systems.',
//         'examples' => [
//             ['94', 'Basic ParticleSystem', 'Create a basic ParticleSystem.', ['Particles']],
//             ['95', 'Particle Capacity', 'Configure particle system capacity.', ['Particles', 'Properties']],
//             ['96', 'Particle Texture', 'Assign a particle texture.', ['Particles', 'Textures']],
//             ['97', 'ParticleSystem Properties', 'Configure ParticleSystem properties.', ['Particles', 'Properties']],
//             ['98', 'Multiple Particle Systems', 'Use multiple particle systems.', ['Particles', 'Multiple']],
//             ['99', 'Particle Systems + Lights', 'Combine particle systems with lighting.', ['Particles', 'Lighting']],
//             ['100', 'Particle Systems + Models', 'Combine particle systems with loaded models.', ['Particles', 'Models']],
//             ['101', 'Advanced Particle Scene', 'Build a complete advanced particle scene.', ['Particles', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '08',
//         'title' => 'GUI',
//         'description' => 'Create GUI elements and integrate them with runtime scenes.',
//         'examples' => [
//             ['102', 'Basic AdvancedDynamicTexture', 'Create a fullscreen AdvancedDynamicTexture.', ['GUI']],
//             ['103', 'Basic GUI Button', 'Create a basic GUI Button.', ['GUI', 'Button']],
//             ['104', 'Button Text', 'Configure GUI button text.', ['GUI', 'Button']],
//             ['105', 'GUI Properties', 'Configure GUI properties.', ['GUI', 'Properties']],
//             ['106', 'GUI Parent/Control Relationship', 'Add GUI controls to an AdvancedDynamicTexture.', ['GUI', 'Hierarchy']],
//             ['107', 'Multiple GUI Controls', 'Create multiple GUI controls.', ['GUI', 'Multiple']],
//             ['108', 'GUI + Runtime References', 'Use runtime references with GUI elements.', ['GUI', 'References']],
//             ['109', 'GUI + Scene Interaction', 'Connect GUI elements to scene interaction.', ['GUI', 'Interaction']],
//             ['110', 'Advanced GUI Scene', 'Build a complete advanced GUI scene.', ['GUI', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '09',
//         'title' => 'Environment',
//         'description' => 'Configure HDR and prefiltered environments and their presentation.',
//         'examples' => [
//             ['111', 'Basic Environment', 'Add a basic environment to a scene.', ['Environment']],
//             ['112', 'HDR Environment', 'Load an HDR environment.', ['Environment', 'HDR']],
//             ['113', 'Prefiltered Environment', 'Load a prefiltered environment texture.', ['Environment', 'ENV']],
//             ['114', 'Environment Intensity', 'Control environment intensity.', ['Environment']],
//             ['115', 'Environment Background', 'Control environment background rendering.', ['Environment']],
//             ['116', 'Environment Background Blur', 'Control environment background blur.', ['Environment']],
//             ['117', 'Environment Rotation', 'Control environment rotation.', ['Environment']],
//             ['118', 'Environment Without Background', 'Use an environment without displaying its background.', ['Environment']],
//             ['119', 'Environment + Models', 'Combine an environment with loaded models.', ['Environment', 'Models']],
//             ['120', 'Environment + Lighting', 'Combine environment lighting with runtime lights.', ['Environment', 'Lighting']],
//             ['121', 'Advanced Environment Scene', 'Build a complete advanced environment scene.', ['Environment', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '10',
//         'title' => 'Events & Actions',
//         'description' => 'Connect native DOM events, Babylon observables and ActionManager triggers to runtime actions.',
//         'examples' => [
//             ['122', 'Basic Action', 'Execute a basic runtime action.', ['Actions']],
//             ['123', 'Immediate Action Execution', 'Execute an action immediately when it is processed.', ['Actions']],
//             ['124', 'Canvas Click Event', 'Respond to a canvas click event.', ['Events', 'Click']],
//             ['125', 'Canvas Wheel Event', 'Respond to a canvas wheel event.', ['Events', 'Wheel']],
//             ['126', 'Other Native Canvas Events', 'Use other native canvas DOM events.', ['Events', 'DOM']],
//             ['127', 'Pointer Observable Event', 'Bind to a Babylon pointer observable.', ['Events', 'Babylon']],
//             ['128', 'Babylon Observable Event', 'Bind runtime actions to Babylon observables.', ['Events', 'Babylon']],
//             ['129', 'Babylon ActionManager Trigger', 'Use Babylon ActionManager triggers.', ['Events', 'ActionManager']],
//             ['130', 'Action Target', 'Execute an action against a specific target.', ['Actions', 'Target']],
//             ['131', 'Action + References', 'Use registered references inside actions.', ['Actions', 'References']],
//             ['132', 'Action + Scene', 'Access the scene from runtime action code.', ['Actions', 'Scene']],
//             ['133', 'Action + BABYLON API', 'Use the Babylon.js API inside an action.', ['Actions', 'Babylon.js']],
//             ['134', 'Action + Event Data', 'Use event data inside an action.', ['Actions', 'Events']],
//             ['135', 'Action + Model Meshes', 'Use imported model meshes inside actions.', ['Actions', 'Models']],
//             ['136', 'Multiple Events', 'Combine multiple runtime events.', ['Events', 'Multiple']],
//             ['137', 'Multiple Actions', 'Combine multiple runtime actions.', ['Actions', 'Multiple']],
//             ['138', 'Advanced Event-Driven Scene', 'Build a complete event-driven scene.', ['Events', 'Actions', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '11',
//         'title' => 'Shadows',
//         'description' => 'Create and configure shadows, generators, casters and receivers.',
//         'examples' => [
//             ['139', 'Basic Shadow', 'Create a basic shadow setup.', ['Shadows']],
//             ['140', 'Shadow Generator', 'Create and configure a ShadowGenerator.', ['Shadows']],
//             ['141', 'Shadow Map Size', 'Control shadow map size.', ['Shadows', 'Properties']],
//             ['142', 'Shadow Darkness', 'Control shadow darkness.', ['Shadows', 'Properties']],
//             ['143', 'Shadow Light Properties', 'Configure shadow-related light properties.', ['Shadows', 'Lighting']],
//             ['144', 'Shadow Caster', 'Configure a mesh as a shadow caster.', ['Shadows', 'Caster']],
//             ['145', 'Shadow Receiver', 'Configure a mesh as a shadow receiver.', ['Shadows', 'Receiver']],
//             ['146', 'Multiple Casters', 'Use multiple shadow casters.', ['Shadows', 'Caster']],
//             ['147', 'Multiple Receivers', 'Use multiple shadow receivers.', ['Shadows', 'Receiver']],
//             ['148', 'Multiple Shadow Generators', 'Use multiple shadow generators.', ['Shadows', 'Multiple']],
//             ['149', 'Shadows + Multiple Lights', 'Combine shadows with multiple lights.', ['Shadows', 'Lighting']],
//             ['150', 'Advanced Shadow Scene', 'Build a complete advanced shadow scene.', ['Shadows', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '12',
//         'title' => 'Physics',
//         'description' => 'Build Havok-powered physics scenes and collision systems.',
//         'examples' => [
// ['151', 'Basic Fall', 'Drop a single dynamic box and watch it respond to gravity.', ['Physics', 'Basics']],
// ['152', 'Falling on the Ground', 'Drop a dynamic box onto a static ground plane with restitution and friction.', ['Physics', 'Ground', 'Basics']],
// ['153', 'Multiple Dynamic Bodies', 'Collide two dynamic boxes above a static ground with restitution.', ['Physics', 'Collision', 'Multiple']],
// ['154', 'Physics Properties', 'Configure restitution, friction, linear damping, and angular damping.', ['Physics', 'Properties']],
// ['155', 'Damping and Sleep', 'Compare two boxes with different damping and sleep settings.', ['Physics', 'Properties', 'Sleep']],
// ['156', 'Linear and Angular Velocity', 'Launch a box with initial linear and angular velocity.', ['Physics', 'Velocity']],
// ['157', 'Impulse', 'Kick a resting box upward with an impulse at a contact point.', ['Physics', 'Impulse']],
// ['158', 'Impulse and Force', 'Combine an impulse with a continuous force on the same body.', ['Physics', 'Impulse', 'Force']],
// ['159', 'Motion Type', 'Set the motion type of a physics body explicitly.', ['Physics', 'Body', 'Motion']],
// ['160', 'Collision Event', 'Log collision events when a box hits the ground.', ['Physics', 'Collision']],
// ['161', 'Two-Body Collision', 'Log collisions between two dynamic boxes and the ground.', ['Physics', 'Collision', 'Multiple']],
// ['162', 'Collision Event Fields', 'Inspect type, collider, point, normal, and impulse on collision.', ['Physics', 'Collision']],
// ['163', 'Collision Start and End', 'Handle both collision started and collision ended events.', ['Physics', 'Collision']],
// ['164', 'Collision Type Filtering', 'Filter collisions by started, continued, or finished types.', ['Physics', 'Collision', 'Filtering']],

// ['165', 'Havok Physics Initialization', 'Initialize Havok through the runtime and see the scene physics enabled on first physics element.', ['Physics', 'Havok', 'Initialization']],
// ['166', 'Physics Shape Sphere', 'Use a SPHERE physics shape for rolling balls.', ['Physics', 'Shape']],
// ['167', 'Physics Shape Capsule', 'Use a CAPSULE physics shape for character-like bodies.', ['Physics', 'Shape']],
// ['168', 'Physics Shape Cylinder', 'Use a CYLINDER physics shape for barrels and pillars.', ['Physics', 'Shape']],
// ['169', 'Physics Shape Convex Hull', 'Use a CONVEX_HULL shape for approximate mesh collision.', ['Physics', 'Shape']],
// ['170', 'Physics Shape Mesh', 'Use a MESH shape for exact mesh collision.', ['Physics', 'Shape']],
// ['171', 'Physics Shape Ground', 'Use a GROUND shape for an infinite static plane.', ['Physics', 'Shape', 'Static']],
// ['172', 'Shape Comparison', 'Compare BOX, SPHERE, CAPSULE, and CYLINDER side by side.', ['Physics', 'Shape', 'Comparison']],

// ['173', 'Static Body', 'Create a static body that never moves under gravity.', ['Physics', 'Body', 'Static']],
// ['174', 'Dynamic Body', 'Create a dynamic body that responds to gravity and collisions.', ['Physics', 'Body', 'Dynamic']],
// ['175', 'Kinematic Body', 'Create a kinematic body driven by its transform, not forces.', ['Physics', 'Body', 'Kinematic']],
// ['176', 'Motion Type Switching', 'Switch a body between DYNAMIC, STATIC, and KINEMATIC at runtime.', ['Physics', 'Body', 'Motion', 'Action']],

// ['177', 'Velocity on the Ground', 'Give a resting box horizontal velocity and friction slowing it down.', ['Physics', 'Velocity', 'Friction']],
// ['178', 'Angular Spin', 'Apply pure angular velocity and watch a box spin in place.', ['Physics', 'Velocity', 'Angular']],
// ['179', 'Impulse at Contact Point', 'Compare an off-center impulse against a centered one.', ['Physics', 'Impulse', 'Contact']],
// ['180', 'Continuous Force', 'Apply a force each frame using an observable on the physics body.', ['Physics', 'Force', 'Observable']],
// ['181', 'Jump on Click', 'Apply an upward impulse whenever the user clicks the canvas.', ['Physics', 'Impulse', 'Action', 'Interaction']],

// ['182', 'Click to Drop a Ball', 'Spawn a dynamic sphere with an impulse on each click.', ['Physics', 'Actions', 'Interaction']],
// ['183', 'Shoot a Cannonball', 'Fire a sphere with linear velocity along the camera forward vector.', ['Physics', 'Velocity', 'Camera']],
// ['184', 'Stacked Boxes Tower', 'Stack several dynamic boxes and watch the tower topple.', ['Physics', 'Multiple', 'Stacking']],
// ['185', 'Domino Row', 'Line up thin boxes as dominoes and topple the first one.', ['Physics', 'Multiple', 'Chain']],
// ['186', 'Bouncing Balls Pit', 'Drop many spheres of different restitution into a bowl.', ['Physics', 'Multiple', 'Restitution']],
// ['187', 'Bowling Alley', 'Roll a heavy sphere into a triangle of light pins.', ['Physics', 'Multiple', 'Collision']],
// ['188', 'Ragdoll Sketch', 'Chain multiple bodies with compounds to approximate a ragdoll.', ['Physics', 'Multiple', 'Compound']],
// ['189', 'Elevator Platform', 'Move a kinematic platform up and down to carry a dynamic box.', ['Physics', 'Kinematic', 'Animation']],
// ['190', 'Conveyor Floor', 'Apply continuous force to simulate a moving conveyor surface.', ['Physics', 'Force', 'Kinematic']],

// ['191', 'Physics + Model Caster', 'Load a GLB model and attach a physics body to it.', ['Physics', 'Models', 'Physics']],
// ['193', 'Physics + Material', 'Assign different StandardMaterials to physics bodies.', ['Physics', 'Materials', 'Physics']],
// ['194', 'Physics + Actions', 'Trigger a runtime action when a body collides with the ground.', ['Physics', 'Actions', 'Collision']],
// ['195', 'Physics + Animation', 'Play a model animation when its physics body starts colliding.', ['Physics', 'Models', 'Animation', 'Collision']],
// ['196', 'Physics + Skybox', 'Fall a box inside an environment skybox with HDR reflections.', ['Physics', 'Environment', 'HDR']],

// ['197', 'Collision Counter UI', 'Count collisions between a box and the ground using a GUI text.', ['Physics', 'Collision', 'GUI']],
// ['198', 'Collision Log Panel', 'Print every collision into an AdvancedDynamicTexture text block.', ['Physics', 'Collision', 'GUI']],
// ['199', 'Collision Type Badge', 'Update a GUI text with the last collision type observed.', ['Physics', 'Collision', 'GUI']],
// ['200', 'Collision Impulse Meter', 'Visualize the last collision impulse magnitude with a GUI bar.', ['Physics', 'Collision', 'GUI']],
// ['201', 'Per-Body Collision Feed', 'Route collisions from multiple bodies into separate GUI labels.', ['Physics', 'Collision', 'Multiple', 'GUI']],
// ['202', 'Reset Scene Button', 'Add a GUI button that resets all dynamic bodies to their start transforms.', ['Physics', 'GUI', 'Action']],
// ['203', 'Spawn on Button Click', 'Add a GUI button that spawns a new dynamic sphere each press.', ['Physics', 'GUI', 'Action']],
// ['204', 'Pause and Resume Physics', 'Add GUI buttons that disable and re-enable the physics engine.', ['Physics', 'GUI', 'Action']],

// ['205', 'Physics Playground', 'A single scene combining shapes, materials, static and dynamic bodies, and GUI controls.', ['Physics', 'Advanced', 'Playground']],
// ['206', 'Physics Sandbox UI', 'A control panel with buttons to spawn, reset, and impulse bodies.', ['Physics', 'Advanced', 'GUI']],
// ['207', 'Pendulum Swing', 'Hang a heavy box from a spherical joint-like constraint by chaining bodies.', ['Physics', 'Advanced', 'Constraint']],
// ['208', 'Angry Ball Launcher', 'Aim and launch spheres at a stack of boxes with a GUI trigger.', ['Physics', 'Advanced', 'Interaction']],
// ['209', 'Physics Puzzle Level', 'A small box-pushing puzzle driven entirely by physics and clicks.', ['Physics', 'Advanced', 'Puzzle']],
// ['210', 'Complete Physics Demo', 'A showcase scene that combines falling, stacking, shooting, and collision UI in one page.', ['Physics', 'Advanced', 'Showcase']],
//         ],
//     ],
//     [
//         'number' => '13',
//         'title' => 'Generic Runtime Construction',
//         'description' => 'Use the runtime generic constructor system for Babylon.js and Babylon.GUI objects.',
//         'examples' => [
//             ['172', 'Generic Babylon Constructor', 'Create an object through the generic Babylon constructor resolver.', ['Runtime', 'Babylon.js']],
//             ['173', 'Generic Babylon Constructor with Arguments', 'Create a generic Babylon object with custom constructor arguments.', ['Runtime', 'Babylon.js', 'Arguments']],
//             ['174', 'Generic Babylon GUI Constructor', 'Create a Babylon GUI object through generic construction.', ['Runtime', 'GUI']],
//             ['175', 'Generic Constructor References', 'Use runtime references with generic constructors.', ['Runtime', 'References']],
//             ['176', 'Generic Constructor Properties', 'Configure generic constructor objects through properties.', ['Runtime', 'Properties']],
//             ['177', 'Generic Constructor + Expressions', 'Use JavaScript expressions with generic constructors.', ['Runtime', 'JavaScript']],
//             ['178', 'Generic Constructor + Parent', 'Parent a generic runtime object to another object.', ['Runtime', 'Hierarchy']],
//             ['179', 'Generic Constructor + Material', 'Assign materials to generic runtime objects.', ['Runtime', 'Materials']],
//             ['180', 'Advanced Generic Runtime Scene', 'Build a complete scene using generic runtime construction.', ['Runtime', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '14',
//         'title' => 'Runtime Integration & API',
//         'description' => 'Combine runtime capabilities and use the public JavaScript runtime API.',
//         'examples' => [
//             ['181', 'Canvas + Runtime + Camera', 'Combine the canvas, runtime and camera systems.', ['Canvas', 'Runtime', 'Camera']],
//             ['182', 'Runtime + Camera + Light', 'Combine runtime, camera and lighting.', ['Runtime', 'Camera', 'Lighting']],
//             ['183', 'Runtime + Camera + Mesh', 'Combine runtime, camera and meshes.', ['Runtime', 'Camera', 'Mesh']],
//             ['184', 'Runtime + Camera + Model', 'Combine runtime, camera and models.', ['Runtime', 'Camera', 'Models']],
//             ['185', 'Runtime + Mesh + Material', 'Combine meshes and materials.', ['Mesh', 'Materials']],
//             ['186', 'Runtime + Model + Environment', 'Combine models with an environment.', ['Models', 'Environment']],
//             ['187', 'Runtime + Model + Animation', 'Combine models and animation control.', ['Models', 'Animation']],
//             ['188', 'Runtime + Model + Lighting', 'Combine models and lighting.', ['Models', 'Lighting']],
//             ['189', 'Runtime + Model + Shadows', 'Combine models and shadows.', ['Models', 'Shadows']],
//             ['190', 'Runtime + Model + Physics', 'Combine models and physics.', ['Models', 'Physics']],
//             ['191', 'Runtime + GUI + Scene', 'Combine GUI and runtime scene elements.', ['GUI', 'Scene']],
//             ['192', 'Runtime + Events + Actions', 'Build an event-driven runtime scene.', ['Events', 'Actions']],
//             ['193', 'Runtime + References + Actions', 'Combine references with runtime actions.', ['References', 'Actions']],
//             ['194', 'Runtime + Multiple Models + Progress', 'Load multiple models with aggregate progress.', ['Models', 'Loading']],
//             ['195', 'Runtime + Multiple Cameras + Lights', 'Combine multiple cameras and lights.', ['Camera', 'Lighting']],
//             ['196', 'Runtime + Physics + Collision Actions', 'Connect physics collisions to runtime actions.', ['Physics', 'Collision', 'Actions']],
//             ['197', 'Runtime + Shadows + Environment', 'Combine shadows and environment lighting.', ['Shadows', 'Environment']],
//             ['198', 'Runtime Full Feature Scene', 'Combine the major runtime systems into one scene.', ['Runtime', 'Advanced']],
//             ['199', 'Runtime Production-Style Scene', 'Build a production-oriented runtime scene.', ['Runtime', 'Production']],
//             ['200', 'ready() — Basic', 'Initialize the runtime using the ready() API.', ['API', 'Runtime']],
//             ['201', 'ready() — Scene Retrieval', 'Retrieve the initialized Babylon.js scene through ready().', ['API', 'Scene']],
//             ['202', 'ready() — Scene Caching', 'Demonstrate ready() scene caching.', ['API', 'Runtime']],
//             ['203', 'ready() — Repeated Initialization', 'Handle repeated ready() initialization safely.', ['API', 'Runtime']],
//             ['204', 'loadModel() — Basic', 'Load a model using the runtime loadModel() API.', ['API', 'Models']],
//             ['205', 'loadModel() — Custom Model ID', 'Load a model with a custom runtime ID.', ['API', 'Models']],
//             ['206', 'loadModel() + Model Registry', 'Use loadModel() with registered model data.', ['API', 'Models', 'Registry']],
//             ['207', 'loadModel() + Model Animation', 'Load and control model animation through the API.', ['API', 'Models', 'Animation']],
//             ['208', 'loadModel() + Multiple Models', 'Load multiple models programmatically.', ['API', 'Models']],
//             ['209', 'Runtime API + Declarative Scene', 'Combine the JavaScript API with declarative runtime markup.', ['API', 'Runtime']],
//             ['210', 'Runtime API Full Integration', 'Build a complete runtime API integration.', ['API', 'Runtime', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '15',
//         'title' => 'Plugin System',
//         'description' => 'Introduce the Arashtad 3D Runtime plugin architecture and integration.',
//         'examples' => [
//             ['211', 'Plugin Architecture — Basic', 'Introduce the runtime plugin architecture.', ['Plugins', 'Architecture']],
//             ['212', 'Loading Runtime Plugins', 'Load the runtime plugin bundle.', ['Plugins', 'Runtime']],
//             ['213', 'Accessing Plugin APIs', 'Access public plugin APIs from JavaScript.', ['Plugins', 'API']],
//             ['214', 'Runtime + Plugin Integration', 'Combine runtime features with plugins.', ['Runtime', 'Plugins']],
//         ],
//     ],
//     [
//         'number' => '16',
//         'title' => 'Models Plugin',
//         'description' => 'Use the implemented Models plugin to inspect loaded model data.',
//         'examples' => [
//             ['215', 'Models Plugin — Basic', 'Initialize and use the Models plugin.', ['Plugins', 'Models']],
//             ['216', 'Get Model Data', 'Retrieve registered model data.', ['Plugins', 'Models', 'API']],
//             ['217', 'Get Model Meshes', 'Retrieve meshes from a loaded model.', ['Plugins', 'Models', 'Meshes']],
//             ['218', 'Get Model Animations', 'Retrieve animations from a loaded model.', ['Plugins', 'Models', 'Animation']],
//             ['219', 'Get Model Skeletons', 'Retrieve skeletons from a loaded model.', ['Plugins', 'Models', 'Skeletons']],
//             ['220', 'Get Model Particle Systems', 'Retrieve particle systems from a loaded model.', ['Plugins', 'Models', 'Particles']],
//             ['221', 'Models Plugin + Model References', 'Combine the Models plugin with runtime model references.', ['Plugins', 'Models', 'References']],
//             ['222', 'Models Plugin + Interactions', 'Use model data with the Interactions plugin.', ['Plugins', 'Models', 'Interactions']],
//             ['223', 'Models Plugin Advanced Scene', 'Build an advanced scene using the Models plugin.', ['Plugins', 'Models', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '17',
//         'title' => 'Lazy Loading Plugin',
//         'description' => 'Load runtime scenes only when their containers approach the viewport.',
//         'examples' => [
//             ['224', 'Lazy Loading — Basic', 'Create a basic lazy-loaded runtime scene.', ['Plugins', 'Lazy Loading']],
//             ['225', 'Lazy Loading with Root Margin', 'Configure the lazy-loading root margin.', ['Plugins', 'Lazy Loading']],
//             ['226', 'Lazy Loading Callback', 'Execute custom code when lazy loading is triggered.', ['Plugins', 'Lazy Loading', 'API']],
//             ['227', 'Multiple Lazy-Loaded Scenes', 'Lazy-load multiple runtime scenes.', ['Plugins', 'Lazy Loading']],
//             ['228', 'Lazy Loading + Runtime Initialization', 'Initialize the runtime when the scene enters the loading range.', ['Plugins', 'Lazy Loading', 'Runtime']],
//             ['229', 'Lazy Loading + Models', 'Combine lazy loading with model loading.', ['Plugins', 'Lazy Loading', 'Models']],
//             ['230', 'Lazy Loading + Interactions', 'Combine lazy loading with interactions.', ['Plugins', 'Lazy Loading', 'Interactions']],
//             ['231', 'Advanced Lazy Loading Scene', 'Build a complete lazy-loading scene.', ['Plugins', 'Lazy Loading', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '18',
//         'title' => 'Scroll Lock Plugin',
//         'description' => 'Control page scrolling while interacting with 3D canvases.',
//         'examples' => [
//             ['232', 'Scroll Lock — Basic', 'Create a basic scroll-locked canvas.', ['Plugins', 'Scroll Lock']],
//             ['233', 'Enable Scroll Lock', 'Enable scroll locking for runtime canvases.', ['Plugins', 'Scroll Lock']],
//             ['234', 'Disable Scroll Lock', 'Disable scroll locking.', ['Plugins', 'Scroll Lock']],
//             ['235', 'Scroll Lock + Canvas', 'Use scroll locking with a runtime canvas.', ['Plugins', 'Scroll Lock', 'Canvas']],
//             ['236', 'Scroll Lock + Touch Controls', 'Combine scroll locking with touch controls.', ['Plugins', 'Scroll Lock', 'Touch']],
//             ['237', 'Scroll Lock + Multiple Scenes', 'Manage scroll locking across multiple scenes.', ['Plugins', 'Scroll Lock', 'Multiple']],
//         ],
//     ],
//     [
//         'number' => '19',
//         'title' => 'Touch Controls Plugin',
//         'description' => 'Add touch gestures and mobile interaction behavior to runtime scenes.',
//         'examples' => [
//             ['238', 'Touch Controls — Basic', 'Enable basic touch controls.', ['Plugins', 'Touch']],
//             ['239', 'Touch Scroll Prevention', 'Prevent page scrolling during touch interaction.', ['Plugins', 'Touch']],
//             ['240', 'Touch Double Tap', 'Handle touch double-tap gestures.', ['Plugins', 'Touch']],
//             ['241', 'Touch Long Press', 'Handle touch long-press gestures.', ['Plugins', 'Touch']],
//             ['242', 'Touch Move 3D', 'Handle three-dimensional touch movement events.', ['Plugins', 'Touch']],
//             ['243', 'Touch Event Data', 'Use the data supplied by touch events.', ['Plugins', 'Touch', 'Events']],
//             ['244', 'Touch Controls Options', 'Configure touch-control options.', ['Plugins', 'Touch', 'Configuration']],
//             ['245', 'Enable Controls for Multiple Canvases', 'Enable touch controls across multiple canvases.', ['Plugins', 'Touch', 'Multiple']],
//             ['246', 'Disable Controls', 'Disable touch controls.', ['Plugins', 'Touch']],
//             ['247', 'Touch Controls + Interactions', 'Combine touch controls with interactions.', ['Plugins', 'Touch', 'Interactions']],
//             ['248', 'Touch Controls + Scroll Lock', 'Combine touch controls with scroll locking.', ['Plugins', 'Touch', 'Scroll Lock']],
//             ['249', 'Advanced Touch Scene', 'Build a complete touch-driven 3D scene.', ['Plugins', 'Touch', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '20',
//         'title' => 'Interactions Plugin — Foundation',
//         'description' => 'Introduce raycasting, picking and pointer events through the Interactions plugin.',
//         'examples' => [
//             ['250', 'Interactions — Basic', 'Initialize the Interactions plugin.', ['Plugins', 'Interactions']],
//             ['251', 'Enable Interactions', 'Enable interaction handling for a scene and canvas.', ['Plugins', 'Interactions']],
//             ['252', 'Basic Raycast', 'Perform a basic scene raycast.', ['Interactions', 'Raycasting']],
//             ['253', 'Raycast Mesh', 'Retrieve the mesh hit by a raycast.', ['Interactions', 'Raycasting']],
//             ['254', 'Raycast Point', 'Retrieve the picked point from a raycast.', ['Interactions', 'Raycasting']],
//             ['255', 'Pick Event', 'Handle object picking.', ['Interactions', 'Events']],
//             ['256', 'Pointer Over', 'Handle pointer-over interactions.', ['Interactions', 'Events']],
//             ['257', 'Pointer Out', 'Handle pointer-out interactions.', ['Interactions', 'Events']],
//             ['258', 'Pointer Move', 'Handle pointer-move interactions.', ['Interactions', 'Events']],
//             ['259', 'Pointer Down', 'Handle pointer-down interactions.', ['Interactions', 'Events']],
//             ['260', 'Pointer Up', 'Handle pointer-up interactions.', ['Interactions', 'Events']],
//             ['261', 'Interaction Custom Events', 'Use the canvas custom events emitted by the plugin.', ['Interactions', 'Events']],
//         ],
//     ],
//     [
//         'number' => '21',
//         'title' => 'Interactions — Targets',
//         'description' => 'Target individual meshes, groups, patterns and complete hierarchies.',
//         'examples' => [
//             ['262', 'Target by Mesh', 'Bind an interaction directly to a mesh.', ['Interactions', 'Targets']],
//             ['263', 'Target by Mesh Name', 'Target meshes by exact name.', ['Interactions', 'Targets', 'Names']],
//             ['264', 'Target Multiple Meshes by Name', 'Target multiple meshes sharing an exact name.', ['Interactions', 'Targets']],
//             ['265', 'Target by Regular Expression', 'Target meshes using a regular expression.', ['Interactions', 'Targets', 'Regex']],
//             ['266', 'Target by Array', 'Resolve multiple target types from an array.', ['Interactions', 'Targets']],
//             ['267', 'Target by Hierarchy', 'Target a root mesh and its hierarchy.', ['Interactions', 'Targets', 'Hierarchy']],
//             ['268', 'Resolve Targets', 'Use the target-resolution API.', ['Interactions', 'Targets', 'API']],
//             ['269', 'Complex Target Resolution', 'Combine multiple target-resolution techniques.', ['Interactions', 'Targets', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '22',
//         'title' => 'Interactions — Bindings',
//         'description' => 'Build configuration-driven interaction bindings and manage their lifecycle.',
//         'examples' => [
//             ['270', 'Basic Event Binding', 'Bind an event handler to a mesh.', ['Interactions', 'Bindings']],
//             ['271', 'Bind Multiple Events', 'Bind multiple events to a target.', ['Interactions', 'Bindings']],
//             ['272', 'Bind by Mesh Name', 'Create bindings by exact mesh name.', ['Interactions', 'Bindings', 'Names']],
//             ['273', 'Bind All Matching Meshes', 'Bind all meshes matching an exact name.', ['Interactions', 'Bindings']],
//             ['274', 'Bind by Regular Expression', 'Bind interactions to matching mesh names.', ['Interactions', 'Bindings', 'Regex']],
//             ['275', 'Bind Hierarchy', 'Bind interactions to a complete hierarchy.', ['Interactions', 'Bindings', 'Hierarchy']],
//             ['276', 'Unbind Event', 'Remove an individual event binding.', ['Interactions', 'Bindings']],
//             ['277', 'Unbind All Events', 'Remove all event bindings from a mesh.', ['Interactions', 'Bindings']],
//             ['278', 'Remove Mesh Bindings', 'Remove all plugin bindings associated with a mesh.', ['Interactions', 'Bindings']],
//             ['279', 'Binding Configuration', 'Create configuration-driven bindings.', ['Interactions', 'Bindings', 'Configuration']],
//             ['280', 'Destroy Individual Binding', 'Destroy a single binding without affecting others.', ['Interactions', 'Bindings', 'Lifecycle']],
//             ['281', 'Advanced Binding System', 'Build a complete interaction binding system.', ['Interactions', 'Bindings', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '23',
//         'title' => 'Interactions — Highlighting',
//         'description' => 'Highlight and restore interactive objects.',
//         'examples' => [
//             ['282', 'Basic Highlight', 'Highlight a mesh during interaction.', ['Interactions', 'Highlight']],
//             ['283', 'Highlight Color', 'Customize highlight color.', ['Interactions', 'Highlight']],
//             ['284', 'Highlight Width', 'Customize highlight outline width.', ['Interactions', 'Highlight']],
//             ['285', 'Unhighlight', 'Remove a plugin-managed highlight.', ['Interactions', 'Highlight']],
//             ['286', 'Restore Original Highlight State', 'Restore the mesh state saved before highlighting.', ['Interactions', 'Highlight']],
//             ['287', 'Clear All Highlights', 'Clear all plugin-managed highlights.', ['Interactions', 'Highlight']],
//             ['288', 'Highlight Multiple Objects', 'Highlight multiple objects independently.', ['Interactions', 'Highlight']],
//             ['289', 'Highlight + Pointer Events', 'Connect highlighting to pointer events.', ['Interactions', 'Highlight', 'Events']],
//             ['290', 'Advanced Highlight Scene', 'Build a complete highlight-driven interaction scene.', ['Interactions', 'Highlight', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '24',
//         'title' => 'Interactions — Cards',
//         'description' => 'Display contextual HTML information cards for interactive objects.',
//         'examples' => [
//             ['291', 'Basic Card', 'Display a basic interaction card.', ['Interactions', 'Cards']],
//             ['292', 'Card HTML Content', 'Display HTML content inside an interaction card.', ['Interactions', 'Cards', 'HTML']],
//             ['293', 'Card Position', 'Control the card position.', ['Interactions', 'Cards', 'Position']],
//             ['294', 'Card CSS Class', 'Customize the card CSS class.', ['Interactions', 'Cards', 'CSS']],
//             ['295', 'Card Z-Index', 'Control the card stacking order.', ['Interactions', 'Cards', 'CSS']],
//             ['296', 'Hide Card', 'Hide an interaction card.', ['Interactions', 'Cards']],
//             ['297', 'Multiple Cards', 'Manage cards for multiple meshes.', ['Interactions', 'Cards']],
//             ['298', 'Card + Picking', 'Display cards from picking interactions.', ['Interactions', 'Cards', 'Picking']],
//             ['299', 'Card + Highlight', 'Combine cards with mesh highlighting.', ['Interactions', 'Cards', 'Highlight']],
//             ['300', 'Advanced Interactive Information Scene', 'Build a complete interactive information scene.', ['Interactions', 'Cards', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '25',
//         'title' => 'Interactions — Navigation',
//         'description' => 'Navigate active cameras to interactive targets.',
//         'examples' => [
//             ['301', 'Basic Camera Navigation', 'Navigate the active camera to an interactive target.', ['Interactions', 'Navigation', 'Camera']],
//             ['302', 'Navigate to Position', 'Navigate the camera to a target position.', ['Interactions', 'Navigation']],
//             ['303', 'Navigate to Target', 'Set the camera target during navigation.', ['Interactions', 'Navigation']],
//             ['304', 'Navigate with Radius', 'Control ArcRotateCamera radius during navigation.', ['Interactions', 'Navigation']],
//             ['305', 'Navigate with Alpha', 'Control ArcRotateCamera alpha during navigation.', ['Interactions', 'Navigation']],
//             ['306', 'Navigate with Beta', 'Control ArcRotateCamera beta during navigation.', ['Interactions', 'Navigation']],
//             ['307', 'Navigate to Mesh', 'Navigate the camera to an interactive mesh.', ['Interactions', 'Navigation', 'Mesh']],
//             ['308', 'Navigation + Picking', 'Navigate based on picked objects.', ['Interactions', 'Navigation', 'Picking']],
//             ['309', 'Navigation + Cards', 'Combine camera navigation with information cards.', ['Interactions', 'Navigation', 'Cards']],
//             ['310', 'Advanced Navigation Scene', 'Build a complete interactive navigation scene.', ['Interactions', 'Navigation', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '26',
//         'title' => 'Interactions — Points',
//         'description' => 'Create and manage interactive 3D points.',
//         'examples' => [
//             ['311', 'Basic Interaction Point', 'Create a basic interaction point.', ['Interactions', 'Points']],
//             ['312', 'Point Position', 'Control the position of an interaction point.', ['Interactions', 'Points']],
//             ['313', 'Point Diameter', 'Control the diameter of an interaction point.', ['Interactions', 'Points']],
//             ['314', 'Point Name', 'Assign a name to an interaction point.', ['Interactions', 'Points']],
//             ['315', 'Point Material', 'Assign a material to an interaction point.', ['Interactions', 'Points', 'Materials']],
//             ['316', 'Remove Point', 'Remove an individual interaction point.', ['Interactions', 'Points']],
//             ['317', 'Clear Points', 'Remove all interaction points.', ['Interactions', 'Points']],
//             ['318', 'Dynamic Points', 'Create and manage points dynamically.', ['Interactions', 'Points', 'Dynamic']],
//             ['319', 'Point + Picking', 'Combine interaction points with picking.', ['Interactions', 'Points', 'Picking']],
//             ['320', 'Point + Built-In Action', 'Create interaction points through built-in actions.', ['Interactions', 'Points', 'Actions']],
//             ['321', 'Advanced Point Scene', 'Build a complete point-based interaction scene.', ['Interactions', 'Points', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '27',
//         'title' => 'Interactions — Actions',
//         'description' => 'Use built-in and custom interaction actions.',
//         'examples' => [
//             ['322', 'Highlight Action', 'Trigger the built-in highlight action.', ['Interactions', 'Actions', 'Highlight']],
//             ['323', 'Unhighlight Action', 'Trigger the built-in unhighlight action.', ['Interactions', 'Actions', 'Highlight']],
//             ['324', 'Card Action', 'Trigger the built-in card action.', ['Interactions', 'Actions', 'Cards']],
//             ['325', 'Hide Card Action', 'Trigger the built-in hide-card action.', ['Interactions', 'Actions', 'Cards']],
//             ['326', 'Navigate Action', 'Trigger the built-in navigation action.', ['Interactions', 'Actions', 'Navigation']],
//             ['327', 'Point Action', 'Trigger the built-in point action.', ['Interactions', 'Actions', 'Points']],
//             ['328', 'Function Action', 'Use a custom JavaScript function as an action.', ['Interactions', 'Actions', 'JavaScript']],
//             ['329', 'Action Context', 'Use interaction context data inside actions.', ['Interactions', 'Actions', 'API']],
//             ['330', 'Action + Interactions Instance', 'Use the interactions instance from an action.', ['Interactions', 'Actions', 'API']],
//             ['331', 'Multiple Actions', 'Combine multiple interaction actions.', ['Interactions', 'Actions']],
//             ['332', 'Conditional Custom Action', 'Build conditional behavior with a custom action function.', ['Interactions', 'Actions', 'JavaScript']],
//             ['333', 'Advanced Action-Driven Scene', 'Build a complete action-driven interaction scene.', ['Interactions', 'Actions', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '28',
//         'title' => 'Interactions — Complete Systems',
//         'description' => 'Combine the interaction subsystem into complete application-level experiences.',
//         'examples' => [
//             ['334', 'Interactive Model', 'Turn a loaded model into an interactive experience.', ['Interactions', 'Models']],
//             ['335', 'Interactive Product', 'Create an interactive product experience.', ['Interactions', 'Product']],
//             ['336', 'Interactive Architecture Model', 'Create an interactive architectural model.', ['Interactions', 'Architecture']],
//             ['337', 'Interactive Technical Model', 'Create an interactive technical model.', ['Interactions', 'Technical']],
//             ['338', 'Interactive Map', 'Create an interactive 3D map.', ['Interactions', 'Map']],
//             ['339', 'Interactive Information Model', 'Create an interactive information model.', ['Interactions', 'Information']],
//             ['340', 'Interactive Model with Cards', 'Combine an interactive model with information cards.', ['Interactions', 'Cards', 'Models']],
//             ['341', 'Interactive Model with Highlights', 'Combine an interactive model with highlighting.', ['Interactions', 'Highlight', 'Models']],
//             ['342', 'Interactive Model with Camera Navigation', 'Combine model interaction with camera navigation.', ['Interactions', 'Navigation', 'Models']],
//             ['343', 'Interactive Model with Points', 'Combine model interaction with 3D points.', ['Interactions', 'Points', 'Models']],
//             ['344', 'Interactive Model with Multiple Target Types', 'Combine names, patterns, arrays and hierarchies as interaction targets.', ['Interactions', 'Targets', 'Models']],
//             ['345', 'Interactive Model with Touch Controls', 'Combine interactions with touch controls.', ['Interactions', 'Touch', 'Models']],
//             ['346', 'Interactive Model with Lazy Loading', 'Combine interactions with lazy-loaded scenes.', ['Interactions', 'Lazy Loading', 'Models']],
//             ['347', 'Full Interactions System', 'Build a complete application-level interaction system.', ['Interactions', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '29',
//         'title' => 'Plugin Combinations',
//         'description' => 'Combine the implemented runtime plugins into progressively larger systems.',
//         'examples' => [
//             ['348', 'Models + Interactions', 'Combine the Models and Interactions plugins.', ['Plugins', 'Models', 'Interactions']],
//             ['349', 'Models + Lazy Loading', 'Combine model loading with lazy loading.', ['Plugins', 'Models', 'Lazy Loading']],
//             ['350', 'Models + Touch Controls', 'Combine model scenes with touch controls.', ['Plugins', 'Models', 'Touch']],
//             ['351', 'Models + Scroll Lock', 'Combine model scenes with scroll locking.', ['Plugins', 'Models', 'Scroll Lock']],
//             ['352', 'Lazy Loading + Interactions', 'Combine lazy loading with interactions.', ['Plugins', 'Lazy Loading', 'Interactions']],
//             ['353', 'Touch Controls + Interactions', 'Combine touch controls with interactions.', ['Plugins', 'Touch', 'Interactions']],
//             ['354', 'Scroll Lock + Touch Controls + Interactions', 'Combine scroll locking, touch controls and interactions.', ['Plugins', 'Scroll Lock', 'Touch', 'Interactions']],
//             ['355', 'Models + Lazy Loading + Interactions', 'Combine model loading, lazy loading and interactions.', ['Plugins', 'Models', 'Lazy Loading', 'Interactions']],
//             ['356', 'Models + Touch Controls + Interactions', 'Combine models, touch controls and interactions.', ['Plugins', 'Models', 'Touch', 'Interactions']],
//             ['357', 'All Implemented Plugins Together', 'Use all currently implemented plugins together.', ['Plugins', 'All']],
//             ['358', 'Full Runtime + All Implemented Plugins', 'Combine the runtime with every currently implemented plugin.', ['Runtime', 'Plugins', 'Advanced']],
//         ],
//     ],
//     [
//         'number' => '30',
//         'title' => 'Final Production Examples',
//         'description' => 'Complete production-oriented examples demonstrating the runtime and plugins together.',
//         'examples' => [
//             ['359', 'Complete 3D Product Viewer', 'Build a complete production-style 3D product viewer.', ['Product', 'Production']],
//             ['360', 'Complete Interactive Product Configurator Foundation', 'Build the foundation of a complete interactive product configurator.', ['Product', 'Configurator', 'Production']],
//             ['361', 'Complete Interactive Architectural Viewer', 'Build a complete interactive architectural viewer.', ['Architecture', 'Production']],
//             ['362', 'Complete Interactive Technical Documentation Viewer', 'Build a complete interactive technical documentation viewer.', ['Technical', 'Documentation', 'Production']],
//             ['363', 'Complete Interactive 3D Model Explorer', 'Build a complete interactive 3D model explorer.', ['Models', 'Explorer', 'Production']],
//             ['364', 'Complete Interactive 3D Presentation', 'Build a complete interactive 3D presentation.', ['Presentation', 'Production']],
//             ['365', 'Complete Interactive 3D Information System', 'Build a complete interactive 3D information system.', ['Information', 'Production']],
//             ['366', 'Complete Runtime + Plugin Showcase', 'Build the complete flagship demonstration of the runtime and implemented plugins.', ['Runtime', 'Plugins', 'Showcase']],
//         ],
//     ],
// ];

$categoriesDir = __DIR__ . '/categories';
$categories = [];

$dirs = array_filter(scandir($categoriesDir), function ($item) use ($categoriesDir) {
    return $item !== '.' && $item !== '..' && is_dir($categoriesDir . '/' . $item);
});

natcasesort($dirs);

foreach ($dirs as $categoryDir) {
    $categoryPath = $categoriesDir . '/' . $categoryDir;

    // Parse "01 Basic Scene & Runtime" -> number + title
    if (!preg_match('/^(\d+)\s+(.+)$/', $categoryDir, $m)) {
        continue;
    }
    $categoryNumber = $m[1];
    $categoryTitle = $m[2];

    // Read meta.txt for the description
    $description = '';
    $metaFile = $categoryPath . '/meta.txt';
    if (is_file($metaFile)) {
        $description = trim(file_get_contents($metaFile));
    }

    // Gather examples (subdirectories)
    $exampleDirs = array_filter(scandir($categoryPath), function ($item) use ($categoryPath) {
        return $item !== '.' && $item !== '..' && is_dir($categoryPath . '/' . $item);
    });

    natcasesort($exampleDirs);

    $examples = [];
    foreach ($exampleDirs as $exampleDir) {
        $examplePath = $categoryPath . '/' . $exampleDir;

        if (!preg_match('/^(\d+)\s+(.+)$/', $exampleDir, $em)) {
            continue;
        }
        $exampleNumber = $em[1];
        $exampleTitle = $em[2];

        $exampleDescription = '';
        $exampleKeywords = [];

        $indexFile = $examplePath . '/index.html';
        if (is_file($indexFile)) {
            $html = file_get_contents($indexFile);

            if (preg_match('/<meta\s+name=["\']description["\']\s+content=["\']([^"\']*)["\']/i', $html, $dm)) {
                $exampleDescription = $dm[1];
            }

            if (preg_match('/<meta\s+name=["\']keywords["\']\s+content=["\']([^"\']*)["\']/i', $html, $km)) {
                $exampleKeywords = array_map('trim', explode(',', $km[1]));
            }
        }

        $examples[] = [$exampleNumber, $exampleTitle, $exampleDescription, $exampleKeywords, $exampleDir, $categoryDir];
    }

    $categories[] = [
        'number' => $categoryNumber,
        'title' => $categoryTitle,
        'description' => $description,
        'examples' => $examples,
    ];
}

$total = 0;

foreach ($categories as $category) {
    $total += count($category['examples']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Arashtad 3D Runtime interactive examples, from basic Babylon.js scenes to production-ready 3D applications.">
    <title>Arashtad 3D Runtime — Examples</title>
    <link rel="stylesheet" href="assets/css/example.css">
</head>
<body>

<div class="example-site">

    <header class="example-header">
        <div class="example-header-inner">
            <a class="example-brand" href="./">
                <span class="example-brand-mark">A3D</span>
                <span class="example-brand-text">ARASHTAD 3D RUNTIME</span>
                <span class="example-brand-version">1.0.0</span>
            </a>

            <nav class="example-nav">
                <a href="#fundamentals">Fundamentals</a>
                <a href="#models">Models</a>
                <a href="#rendering">Rendering</a>
                <a href="#interaction">Interaction</a>
                <a href="#production">Production</a>
            </nav>
        </div>
    </header>

    <main class="example-main">

        <section class="example-hero">
            <div class="example-eyebrow">Interactive Examples</div>

            <h1>
                Build 3D for the <span>Web.</span>
            </h1>

            <p>
                A progressive collection of examples for Arashtad 3D Runtime,
                from the first scene and model to complete production-oriented
                3D applications built on Babylon.js.
            </p>

            <div class="example-hero-meta">
                <span class="example-badge green">90 Examples</span>
                <span class="example-badge">Babylon.js</span>
                <span class="example-badge">WebGL</span>
                <span class="example-badge orange">Runtime 1.0.0</span>
                <span class="example-badge">MIT</span>
            </div>
        </section>

        <section class="example-section">
            <div class="example-info-grid">
                <div class="example-stat">
                    <div class="example-stat-value"><?= $total ?></div>
                    <div class="example-stat-label">Examples</div>
                </div>

                <div class="example-stat">
                    <div class="example-stat-value">05</div>
                    <div class="example-stat-label">Progressive Levels</div>
                </div>

                <div class="example-stat">
                    <div class="example-stat-value">01→<?= $total ?></div>
                    <div class="example-stat-label">Simple to Production</div>
                </div>
            </div>
        </section>

        <?php foreach ($categories as $category): ?>
            <?php
            $anchor = match ($category['number']) {
                '01' => 'fundamentals',
                '02' => 'models',
                '03' => 'rendering',
                '04' => 'interaction',
                '05' => 'production',
                default => 'examples',
            };
            ?>
            <section class="example-category" id="<?= htmlspecialchars($anchor, ENT_QUOTES, 'UTF-8') ?>">

                <div class="example-category-heading">
                    <span class="example-category-number"><?= htmlspecialchars($category['number'], ENT_QUOTES, 'UTF-8') ?></span>
                    <h2><?= htmlspecialchars($category['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                </div>

                <p class="example-section-description">
                    <?= htmlspecialchars($category['description'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <div class="example-grid">
                    <?php foreach ($category['examples'] as $example): ?>
                        <?php
                        [$number, $title, $description, $tags, $directory, $categoryDir] = $example;
                        $relPath = 'categories/' . $categoryDir . '/' . $directory;
                        $path = implode('/', array_map('rawurlencode', explode('/', $relPath))) . '/';
                        $exists = is_dir(__DIR__ . '/' . $relPath);
                        ?>
                        <?php if ($exists): ?>
                            <a class="example-card" href="<?= htmlspecialchars($path, ENT_QUOTES, 'UTF-8') ?>">
                        <?php else: ?>
                            <div class="example-card coming-soon">
                        <?php endif; ?>

                            <div class="example-card-number"><?= htmlspecialchars($number, ENT_QUOTES, 'UTF-8') ?></div>
                            <div class="example-card-level"><?= htmlspecialchars($category['title'], ENT_QUOTES, 'UTF-8') ?></div>

                            <h3><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h3>

                            <p><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>

                            <div class="example-card-footer">
                                <div class="example-card-tags">
                                    <?php foreach ($tags as $tag): ?>
                                        <span class="example-card-tag"><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></span>
                                    <?php endforeach; ?>
                                </div>

                                <?php if ($exists): ?>
                                    <span class="example-card-arrow">OPEN →</span>
                                <?php else: ?>
                                    <span class="example-card-arrow">COMING SOON</span>
                                <?php endif; ?>
                            </div>

                        <?php if ($exists): ?>
                            </a>
                        <?php else: ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </section>
        <?php endforeach; ?>

    </main>

    <footer class="example-footer">
        <div class="example-footer-inner">
            <span>Arashtad 3D Runtime 1.0.0</span>
            <span>Powered by <a href="https://www.babylonjs.com/" target="_blank" rel="noopener noreferrer">Babylon.js</a></span>
        </div>
    </footer>

</div>

</body>
</html>