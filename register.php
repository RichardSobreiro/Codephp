<?php
include "./inc/mysql_connect_inc.php";
include "./inc/validation_inc.php";

$register = @$_POST['register'];
$un = ""; // username
$em = ""; // email
$repeated_em = "";
$pswd = ""; // Password
$repeated_pswd = ""; // Password
$d = "";
$football = "";
$futsal = "";
$country = "";
$email_check = ""; // Check if email exists

// Registration form
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$repeated_em = strip_tags(@$_POST['repeated_email']);
$pswd = strip_tags(@$_POST['password']);
$repeated_pswd = strip_tags(@$_POST['repeated_password']);
$condterms = @$_POST['condterms'];
$football = @$_POST['football'];
$futsal = @$_POST['futsal'];
$country = @$_POST['country'];
$d = date("Y-m-d"); 

if($register){
    if(check_email_address($em)){
        if($em == $repeated_em){
            $email_check = mysqli_query($connection, "SELECT email FROM users_data WHERE email='$em'");
            $check = mysqli_num_rows($email_check);
            if($check == 0){
                if(check_username($un)){    
                    if($pswd == $repeated_pswd){
                        if((strlen($pswd) < 16)||(strlen($pswd) > 5)){
                            if($un&&$em&&$repeated_em&&$pswd&&$repeated_pswd){
                                if($condterms){
                                    if(($futsal)&&($football)) {
                                        $pswd = md5($pswd);
                                        mysqli_query($connection, "INSERT INTO users_data VALUES ('','$un','$em','$pswd','$d','img/default_pic.jpg','','','','','Footbal,Futsal','$country')");
                                        header("Location: index");
                                    } elseif($football) {
                                        $pswd = md5($pswd);
                                        mysqli_query($connection, "INSERT INTO users_data VALUES ('','$un','$em','$pswd','$d','img/default_pic.jpg','','','','','Footbal','$country')");
                                        header("Location: index");
                                    } elseif($futsal) {
                                        $pswd = md5($pswd);
                                        mysqli_query($connection, "INSERT INTO users_data VALUES ('','$un','$em','$pswd','$d','img/default_pic.jpg','','','','','Futsal','$country')");
                                        header("Location: index");
                                    } else {
                                        echo "<h1><b>You must choose some Sport!</b></h1>";
                                    }
                                }else{
                                    echo "You must accept the User Conditions Terms!";
                                }
                            }else{
                                echo "You must fill all of the fields!";
                            }
                        }else{
                            echo "Your password lenght must be greater or equal 6 characters and"
                            . "less then or equal 15 characters!";
                        }
                    }else{
                        echo "Your passwords does not match!";
                    }
                }else{
                    echo "";
                }
            }else{
                echo "Your email is alread registered!";
            }
        }else{
            echo "Your emails does not match!";
        }
    }else{
        echo "You must enter a valid email address!";
    }
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <!--Support for IE 9 or IE 8-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SportNet | Register</title>
    
    <!---------------------------------------------------------------------------------------------------------->
    <!--Tell the browser to be responsive to screen width-->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!---------------------------------------------------------------------------------------------------------->
    <!-- Ajax Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js" async></script> 
    <!-- Bootstrap Scripts -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" async></script>
    <!-- Bootstrap/TutorialsPoint Core CSS -->
    <!--link href="http://www.tutorialspoint.com/bootstrap/css/bootstrap.min.css" rel="stylesheet"-->
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!---------------------------------------------------------------------------------------------------------->
    <!-- Script Popup Window -->
    <script src="js/popup_window.js" type="text/javascript"></script>
    <!---------------------------------------------------------------------------------------------------------->
    <!--Style sheet for the project step-->
    <link rel="stylesheet" href="./css/Style_Initial.css">
    <!--Check the login form-->
    <script type="text/javascript" src="./js/login_register_check.js" async></script>
    <!---------------------------------------------------------------------------------------------------------->
    <!-- Attempt to use Bootstrap without internet -->
    <!-- Bootstrap CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Script Files -->
    <!--script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap Script Files -->
    <!--script src="fonts/bootstrap.min.js"></script>
    <!---------------------------------------------------------------------------------------------------------->
  </head>
  
  <body class="hold-transition register-page">
    <div class="login-reg-box">
      <div class="login-reg-logo">
        <b>Sport</b>Net
      </div>
      
      <div class="login-reg-body">
        <p class="login-reg-msg">Register a new member</p>
        <form action="register.php" method="post" onsubmit="return validate_register()">
          <div class="form-group has-feedback">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" name="repeated_email" id="repeated_email" class="form-control" placeholder="Repeat Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="repeated_password" id="repeated_email" class="form-control" placeholder="Repeat Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <select class="form-control" name="country" id="country">
              <option>US</option>
              <option>Deutschland</option>
              <option>England</option>
              <option>Brasil</option>
          </select>
          <div class="form-group has-feedback">
            <div class="checkbox">
                <label><input type="checkbox" name="football" id="football" value="1" checked="">  Football</label>
                <label class="pull-right"><input type="checkbox" name="futsal" id="futsal" value="2">  Futsal</label>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="condterms" value="accepted" checked> I agree to the <a href="#">User Conditions Terms</a>
                </label>
              </div>    
            </div>
            <div class="col-xs-4">
              <input type="submit" name="register" value="Register" class="btn btn-primary btn-block">
            </div>
          </div>
        </form>
        <a href="index" class="text-center">I am already a member</a>
      </div>
    </div>
  </body>
</html>

