<?php

if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }
}

if (!function_exists('config')) {
    function config(string $key, $default = null)
    {
        static $configs = [];

        if (empty($configs)) {
            foreach (glob(__DIR__ . '/../config/*.php') as $file) {
                $name = basename($file, '.php');
                $configs[$name] = require $file;
            }
        }

        [$file, $item] = explode('.', $key) + [null, null];

        return $configs[$file][$item] ?? $default;
    }
}
