<?php
session_start();
if(isset($_SESSION["username"])){
  $user = $_SESSION["username"];    
  $email = $_SESSION["email"];
  $id = $_SESSION["id"];
}else{
  $user="";
}
include "./inc/mysql_connect_inc.php";

if($user){
?>
<!--Begin of the header-->
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE-edge">
      <title>User Profile</title>
<!---------------------------------------------------------------------------------------------------------------->
      <!--Tell the browser to be responsive to screen width-->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!---------------------------------------------------------------------------------------------------------->
      <!-- Ajax Scripts -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> 
      <!-- Bootstrap Scripts -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <!-- Bootstrap/TutorialsPoint Core CSS -->
      <!--link href="http://www.tutorialspoint.com/bootstrap/css/bootstrap.min.css" rel="stylesheet"-->
      <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <!---------------------------------------------------------------------------------------------------------->
      <!-- Script Popup Window -->
      <script src="js/popup_window.js" type="text/javascript"></script>
      <!---------------------------------------------------------------------------------------------------------->
      <!-- Attempt to use Bootstrap without internet -->
      <!-- Bootstrap CSS Files -->
      <!--link href="css/bootstrap.min.css" rel="stylesheet"-->
      <!-- Bootstrap Script Files -->
      <!--script src="js/bootstrap.min.js"></script-->
      <!---------------------------------------------------------------------------------------------------------->
      <!-- (OBSOLETE)Bootstrap Script Files -->
      <!--script src="fonts/bootstrap.min.js"></script-->
      <!---------------------------------------------------------------------------------------------------------->
      <!-- Attempt to use a local distribution of JQUERY -->
      <!--script src="/js/jquery.js"></script-->
      <!---------------------------------------------------------------------------------------------------------->
      <!-- Attempt to use a local and remote distribution (CDN) of BOOTSTRAP and JQUERY-->
      <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="/js/jquery.js">\x3C/script>')</script-->
      <!---------------------------------------------------------------------------------------------------------->
      <!--script type="text/javascript">
 
	$(document).ready(function(){
 
		$("body").html("jQuery is working");	
 
	});
 
       </script-->
      <!---------------------------------------------------------------------------------------------------------->

    </head>
    
    <body>
    <style>    
        .btn_search
        {
        -webkit-appearance: none;
        outline: none;
        border: 0;
        background: transparent;
        }
        /* Set black background color, white text and some padding */
        footer {
          background-color: #555;
          color: white;
          padding: 15px;
        }
    </style>
        
<nav class="navbar navbar-inverse" role="banner">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><b>Sport</b>Net</a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
<!--------------------------------------------------------------------------------------------------------------->
        
<!--------------------------------------------------------------------------------------------------------------->                
        <li>
          <a href="" class="dropdown-toggle" id = "dropdownMenu1" data-toggle = "dropdown">
            <span class="glyphicon glyphicon-envelope"></span> 
            Messages
            <span class="label label-success">0</span>
          </a>
          <ul class = "dropdown-menu" role = "menu" aria-labelledby = "dropdownMenu1">
            <li role = "presentation" class = "dropdown-header">Messages</li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "messages.php">Some Message</a>
            </li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">Some Message</a>
            </li>
            <li role = "presentation" class = "divider"></li>
            <li role = "presentation" class = "dropdown-header">Messages Page</li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">All Messages</a>
            </li>
          </ul>
        </li>
<!--------------------------------------------------------------------------------------------------------------->                
        <li>
          <a href="#" class="dropdown-toggle" id = "dropdownMenu1" data-toggle = "dropdown">
            <span class="glyphicon glyphicon-king"></span> 
            Manager
            <span class="label label-success">4</span>
          </a>
          <ul class = "dropdown-menu" role = "menu" aria-labelledby = "dropdownMenu1">
            <li role = "presentation" class = "dropdown-header">Messages</li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">Some Message</a>
            </li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">Some Message</a>
            </li>
            <li role = "presentation" class = "divider"></li>
            <li role = "presentation" class = "dropdown-header">Messages Page</li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">All Messages</a>
            </li>
          </ul>
        </li>
<!--------------------------------------------------------------------------------------------------------------->        
        <li>
          <a href="#" class="dropdown-toggle" id = "dropdownMenu1" data-toggle = "dropdown">
            <span class="glyphicon glyphicon-bell"></span> 
            Events
            <span class="label label-success">4</span>
          </a>
          <ul class = "dropdown-menu" role = "menu" aria-labelledby = "dropdownMenu1">
            <li role = "presentation" class = "dropdown-header">Messages</li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">Some Message</a>
            </li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">Some Message</a>
            </li>
            <li role = "presentation" class = "divider"></li>
            <li role = "presentation" class = "dropdown-header">Messages Page</li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "#">All Messages</a>
            </li>
          </ul>
        </li>
<!--------------------------------------------------------------------------------------------------------------->                
        <li>
          <a href="friend_requests.php" id = "friend_requests">
            <span class=""></span> 
            +Friends
          </a>
        </li>
<!--------------------------------------------------------------------------------------------------------------->                
        <li>
          <a href="#" class="dropdown-toggle" id = "dropdownMenu1" data-toggle = "dropdown">
            <span class="glyphicon glyphicon-home"></span> 
            Account
          </a>
          <ul class = "dropdown-menu" role = "menu" aria-labelledby = "dropdownMenu1">
            <li role = "presentation" class = "divider"></li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "settings.php">Settings</a>
            </li>
            <li role = "presentation" class = "divider"></li>
            <li role = "presentation" >
                <a role = "menuitem" tabindex = "-1" href = "logout.php">Logout</a>
            </li>
            <li role = "presentation" class = "divider"></li>
          </ul>
        </li>
<!--------------------------------------------------------------------------------------------------------------->                
        </ul>
<!--------------------------------------------------------------------------------------------------------------->                
        <ul class="nav navbar-nav pull-right">
            <li class="active pull-right">
                <a href="<?php echo $user;?>">
                    <span class="glyphicon glyphicon-user"></span>
                    <?php echo $user;?>
                </a>
            </li>
        
<!--------------------------------------------------------------------------------------------------------------->
        
            <li class="pull-right">
              <form action="search.php" method="post" class="navbar-form" name="search_form">  
                <div class="form-group" style="display:inline;">
                    <div class="input-group">
                        <!--<span class="input-group-addon">
                            <a href="#" class="dropdown-toggle" id = "dropdownMenu1" data-toggle = "dropdown">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </a>
                            <ul class = "dropdown-menu text-center">
                                <li role = "presentation" class = "divider"></li>
                                <li>    
                                    &nbsp;&nbsp;
                                    <div class="checkbox">
                                      <label><input type="checkbox" name="search_friends" id="search_friends" value="1" checked="">  Friends</label>
                                    </div>
                                </li>
                                <li role = "presentation" class = "divider"></li>
                                <li>    
                                    &nbsp;&nbsp;
                                    <div class="checkbox">
                                      <label><input type="checkbox" name="search_teams" id="search_teams" value="2">  Teams</label>
                                    </div>
                                </li>
                                <li role = "presentation" class = "divider"></li>
                            </ul>
                        </span>-->
                        <input type="text" name="search" id="search" class="form-control" placeholder="What are searching for?">
                        <span class="input-group-addon">
                          <button type="submit" name="search_button" class="btn_search">
                                <span class="glyphicon glyphicon-search">
                                </span>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
            </li>
        </ul>
<!--------------------------------------------------------------------------------------------------------------->                
    </div>
  </div>
</nav>
<!--End of the header-->  
<?php
} else {
    header("location: index.php");
}
