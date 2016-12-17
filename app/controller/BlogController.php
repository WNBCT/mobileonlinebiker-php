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
        echo "blog all";
    }


    public function getBlogId(Request $request, $args)
    {
        $name = $request->getAttribute('item');

        print_r($name);
    }

}