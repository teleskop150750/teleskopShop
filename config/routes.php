<?php

use shop\Router;


// пользовательские маршруты


// маршруты по умолчанию
Router::addRoute('^admin$', [
    'controller' => 'Main',
    'action' => 'index',
    'prefix' => 'admin',
]);
Router::addRoute('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', [
    'prefix' => 'admin',
]);

Router::addRoute('^$', [
    'controller' => 'Main',
    'action' => 'index',
]);
Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
