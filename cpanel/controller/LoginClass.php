<?php

class LoginClass{
  private $dbconn;
  
  function __construct($conn){
    $this->dbconn = $conn;
  }

  public function accountCheck($username, $password){
    try{
      $exec = $this->dbconn->prepare("SELECT idUser FROM tblusers WHERE Username=:Username");
      $exec->bindparam(":Username", $username);
      $exec->execute();
      if($exec->rowCount() > 0){
        $_SESSION['user_id'] = $exec->fetch(PDO::FETCH_COLUMN, 0);
      }
      $sqlstatement=$this->dbconn->prepare("SELECT userPass FROM tblusers WHERE Username=:username");
      $sqlstatement->bindParam(':username',$username);
      $sqlstatement->execute();
      if($sqlstatement->rowCount() > 0){
        $pw = $sqlstatement->fetchColumn();
        if(password_verify($password, $pw)){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }catch(PDOException $e){
      echo $e->getMessage();
    }
  }

  public function getUsername($userID){
    try{
      $exec = $this->dbconn->prepare("SELECT username FROM tblusers WHERE idUser=:UserID");
      $exec->bindparam(":UserID", $userID);
      $exec->execute();
      if($exec->rowCount() > 0){
        echo $exec->fetch(PDO::FETCH_COLUMN, 0);
      }
    }catch(PDOException $e){
      echo $e->getMessage();
    }
  }

}

?>