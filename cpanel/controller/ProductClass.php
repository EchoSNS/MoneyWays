<?php

class ProductClass{
    private $dbconn;
    public $ProductNameExist;

    function __construct($conn){
        $this->dbconn = $conn;
    }

    public function listProduct(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM tblproduct");
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<div class='col-sm-12 col-md-6 col-lg-4 p-b-50'>";
					echo "<div class='block2'>";
                    echo "<div class='block2-img wrap-pic-w of-hidden pos-relative block2-label";
                    if($row['Sale'] > 0){
                        echo "sale";
                    }
                    else{
                        if(strtotime($row['DatePosted']) > strtotime('-1 week')){
                            echo "new";
                        }
                    }
                    echo "'>";
                    echo "<img src=images/". $row['Picture'] ." alt=".$row['ProductName']."'>";
                    echo "<div class='block2-overlay trans-0-4'>";
                    if(isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])){
                        echo "<div class='block2-btn-addcart w-size1 trans-0-4'>";
                        echo "<a href='?category=0&idProduct=". $row['idProduct'] ."&quantity=1'>";
                        echo "<button class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4'>";
                        echo "Add to Cart";
                        echo "</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='block2-txt p-t-20'>";
                    echo "<a href='product-detail.php?id=". $row['idProduct'] ."' class='block2-name dis-block s-text3 p-b-5'>";
                    echo $row['ProductName'];
                    echo "</a>";
                    echo "<span class='block2-price m-text6 p-r-5'>";
                    echo "$". $row['ProductPrice'];
                    echo "</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getProductCategorybyProductID($productID){
        try{
            $query = $this->dbconn->prepare("SELECT tblCategory.idCategory, tblCategory.CategoryName, tblProduct.IdProduct FROM tblCategory LEFT JOIN tblProduct ON tblCategory.idCategory=tblProduct.idCategory");
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    if($productID == $row['IdProduct']){
                        echo "<a href='BuyPage.php?category=".$row['idCategory']."' class='s-text16'>";
                        echo $row['CategoryName'];
                        echo "<i class='fa fa-angle-right m-l-8 m-r-9' aria-hidden='true'></i>";
                        echo "</a>";
                        break;
                    }
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function GetProductName($productID){
        $exec = $this->dbconn->prepare("SELECT ProductName FROM tblproduct WHERE idProduct=:productID");
        $exec->bindparam(":productID", $productID);
        $exec->execute();
        if($exec->rowCount() > 0){
            $productName = $exec->fetch(PDO::FETCH_COLUMN, 0);
        }
        return $productName;
    }

    public function GetProductPrice($productID){
        $exec = $this->dbconn->prepare("SELECT ProductPrice FROM tblproduct WHERE idProduct=:productID");
        $exec->bindparam(":productID", $productID);
        $exec->execute();
        if($exec->rowCount() > 0){
            $productPrice = $exec->fetch(PDO::FETCH_COLUMN, 0);
        }
        return $productPrice;
    }
    
    public function GetProductDescription($productID){
        $exec = $this->dbconn->prepare("SELECT ProductDescription FROM tblproduct WHERE idProduct=:productID");
        $exec->bindparam(":productID", $productID);
        $exec->execute();
        if($exec->rowCount() > 0){
            $productDescription = $exec->fetch(PDO::FETCH_COLUMN, 0);
        }
        return $productDescription;
    }

    public function GetProductCategoryName($productID){
        $exec = $this->dbconn->prepare("SELECT tblCategory.idCategory, tblCategory.CategoryName, tblProduct.IdProduct FROM tblCategory LEFT JOIN tblProduct ON tblCategory.idCategory=tblProduct.idCategory");
        $exec->execute();
        if($exec->rowCount() > 0){
            while ($row = $exec->fetch(PDO::FETCH_ASSOC)){
                if($productID == $row['IdProduct']){
                    echo $row['CategoryName'];
                    break;
                }
            }
        }
    }

    public function GetRelatedProduct($productID){
        $exec = $this->dbconn->prepare("SELECT tblProduct.idCategory FROM tblProduct WHERE idProduct=:productID");
        $exec->bindparam(":productID", $productID);
        $exec->execute();
        if($exec->rowCount() > 0){
            $categoryID = $exec->fetch(PDO::FETCH_COLUMN, 0);
        }
        $exec = $this->dbconn->prepare("SELECT * FROM tblProduct WHERE idCategory=:categoryID");
        $exec->bindparam(":categoryID", $categoryID);
        $exec->execute();
        if($exec->rowCount() > 0){
            while ($row = $exec->fetch(PDO::FETCH_ASSOC)){
                if($productID == $row['idProduct']){
                    continue;
                }
                echo "<div class='item-slick2 p-l-15 p-r-15'>";
                echo "<div class='block2'>";
                echo "<div class='block2-img wrap-pic-w of-hidden pos-relative block2-label";
                if($row['Sale'] > 0){
                    echo "sale";
                }
                else{
                    if(strtotime($row['DatePosted']) > strtotime('-1 week')){
                        echo "new";
                    }
                }
                echo "'>";
                echo "<img src=images/". $row['Picture'] ." alt=".$row['ProductName']."'>";
                echo "<div class='block2-overlay trans-0-4'>";
                if(isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])){
                    echo "<div class='block2-btn-addcart w-size1 trans-0-4'>";
                    echo "<a href='?category=0&idProduct=". $row['idProduct'] ."&quantity=1'>";
                    echo "<button class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4'>";
                    echo "Add to Cart";
                    echo "</button>";
                    echo "</a>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "<div class='block2-txt p-t-20'>";
                echo "<a href='product-detail.php?id=". $row['idProduct'] ."' class='block2-name dis-block s-text3 p-b-5'>";
                echo $row['ProductName'];
                echo "</a>";
                echo "<span class='block2-price m-text6 p-r-5'>";
                echo "$". $row['ProductPrice'];
                echo "</span>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
    }

    public function getSpecificProductCategory($categoryID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM tblProduct WHERE IdCategory=:categoryID");
            $query->bindparam(":categoryID", $categoryID);
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<div class='col-sm-12 col-md-6 col-lg-4 p-b-50'>";
					echo "<div class='block2'>";
                    echo "<div class='block2-img wrap-pic-w of-hidden pos-relative block2-label";
                    if($row['Sale'] > 0){
                        echo "sale";
                    }
                    else{
                        if(strtotime($row['DatePosted']) > strtotime('-1 week')){
                            echo "new";
                        }
                    }
                    echo "'>";
                    echo "<img src=images/". $row['Picture'] ." alt=".$row['ProductName']."'>";
                    echo "<div class='block2-overlay trans-0-4'>";
                    if(isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])){
                        echo "<div class='block2-btn-addcart w-size1 trans-0-4'>";
                        echo "<a href='?category=0&idProduct=". $row['idProduct'] ."&quantity=1'>";
                        echo "<button class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4'>";
                        echo "Add to Cart";
                        echo "</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='block2-txt p-t-20'>";
                    echo "<a href='product-detail.php?id=". $row['idProduct'] ."' class='block2-name dis-block s-text3 p-b-5'>";
                    echo $row['ProductName'];
                    echo "</a>";
                    echo "<span class='block2-price m-text6 p-r-5'>";
                    echo "$". $row['ProductPrice'];
                    echo "</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function searchByNameProduct($productName){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM tblProduct WHERE ProductName LIKE '%$productName%' OR ProductDescription LIKE '%$productName%' OR DatePosted LIKE '%$productName%' ORDER BY idProduct DESC");
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<div class='col-sm-12 col-md-6 col-lg-4 p-b-50'>";
					echo "<div class='block2'>";
                    echo "<div class='block2-img wrap-pic-w of-hidden pos-relative block2-label";
                    if($row['Sale'] > 0){
                        echo "sale";
                    }
                    else{
                        if(strtotime($row['DatePosted']) > strtotime('-1 week')){
                            echo "new";
                        }
                    }
                    echo "'>";
                    echo "<img src=images/". $row['Picture'] ." alt=".$row['ProductName']."'>";
                    echo "<div class='block2-overlay trans-0-4'>";
                    if(isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])){
                        echo "<div class='block2-btn-addcart w-size1 trans-0-4'>";
                        echo "<a href='?category=0&idProduct=". $row['idProduct'] ."&quantity=1'>";
                        echo "<button class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4'>";
                        echo "Add to Cart";
                        echo "</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='block2-txt p-t-20'>";
                    echo "<a href='product-detail.php?id=". $row['idProduct'] ."' class='block2-name dis-block s-text3 p-b-5'>";
                    echo $row['ProductName'];
                    echo "</a>";
                    echo "<span class='block2-price m-text6 p-r-5'>";
                    echo "$". $row['ProductPrice'];
                    echo "</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}


?>