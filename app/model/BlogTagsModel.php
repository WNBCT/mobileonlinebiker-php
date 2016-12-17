<?php


class BlogTagsModel
{
    private $conn;


    public function __construct() {
        $this->conn = new DB_PDO();
    }

    public function getTagsBlogId($blog_id)
    {
        $sql = "SELECT blog_tag.tag_id, tags.tag_name FROM blog_tag
                LEFT JOIN tags ON blog_tag.tag_id = tags.tag_id WHERE blog_id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $blog_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return [array("tag_id" => "null", "tag_name" => "null")];
    }


    public function getBlogsTagId($tag_id)
    {
        $sql = "SELECT blog.blog_id, blog.blog_title FROM blog_tag 
                LEFT JOIN blog ON blog_tag.blog_id = blog.blog_id WHERE tag_id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $tag_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return array("blog_id" => "null", "blog_title" => "null");
    }


    function __destruct()
    {
        $this->conn = null;
    }


}