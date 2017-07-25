<?php
class DATABASE{
    private $host = "localhost";
    private $db_name = "roflrogue_db";
    private $user = "roflrogue";
    private $password = ;
    public $connect;
    public function dbc(){
        $this->connect = null;
        try{
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception){
            echo "Connection Error: " . $exception->getMessage();
        }
        return $this->connect;
    }  
}
?>
