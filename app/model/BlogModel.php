<?php



class BlogModel
{
    private $conn;

    private $user;
    private $blogTags;
    private $symbol;


    public function __construct() {
        $this->conn = new DB_PDO();
        $this->blogTags = new BlogTagsModel();
        $this->user = new UserModel();
        $this->symbol = new SymbolBlogModel();
    }



    public function selectBlogAll()
    {
        $sql = "SELECT * FROM blog ";

        // prepare sql
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // getting result
        $rowAll = $stmt->fetchAll();
        $result = array();


        if ($stmt->rowCount() > 0) {
            foreach ($rowAll as $item => $value) {
                array_push($result, array(
                    "blog_id"       => $value['blog_id'],
                    "title"         => $value['blog_title'],
                    "public_date"   => $value['blog_public'],
                    "tags"          => $this->blogTags->getTagsBlogId($value['blog_id']),
                    "user"          => $this->user->getNameUserId($value['user_id']),
                    "symbol"        => $this->symbol->getSymbol($value['blog_id'], $value['user_id'])
                ));
            }

            return array('count'=>$stmt->rowCount(), 'blog'=>$result);
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

        // getting result
        $rowAll = $stmt->fetchAll();
        $result = array();


        if ($stmt->rowCount() > 0) {
            foreach ($rowAll as $item => $value) {
                $result["blog_id"]      = $value['blog_id'];
                $result["title"]        = $value['blog_title'];
                $result["description"]  = $value['blog_description'];
                $result["status"]       = $value['blog_status'];
                $result["image"]        = $value['blog_image'];
                $result["public_date"]  = $value['blog_public'];
                $result["tags"]         = $this->blogTags->getTagsBlogId($value['blog_id']);
                $result["user"]         = $this->user->getUserId($value['user_id']);
                $result["symbol"]       = $this->symbol->getSymbol($value['blog_id'], $value['user_id']);
            }

            return array('count'=>$stmt->rowCount(), 'blog'=>$result);
        }
        return false;
    }


    public function close()
    {
        $this->conn = null;
    }
}