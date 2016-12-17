<?php


class TagsModel
{
    private $conn;
    private $result;


    public function __construct()
    {
        $this->conn = new DB_PDO();
        $this->result = array();
    }


    public function getTagId($id)
    {
        $sql = "SELECT * FROM tags WHERE tag_id=:id ORDER BY tag_name ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch();

        $result['id'] = $row['tag_id'];
        $result['name'] = $row['tag_name'];

        $this->result = array('data' => $result);

        return $row;
    }

    public function getTags()
    {
        $sql = "SELECT * FROM tags ORDER BY tag_name ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $arr = array();

        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetchAll() as $item => $value) {
                array_push($arr, array(
                    'id' => $value['tag_id'],
                    'name' => $value['tag_name']
                ));
            }
        }

        $this->result = array('count' => $stmt->rowCount(), 'lists' => $arr);

        return $arr;
    }

    public function showJSON()
    {
        echo json_encode($this->result);
    }

    function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        $this->conn = null;
    }
}