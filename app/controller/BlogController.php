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

        $result = $this->model->selectBlogAll();
        $blogTags = new BlogTagsModel();
        $user = new UserModel();
        $symbol = new SymbolBlogModel();
        $output = [];

        if ($result['count'] > 0) {
            foreach ($result['data'] as $item => $value) {
                array_push($output, array(
                    "blog_id"       => $value['blog_id'],
                    "title"         => $value['blog_title'],
                    "public_date"   => $value['blog_public'],
                    "tags"          => $blogTags->getTagsBlogId($value['blog_id']),
                    "user"          => $user->getNameUserId($value['user_id']),
                    "symbol"        => $symbol->getSymbol($value['blog_id'], $value['user_id'])
                ));
            }
        }

        echo json_encode(array('count'=>$result['count'], 'blog'=>$output));
    }


    public function getBlogId(Request $request, $args)
    {
        $id = $request->getAttribute('item');
        $result = $this->model->selectBlogId($id);
        $blogTags = new BlogTagsModel();
        $user = new UserModel();
        $symbol = new SymbolBlogModel();
        $output = [];

        if ($result['count'] > 0) {

            $output["blog_id"]      = $result['data']['blog_id'];
            $output["title"]        = $result['data']['blog_title'];
            $output["description"]  = $result['data']['blog_description'];
            $output["status"]       = $result['data']['blog_status'];
            $output["image"]        = $result['data']['blog_image'];
            $output["public_date"]  = $result['data']['blog_public'];
            $output["tags"]         = $blogTags->getTagsBlogId($result['data']['blog_id']);
            $output["user"]         = $user->getUserId($result['data']['user_id']);
            $output["symbol"]       = $symbol->getSymbol($result['data']['blog_id'], $result['data']['user_id']);

        }

        echo json_encode($output);
//        print_r(array('count'=>$result['count'], 'blog'=>$output));
    }


    public function postInsertBlog(Request $request)
    {
        $d = $request->getParsedBody();
        $blogTag = new BlogTagsModel();
        $symbol = new SymbolBlogModel();

        $data = [
            'title' => $d['title'],
            'desc'  => $d['desc'],
            'img'     => $d['img'],
            'user_id' => $d['user_id']
        ];

        // insert blog
        if ($this->model->insert($data)) {
            $blog_id = $this->model->getIdLatest();

            // insert blog tags
            $blogTag->insertBlogAndTag($blog_id, $d['tags_id']);

            // insert symbol
            $symbol->insert($blog_id, $d['tags_id']);

            return true;
        } else {
            return false;
        }

    }

    public function updateBlog(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $blogTag = new SymbolBlogModel();

        $blogArr = array(
            'title' => $data['title'],
            'desc' => $data['desc'],
            'img' => $data['img'],
            'user_id' => $data['user_id'],
        );

        // TODO array
        $tagsInsert=$args['tags_push'];
        $tagsDelete=$args['tags_pop'];

        if ($this->model->update($args['blog_id'], $blogArr)
                && $blogTag->update($args['blog_id'], $tagsInsert, $tagsDelete)) {
            $output['message'] = 'UPDATE Blog (' . $args['blog_id'] . ') :: completed';
            $output['success'] = 'true';
        } else {
            $output['message'] = 'UPDATE Blog (' . $args['blog_id'] . ') :: failed';
            $output['error'] = 'false';
        }

        echo json_encode($output);
    }


    public function updateSymbol(Request $request, Response $response, $args)
    {
        $symbolModel = new SymbolBlogModel();
        $data = $request->getParsedBody();

        if (isset($data['blog_id']) && isset($args['blog_id']) ) {
            if ($symbolModel->update($args['blog_id'], $data['user_id'], $data['symbol'])) {
                $output['message'] = 'UPDATE Blog (' . $args['blog_id'] . ') :: completed';
                $output['success'] = 'true';
            }
        } else {
            $output['message'] = 'UPDATE Blog (' . $args['blog_id'] . ') :: failed';
            $output['error'] = 'false';
        }

        echo json_encode($output);
    }


    public function deleteBlog(Request $request,Response $response, $args)
    {

        if ($this->model->delete($args['blog_id'])) {
            $output['message'] = 'DELETE Blog (' . $args['blog_id'] . ') :: completed';
            $output['success'] = 'true';
        } else {
            $output['message'] = 'DELETE Blog (' . $args['blog_id'] . ') :: failed';
            $output['error'] = 'false';
        }

        echo json_encode($output);
    }

}