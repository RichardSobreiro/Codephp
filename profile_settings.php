<?php
include "./inc/header.php";

// Begin: Profile Pic Upload //
// Check whether the user has uploaded a profile pic or not
$check_pic = mysqli_query($connection, "SELECT profile_pic FROM users_data WHERE username='$user'");
$get_pic_row = mysqli_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['profile_pic'];
if($profile_pic_db == ""){
    $profile_pic = "img/default_pic.jpg";
} else {
    $profile_pic = "userdata/profile_pics/".$profile_pic_db;
}
// End: Profile Pic Upload //
?>
<body>
    
</body>