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
//        return [array("tag_id" => "null", "tag_name" => "null")];
        return 'null';
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
//        return array("blog_id" => "null", "blog_title" => "null");
        return 'null';
    }


    public function updateTags($blog_id, $tagsInsert=array(), $tagsDelete=array())
    {
        $check = true;
        if (count($tagsInsert)) {
            for ($i = 0; $i < count($tagsInsert); $i++) {
                $check = $check == $this->insertBlogAndTag($blog_id, $tagsInsert[$i]);
            }
        }

        if (count($tagsDelete)) {
            for ($i = 0; $i < count($tagsInsert); $i++) {
                $check = $check == $this->deleteBlogAndTag($blog_id, $tagsInsert[$i]);
            }
        }

        return $check;
    }


    public function insertBlogAndTag($blog_id, $tag_id)
    {
        $sql = "INSERT INTO blog_tag SET blog_id=:blog_id, tag_id=:tag_id, created_at=NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":blog_id", $blog_id);
        $stmt->bindValue(":tag_id", $tag_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBlogAndTag($blog_id, $tag_id)
    {
        $sql = "DELETE FROM blog_tag WHERE blog_id=:blog_id AND tag_id=:tag_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":blog_id", $blog_id);
        $stmt->bindValue(":tag_id", $tag_id);

        return $stmt->execute();
    }


    private function isCheck($blog_id, $tag_id)
    {
        $sql = "SELECT count(*) AS count FROM blog_tag WHERE blog_id=:blog_id AND tag_id=:tag_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":blog_id", $blog_id);
        $stmt->bindValue(":tag_id", $tag_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    // note
    private function selectTags($blog_id = null, $tag_id = null)
    {
        if ($blog_id != null && $tag_id != null) {
            // select all


        } else if ($blog_id != null && $tag_id == null) {
            // select tags


        } else if ($blog_id == null && $tag_id != null) {
            // select blogs


        } else {
            // select tag and blog
            $sql = "SELECT * FROM blog_tag WHERE blog_id=:blog_id AND tag_id=:tag_id";

        }
    }


    function __destruct()
    {
        $this->conn = null;
    }


}