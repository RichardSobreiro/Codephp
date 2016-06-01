<?php
include "./inc/header.php";
?>
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


        <div class="container">
            <h1 class="thick-heading">|| Results ||</h1>
            <div class="featurette" id="about">
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Begin: Friend Results Timeline -->
                <div class="container">
                    <div class="qa-message-list" id="wallmessages">
<?php
if (isset($_POST['search'])) {
    $username_searched = $_POST['search'];
    $result = mysqli_query($connection, "SELECT * FROM users_data WHERE username='$username_searched'");
    $count = mysqli_num_rows($result);
    if($count == 0) {
?>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Begin: Single Friend Result -->
                    <div class="message-item" id="m1">
                        <div class="message-inner">
                            <div class="message-head clearfix">
                                <div class="avatar pull-left">
                                    <a href=""><img src=""></a>
                                </div>
                                <div class="user-detail">
                                    <h5 class="handle">Sorry!</h5>
                                    <div class="post-meta">
                                        <div class="asker-meta">
                                            <span class="qa-message-what"></span>
                                            <span class="qa-message-who">
                                                <span class="qa-message-who-data">
                                                  <a href=""></a>
                                                </span>
                                                <span class="qa-message-who-pad"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="qa-message-content">
                                No results found for <b><?php echo $username_searched;?>!</b>
                            </div>
                            <br>
                        </div>
                    </div>
<!-- End: Single Friend Result -->
<!------------------------------------------------------------------------------------------------------------------------------------------->        
<?php
    }else {
?>
                    <h4>
                        <?php echo $count;?> results found for: <span class="text-navy">"<?php echo $username_searched;?>"</span>
                    </h4>
<?php
        $selectFriendsQuery = mysqli_query($connection,"SELECT friend_array FROM users_data WHERE email='$email'");
        $friendRow = mysqli_fetch_assoc($selectFriendsQuery);
        $friendArray = $friendRow['friend_array'];
        while($get_row = mysqli_fetch_assoc($result)){
            $id = $get_row['id'];
            $username = $get_row['username'];
            $email_user_finded = $get_row['email'];
            $first_name = $get_row['first_name'];
            $last_name = $get_row['last_name'];
            $p_info = $get_row['p_info'];
            //$friend_array = $get_row['friend_array'];
            $sports_array = $get_row['sports'];
            $country = $get_row['country'];
            $profile_pic_profile = $get_row['profile_pic'];
?>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-- Begin: Single Friend Result -->
                    <div class="message-item" id="m1">
                        <div class="message-inner">
                            <div class="message-head clearfix">
                                <div class="avatar pull-left">
                                    <a href="<?php echo $username; ?>"><img src="<?php echo $profile_pic_profile; ?>"></a>
                                </div>
                                <div class="user-detail">
                                    <!--h5 class="handle">User</h5-->
                                    <div class="post-meta">
                                        <div class="asker-meta">
                                            <span class="qa-message-what"></span>
                                            <span class="qa-message-who">
                                                <!--span class="qa-message-who-pad">by </span-->
                                                <span class="qa-message-who-data">
                                                  <a href="<?php echo $username; ?>"><?php echo $username; ?></a>
                                                </span>
                                                <span class="qa-message-who-pad">from <?php echo $country; ?></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="qa-message-content">
                                <?php 
                                if($p_info != ""){
                                    echo $p_info;
                                } else {
                                    echo "No information provided!";
                                }
                                ?>
                            </div>
                            <br>
                            <form action="<?php echo $username;?>" method="post">
                                <?php
                                if($username != $user){
                                    if ($friendArray != "") {
                                        $friendArray = explode(",",$friendArray);
                                        if (in_array($email_user_finded, $friendArray)) {
                                            ?>
                                            <input type="submit" name="remove" id="remove" class="btn btn-sm btn-success" value="Remove" >
                                            <?php
                                        } else {
                                            ?>
                                            <input type="submit" name="add" id="add" class="btn btn-sm btn-success" value="+Add" >
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <input type="submit" name="add" id="add" class="btn btn-sm btn-success" value="+Add" >
                                        <?php
                                    }
                                }
                                ?>
                            </form>
                        </div>
                    </div>
<!-- End: Single Friend Result -->
<!------------------------------------------------------------------------------------------------------------------------------------------->
<?php
        }
    }
}
?>
                    </div>
                </div>
            </div>
            <!-- End: Friend Requests Timeline -->
<!------------------------------------------------------------------------------------------------------------------------------------------->
        </div>
    </body>
</html>



