<?php
namespace app\Core;

class Application
{
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . "/../config/settings.php";
        $this->unit();
    }
    private function unit()
{
    $dirs = [
        $this->config['content']['pages_dir'],
        $this->config['content']['posts_dir'],
        $this->config['content']['media_dir']
    ];
    foreach ($dirs as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }
    }

    if (session_status() == PHP_SESSION_NONE) {
     session_start();
    }
}

public function getConfig(){
        return $this->config;
}

public function redirect($url){
        header("Location:" . $url);
        exit;
}
}
?>

