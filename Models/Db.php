<?php

/*
class DB {
  //プロパティ
  private $host;
  private $dbname;
  private $user;
  private $pass;
  protected $connect;

  //コンストラクタ
  function __construct($host, $dbname, $user, $pass) {
    $this->host = $host;
    $this->dbname = $dbname;
    $this->user = $user;
    $this->pass = $pass;
  }

  //メソッド（DB接続)
  public function connectDb() {
    $this->connect = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->pass);
    if(!$this->connect) {
      echo 'DBに接続できませんでした';
      die();
    }
  }
}
date_default_timezone_set('Asia/Tokyo');
*/

require_once('../View/database.php');

class Db {
    protected $dbh;
    
    public function __construct($dbh = null) {
        if(!$dbh){
            try{
                $this->dbh = new PDO(
        
                    'mysql:dbname='.DB_NAME.
                    ';host='.DB_HOST,DB_USER,DB_PASSWD
                );
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "接続成功１";
                
            }catch (PDOException $e){
                echo "接続失敗".$e->getMessage() ."\n";
                exit();
            }
        }else {
            $this->dbh = $dbh;
            //echo "接続成功２";
        }
    }
    
    public function get_db_handler() {
        return $this->dbh;
    }
}

?>