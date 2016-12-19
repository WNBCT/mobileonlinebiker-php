<?php


class Message
{

    public static function setSuccess($string)
    {
        $response["result"] = "success";
        $response["message"] = $string. " Complected!";
        return json_encode($response);
    }


    public static function getSuccess()
    {
        $response["result"] = "success";
        $response["message"] = "Complected!";
        return json_encode($response);
    }


    public static function setError($string)
    {
        $response["result"] = "failure";
        $response["message"] = $string . " Failure!";
        return json_encode($response);
    }


    public static function getError()
    {
        $response["result"] = "failure";
        $response["message"] = "Failure!";
        return json_encode($response);
    }

}