<?php
include "./inc/header.php";

// Begin: Profile Pic Upload From Database //
// Check whether the user has uploaded a profile pic or not
$check_pic = mysqli_query($connection, "SELECT profile_pic FROM users_data WHERE username='$user'");
$get_pic_row = mysqli_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['profile_pic'];
if($profile_pic_db == ""){
    $profile_pic = "img/default_pic.jpg";
} else {
    $profile_pic = $profile_pic_db;
}
// Data: Profile Pic Upload From Database //

// Begin: Profile Pic Upload //
if(isset($_FILES['profilepic'])){
    if(((@$_FILES["profilepic"]["type"]=="image/jpeg")||(@$_FILES["profilepic"]["type"]=="image/png")
                    ||(@$_FILES["profilepic"]["type"]=="image/gif"))&&(@$_FILES["profilepic"]["size"]<1048576)){
        if(!file_exists("userdata/profile_pics/$id")){
            mkdir("userdata/profile_pics/$id");
            if(file_exists("userdata/profile_pics/$id/".$_FILES["profilepic"]["name"])){
                $files = glob("userdata/profile_pics/$id/*"); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file))
                    unlink($file); // delete file
                }
                move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "userdata/profile_pics/$id/".$_FILES["profilepic"]["name"]);
                $profile_pic_name = @$_FILES["profilepic"]["name"];
                $profile_pic_query = mysqli_query($connection, "UPDATE users_data SET profile_pic='userdata/profile_pics/$id/$profile_pic_name' WHERE id='$id'");
                //header("Location: settings.php");
            }else{
                move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "userdata/profile_pics/$id/".$_FILES["profilepic"]["name"]);
                $profile_pic_name = @$_FILES["profilepic"]["name"];
                $profile_pic_query = mysqli_query($connection, "UPDATE users_data SET profile_pic='userdata/profile_pics/$id/$profile_pic_name' WHERE id='$id'");
                //header("Location: settings.php");
            }
        } else {
            if(file_exists("userdata/profile_pics/$id/".$_FILES["profilepic"]["name"])){
                $files = glob("userdata/profile_pics/$id/*"); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file))
                    unlink($file); // delete file
                }
                move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "userdata/profile_pics/$id/".$_FILES["profilepic"]["name"]);
                $profile_pic_name = @$_FILES["profilepic"]["name"];
                $profile_pic_query = mysqli_query($connection, "UPDATE users_data SET profile_pic='userdata/profile_pics/$id/$profile_pic_name' WHERE id='$id'");
                //header("Location: settings.php");
            }else{
                move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "userdata/profile_pics/$id/".$_FILES["profilepic"]["name"]);
                $profile_pic_name = @$_FILES["profilepic"]["name"];
                $profile_pic_query = mysqli_query($connection, "UPDATE users_data SET profile_pic='userdata/profile_pics/$id/$profile_pic_name' WHERE id='$id'");
                //header("Location: settings.php");
            }
        }
    }else {
            echo "Invalid File! Your image must be no larger than 1MB and it must be either a .jpg, , .jpeg, .png or .gif";
    }
}
// End: Profile Pic Upload //

// Begin: User informations //
$send_p_info = @$_POST['send_p_info'];
$get_info = mysqli_query($connection, "SELECT first_name, last_name, p_info FROM users_data WHERE email='$email'");
$get_row = mysqli_fetch_assoc($get_info);
$db_first_name = $get_row['first_name'];
$db_last_name = $get_row['last_name'];
$db_p_info = $get_row['p_info'];
if($send_p_info){
    $first_name = strip_tags(@$_POST['first_name']);
    $last_name = strip_tags(@$_POST['last_name']);
    $p_info = @$_POST['p_info'];
    if(strlen($first_name) < 3){
?>
<script type="text/javascript">
    popup("Your first name must be 3 or more\ncharacters long!");
</script>
<?php
    }else{
      if(strlen($last_name) < 3){
?>
<script type="text/javascript">
    popup("Your last name must be 3 or more\ncharacters long!");
</script>
<?php
      }else{
        $info_submit_query = mysqli_query($connection, "UPDATE users_data SET first_name='$first_name', last_name='$last_name', p_info='$p_info' WHERE email='$email'");
        ?>
        <script type="text/javascript">
            popup("Your Profile information has been updated!");
        </script>
        <?php
        //header("Location: settings.php");
      }
    } 
}else{
  // Do nothing
}
// End: User informations //

// Begin: Password Change //
$pswd_change =@$_POST['pswd_change'];
$old_password = strip_tags(@$_POST['old_password']);
$new_password = strip_tags(@$_POST['new_password']);
$repeat_newpassword = strip_tags(@$_POST['pswd_repeated']);
  
if ($pswd_change) {
    $password_query = mysqli_query($connection, "SELECT * FROM users_data WHERE email='$email'");
    while($row = mysqli_fetch_assoc($password_query)) {
        $db_password = $row['password'];
        $old_password_md5 = md5($old_password);
        if($old_password_md5 == $db_password){
        if($new_password == $repeat_newpassword){
            if (strlen($new_password)<=5){
                ?>
                <script type="text/javascript">
                    popup("Sorry! But your password must be more than 5 character long!");
                </script>
                <?php
                }else{
                    $new_password_md5 = md5($new_password);
                    $password_update_query = mysqli_query($connection,"UPDATE users_data SET password='$new_password_md5' WHERE email='$email'");
                    ?>
                    <script type="text/javascript">
                        popup("Success!Your password was updated!");
                    </script>
                    <?php
                }
            }else {
                ?>
                <script type="text/javascript">
                popup("Your new passwords do not match!");
                </script>
                <?php
            }
        }else{
            ?>
            <script type="text/javascript">
            popup("The old password does not match!");
            </script>
            <?php
        }
    }
} else {
    // Do nothing
}
// End: User informations //

