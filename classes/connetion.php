<?php

  class BDconnect {
    protected $dsn = "mysql:host=localhost; dbname=youdemy";
    protected $user = 'root';
    protected $password = "";
    private $pdo;

    function PDOconnect(){
      try{
        $this->pdo = new PDO($this->dsn, $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->pdo; 
      }
      catch(PDOException $e){
        die("error : " . $e->getMessage());
      }
    }
  }