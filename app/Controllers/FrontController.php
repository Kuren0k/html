<?php

namespace App\Controllers;

use AllowDynamicProperties;
use App\Models\Post;
use App\Views\FrontView;

#[AllowDynamicProperties] class FrontController
{
    private Post $postModel;
    private FrontView $view;

    public function __construct(Post $postModel, FrontView $view)
    {
        $this->postModel = $postModel;
        $this->view = $view;
    }

    public function index()
    {
        $this->view->render("../templates/index.php");
    }

    public function showPostsList()
    {
        $posts = $this->postModel->all();
        $this->view->render("../templates/showPostsList.php", ["posts" => $posts]);
    }

}