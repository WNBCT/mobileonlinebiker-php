<?php


// include class connect database
require_once 'app/config/xhe1_.php';
require_once 'app/config/db_connect.php';

// include model
require_once 'app/model/UserModel.php';
require_once 'app/model/BlogModel.php';
require_once 'app/model/TagsModel.php';
require_once 'app/model/BlogTagsModel.php';
require_once 'app/model/SymbolBlogModel.php';
require_once 'app/model/SymbolForumModel.php';
//require_once 'app/model/';


// include controller
require_once 'app/controller/NewsController.php';
require_once 'app/controller/UserController.php';
require_once 'app/controller/BlogController.php';