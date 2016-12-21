<?php



class BlogModel
{
    private $conn;

    public function __construct() {
        $this->conn = new DB_PDO();
    }


    public function selectBlogAll()
    {
        $sql = "SELECT * FROM blog ORDER BY blog_id DESC ";

        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // getting result
            $arr = array();
            $arr['count'] = $stmt->rowCount();
            $arr['data'] = $stmt->fetchAll();
            return $arr;
        }

        return false;
    }


    public function selectBlogId($blog_id)
    {
        $sql = "SELECT * FROM blog WHERE blog_id=:id";
        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $blog_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // getting result
            $arr = array();
            $arr['count'] = $stmt->rowCount();
            $arr['data'] = $stmt->fetch();
            return $arr;
        }

        return false;
    }


    public function insert($arr=[])
    {
        try {
            $sql = "INSERT INTO blog 
                SET blog_title=:blog_title, blog_description=:blog_description, 
                    blog_image=:blog_image, user_id=:user_id, blog_public=NOW();";

            // prepare sql
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":blog_title", $arr['title']);
            $stmt->bindValue(":blog_description", $arr['desc']);
            $stmt->bindValue(":blog_image", $arr['img']);
            $stmt->bindValue(":user_id", $arr['user_id']);
            return $stmt->execute();

        } catch (PDOException $exception) {
            echo "ERROR (insert) :: " . $exception->getMessage();
            return false;
        }
    }

    public function update($blog_id='', $arr=[])
    {
        try {
            $sql = "UPDATE blog SET blog_title=:blog_title, blog_description=:blog_description, blog_image=:blog_image, user_id=:user_id WHERE blog_id=:blog_id";

            // prepare sql
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":blog_id", $blog_id);
            $stmt->bindValue(":blog_title", $arr['title']);
            $stmt->bindValue(":blog_description", $arr['desc']);
            $stmt->bindValue(":blog_image", $arr['img']);
            $stmt->bindValue(":user_id", $arr['user_id']);

            return $stmt->execute();

        } catch (PDOException $exception) {
            echo "ERROR (update) :: " . $exception->getMessage();
            return false;
        }
    }

    public function delete($blog_id)
    {
        try {
            $sql = "DELETE FROM blog WHERE blog_id=:blog_id";

            // prepare sql
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":blog_id", $blog_id);

            return $stmt->execute();

        } catch (PDOException $exception) {
            echo "ERROR (delete) :: " . $exception->getMessage();
            return false;
        }
    }

    public function getIdLatest()
    {
        try {
            $sql = "SELECT blog_id FROM blog ORDER BY blog_id DESC";

            // prepare sql
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $send = $stmt->fetch();
            return $send['blog_id'];

        } catch (PDOException $exception) {
            echo "ERROR (delete) :: " . $exception->getMessage();
            return false;
        }
    }

    public function close()
    {
        $this->conn = null;
    }
}