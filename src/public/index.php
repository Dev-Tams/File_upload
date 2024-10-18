<?php

const BASE_PATH = __DIR__ . '/../../'; 

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . '/functions.php';
use FastRoute\RouteCollector;
use App\Http\Controllers\FileUploadController;




$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/upload', [FileUploadController::class, 'index']);
    $r->addRoute('POST', '/upload', [FileUploadController::class, 'store']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$uri = rawurldecode(parse_url($uri, PHP_URL_PATH));
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$class, $method] = $handler;

        $controller = new $class();
        call_user_func_array([$controller, $method], $vars);
        break;
}
