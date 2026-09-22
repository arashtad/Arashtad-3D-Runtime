<?php

$version = '1.1.0';

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
                <span class="example-brand-mark"></span>
                <span class="example-brand-text">ARASHTAD 3D RUNTIME</span>
                <span class="example-brand-version"><?php echo $version; ?></span>
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
                <span class="example-badge orange">Runtime <?php echo $version; ?></span>
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
            <span>Arashtad 3D Runtime <?php echo $version; ?></span>
            <span>Powered by <a href="https://www.babylonjs.com/" target="_blank" rel="noopener noreferrer">Babylon.js</a></span>
        </div>
    </footer>

</div>

</body>
</html>