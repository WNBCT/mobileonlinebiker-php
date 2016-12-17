<?php



class DB_PDO extends PDO {


    public function __construct()
    {
        $this->connectDB();
    }


    public function connectDB()
    {
        try {
            parent::__construct('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            parent::exec('set charset utf8');

//            echo "Connected successfully";
        } catch (PDOException $exception) {
            echo "ERROR -> " . $exception->getMessage();
        }
    }


}