<?php
session_start();
require_once '../class.user.php';
$user = new USER();
if(isset($_POST['btn-login'])){
    $email = $_POST['txtemail'];
    $pass = $_POST['txtpass'];
    if($user->login($email,$pass)){
        $user->redirect('home.php');
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
                <li><a href="mail/Rainloop">Mail</a></li>
                <li><a href="blog.php">Blog</a></li>
                <?php
                    if($user->is_logged_in()==""){
                ?>
                <li><label for="toggle-login"></label></li>
                <?php }else{ ?>
                <li><a href="logout.php">Log Out</a></li>
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
            <section>
                <header class="page-header">
                    <h1>Roflrogue Mail</h1>
                    <span>This project is still in development. Please check back again later.</span>	
                </header>
            </section>
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

