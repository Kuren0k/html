<?php

use App\Controllers\FrontController;
use App\Models\Post;
use App\Views\FrontView;

require __DIR__ . '/../vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$uri = $_SERVER['REQUEST_URI'];
$postModel =new Post();
$frontView = new FrontView();
$frontController = new FrontController($postModel, $frontView);

switch ($uri) {
    case '/':
            $frontController->index();
            break;
    case '/blog':
            $frontController->showPostsList();
            break;
    case '/post/{id}':
            $frontController->showPostsList();
            break;
    default:
        echo '404 Not Found';
}
