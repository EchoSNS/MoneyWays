<!DOCTYPE html>
<html lang="en">
<head>
	<title>Money Ways - Register</title>
<?php
    require_once('cpanel/config/db.php');
    if(isset($_SESSION['loggedin'])){
        header("location: MyProfile.php");
    }
    if(isset($_POST['submit'])){
    
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($register->createAccount($username,$password)){
            $_SESSION['success'] = "Account created successfully";
            header('location: register.php');
            exit(0);
        }else if($register->userExist){
            $_SESSION['fail'] = "Username already exist";
            header('location: register.php');
            exit(0);
        }else if($register->emailExist){
            $_SESSION['fail'] = "Email already exist";
            header('location: register.php');
            exit(0);
        }
    
    }
	require_once("layout/header.php");
?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m">
		<h2 class="l-text2 t-center" style="color:black">
			Register An Account
		</h2>
	</section>
    
    <section class="bgwhite p-b-100">
        <div class="container">
            <div class="row">
                <div id="content" class="col-sm-12">
                    <form method="post" id="create_customer" accept-charset="UTF-8">
                        <input type="hidden" name="form_type" value="create_customer" />
                        <input type="hidden" name="utf8" value="✓" />
                        <div  id="create-account-form " >
                            <fieldset id="account" class="form-horizontal">
                                <legend>Your Personal Details</legend>
                                <div class="form-group required">
                                    <label  class="col-sm-2 control-label" for="username">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" id="username" placeholder="Username"  class="form-control"  autocorrect="off" autocapitalize="off">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label  class="col-sm-2 control-label" for="password">Password</label>
                                    <div class="col-sm-10">
                                    <input type="password" value="" name="password" id="create_password" placeholder="Password"  class="form-control" >
                                </div>
                            </fieldset>
                        </div>
                        <div class="submit">					
                            <button name="submit" id="button-account" type="submit" class="btn btn-primary">
                                <span>
                                    <i class="fa fa-user left"></i>
                                    Create
                                </span>
                            </button>
                            &nbsp;
                            or <a class="btn-acct" href="index.php">Return to Store</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    </div>
    <?php
      if(isset($_SESSION['success']))
      {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
      }
      if(isset($_SESSION['fail'])){
        echo $_SESSION['fail'];
        unset($_SESSION['fail']);
      }
    ?>
    </div>
<?php
	require_once("layout/footer_gray.php");
?>