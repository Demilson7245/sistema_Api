<?php
// autoload.php
spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/../modeloVista/';
    $file = $base_dir . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