$pswd_change =@$_POST['pswd_change'];
$old_password = strip_tags(@$_POST['old_password']);
$new_password = strip_tags(@$_POST['new_password']);
$repeat_newpassword = strip_tags(@$_POST['pswd_repeated']);
  
if ($pswd_change) {
    $password_query = mysqli_query($connection, "SELECT * FROM users_data WHERE email='$email'");
    while($row = mysqli_fetch_assoc($password_query)) {
        $db_password = $row['password'];
        $old_password_md5 = md5($old_password);
        if($old_password_md5 == $db_password){
        if($new_password == $repeat_newpassword){
            if (strlen($new_password)<=5){
                ?>
                <script type="text/javascript">
                    popup("Sorry! But your password must be more than 5 character long!");
                </script>
                <?php
                }else{
                    $new_password_md5 = md5($new_password);
                    $password_update_query = mysqli_query($connection,"UPDATE users_data SET password='$new_password_md5' WHERE email='$email'");
                    ?>
                    <script type="text/javascript">
                        popup("Success!Your password was updated!");
                    </script>
                    <?php
                }
            }else {
                ?>
                <script type="text/javascript">
                popup("Your new passwords do not match!");
                </script>
                <?php
            }
        }else{
            ?>
            <script type="text/javascript">
            popup("The old password does not match!");
            </script>
            <?php
        }
    }
} else {
    // Do nothing
}
// Begin: Username Change //
$username_change =@$_POST['username_change'];
$new_username = strip_tags(@$_POST['new_username']);
$new_username = str_replace(' ', '_', $new_username);
echo $new_username;
  
if ($username_change) {
    $username_query = mysqli_query($connection, "SELECT * FROM users_data WHERE email='$email'");
    while($row = mysqli_fetch_assoc($username_query)) {
        $db_username = $row['username'];
        if (strlen($new_username) < 26){
            if (strlen($new_username) <= 2){
                ?>
                <script type="text/javascript">
                    popup("Sorry! But your username must be more than 1 character long!");
                </script>
                <?php
            } else {
                $username_update_query = mysqli_query($connection,"UPDATE users_data SET username='$new_username' WHERE email='$email'");
                ?>
                <script type="text/javascript">
                    popup("Success!Your username was updated!\nYou need to logout for the changes take effect!");
                </script>
                <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                popup("Sorry! But your username must be less than 26 character long!");
            </script>
            <?php
        }
    }
} else {
    // Do nothing
}
// End: Username Change //

?>
<style>
  .col-xs-12 {
    width: 100%;
  }
  .form-control {
    width: 50%;
  }
  @media (max-width: 767px){
    .col-xs-12 {
      width: 100%;
    }
    .form-control {
    width: 100%;
  }
  }
</style>

<body>
  <hr><hr>
  <!--Begin: Profile Pic--> 
        <div class="form-group">
            <div class="container">
                <img src="<?php echo $profile_pic; ?>" class="img-circle" alt="File not found" width="200" height="200"> 
                <br>
            </div>
            <div class="col-xs-12">
              <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <br>
                    <label for="img">File:</label>
                    <input type="file" name="profilepic" class="btn" />
                    <br>
                    <input type="submit" name="uploadpic" class="btn btn-lg btn-success" value="Submit" />
                </form>
            </div>
        </div>
<!--End: Profile Pic-->
       	
<br><br><br><br><br><br><br><br>
<div>
  <hr><hr>
    <form class="form" action="settings.php" method="post">
        <div class=" col-xs-12 ">
            <label for="first_name"><h4>First name</h4></label>
            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $db_first_name; ?>">
        </div>
        <div class=" col-xs-12 ">
            <label for="last_name"><h4>Last name</h4></label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $db_last_name; ?>">
        </div>
        <div class=" col-xs-12 ">
            <label for="p_info"><h4>Personal Info</h4></label>
            <textarea class="form-control" rows="5" name="p_info" id="p_info"><?php echo $db_p_info; ?></textarea>
        </div>
        <div class="col-xs-12">
            <br>
            <input type="submit" name="send_p_info" id="send_p_info" class="btn btn-lg btn-success" value="Save">
        </div>
    </form>
</div>
<div>
  <hr><hr>
    <form class="form" action="settings.php" method="post">
        <div class=" col-xs-12 ">
            <label for="old_password"><h4>Old Password</h4></label>
            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password">
        </div>
        <div class=" col-xs-12 ">
            <label for="new_password"><h4>New Password</h4></label>
            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
        </div>
        <div class=" col-xs-12 ">
            <label for="pswd_repeated"><h4>Repeat the New Password</h4></label>
            <input type="password" class="form-control" name="pswd_repeated" id="pswd_repeated" placeholder="Repeat the New Password">
        </div>
        <div class="col-xs-12">
            <br>
            <input type="submit" name="pswd_change" id="pswd_change" class="btn btn-lg btn-success" value="Save">
        </div>
    </form>
</div>
<div>
  <hr><hr>
    <form class="form" action="settings.php" method="post">
        <div class=" col-xs-12 ">
            <label for="username_change"><h4>Enter a New Username</h4></label>
            <input type="text" class="form-control" name="new_username" id="new_username" placeholder="New Username">
        </div>
        <div class="col-xs-12">
            <br>
            <input type="submit" name="username_change" id="username_change" class="btn btn-lg btn-success" value="Save">
        </div>
    </form>
</div>
</body>