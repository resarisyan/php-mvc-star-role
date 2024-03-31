<?php
require_once __DIR__ . '/../vendor/autoload.php';

use StarRole\PhpMvc\App\Router;
use StarRole\PhpMvc\Controller\HomeController;

Router::add('GET', '/', HomeController::class, 'index', []);

Router::run();
