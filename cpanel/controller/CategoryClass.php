<?php

class CategoryClass{
    private $dbconn;
    private $category_active;

    function __construct($conn){
        $this->dbconn = $conn;
    }

    public function getCurrentCategoryActiveBuy($currentCategory){
        $this->category_active = (int)$currentCategory;
    }

    public function getAllCategory(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM tblcategory");
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
					echo "<li class='p-t-4'>";
                    if($row['idCategory'] == $this->category_active){
                        echo "<a href=?category=". $row['idCategory'] ." class='s-text13 active1'>";
                    }
                    else{
                        echo "<a href=?category=". $row['idCategory'] ." class='s-text13'>";
                    }
                    echo $row['CategoryName'];
                    echo "</a>";
                    echo "</li>";
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}


?>