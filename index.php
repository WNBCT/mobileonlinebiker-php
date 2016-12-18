<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// autoload
require 'vendor/autoload.php';

// include library
include 'library/simple_html_dom.php';

// include controller
require 'myAutoload.php';

$app = new \Slim\App;

// route
// get post put delete

// news
$app->get('/rss/news', '\NewsController:getData');

// user
$app->post('/user/register', '\UserController:registerUser');
$app->post('/user/login', '\UserController:loginUser');
$app->post('/user/chgPass', '\UserController:chgPass');

// blog
$app->get('/blog-all', '\BlogController:getBlogAll');
$app->get('/blog/{item}', '\BlogController:getBlogId');


// tags
$app->get('/tags', function (){
    $t = new BlogModel();
    echo json_encode($t->selectBlogId("1001"));
});


// test
$app->post('/test', function (Request $request) {
    print_r($request->getParsedBody());
});


$app->run();
