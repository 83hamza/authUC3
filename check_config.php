<?php

$dir = __DIR__ . "/config";
$files = glob($dir . "/*.php");

foreach ($files as $file) {
    try {
        $config = include $file;

        if (!is_array($config)) {
            echo "❌ ERROR: " . basename($file) . " returns type: " . gettype($config) . PHP_EOL;
        }
    } catch (Throwable $e) {
        echo "❌ EXCEPTION in " . basename($file) . " => " . $e->getMessage() . PHP_EOL;
    }
}

echo "✅ Finished scanning config files." . PHP_EOL;
