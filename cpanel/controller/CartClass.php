<?php

class CartClass{
    private $dbconn;
    private $productExist;

    function __construct($conn){
        $this->dbconn = $conn;
    }

    public function listCartProduct(){
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

    public function addProductToCart($productID, $productQuantity, $userID){
        try{
            $orderProductHolder = 0;
            $exec = $this->dbconn->prepare("SELECT numberOfOrders FROM tblcart WHERE idProduct=:productID AND idUser=:userID");
            $exec->bindParam(':productID', $productID);
            $exec->bindParam(':userID', $userID);
            $exec->execute();
            if($exec->rowCount() > 0){
                $this->productExist = true;
                    $orderProductHolder = intval($exec->fetch(PDO::FETCH_COLUMN, 0));
            }
            if($this->productExist == true){
                $productQuantity += $orderProductHolder;
                $exec = $this->dbconn->prepare("UPDATE tblCart SET numberOfOrders = :quantity WHERE idProduct=:productID AND idUser=:userID");
                $exec->bindParam(':quantity', $productQuantity);
                $exec->bindParam(':productID', $productID);
                $exec->bindParam(':userID', $userID);
                $exec->execute();
                $productExist = false;
            }
            else{
                $exec = $this->dbconn->prepare("INSERT INTO tblcart(idUser, idProduct, numberOfOrders) VALUES(:userID, :productID, :quantity)");
                $exec->bindParam(':quantity', $productQuantity);
                $exec->bindParam(':productID', $productID);
                $exec->bindParam(':userID', $userID);
                $exec->execute();
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getNumberOfItemsInCart($userID){
        $query = $this->dbconn->prepare("SELECT COUNT(*) FROM tblcart WHERE idUser = :userID");
        $query->bindParam(':userID', $userID);
        $query->execute();
        $nRows = $query->fetchColumn();
        echo $nRows;
    }

    public function listCartItems($userID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM tblcart LEFT JOIN tblproduct ON tblcart.idProduct = tblproduct.idProduct WHERE tblcart.idUser =:userID UNION
            SELECT * FROM tblcart RIGHT JOIN tblproduct ON tblcart.idProduct = tblproduct.idProduct WHERE tblcart.idUser =:userID");
            $query->bindParam(':userID', $userID);
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr class='table-row'>";
                    echo "<td class='column-1'>";
                    echo "<div class='cart-img-product b-rad-4 o-f-hidden'>";
                    echo "<img src='images/". $row['Picture'] ."' alt='IMG-PRODUCT'>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td class='column-2'>".$row['ProductName']."</td>";
                    echo "<td class='column-3'>$".$row['ProductPrice']."</td>";
                    echo "<td class='column-4'>";
                    echo "<div class='flex-w bo5 of-hidden w-size17'>";
                    echo "<button class='btn-num-product-down color1 flex-c-m size7 bg8 eff2'>";
                    echo "<i class='fs-12 fa fa-minus' aria-hidden='true'></i>";
                    echo "</button>";
                    echo "<input class='size8 m-text18 t-center num-product' type='number' name='num-product1' value=".$row['numberOfOrders'].">";
                    echo "<button class='btn-num-product-up color1 flex-c-m size7 bg8 eff2'>";
                    echo "<i class='fs-12 fa fa-plus' aria-hidden='true'></i>";
                    echo "</button>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td class='column-5'>$".($row['numberOfOrders'] * $row['ProductPrice']) ."</td>";
                    echo "</tr>";
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getTotalPrice($userID){
        try{
            $total = 0;
            $query = $this->dbconn->prepare("SELECT * FROM tblcart LEFT JOIN tblproduct ON tblcart.idProduct = tblproduct.idProduct WHERE tblcart.idUser =:userID UNION
            SELECT * FROM tblcart RIGHT JOIN tblproduct ON tblcart.idProduct = tblproduct.idProduct WHERE tblcart.idUser =:userID");
            $query->bindParam(':userID', $userID);
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $total += $row['numberOfOrders'] * $row['ProductPrice'];
                }
            }
            echo $total;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}


?>