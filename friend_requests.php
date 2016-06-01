<?php
include "./inc/header.php";

?>
<!-- Custom CSS -->
<!--link href="./css/one-page-wonder.css" rel="stylesheet"-->
<style>
.message-item {
    margin-bottom: 25px;
    margin-left: 40px;
    position: relative;
}

.message-item .message-inner {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 10px;
    position: relative;
}

.message-item .message-inner:before {
    border-right: 10px solid #ddd;
    border-style: solid;
    border-width: 10px;
    color: rgba(0, 0, 0, 0);
    content: "";
    display: block;
    height: 0;
    position: absolute;
    left: -20px;
    top: 6px;
    width: 0;
}

.message-item .message-inner:after {
    border-right: 10px solid #fff;
    border-style: solid;
    border-width: 10px;
    color: rgba(0, 0, 0, 0);
    content: "";
    display: block;
    height: 0;
    position: absolute;
    left: -18px;
    top: 6px;
    width: 0;
}

.message-item:before {
    background: #fff;
    border-radius: 2px;
    bottom: -30px;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    content: "";
    height: 100%;
    left: -30px;
    position: absolute;
    width: 3px;
}

.message-item:after {
    background: #fff;
    border: 2px solid #ccc;
    border-radius: 50%;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    content: "";
    height: 15px;
    left: -36px;
    position: absolute;
    top: 10px;
    width: 15px;
}

.clearfix:before,
.clearfix:after {
    content: " ";
    display: table;
}

.message-item .message-head {
    border-bottom: 1px solid #eee;
    margin-bottom: 8px;
    padding-bottom: 8px;
}

.message-item .message-head .avatar {
    margin-right: 20px;
}

.message-item .message-head .user-detail {
    overflow: hidden;
}

.message-item .message-head .user-detail h5 {
    font-size: 16px;
    font-weight: bold;
    margin: 0;
}

.message-item .message-head .post-meta {
    float: left;
    padding: 0 15px 0 0;
}

.message-item .message-head .post-meta >div {
    color: #333;
    font-weight: bold;
    text-align: right;
}

.post-meta > div {
    color: #777;
    font-size: 12px;
    line-height: 22px;
}

.message-item .message-head .post-meta >div {
    color: #333;
    font-weight: bold;
    text-align: right;
}

.post-meta > div {
    color: #777;
    font-size: 12px;
    line-height: 22px;
}

img {
    min-height: 40px;
    max-height: 40px;
}


</style>

<body>
  <div class="row">
        <div class="container">
    <!-- Page Content -->
            <div class="col-sm-6">
                <div class="well">  
      
                    <h1 class="thick-heading">|| Friend Requests ||</h1>

                        <!-- First Featurette -->
                        <div class="featurette" id="about">
<!---------------------------------------------------------------------------------------------------------->
<!-- Begin: Friend Requests Timeline -->
            

                <div class="qa-message-list" id="wallmessages">
