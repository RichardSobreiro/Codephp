<?php 
include ("inc/header.php");

// Find Friend Requests
$friendRequests = mysqli_query($connection, "SELECT * FROM friend_requests WHERE user_to='$user'");
$numrows = mysqli_num_rows($friendRequests);
if ($numrows == 0) {
?>
<div class="col-sm-3">
</div>

<div class="col-sm-6 text-center">
    <div class="row">
        <div class = "alert alert-success alert-dismissable">
            <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">
               &times;
            </button>
            <div class = "alert alert-success">
                <p><?php echo $user; ?></p>
                <img src="img/default_pic.jpg" class="img-circle" height="55" width="55" alt="Error">
            </div>
            <p>At the moment you do not have any friend request!</p>
        </div>
    </div>
    <!--div class="row">
        <div class="col-sm-3">
            <div class="well">
                <p><?php echo $user; ?></p>
                <img src="img/default_pic.jpg" class="img-circle" height="55" width="55" alt="Error">
            </div>
        </div>
        <div class="col-sm-9">
            <div class="well">
                <p>At the moment you do not have any friend request!</p>
            </div>
        </div>
    </div-->
</div>
<div class="col-sm-3">
</div>
<?php
    $user_from = "";
}
else {
    while ($get_row = mysql_fetch_assoc($friendRequests)) {
    $id = $get_row['id']; 
    $user_to = $get_row['user_to'];
    $user_from = $get_row['user_from'];
  
    echo '' . $user_from . ' wants to be friends'.'<br />';

    if (isset($_POST['acceptrequest'.$user_from])) {
        //Get friend array for logged in user
        $get_friend_check = mysql_query("SELECT friend_array FROM users WHERE username='$user'");
        $get_friend_row = mysql_fetch_assoc($get_friend_check);
        $friend_array = $get_friend_row['friend_array'];
        $friendArray_explode = explode(",",$friend_array);
        $friendArray_count = count($friendArray_explode);

        //Get friend array for person who sent request
        $get_friend_check_friend = mysql_query("SELECT friend_array FROM users WHERE username='$user_from'");
        $get_friend_row_friend = mysql_fetch_assoc($get_friend_check_friend);
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
         $add_friend_query = mysql_query("UPDATE users SET friend_array=CONCAT(friend_array,'$user_from') WHERE username='$user'");
        }
        if ($friendArray_count_friend == NULL) {
         $add_friend_query = mysql_query("UPDATE users SET friend_array=CONCAT(friend_array,'$user_to') WHERE username='$user_from'");
        }
        if ($friendArray_count >= 1) {
         $add_friend_query = mysql_query("UPDATE users SET friend_array=CONCAT(friend_array,',$user_from') WHERE username='$user'");
        }
        if ($friendArray_count_friend >= 1) {
         $add_friend_query = mysql_query("UPDATE users SET friend_array=CONCAT(friend_array,',$user_to') WHERE username='$user_from'");
        }
        $delete_request = mysql_query("DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'");
        echo "You are now friends!";
        header("Location: friend_requests.php");
    }
    if (isset($_POST['ignorerequest'.$user_from])) {
    $ignore_request = mysql_query("DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'");
      echo "Request Ignored!";
      header("Location: friend_requests.php");
    }
?>
<form action="friend_requests.php" method="POST">
<input type="submit" name="acceptrequest<? echo $user_from; ?>" value="Accept Request">
<input type="submit" name="ignorerequest<? echo $user_from; ?>" value="Ignore Request">
</form>
<?php
    }
}
?>