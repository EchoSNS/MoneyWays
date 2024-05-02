<!DOCTYPE html>
<html lang="en">
<head>
	<title>Money Ways - Login</title>
<?php
    require_once(__DIR__ . '/cpanel/config/db.php');

    if(isset($_SESSION['loggedin'])){
        header("location: MyProfile.php");
    }
    else{

        if(isset($_POST["submit"])){
            $username=$_POST["username"]; 
            $password=$_POST["password"]; 
            if($login->accountCheck($username,$password)){
		        unset($_SESSION['logout']); 
                $_SESSION['loggedin'] = "Logged In";
                header("location: index.php");
            }
            else{
                $_SESSION["invalid"] = "Wrong username or password";
            }
        }
    }
	require_once("layout/header.php");
?>
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m">
		<h2 class="l-text2 t-center" style="color:black">
			Login/Register
		</h2>
</section>

<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well">
                            <h2>New Customer</h2>
                            <p><strong>Register Account</strong></p>
                            <p>By creating an account you will be able to shop faster, be up to date on an order&#39;s status, and keep track of the orders you have previously made.</p>
                            <br/>
                            <a href="register.php" id="button-account" class="btn btn-primary">Continue</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="well">
                            <h2>Returning Customer</h2>
                            <p><strong>I am a returning customer</strong></p>
                            <form method="post" id="customer_login" accept-charset="UTF-8">
                                <input type="hidden" name="form_type" value="customer_login" />
                                <input type="hidden" name="utf8" value="✓" />
                                <div class="form-group">
                                    <label class="control-label" for="username">Username</label>
                                    <input type="text" value="" name="username" id="username" placeholder="Username"  class="form-control"  autocorrect="off" autocapitalize="off" autofocus>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input class="form-control" type="password" value="" name="password" id="password" placeholder="Password"  class="form-control">
                                </div>
                                
                                <p class="submit">			
                                    <input name="submit" type="submit" value="Sign In" class="btn btn-primary" />
                                    or <a class="btn-acct" href="index.html">Return to Store</a>
                                </p>
                                <input type="hidden" name="return_url" value="/account" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div>
    <?php
        if(isset($_SESSION['invalid']))
        {
            echo $_SESSION['invalid'];
            unset($_SESSION['invalid']);
        }
    ?>
</div>
<?php
require_once("layout/footer_gray.php");
?>