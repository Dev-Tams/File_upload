<?php

const BASE_PATH = __DIR__ . '/../../';

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . '/functions.php';


use Dotenv\Dotenv;
use App\Database;
use FastRoute\RouteCollector;
use App\Http\Controllers\FileUploadController;
use function functions\dd;


$dotenv = Dotenv::createUnsafeImmutable(BASE_PATH);
$dotenv->load();

$config = require BASE_PATH .'config/database.php';
dd($config);
$dbConfig = $config['Database'];
dd($dbConfig);
$db = new Database($dbConfig);
dd($db);


$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    //  $r->addRoute('GET', '/', 'Welcome, trying to upload a file, use the route /Upload');
    $r->addRoute('GET', '/', [FileUploadController::class, 'index']);
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
