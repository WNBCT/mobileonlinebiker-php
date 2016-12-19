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

    public function insert($blog_id='', $user_id='')
    {
        try {
            $sql = "INSERT INTO blogs_users_symbol SET blog_id=:blog_id, user_id=:user_id, created_at=NOW()";

            // prepare sql
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":blog_id", $blog_id);
            $stmt->bindValue(":user_id", $user_id);

            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "ERROR (update) :: " . $exception->getMessage();
            return false;
        }
    }


    public function update($blog_id='', $user_id='', $symbol='')
    {
        $symbolArr = array('star', 'heart', 'smile', 'like');
        try {

            if (array_keys($symbolArr, $symbol)) {
                $sql = "UPDATE blogs_users_symbol SET symbol=:symbol WHERE blog_id=:blog_id AND user_id=:user_id";

                // prepare sql
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":blog_id", $blog_id);
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