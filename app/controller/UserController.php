<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UserController
{

    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }


    public function registerUser(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();


        if(isset($data->user ) && !empty($data->user) && isset($data->user->name)
                    && isset($data->user->email) && isset($data->user->password)) {

            $user = $data -> user;
            $name = $user -> name;
            $email = $user -> email;
            $password = $user -> password;

            if ($this->model->isEmailValid($email)) {

                echo $this->model->register($name, $email, $password);
            } else {
                echo $this->model->getMsgInvalidEmail();
            }

        } else {
            echo $this->model->getMsgInvalidParam();
        }

    }


    public function loginUser(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> password)){

            $user = $data -> user;
            $email = $user -> email;
            $password = $user -> password;


            echo $this->model->loginUser($email, $password);

        } else {

            echo $this->model->getMsgInvalidParam();

        }
    }


    public function chgPass(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> old_password)
            && isset($data -> user -> new_password)){

            $user = $data -> user;
            $email = $user -> email;
            $old_password = $user -> old_password;
            $new_password = $user -> new_password;

            echo $this->model->changePassword($email, $old_password, $new_password);

        } else {

            echo $this->model->getMsgInvalidParam();

        }
    }




}