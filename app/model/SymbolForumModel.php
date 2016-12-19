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


    public function insert($forum_id='', $user_id='')
    {
        try {
            $sql = "INSERT INTO forums_users_symbol SET forum_id=:forum_id, user_id=:user_id, created_at=NOW()";

            // prepare sql
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":forum_id", $forum_id);
            $stmt->bindValue(":user_id", $user_id);

            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "ERROR (update) :: " . $exception->getMessage();
            return false;
        }
    }

    public function update($forum_id='', $user_id='', $symbol='')
    {
        $symbolArr = array('star', 'heart', 'smile', 'like');
        try {

            if (array_keys($symbolArr, $symbol)) {
                $sql = "UPDATE forums_users_symbol SET symbol:symbol WHERE forum_id=:forum_id AND user_id=:user_id";

                // prepare sql
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":forum_id", $forum_id);
                $stmt->bindValue(":user_id", $user_id);
                $stmt->bindValue(":symbol", $symbol);

                return $stmt->execute();
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo "ERROR (update) :: " . $exception->getMessage();
            return false;
        }
    }

    function __destruct()
    {
        $this->conn = null;
    }
}