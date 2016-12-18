<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class BlogController
{

    private $model;

    public function __construct() {
        $this->model = new BlogModel();
    }


    public function getBlogAll()
    {
        echo json_encode($this->model->selectBlogAll());
    }


    public function getBlogId(Request $request, $args)
    {
        $id = $request->getAttribute('item');

        echo json_encode($this->model->selectBlogId($id));
    }

}