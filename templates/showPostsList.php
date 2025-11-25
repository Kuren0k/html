<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
foreach ($data['posts'] as $post) {
    echo '<h2>' . $post['title'] . '</h2>';
    echo '<p>' . $post['content'] . '</p>';
}
?>
<a href="/">Home page</a>
</body>
</html>