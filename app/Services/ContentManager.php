<?php
namespace App\Services;

class ContentManager
{
    private $pagesDir;
    private $postsDir;

    public function __construct($pagesDir, $postsDir)
    {
        $this->pagesDir = $pagesDir;
        $this->postsDir = $postsDir;
    }

    public function setPage($slug, $data)
    {
        $filename = $this->pagesDir .  $slug . '.json';
        $data['created_at'] = date('Y-m-d H:i:s');
        if (!isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function getPage($slug)
    {
        $filename = $this->pagesDir .  $slug . '.json';
        return file_get_contents($filename) ? json_decode(file_get_contents($filename), true) : null;
    }

    public function getAllPages()
    {
        $pages = [];
        $files = glob($this->pagesDir . '*.json');

        foreach ($files as $file)
        {
            $content = json_decode(file_get_contents($file), true);
            $pages[basename($file, '.json')] = $content;
        }

        uasort($pages, function ($a, $b) {
            return strtotime($a['created_at']) <=> strtotime($b['created_at']);
        });

        return $pages;
    }

    public function deletePage($slug)
    {
        $filename = $this->pagesDir .  $slug . '.json';
        return file_exists($filename) ? unlink($filename) : false;
    }

    public function pageExists($slug)
    {
        return file_exists($this->pagesDir .  $slug . '.json');
    }

    public function savePost($slug, $data)
    {
        $filename = $this->pagesDir .  $slug . '.json';
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['updated_at']))
        {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function getPost($slug)
    {
        $filename = $this->postsDir .  $slug . '.json';
        return file_exists($filename) ? json_decode(file_get_contents($filename), true) : null;
    }

    public function getAllPosts($status = null)
    {
        $posts = [];
        $files = glob($this->postsDir . '*.json');

        foreach ($files as $file)
        {
            $content = json_decode(file_get_contents($file), true);
            if ($status === null || $content['status'] === $status)
            {
                $posts[basename($file, '.json')] = $content;
            }
        }

        uasort($posts, function ($a, $b) {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        });
        return $posts;
    }
    public function deletePost($slug)
    {
        $filename = $this->postsDir .  $slug . '.json';
        return file_exists($filename) ? unlink($filename) : false;
    }

    public function postExists($slug)
    {
        return file_exists($this->postsDir .  $slug . '.json');
    }
}
?>