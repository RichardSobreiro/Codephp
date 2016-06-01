<?php
include './inc/mysql_connect_inc.php';
include './inc/validation_inc.php';

session_start();
if (!isset($_SESSION["username"])) {
    echo "";
}
else{
    echo "<meta http-equiv=\"refresh\" content=\"0; url=profile.php\">";	
}

if((isset($_POST['email'])) && (isset($_POST['password']))){
    if(check_email_address($_POST['email'])){
        if(check_password($_POST['password'])){
            $pswd = $_POST['password'];
            $email = $_POST['email'];
            $md5pswd = md5($pswd);
            $result = mysqli_query($connection, "SELECT * FROM users_data WHERE email='$email' && password='$md5pswd'");
            $count = mysqli_num_rows($result);
            if($count == 1){
                $getter = mysqli_fetch_assoc($result);
                $id = $getter['id'];
                $username = $getter['username'];
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $pswd;
                $_SESSION["email"] = $email;
                
                header("location: $username");
                exit();
            }else{
                echo "The information provided is incorrect!";
            }
        }else{
            echo "Your password is invalid!";
        }
    }else{
        echo "Your email is invalid!";
    }
}
?>

<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>SportNet | Log in</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      
      <!-- Glyphicon Icons from Bootstrap -->
      <!--link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"-->
      <!---------------------------------------------------------------------------------------------------------->
      <!-- Initial Style of the Login Page -->
      <link rel="stylesheet" href="./css/Style_Initial.css">
      <!--Check the login form-->
      <script type="text/javascript" src="./js/login_register_check.js" async></script>
      <!---------------------------------------------------------------------------------------------------------->
      <!-- Attempt to use Bootstrap without internet -->
      <!-- Bootstrap CSS Files -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap Script Files -->
      <script src="js/bootstrap.min.js"></script>
      <!-- Bootstrap Script Files -->
      <script src="fonts/bootstrap.min.js"></script>
      <!---------------------------------------------------------------------------------------------------------->
    </head>
      
    <body class="hold-transition login-page">
      <div class="login-reg-box">
        <!--Logo-->
        <div class="login-reg-logo">
          <b>Sport</b>Net
        </div>
        <div class="login-box-body">
          <p class="login-reg-msg">Sign in</p>
          <form action="index.php" method="post" name="login_form" onsubmit="return validate_login()">
            <div class="form-group has-feedback">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Remember Me
                  </label>
                </div>
              </div>
              <div class="col-xs-4">
                <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
              </div>
            </div>
          </form>
          <!-- Possible social login links like Google+ and Facebook
          <div class="social-auth-links text-center">
              
          </div>
          -->
          <a href="#">I forgot my password</a><br />
          <a href="register.php" class="text-center">Register a new member</a>
        </div>
      </div>
      <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      </script>
    </body>
</html>
