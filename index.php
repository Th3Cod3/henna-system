<?php 

require_once "vendor/autoload.php";

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

$route = $_GET['route'] ?? '/';


$router = new Phroute\Phroute\RouteCollector();


$router->controller('/', App\Controllers\IndexController::class);
$router->controller('/events', App\Controllers\System\EventsController::class);
$router->controller('/people', App\Controllers\System\EventsController::class);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;

?>