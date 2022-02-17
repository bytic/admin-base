<?php

use ByTIC\AdminBase\Utility\ViewHelper;
use Nip\View\View;

require '_init.php';

$view = new View();
$view->setBasePath(__DIR__ . '/views');

ViewHelper::registerFrontendPaths($view);

$layout = require '_layout.php';
ViewHelper::registerLayoutVariables($view, $layout);

$controller = $_GET['controller'] ?? 'index';
$action = $_GET['action'] ?? 'index';
$view->setBlock('content', $controller . '/' . $action);

echo $view->load('/layouts/default');

