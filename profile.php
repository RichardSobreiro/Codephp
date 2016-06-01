<?php
include "./inc/header.php";
?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<?php
// Begin: Profile Picture PHP
if(isset($_GET['u'])){
    $user_url = $connection->real_escape_string($_GET['u']);
    $username_profile = str_replace('_', ' ', $user_url);
    
    if(ctype_alnum($username_profile)){
        $check = mysqli_query($connection, "SELECT * FROM users_data WHERE username='$user_url'");
        if(mysqli_num_rows($check) == 1){
            $get = mysqli_fetch_assoc($check);
            $username_profile = $get['username'];
            $first_name_profile = $get['first_name'];
            $last_name_profile = $get['last_name'];
            $email_profile = $get['email'];
            $profile_pic_db = $get['profile_pic'];
            $sports_array = $get['sports'];
            if ($sports_array != "") {
                $sports_array = explode(",", $sports_array);
                $countSports = count($sports_array);
                $sportsVector = array_slice($sports_array, 0, 8);
            } else {
                $sportsVector[0] = "";
                $sportsVector[1] = "";
            }
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
}
// End: Profile Picture PHP

// Begin: Accept Friend Request PHP
if (isset($_POST['add'])) {
//if($friend_request){
    $friend_request = $_POST['add'];

    $user_to = $username_profile;
    $user_from = $user;

    if ($user_to == $user) {
        ?>
        <script type="text/javascript">
        popup("You can't send a friend request to yourself!");
        </script>
        <?php
    }
    else {
        $date = date("Y-m-d");
        $msg = "Mensage for test only!";
        $create_request = mysqli_query($connection,"INSERT INTO friend_requests VALUES ('','$user_from','$user_to','$date','$msg','$email')");
        ?>
        <script type="text/javascript">
        popup("Your friend Request has been sent!");
        </script>
        <?php
    }
} else {
 //Do nothing
}
// End: Accept Friend Request PHP

// Begin: Refuse Friend Request PHP
if (@$_POST['remove']) {
    // Friend array for logged in user
    $add_friend_check = mysqli_query($connection, "SELECT friend_array FROM users_data WHERE email='$email'");
    $get_friend_row = mysqli_fetch_assoc($add_friend_check);
    $friend_array = $get_friend_row['friend_array'];
    $friend_array_explode = explode(",", $friend_array);
    $friend_array_count = count($friend_array_explode);

    // Friend array for user who owns profile
    $add_friend_check_username = mysqli_query($connection, "SELECT friend_array FROM users_data WHERE email='$email_profile'");
    $get_friend_row_profile = mysqli_fetch_assoc($add_friend_check_username);
    $friend_array_profile = $get_friend_row_profile['friend_array'];
    $friend_array_explode_profile = explode(",",$friend_array_profile);
    $friend_array_count_profile = count($friend_array_explode_profile);

    $usernameComma = ",".$email_profile;
    $usernameComma2 = $email_profile.",";

    $userComma = ",".$email;
    $userComma2 = $email.",";

    if (strstr($friend_array,$usernameComma)) {
        $friend1 = str_replace("$usernameComma","",$friend_array);
    }
    else
    if (strstr($friend_array,$usernameComma2)) {
        $friend1 = str_replace("$usernameComma2","",$friend_array);
    }
    else
    if (strstr($friend_array,$email_profile)) {
        $friend1 = str_replace("$email_profile","",$friend_array);
    }
    //Remove logged in user from other persons array
    if (strstr($friend_array_profile,$userComma)) {
        $friend2 = str_replace("$userComma","",$friend_array_profile);
    }
    else
    if (strstr($friend_array_profile,$userComma2)) {
        $friend2 = str_replace("$userComma2","",$friend_array_profile);
    }
    else
    if (strstr($friend_array_profile,$email)) {
        $friend2 = str_replace("$user","",$friend_array_profile);
    }

    $removeFriendQuery = mysqli_query($connection, "UPDATE users_data SET friend_array='$friend1' WHERE email='$email'");
    $removeFriendQuery_profile = mysqli_query($connection, "UPDATE users_data SET friend_array='$friend2' WHERE email='$email_profile'");
   
    ?>
    <script type="text/javascript">
        popup("Friend Removed ...");
    </script>
    <?php
}
// End: Refuse Friend Request PHP

// Begin: Cancel Friend Request PHP
if (@$_POST['cancel']) {
    $ignore_request = mysqli_query($connection,"DELETE FROM friend_requests WHERE user_to='$username_profile'&&user_from='$user'&&email='$email'");
    ?>
    <script type="text/javascript">
        popup("Request Canceled!");
    </script>
    <meta http-equiv="refresh" content="0;URL='<?php echo $user;?>'">
    <?php
}
// End: Cancel Friend Request PHP

// Begin: Friends Mural PHP
$friendsArray = "";
$countFriends = "";
$friendArray12 = "";
$selectFriendsQuery = mysqli_query($connection, "SELECT email,friend_array FROM users_data WHERE username='$username_profile'");
$friendRow = mysqli_fetch_assoc($selectFriendsQuery);
$friendArray = $friendRow['friend_array'];

if ($friendArray != "") {
    $friendArray = explode(",", $friendArray);
    $countFriends = count($friendArray);
    $friendArray12 = array_slice($friendArray, 0, 8);
} else {

}
// End: Friends Mural PHP
?>
        <div class="container text-center">
            <div class="row">
<!--------------------------------------------------------------------------------------------------------------->              
            <!--Begin: Rigth Body-->
                <div class="col-sm-3 well">
<!--------------------------------------------------------------------------------------------------------------->
                    <!--Begin: Profile Pic-->
                    <div class="well">
                        <p><a href="<?php echo $username_profile; ?>"><?php echo $username_profile; ?></a></p>
                        <img src="<?php echo $profile_pic_profile; ?>" class="img-circle" height="300" width="200" alt="Server Error">
                        <br><br>
                        <form action="<?php echo $username_profile;?>" method="post">
                            <?php
                            if($username_profile != $user) {
                                if (in_array($email, $friendArray)) {
                                    ?>
                                    <input type="submit" name="remove" id="remove" class="btn btn-sm btn-success" value="Remove" >
                                    <?php
                                } else {
                                    $friendRequests = mysqli_query($connection, "SELECT * FROM friend_requests WHERE user_to='$username_profile'&&user_from='$user'");
                                    $numrows = mysqli_num_rows($friendRequests);
                                    if ($numrows == 0) {
                                        ?>
                                        <input type="submit" name="add" id="add" class="btn btn-sm btn-success" value="+Add" >
                                        <?php
                                    } else {
                                        ?>
                                        <p class="text-success">Cancel Request:</p>
                                        <input type="submit" name="cancel" id="cancel" class="btn btn-sm btn-success" value="Cancel" >
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </form>
                    </div>
                    <!--End: Profile Pic-->      
<!--------------------------------------------------------------------------------------------------------------->                    
                    <!--Begin: Sports-->    
                    <div class="well">
                        <p><a href="#">Sports</a></p>
                        <?php 
                        $i = 0;
                        foreach($sportsVector as $key => $value){
                            if($sportsVector[$i] != ""){
                                ?>
                                <p><span class="label label-success">
                                <?php
                                    echo $sportsVector[$i];
                                ?>
                                </span></p>
                                <?php
                            }
                            $i++;
                        }    
                        ?>
                    </div>
                    <!--End: Sports-->    
<!--------------------------------------------------------------------------------------------------------------->                    
                    <!-- Begin: Friends Mural -->
                    <div class="well">
                        <p><a href="friend_requests.php">Friends</a></p>
                    <?php
                    if($countFriends != 0){
                        $array_friendUsername = array_fill(0, 8, "");
                        $array_friendProfilePic = array_fill(0, 8, "");
                        $i = 0;
                        foreach($friendArray12 as $key => $value){
                            $getFriendQuery = mysqli_query($connection, "SELECT * FROM users_data WHERE email='$value' LIMIT 1");
                            $getFriendRow = mysqli_fetch_assoc($getFriendQuery);
                            $array_friendUsername[$i] = $getFriendRow['username'];
                            if($getFriendRow['profile_pic'] == ""){
                                $array_friendProfilePic[$i] = "img/default_pic.jpg";
                            }else{
                                $array_friendProfilePic[$i] = $getFriendRow['profile_pic'];
                            }
                            $i++;
                        }
                    ?>
                        <div class="row hidden-sm hidden-xs">
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[0]) && ($array_friendProfilePic[0])){
                                ?>
                                <a href="<?php echo $array_friendUsername[0]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[0];?>">
                                  <img src="<?php echo $array_friendProfilePic[0]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[1]) && ($array_friendProfilePic[1])){
                                ?>
                                <a href="<?php echo $array_friendUsername[1]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[1];?>">
                                  <img src="<?php echo $array_friendProfilePic[1]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[2]) && ($array_friendProfilePic[2])){
                                ?>
                                <a href="<?php echo $array_friendUsername[2]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[2];?>">
                                  <img src="<?php echo $array_friendProfilePic[2]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row hidden-sm hidden-xs">
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[3]) && ($array_friendProfilePic[3])){
                                ?>
                                <a href="<?php echo $array_friendUsername[3]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[3];?>">
                                  <img src="<?php echo $array_friendProfilePic[3]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[4]) && ($array_friendProfilePic[4])){
                                ?>
                                <a href="<?php echo $array_friendUsername[4]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[4];?>">
                                  <img src="<?php echo $array_friendProfilePic[4]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[5]) && ($array_friendProfilePic[5])){
                                ?>
                                <a href="<?php echo $array_friendUsername[5]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[5];?>">
                                  <img src="<?php echo $array_friendProfilePic[5]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row hidden-sm hidden-xs">
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[6]) && ($array_friendProfilePic[6])){
                                ?>
                                <a href="<?php echo $array_friendUsername[6]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[6];?>">
                                  <img src="<?php echo $array_friendProfilePic[6]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                if(($array_friendUsername[7]) && ($array_friendProfilePic[7])){
                                ?>
                                <a href="<?php echo $array_friendUsername[7]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[7];?>">
                                  <img src="<?php echo $array_friendProfilePic[7]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                if(isset($array_friendUsername[8]) && isset($array_friendProfilePic[8])){
                                ?>
                                <a href="<?php echo $array_friendUsername[8]; ?>" data-toggle="tooltip" title="<?php echo $array_friendUsername[8];?>">
                                  <img src="<?php echo $array_friendProfilePic[8]; ?>" class="img-responsive" style="height:60px; width: 60px;">
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<p>Find friends with the search engine!</p>";
                    }
                    ?>
                    </div>
                    <!-- End: Friends Mural -->
<!--------------------------------------------------------------------------------------------------------------->                    
                </div>
                <!--End: Rigth Body-->
<!--------------------------------------------------------------------------------------------------------------->
                <!--Begin: Center Body-->
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default text-left">
                                <div class="panel-body">
                                    <p contenteditable="true">Status: Feeling Blue</p>
                                    <button type="button" class="btn btn-default btn-sm">
                                      <span class="glyphicon glyphicon-thumbs-up"></span> Like
                                    </button>     
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="well">
                                <p>John</p>
                                <img src="" class="img-circle" height="55" width="55" alt="Avatar">
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="well">
                                <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="well">
                                <p>Bo</p>
                                <img src="" class="img-circle" height="55" width="55" alt="Avatar">
                            </div>
                        </div>    
                        <div class="col-sm-9">
                            <div class="well">
                                <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End: Center Body-->

                <!--Begin: Left Body-->
                <div class="col-sm-2 well">
                    <div class="thumbnail">
                        <p>Upcoming Events:</p>
                        <img src="" alt="Paris" width="400" height="300">
                        <p><strong>Paris</strong></p>
                        <p>Fri. 27 November 2015</p>
                        <button class="btn btn-primary">Info</button>
                    </div>      
                    <div class="well">
                      <p>ADS</p>
                    </div>
                    <div class="well">
                        <p>ADS</p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>Footer Text</p>
        </footer>

    </body>
</html>
<!--Begin of the profile body-->  

