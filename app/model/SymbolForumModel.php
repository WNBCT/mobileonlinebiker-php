<?php


class SymbolForumModel
{
    private $conn;

    public function __construct() {
        $this->conn = new DB_PDO();
    }


    public function getSymbol($forum_id, $user_id)
    {
        $sql = "SELECT symbol FROM forums_users_symbol WHERE forum_id=:forum_id AND user_id=:user_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":forum_id", $forum_id);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetch()['symbol'];
    }


    function __destruct()
    {
        $this->conn = null;
    }
}