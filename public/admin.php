<?php
require_once  __DIR__.'/../vendor/autoload.php';

use App\Core\Application;
use App\Services\Auth;
use App\Services\ContentManager;
use App\Services\MediaManager;

$app = new Application();
$config = $app->getConfig();
$auth = new Auth($config);
$contentManager = new ContentManager($config['content']['pages_dir'], $config['content']['posts_dir']);
$mediaManager = new MediaManager(
    $config['content']['media_dir'],
    $config['uploads']['allowed_types'],
    $config['uploads']['max_size']
);

$action = $_GET['action'] ?? 'dashboard';

if ($action  == 'login' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($auth->login($_POST['username'], $_POST['password'])) {
        $app->redirect('/admin.php');
    } else {
        $error = 'Неверные учетные данные';
    }
}

if ($action !== 'login') {
    $auth->requireAuth();
}

switch ($action) {
    case 'login':
        showLoginForm($error ?? '');
        break;
    case 'logout':
        $auth->logout();
        $app->redirect('/admin.php?action=login');
        break;
    case 'dashboard':
        showDashboard($contentManager);
        break;
    case 'pages':
        showPages($contentManager);
        break;
    case 'pages-create':
        handlePageCreate($contentManager);
        break;
    case 'pages-edit':
        handlePageEdit($contentManager);
        break;
    case 'pages-delete':
        handlePageDelete($contentManager);
        break;
    case 'posts':
        showPosts($contentManager);
        break;
    case 'posts-create':
        handlePostCreate($contentManager);
        break;
    case 'posts-edit':
        handlePostEdit($contentManager);
        break;
    case 'posts-delete':
        handlePostDelete($contentManager);
        break;
    case 'media':
        handleMedia($mediaManager);
        break;

    default:
        showDashboard($contentManager);
        break;
}

function showLoginForm($error = ''){
    
}