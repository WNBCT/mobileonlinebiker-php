<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class UserController
{

    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }


    public function registerUser(Request $request)
    {
        $data = $request->getParsedBody();

        if(isset($data['name']) && isset($data['email']) && isset($data['password'])) {

            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];

            if ($this->model->isEmailValid($email)) {
                echo $this->model->register($name, $email, $password);
            } else {
                echo $this->model->getMsgInvalidEmail();
            }

        } else {
            echo $this->model->getMsgInvalidParam();
        }

    }


    public function loginUser(Request $request)
    {
        $data = $request->getParsedBody();

        if(isset($data['email']) && isset($data['password'])){

            $email = $data['email'];
            $password = $data['password'];

            echo $this->model->loginUser($email, $password);

        } else {

            echo $this->model->getMsgInvalidParam();

        }
    }


    public function chgPass(Request $request)
    {
        $data = $request->getParsedBody();

        if(isset($data['email']) && isset($data['old_password']) && isset($data['new_password'])){

            $email = $data['email'];
            $old_password = $data['old_password'];
            $new_password = $data['new_password'];

            echo $this->model->changePassword($email, $old_password, $new_password);

        } else {

            echo $this->model->getMsgInvalidParam();
        }
    }




}