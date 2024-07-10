<?php

namespace services\autoloader;

class Autoloader
{
    private string $file_extention = '.php';

    public function loadClass(string $class_name): bool
    {
        $class_name = str_replace('\\', '/', $class_name);
        $path = realpath(__DIR__ . "/../../" . $class_name . $this->file_extention);

        if (file_exists($path)) {
            require $path;
            return true;
        }

        return false;
    }
}
