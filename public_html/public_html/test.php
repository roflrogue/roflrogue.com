<?php
session_start();
require_once('../class.user.php');
$user = new USER();
/*
if($user->is_logged_in()){
    echo 'user is logged in <br  />';
}
if(!$user->is_logged_in()){
    echo 'user is not logged in <br  />';
}
$email = 'admin@roflrogue.com';
$pass = 'Aaron12345';
$user->login($email,$pass);
if($user->is_logged_in()){
    echo 'user is now logged in <br  />';
}
if(!$user->is_logged_in()){
    echo 'user did not log in <br  />';
}
if($user->logout()){
    echo 'user logged out';
}
if(isset($_POST['btn-login'])){
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);
    if($user->login($email,$upass)){
        echo $_SESSION['isIn'];
    }
}
*/

var_dump($_SESSION);
?>
<form method="post" action="test.php" class="nav-login">
                    <input type="email" placeholder="Email Address" name="txtemail" required />
                    <input type="password" placeholder="Password" name="txtupass" required />
                    <button type="submit" name="btn-login">Sign in</button>
                    <a href="signup.php">Sign Up</a>
                    <a href="forgot.php">Lost your Password?</a> 
            </form>