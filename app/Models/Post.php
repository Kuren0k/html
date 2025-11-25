<?php

namespace App\Models;

class Post
{
    public array $posts;

    public function __construct()
    {
        $this->posts = [
            [
                'title' => 'Title 1',
                'content' => 'Content 1'
            ],
            [
                'title' => 'Title 2',
                'content' => 'Content 2'
            ],
            [
                'title' => 'Title 3',
                'content' => 'Content 3'
            ]
        ];
    }

    public function all()
    {
        return $this->posts;
    }
}