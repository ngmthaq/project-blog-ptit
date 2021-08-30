<?php

session_start();

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Default';
$controller = $controllerName . 'Controller';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

require_once("./controllers/$controller.php");

$controllerInstance = new $controller();
$controllerAction = $controllerInstance->$action();

echo $controllerAction;