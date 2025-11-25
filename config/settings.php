<?php
/*
return [
    'site' => [
        'url' => 'http://localhost:8000'
    ],
    'admin' => [
        'username' => 'admin',
        'password' => 'admin'
    ],
    'content' => [
        'pages_dir' => __DIR__ . './content/pages/',
        'posts_dir' => __DIR__ . './content/posts/',
        'media_dir' => __DIR__ . './public/media/uploads/',
        'default_template' => 'default'
    ],
    'uploads' => [
        'max_size' => 5 * 1024 * 1024,
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf'],
        'image_types' => ['jpg', 'jpeg', 'png', 'gif'],
    ]
];
*/
define('ROOT', dirname(__DIR__));
define('TEMPLATES_PATH', DIRECTORY_SEPARATOR . 'templates');
define('CONTENT_PATH', DIRECTORY_SEPARATOR . 'content');

?>
