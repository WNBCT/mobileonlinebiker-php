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
$app->get('/blog/all', '\BlogController:getBlogAll');
$app->get('/blog/get/{item}', '\BlogController:getBlogId');
$app->post('/blog/insert', 'BlogController:postInsertBlog');
$app->put('/blog/update/{blog_id}', 'BlogController:updateBlog');
$app->put('/blog/symbol/update/{blog_id}', 'BlogController:updateSymbol');
$app->delete('/blog/delete/{blog_id}', 'BlogController:deleteBlog');






// tags
$app->get('/tags', function (){
    $arr = array('star', 'heart', 'smile', 'like');
    $test = array_keys($arr, 'star');
    print_r($test);
    echo $test ? 'true' : 'false';
});

// test
$app->put('/test/{id}', function (Request $request, Response $response, $args) {
    $data = $request->getParsedBody();
    print_r($data);
    print_r($args);
});


$app->run();