<?php
// Find Friend Requests
$friendRequests = mysqli_query($connection, "SELECT * FROM friend_requests WHERE user_to='$user'");
$numrows = mysqli_num_rows($friendRequests);
if ($numrows == 0) {
    $date = date("Y-m-d");
?>
<!---------------------------------------------------------------------------------------------------------->
<!-- Begin: Single Friend Requests -->
                    <div class="message-item" id="m1">
                        <div class="message-inner">
                            <div class="message-head clearfix">
                                <div class="avatar pull-left">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="user-detail">
                                    <h5 class="handle">Friend Request</h5>
                                    <div class="post-meta">
                                        <div class="asker-meta">
                                            <span class="qa-message-what"></span>
                                            <span class="qa-message-when">
                                                <span class="qa-message-when-data"><?php echo $date;?></span>
                                            </span>
                                            <span class="qa-message-who">
                                                <span class="qa-message-who-pad">by </span>
                                                <span class="qa-message-who-data">
                                                    SportNet
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="qa-message-content">
                                At the moment you do not have any friend request!
                            </div>
                        </div>
                    </div>
<!-- End: Single Friend Requests -->
<!---------------------------------------------------------------------------------------------------------->
<?php
} else {
    while ($get_row = mysqli_fetch_assoc($friendRequests)){
        $id = $get_row['id'];
        $user_to = $get_row['user_to'];
        $user_from = $get_row['user_from'];
        $date = $get_row['date'];
        $msg = $get_row['msg'];
        $email_user_from = $get_row['email'];
        
        if (isset($_POST['accept'.$user_from])) {
            //Get friend array for logged in user
            $get_friend_check = mysqli_query($connection, "SELECT friend_array FROM users_data WHERE email='$email'");
            $get_friend_row = mysqli_fetch_assoc($get_friend_check);
            $friend_array = $get_friend_row['friend_array'];
            $friendArray_explode = explode(",",$friend_array);
            $friendArray_count = count($friendArray_explode);

            //Get friend array for person who sent request
            $get_friend_check_friend = mysqli_query($connection, "SELECT friend_array FROM users_data WHERE email='$email_user_from'");
            $get_friend_row_friend = mysqli_fetch_assoc($get_friend_check_friend);
            $friend_array_friend = $get_friend_row_friend['friend_array'];
            $friendArray_explode_friend = explode(",",$friend_array_friend);
            $friendArray_count_friend = count($friendArray_explode_friend);

            if ($friend_array == "") {
               $friendArray_count = count(NULL);
            }
            if ($friend_array_friend == "") {
               $friendArray_count_friend = count(NULL);
            }
            if ($friendArray_count == NULL) {
             $add_friend_query = mysqli_query($connection,"UPDATE users_data SET friend_array=CONCAT(friend_array,'$email_user_from') WHERE email='$email'");
            }
            if ($friendArray_count_friend == NULL) {
             $add_friend_query = mysqli_query($connection,"UPDATE users_data SET friend_array=CONCAT(friend_array,'$email') WHERE email='$email_user_from'");
            }
            if ($friendArray_count >= 1) {
                $email_db = ",".$email_user_from;
                //echo $email_db."<br>";
                $add_friend_query = mysqli_query($connection,"UPDATE users_data SET friend_array=CONCAT(friend_array,'$email_db') WHERE email='$email'");
            }
            if ($friendArray_count_friend >= 1) {
                $email_db = ",".$email;
                //echo $email_db."<br>";
                $add_friend_query = mysqli_query($connection,"UPDATE users_data SET friend_array=CONCAT(friend_array,'$email_db') WHERE email='$email_user_from'");
            }
            $delete_request = mysqli_query($connection,"DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'&&email='$email_user_from'");
            ?>
            <script type="text/javascript">
                popup("You are now friends!");
            </script>
            <meta http-equiv="refresh" content="0;URL='friend_requests.php'">
            <?php
        }
      if (isset($_POST['decline'.$user_from])) {
            $ignore_request = mysqli_query($connection,"DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'&&email='$email_user_from'");
            ?>
            <script type="text/javascript">
                popup("Request Ignored!");
            </script>
            <meta http-equiv="refresh" content="0;URL='friend_requests.php'">
            <?php
      }
        
        if(ctype_alnum($user_from)){
            $check = mysqli_query($connection, "SELECT first_name,last_name, email, profile_pic FROM users_data WHERE username='$user_from'");
            if(mysqli_num_rows($check) == 1){
                $get = mysqli_fetch_assoc($check);
                $first_name_profile = $get['first_name'];
                $last_name_profile = $get['last_name'];
                $email_profile = $get['email'];
                $profile_pic_db = $get['profile_pic'];
                if ($profile_pic_db == "") {
                    $profile_pic_profile = "img/default_pic.jpg";
                } else {
                    $profile_pic_profile = $profile_pic_db;
                }
            } else {
                echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/SocialNetwork/index.php>";
                exit();
            }
        }
?>
<!---------------------------------------------------------------------------------------------------------->
<!-- Begin: Single Friend Requests -->
                    <div class="message-item" id="m1">
                        <div class="message-inner">
                            <div class="message-head clearfix">
                                <div class="avatar pull-left">
                                    <a href="<?php echo $user_from; ?>"><img src="<?php echo $profile_pic_profile; ?>"></a>
                                </div>
                                <div class="user-detail">
                                    <h5 class="handle">Friend Request</h5>
                                    <div class="post-meta">
                                        <div class="asker-meta">
                                            <span class="qa-message-what"></span>
                                            <span class="qa-message-when">
                                                <span class="qa-message-when-data"><?php echo $date;?></span>
                                            </span>
                                            <span class="qa-message-who">
                                                <span class="qa-message-who-pad">by </span>
                                                <span class="qa-message-who-data">
                                                  <a href="<?php echo $user_from; ?>"><?php echo $user_from; ?></a>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="qa-message-content">
                                <b><?php echo $user_from; ?></b> wants to be your friend!
                            </div>
                            <br>
                            <form action="friend_requests.php" method="post">
                                <input type="submit" name="accept<?php echo $user_from; ?>" class="btn btn-sm btn-success" value="Accept" >
                                <input type="submit" name="decline<?php echo $user_from; ?>" class="btn btn-sm btn-success" value="Decline" >
                            </form>
                        </div>
                    </div>
<!-- End: Single Friend Requests -->
<!---------------------------------------------------------------------------------------------------------->
<?php
    }
}
?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End: Friend Requests Timeline -->
<!---------------------------------------------------------------------------------------------------------->
            <div class="col-sm-6">
                <div class="well">
                    <h1 class="thick-heading">|| Friends ||</h1>
                    <?php
                    //Get friend array for logged in user
                    $get_friend_check = mysqli_query($connection, "SELECT friend_array FROM users_data WHERE email='$email'");
                    $get_friend_row = mysqli_fetch_assoc($get_friend_check);
                    $friend_array = $get_friend_row['friend_array'];
                    $friendArray_explode = explode(",",$friend_array);
                    $friendArray_count = count($friendArray_explode);
                    $i = 0;
                    while ($i < $friendArray_count){
                        //echo $friendArray_explode[$i];
                        $select_friend_query = mysqli_query($connection, "SELECT * FROM users_data WHERE email='$friendArray_explode[$i]'");
                        $get_row = mysqli_fetch_assoc($select_friend_query);
                        $friend_profile_pic = $get_row['profile_pic'];
                        $friend_p_info = $get_row['p_info'];
                        $friend_country = $get_row['country'];
                        $friend_username = $get_row['username'];
                        $sports_array = $get_row['sports'];
                        if ($sports_array != "") {
                            $sports_array = explode(",", $sports_array);
                            $countSports = count($sports_array);
                            $sportsVector = array_slice($sports_array, 0, 8);
                        } else {
                            $sportsVector[0] = "";
                            $sportsVector[1] = "";
                        }
                        ?>
                        <!---------------------------------------------------------------------------------------------------------->
                        <!-- Begin: Single Friend Contact -->
                        <div class="message-item">
                            <div class="message-inner">
                                <div class="message-head clearfix">
                                    <div class="avatar pull-left">
                                        <a href="<?php echo $friend_username; ?>"><img src="<?php echo $friend_profile_pic; ?>" class="img-responsive" style="height:40px; width: 40px;"></a>
                                    </div>
                                    <div class="user-detail">
                                        <div class="post-meta">
                                            <div class="asker-meta">
                                                <span class="qa-message-what"></span>
                                                <span class="qa-message-when">
                                                </span>
                                                <span class="qa-message-who">
                                                    <span class="qa-message-who-pad"><a href="<?php echo $friend_username; ?>"><?php echo $friend_username; ?></a></span>
                                                    <span class="qa-message-who-data">
                                                        <p></p>
                                                        <?php 
                                                        $j = 0;
                                                        foreach($sportsVector as $key => $value){
                                                            if($sportsVector[$j] != ""){
                                                                ?>
                                                                <p><span class="label label-success">
                                                                <?php
                                                                    echo $sportsVector[$j];
                                                                ?>
                                                                </span></p>
                                                                <?php
                                                            }
                                                            $j++;
                                                        }    
                                                        ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="qa-message-content">
                                    <?php
                                    if($friend_p_info != ""){
                                    ?>
                                        <?php echo $friend_p_info; ?>
                                    <?php    
                                    } else {
                                        echo "No information provided!";
                                    }
                                    ?>     
                                </div>
                                <br>
                                <form action="friend_requests.php" method="post">
                                </form>
                            </div>
                        </div>
                        <!-- End: Single Friend Contact -->
<!---------------------------------------------------------------------------------------------------------->
                        <?php
                        $i++;
                    }
                    ?>
                </div>  
            </div>
        </div>
    </div>
</body>
</html>