<?php

namespace services\autoloader;

class Autoloader
{
    private string $fileextention = '.php';

    public function loadClass(string $class_name): bool
    {
        $class_name = str_replace('\\', '/', $class_name);
        $path = realpath(__DIR__ . "/../../" . $class_name . $this->fileextention);

        if (file_exists($path)) {
            require $path;
            return true;
        }

        return false;
    }
}
