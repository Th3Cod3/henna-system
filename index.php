<?php 

require_once "vendor/autoload.php";
include 'config.php';
require 'functions.php';
session_start();

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

$route = $_GET['route'] ?? '/';

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

$router->filter('auth', function(){
	if(!isset($_SESSION['user_id'])){
		header('Location: ' . BASE_URL . 'login');
		return false;
	}
});




$router->group(['before' => 'auth'], function ($router) {
	$router->controller('events', App\Controllers\System\EventsController::class);
	$router->controller('people', App\Controllers\System\PeopleController::class);
	$router->controller('companies', App\Controllers\System\CompaniesController::class);
	$router->controller('budgets', App\Controllers\System\InvoicesController::class);
	$router->controller('user', App\Controllers\System\UsersController::class);

});

$router->controller('/', App\Controllers\IndexController::class);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);
echo $response;

?>