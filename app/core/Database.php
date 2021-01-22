<?php 
namespace app\core;
use PDO;
use PDOException;

class Database 
{
    private $dbhost = CONFIG['DB_HOST'];
    private $dbuser = CONFIG['DB_USER'];
    private $dbpass = CONFIG['DB_PASS'];
    private $dbname = CONFIG['DB_NAME'];

    private $dbh;
    private $stmt;
    private $error;


    public function __construct()
    {
        $dsn = "mysql:host=".$this->dbhost.";dbname=".$this->dbname;
        $options = [PDO::ATTR_PERSISTENT=>true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try {
            $this->dbh = new PDO($dsn,$this->dbuser,$this->dbpass,$options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
            die();
            exit();
        }
    }



    protected function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
        return $this;
    }

    protected function bind($param,$value,$type = null)
    {
        if(is_null($type))
        {
            switch ($type) {
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
                    break;
            }
        }

        $this->stmt->bindValue($param,$value,$type);
        return $this;

    }

    public function execute()
    {
        $this->stmt->execute();
        return $this;
    }


    protected function all()
    {
        return $this->stmt->fetchAll(PDO::FETCH_CLASS);
    }

    protected function row()
    {
        return $this->stmt->fetchRow(PDO::FETCH_OBJ);
    }



    protected function rowCount()
    {
        return $this->stmt->rowCount();
    }
}