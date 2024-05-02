<?php

class RegisterClass{
  private $dbconn;
  public $emailExist,$userExist;

  function __construct($conn){
    $this->dbconn = $conn;
  }

  public function createAccount($username, $password){
    try {
      $sqlstatement = $this->dbconn->prepare("SELECT * FROM tblusers WHERE UserName=:username");
      $sqlstatement->bindParam(':username', $username);
      $sqlstatement->execute();

      if($sqlstatement->rowCount() > 0){
        $this->userExist = true;
      }
      else{
        $passhash = $this->passHash($password);

        $sqlstatement = $this->dbconn->prepare("INSERT INTO tblusers(Username,userPass) VALUES(:username,:password)");

        $sqlstatement->bindParam(':username', $username);
        $sqlstatement->bindParam(':password', $passhash);
        $sqlstatement->execute();
        return true;
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
      return false;
    }
  }

  public function passHash($password){
    $pass = password_hash($password, PASSWORD_BCRYPT);
    return $pass;
  }
}

?>