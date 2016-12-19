<?php


class ForumModel
{

    private $conn;

    public function __construct() {
        $this->conn = new DB_PDO();
    }

    // select all
    public function selectAll()
    {
        try {
            $sql = "SELECT * FROM forums";
            // prepare sql
            $stmt = $this->conn->prepare($sql);

            if ($stmt->execute()) {
                return $stmt->fetchAll();
            }

        } catch (PDOException $e) {
            echo "ERROR :: " . $e->getMessage();
            return false;
        }
    }

    // select id
    public function selectId($forum_id)
    {
        $sql = "SELECT * FROM forums WHERE forum_id=:forum_id";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':forum_id', $forum_id);

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return false;
    }

    // insert
    public function insert($data=array())
    {
        $sql = "INSERT INTO forums SET forum_title=:title, forum_details=:details, image=:img, user_id=:user_id, created_at=NOW()";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':details', $data['details']);
        $stmt->bindValue(':img', $data['img']);
        $stmt->bindValue(':user_id', $data['user_id']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // update
    public function update($forum_id, $user_id, $data=array())
    {
        $sql = "UPDATE forums SET forum_title=:title, forum_details=:details, image=:img 
WHERE forum_id=:forum_id AND user_id=:user_id";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':details', $data['details']);
        $stmt->bindValue(':forum_id', $forum_id);
        $stmt->bindValue(':user_id', $user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // delete
    public function delete($forum_id)
    {
        $sql = "DELETE FROM forums WHERE forum_id=:forum_id";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':forum_id', $forum_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // get id latest
    public function getLatestId()
    {
        $sql = "SELECT forum_id FROM forums ORDER BY forum_id DESC";

        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $send = $stmt->fetch();
        return $send['forum_id'];
    }
}