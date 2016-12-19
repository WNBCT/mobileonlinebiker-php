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

// forum
$app->get('/forum/all', '\ForumController:readListForum');
$app->get('/forum/get/{forum_id}', '\ForumController:getForumId');
$app->post('/forum/create', '\ForumController:createForum');
$app->post('/forum/symbol/create', '\ForumController:createSymbol');
$app->put('/forum/update/{forum_id}', '\ForumController:updateForumId');
$app->put('/forum/symbol/{forum_id}', '\ForumController:updateSymbolId');
$app->delete('/forum/delete/{forum_id}', '\ForumController:deleteForum');




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
