<?php
class Database{
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'matt1980';
    private $dbname = 'blogpost';
    
    private $dbh;
    private $errors;
    private $stmt;
    
    public function __construct() {
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        //options
        $options = array(
           PDO::ATTR_PERSISTENT => true,
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //create try and catch
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (Exception $ex) {
           echo  $this->errors = $ex->getMessage();
        }
    }
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch (true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindvalue($param, $value, $type);
    }
    public function execute(){
        return $this->stmt->execute();
    }
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function lastInsertId(){
       return $this->dbh->lastInsertId();
    }
    public  function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
