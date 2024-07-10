<?php
require '../services/autoloader/Autoloader.php';

use services\autoloader\Autoloader;

spl_autoload_register([new Autoloader(), 'loadClass']);

//$catalog = Catalogs::getById(1);
if (!$request_uri = preg_replace(['#^/#','#[?].*#','#/$#'], "", $_SERVER['REQUEST_URI'])) {
    $request_uri = 'catalog';
}

$parts = explode("/", $request_uri);
$controllerName = $parts[0];
$action = $parts[1] ?? null;
$controllerClass = 'controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->run($action);
}
