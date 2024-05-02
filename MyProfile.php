<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Profile</title>
<?php
	if(isset($_SESSION['logout'])){
		header("location: login.php");
	}
	require_once("layout/header.php");
?>
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m">
		<h2 class="l-text2 t-center" style="color:black">
            <?php $login->getUsername($_SESSION['user_id']);?>'s Profile
		</h2>
        <p>Under Construction</p>
</section>


<?php
require_once("layout/footer_gray.php");
?>