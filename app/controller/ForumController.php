<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ForumController
{

    // read forum list
    public function readListForum(Request $request, Response $response, $args)
    {
        $forum = new ForumModel();
        $user = new UserModel();

        $output = array();
        $count = count($forum->selectAll());

        foreach ($forum->selectAll() as $item => $value) {

            $usrArr = array();
            $usr = $user->getUserId($value['user_id']);
            $usrArr['user_id'] = $usr['user_id'];
            $usrArr['name'] = $usr['name'];

            array_push($output, array(
                'forum_id' => $value['forum_id'],
                'title' => $value['forum_title'],
                'details' => $value['forum_details'],
                'image' => $value['image'],
                'count_comment' => $value['count_comment'],
                'user' => $usrArr,
            ));

        }

        echo json_encode(['count' => $count, 'lists' => $output]);
    }


    // get forum id and get comments
    public function getForumId(Request $request, Response $response, $args)
    {
        $forum = new ForumModel();
        $user = new UserModel();
        $output = array();

        $f = $forum->selectId($args['forum_id']);

        $output['forum_id'] = $f['forum_id'];
        $output['title'] = $f['forum_title'];
        $output['details'] = $f['forum_details'];
        $output['image'] = $f['image'];
        $output['count_comment'] = $f['count_comment'];
        $output['user'] = $user->getUserId($f['user_id']);

        echo json_encode($output);
    }


    // create forum
    public function createForum(Request $request, Response $response, $args)
    {
        $d = $request->getParsedBody();
        $forum = new ForumModel();

        $data = [
            'title' => $d['title'],
            'details' => $d['details'],
            'img' => $d['img'],
            'user_id' => $d['user_id']
        ];

        if ($forum->insert($data)) {
            echo Message::setSuccess("Insert ");
        } else {
            echo Message::setError("Insert ");
        }
    }


    // create symbol of forum id
    public function createSymbol(Request $request, Response $response, $args)
    {
        $d = $request->getParsedBody();
        $forum = new ForumModel();

        $data = [
            'title' => $d['title'],
            'details' => $d['details'],
            'img' => $d['img'],
            'user_id' => $d['user_id']
        ];

        if ($forum->insert($data)) {
            echo Message::setSuccess("Insert symbol");
        } else {
            echo Message::setError("Insert symbol");
        }
    }


    // update forum id
    public function updateForumId(Request $request, Response $response, $args)
    {
        $d = $request->getParsedBody();
        $forum = new ForumModel();

        $data = [
            'title' => $d['title'],
            'details' => $d['details'],
            'img' => $d['img']
        ];

        if ($forum->update($args['forum_id'], $d['user_id'], $data)) {
            echo Message::setSuccess("Update Forum");
        } else {
            echo Message::setError("Update Forum");
        }
    }


    // update symbol of forum id
    public function updateSymbolId(Request $request, Response $response, $args)
    {
        $d = $request->getParsedBody();
        $symbol = new SymbolForumModel();

        if ($symbol->update($args['forum_id'], $d['user_id'], $d['symbol'])) {
            echo Message::setSuccess("Update Symbol Forum");
        } else {
            echo Message::setError("Update Symbol Forum");
        }
    }
    
    // delete forum id and delete symbol forum
    public function deleteForum(Request $request, Response $response, $args)
    {
        $forum = new ForumModel();

        if ($forum->delete($args['forum_id'])) {
            echo Message::setSuccess("Update Symbol Forum");
        } else {
            echo Message::setError("Update Symbol Forum");
        }
    }

}