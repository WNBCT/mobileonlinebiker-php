<?php


class UserModel
{
    private $conn;


    public function __construct() {
        $this->conn = new DB_PDO();
    }


    public function getUserId($user_id)
    {
        $sql = "SELECT * FROM users WHERE user_id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $user_id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getNameUserId($user_id)
    {
        $sql = "SELECT name FROM users WHERE user_id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $user_id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function register($name, $email, $password)
    {

        if (!empty($name) && !empty($email) && !empty($password)) {


            if ($this->checkUserExist($email)) {

                $response["result"] = "failure";
                $response["message"] = "User Already Registered !";
                return json_encode($response);

            } else {

                if ($this->insertData($name, $email, $password)) {

                    $response["result"] = "success";
                    $response["message"] = "User Registered Successfully !";
                    return json_encode($response);

                } else {

                    $response["result"] = "failure";
                    $response["message"] = "Registration Failure";
                    return json_encode($response);

                }
            }
        } else {
            return $this -> getMsgParamNotEmpty();
        }
    }


    public function loginUser($email, $password) {

        if (!empty($email) && !empty($password)) {

            if ($this->checkUserExist($email)) {

                $result = $this->checkLogin($email, $password);

                if(!$result) {

                    $response["result"] = "failure";
                    $response["message"] = "Invaild Login Credentials";
                    return json_encode($response);

                } else {

                    $response["result"] = "success";
                    $response["message"] = "Login Successful";
                    $response["user"] = $result;
                    return json_encode($response);

                }

            } else {

                $response["result"] = "failure";
                $response["message"] = "Invaild Login Credentials";
                return json_encode($response);

            }
        } else {

            return $this -> getMsgParamNotEmpty();
        }

    }



    public function changePassword($email, $old_password, $new_password) {

        if (!empty($email) && !empty($old_password) && !empty($new_password)) {

            if(!$this->checkLogin($email, $old_password)){

                $response["result"] = "failure";
                $response["message"] = 'Invalid Old Password';
                return json_encode($response);

            } else {
                $result = $this->changePasswordPrivate($email, $new_password);

                if($result) {
                    $response["result"] = "success";
                    $response["message"] = "Password Changed Successfully";
                    return json_encode($response);

                } else {
                    $response["result"] = "failure";
                    $response["message"] = 'Error Updating Password';
                    return json_encode($response);

                }

            }
        } else {

            return $this->getMsgParamNotEmpty();
        }

    }


    // ----
    public function insertData($name,$email,$password){

        $unique_id = uniqid('', true);
        $hash = $this->getHash($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];

        $sql = 'INSERT INTO users SET unique_id=:unique_id, name=:name, email=:email, encrypted_password=:encrypted_password, salt=:salt, created_at = NOW()';

        $query = $this->conn->prepare($sql);
        $query->bindValue(':unique_id', $unique_id);
        $query->bindValue(':name', $name);
        $query->bindValue(':email', $email);
        $query->bindValue(':encrypted_password', $encrypted_password);
        $query->bindValue(':salt', $salt);
        $query->execute();

        return $query;
    }


    public function checkLogin($email, $password) {

        $sql = 'SELECT * FROM users WHERE email=:email';
        $query = $this->conn->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();

        $data = $query->fetchObject();
        $salt = $data->salt;
        $db_encrypted_password = $data->encrypted_password;

        if ($this->verifyHash($password.$salt,$db_encrypted_password) ) {
            $user["name"] = $data->name;
            $user["email"] = $data->email;
            $user["unique_id"] = $data->unique_id;
            return $user;

        } else {
            return false;
        }

    }


    private function changePasswordPrivate($email, $password){

        $hash = $this -> getHash($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];

        $sql = 'UPDATE users SET encrypted_password=:encrypted_password, salt=:salt WHERE email=:email';
        $query = $this->conn->prepare($sql);
        $query->bindValue(':encrypted_password', $encrypted_password);
        $query->bindValue(':salt', $salt);
        $query->bindValue(':email', $email);

        return $query->execute();

    }

    public function checkUserExist($email){

        $sql = 'SELECT COUNT(*) from users WHERE email=:email';
        $query = $this->conn->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();

        if($query){
            $row_count = $query -> fetchColumn();

            if ($row_count == 0){

                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }





    // ---------------- function ----------------
    public function getHash($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = password_hash($password.$salt, PASSWORD_DEFAULT);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);

        return $hash;

    }

    public function verifyHash($password, $hash) {

        return password_verify ($password, $hash);
    }


    public function isEmailValid($email){

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getMsgParamNotEmpty(){


        $response["result"] = "failure";
        $response["message"] = "Parameters should not be empty !";
        return json_encode($response);

    }

    public function getMsgInvalidParam(){

        $response["result"] = "failure";
        $response["message"] = "Invalid Parameters";
        return json_encode($response);

    }

    public function getMsgInvalidEmail(){

        $response["result"] = "failure";
        $response["message"] = "Invalid Email";
        return json_encode($response);

    }
}