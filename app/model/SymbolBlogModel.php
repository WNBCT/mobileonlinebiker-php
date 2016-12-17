<?php


class SymbolBlogModel
{
    private $conn;

    public function __construct() {
        $this->conn = new DB_PDO();
    }


    public function getSymbol($blog_id, $user_id)
    {
        $sql = "SELECT symbol FROM blogs_users_symbol WHERE blog_id=:blog_id AND user_id=:user_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":blog_id", $blog_id);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch()['symbol'];
        }
        return "null";
    }


    function __destruct()
    {
        $this->conn = null;
    }
}