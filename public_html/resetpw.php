<?php
session_start();
require_once '../class.user.php';
require_once '../getSalt.php';
$user = new USER();
if(empty($_GET['id']) && empty($_GET['code'])){
    $user->redirect('index.php');
}
if(isset($_GET['id']) && isset($_GET['code'])){
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];
    $stmt = $user->runQuery("SELECT * FROM users WHERE userID=:uid AND token=:token");
    $stmt->execute(array(":uid"=>$id,":token"=>$code));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() == 1){
        if(isset($_POST['reset-pass'])){
            $pass = $_POST['pass'];
            $cpass = $_POST['conf-pass'];
            if($pass == $cpass){//if pw1&2 dont match echo error
                if(preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $pass)){
                    $pw = $_POST['pass'];
                    $options = [
                        'cost' => 11,
                        'salt' => mkSalt()
                    ];
                    $password = password_hash($pw, PASSWORD_BCRYPT, $options);
                    $stmt = $user->runQuery("UPDATE users SET pass=:password WHERE userID=:uid");
                    $stmt->execute(array(":password"=>$password, ":uid"=>$row['userID']));
                    $msg = "Password Changed";
                    header("refresh:5;index.php");
                }else{
                    $msg = 'Sorry but the password you entered does not meet complexity standards';
                }
                
            }else{
                $data_invalid[] = 'Sorry but the passwords you entered do not match'; 
            }
        }
    }else{
        exit;
    }
}
?>








<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- If IE use the latest rendering engine -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Set the page to the width of the device and set the zoon level -->
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>Welcome To Roflrogues' Den</title>
        <link rel='stylesheet' type='text/css' href='stylesheets/style.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/slider.js"></script>
        <script src="js/bubbles.js"></script>
    </head>
    <body>
        <nav class="nav-box">
            <input type="checkbox" id="toggle-menu" class="hide"/>
            <label for="toggle-menu" class="menu-toggle"><span class="menu-btn"></span></label>
            <div class="menu-bg"></div>
            <input type="checkbox" id="toggle-login" class="hide"/>
            <input type="checkbox" id="find-me-toggle" class="hide"/>
            <div class="find-me-bg"></div>
            <label class="toggle-find-me" for="find-me-toggle"></label>
            <ul class="center">
                <li id="fb"><a href="https://www.facebook.com/aaron.hairston.311"></a></li>
                <li id="in"><a href="https://www.linkedin.com/in/aaron-hairston-297270107/"></a></li>
                <li id="gh"><a href="https://github.com/roflrogue"></a></li>
                <li id="cp"><a href="https://codepen.io/Roflrogue/#"></a></li>
                <li id="res"><a href="#"></a></li>
                <li id="google"><a href="#"></a></li>
            </ul>
            <ul class="nav-bar">
                <li><a href="index.php">Home</a></li>
                <li><a href="resources.php">Resources</a></li>
                <li><a href="mail/index.php">Mail</a></li>
                <li><a href="blog/">Blog</a></li>
                <?php
                    if($user->is_logged_in()==""){
                ?>
                <li><label for="toggle-login"></label></li>
                <?php }else{ ?>
                <li><a href="../logout.php">Log Out</a></li>
                <?php } ?>
            </ul>
            <form method="post" action="index.php" class="nav-login">
                    <input type="email" placeholder="Email Address" name="txtemail" required />
                    <input type="password" placeholder="Password" name="txtpass" required />
                    <button type="submit" name="btn-login">Sign in</button>
                    <a href="signup.php">Sign Up</a>
                    <a href="forgot.php">Lost your Password?</a> 
            </form>
        </nav>
        <main>
            <canvas id="header-canvas"></canvas>
            <form method="post" class="post-resource">
                <h3>Password Reset.</h3>
                <span>Type in your new password below</span>
                <?php
                    if(isset($msg)){echo $msg;}
                ?>
                <input type="password" placeholder="New Password" name="pass" required />
                <input type="password" placeholder="Confirm New Password" name="conf-pass" required />
                <button type="submit" name="reset-pass">Reset Your Password</button>
            </form>
        </main>
        <footer>
            <header><h2>Thanks for visiting</h2></header>
            <section>
                <h3>What did you think?</h3>
                <article><p>I’m very receptive of constructive criticism, and would love to here what you have to say. Thanks for taking the time to visit me, I have lot planned for the future and hope you come back soon.</p></article>
            </section>
            <section>
                <h3>Check out my other work</h3>
                <ul>
                    <li><a href="#">Safe Shot Academy</a></li>
                    <li><a href="#">Ken Godwin Studio</a></li>
                    <li><a href="#">Green Horizons Lawn Service</a></li>
                </ul>
            </section>
        </footer>
    </body>
</html>