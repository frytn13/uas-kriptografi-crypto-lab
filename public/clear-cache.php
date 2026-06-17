<?php
/**
 * EMERGENCY CACHE CLEARER
 * 
 * Cara pakai:
 * 1. Upload file ini ke public/
 * 2. Buka di browser: https://bengkel-dinamo-awi.my.id/crypto-lab/clear-cache.php
 * 3. Hapus file ini setelah selesai (security)
 */

// Prevent direct execution in production if not needed
$allowClear = true; // Set to false after use

if (!$allowClear) {
    die('Cache clearing is disabled. Remove this file for security.');
}

echo "<!DOCTYPE html>
<html>
<head>
    <title>Cache Clearer - Crypto Lab</title>
    <style>
        body {
            font-family: monospace;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #0a0a0a;
            color: #7cffb2;
        }
        h1 { color: #fff; }
        .success { color: #7cffb2; }
        .error { color: #ff6b6b; }
        .warning { color: #ffd93d; }
        pre {
            background: #1a1a1a;
            padding: 15px;
            border-radius: 5px;
            border-left: 3px solid #7cffb2;
            overflow-x: auto;
        }
        .box {
            border: 1px solid #333;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>🧹 Emergency Cache Clearer</h1>
    <div class='box'>";

// Get Laravel base path
$basePath = dirname(__DIR__);

echo "<strong>Base Path:</strong> <code>{$basePath}</code><br><br>";

$results = [];
$errors = [];

// 1. Clear View Cache
$viewPath = $basePath . '/storage/framework/views';
echo "<h2>1. Clearing View Cache...</h2>";

if (is_dir($viewPath)) {
    $files = glob($viewPath . '/*.php');
    $count = 0;
    
    foreach ($files as $file) {
        if (is_file($file)) {
            if (unlink($file)) {
                $count++;
            } else {
                $errors[] = "Failed to delete: " . basename($file);
            }
        }
    }
    
    if ($count > 0) {
        $results[] = "<span class='success'>✅ Deleted {$count} compiled view files</span>";
    } else {
        $results[] = "<span class='warning'>⚠️ No view cache files found</span>";
    }
} else {
    $errors[] = "View cache directory not found: {$viewPath}";
}

// 2. Clear Cache Files
$cachePath = $basePath . '/storage/framework/cache/data';
echo "<h2>2. Clearing Cache Data...</h2>";

if (is_dir($cachePath)) {
    $deleted = 0;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($cachePath, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() !== 'gitignore') {
            if (unlink($file->getPathname())) {
                $deleted++;
            }
        }
    }
    
    if ($deleted > 0) {
        $results[] = "<span class='success'>✅ Deleted {$deleted} cache files</span>";
    } else {
        $results[] = "<span class='warning'>⚠️ No cache files found</span>";
    }
} else {
    $results[] = "<span class='warning'>⚠️ Cache data directory not found</span>";
}

// 3. Clear Config Cache
$configCache = $basePath . '/bootstrap/cache/config.php';
echo "<h2>3. Clearing Config Cache...</h2>";

if (file_exists($configCache)) {
    if (unlink($configCache)) {
        $results[] = "<span class='success'>✅ Deleted config cache</span>";
    } else {
        $errors[] = "Failed to delete config cache";
    }
} else {
    $results[] = "<span class='warning'>⚠️ No config cache found</span>";
}

// 4. Clear Route Cache
$routeCache = $basePath . '/bootstrap/cache/routes-v7.php';
echo "<h2>4. Clearing Route Cache...</h2>";

if (file_exists($routeCache)) {
    if (unlink($routeCache)) {
        $results[] = "<span class='success'>✅ Deleted route cache</span>";
    } else {
        $errors[] = "Failed to delete route cache";
    }
} else {
    $results[] = "<span class='warning'>⚠️ No route cache found</span>";
}

echo "</div><div class='box'><h2>📊 Results:</h2>";

foreach ($results as $result) {
    echo "<p>{$result}</p>";
}

if (!empty($errors)) {
    echo "<h3 class='error'>❌ Errors:</h3>";
    foreach ($errors as $error) {
        echo "<p class='error'>{$error}</p>";
    }
}

echo "</div><div class='box'>
    <h2>✅ Next Steps:</h2>
    <ol>
        <li><strong>Hard refresh browser:</strong> <code>Ctrl + Shift + R</code> (Windows) or <code>Cmd + Shift + R</code> (Mac)</li>
        <li><strong>Test DES page:</strong> <a href='/crypto-lab/des' target='_blank'>Open /des</a></li>
        <li><strong>Hover to panel output</strong> — should be FLAT (no tilt)</li>
        <li><strong class='error'>DELETE THIS FILE</strong> for security: <code>public/clear-cache.php</code></li>
    </ol>
</div>

<div class='box warning'>
    <h3>⚠️ SECURITY WARNING</h3>
    <p>Hapus file ini setelah selesai! File ini bisa diakses publik dan memungkinkan siapa saja clear cache.</p>
    <p><strong>Delete:</strong> <code>public/clear-cache.php</code></p>
</div>

</body>
</html>";

// Auto-delete option (commented for safety)
// uncomment next line to auto-delete this file after execution
// unlink(__FILE__);
