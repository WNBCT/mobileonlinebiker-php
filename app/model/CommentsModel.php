<?php


class CommentsModel
{
    private $conn;

    public function __construct() {
        $this->conn = new DB_PDO();
    }

    // select
    public function selectForum($forum_id)
    {
        $sql = "SELECT * FROM comments_forum WHERE forum_id=:forum_id ORDER BY cmm_id ASC";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':forum_id', $forum_id);

        if ($stmt->execute()) {
            return $stmt->fetchAll();
        }
        return false;
    }

    // insert
    public function insert($forum_id, $user_id, $comment_id, $message)
    {
        $sql = "INSERT INTO comments_forum SET forum_id=:forum_id, user_id=:user_id, cmm_id=:cmm_id, comments=:comments";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':forum_id', $forum_id);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':cmm_id', $comment_id);
        $stmt->bindValue(':comments', $message);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // update
    public function update($forum_id, $user_id, $comment_id, $message)
    {
        $sql = "UPDATE comments_forum SET forum_id=:forum_id, user_id=:user_id, cmm_id=:cmm_id, comments=:comments";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':forum_id', $forum_id);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':cmm_id', $comment_id);
        $stmt->bindValue(':comments', $message);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // delete
    public function delete($forum_id, $user_id, $comment_id)
    {
        $sql = "DELETE FROM comments_forum WHERE forum_id=:forum_id AND user_id=:user_id AND cmm_id=:cmm_id";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':forum_id', $forum_id);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':cmm_id', $comment_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}