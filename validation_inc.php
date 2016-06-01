<?php
function check_email_address($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }else{
        return true;
    }
}

function check_username($username){
    // accepted username length between 5 and 25
    if (preg_match('/^[a-zA-Z\s]+$/', $username)){
        if((strlen($username) < 26)||(strlen($username) > 1)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function check_password($password){
    // accepted password length between 5 and 20, start with character.
    if (preg_match("/^[0-9a-zA-Z_!$@#^&]{5,16}$/", $password)){
        return true;
    }
    else{
        return false;
    }
}
