<?php


class ForumTagModel
{
    private $conn;

    public function __construct() {
        $this->conn = new DB_PDO();
    }

    // select
    public function select()
    {
        try {

        } catch (PDOException $e) {
            echo "ERROR :: " . $e->getMessage();
        }
    }

    // insert
    public function insert()
    {
        try {

        } catch (PDOException $e) {
            echo "ERROR :: " . $e->getMessage();
        }
    }

    // update
    public function update()
    {
        try {

        } catch (PDOException $e) {
            echo "ERROR :: " . $e->getMessage();
        }
    }

    // delete
    public function delete()
    {
        try {

        } catch (PDOException $e) {
            echo "ERROR :: " . $e->getMessage();
        }
    }
}