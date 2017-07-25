<?php
session_start();
require_once '../class.user.php';
$user = new USER();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- If IE use the latest rendering engine -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Set the page to the width of the device and set the zoon level -->
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>Welcome Home</title>
        <link rel='stylesheet' type='text/css' href='stylesheets/style.css'>
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
                <li id="fb"><a href="#"></a></li>
                <li id="in"><a href="#"></a></li>
                <li id="gh"><a href="#"></a></li>
                <li id="cp"><a href="#"></a></li>
                <li id="res"><a href="#"></a></li>
                <li id="google"><a href="#"></a></li>
            </ul>
            <ul class="nav-bar">
                <li><a href="index.php">Home</a></li>
                <li><a href="resources.php">Resources</a></li>
                <li><a href="mail/Rainloop">Mail</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><label for="toggle-login"></label></li>
            </ul>
            <form method="post" action="index.php" class="nav-login">
                    <input type="email" placeholder="Email Address" name="txtemail" required />
                    <input type="password" placeholder="Password" name="txtupass" required />
                    <button type="submit" name="btn-login">Sign in</button>
                    <a href="signup.php">Sign Up</a>
                    <a href="forgot.php">Lost your Password?</a> 
            </form>
        </nav>
        <main>
            <header class="page-header">
                <div class="head-box">
                    <h1><?php echo $msg;?></h1>
                    <span>A site I built just because!</span>	
                </div>
                <canvas id="header-canvas"></canvas>   
            </header>
            <section>
                <header>
                    <h2>What&#39;s Up!!</h2>
                </header>
                <article>
                    <h3>Thanks for visiting</h3>
                    <p>Thanks for visiting my page! I hope to have much more content coming soon. I am currently working on a few back end projects such as a IMAP web-mail client.</p>
                    <p>Why reinvent the wheel you say? Elementary! My dear Watson, I need to know how it works! That is exactly what this website will be, a place for me to display what I have learned.</p>
                </article>
            </section>
            <section>
                <header>
                    <h2>Need a Web Developer?</h2>
                </header>
                <article>
                    <h3>Check out my resume</h3>
                    <p>Thanks for visiting my page! I hope to have much more content coming soon. I am currently working on a few back end projects such as a IMAP web-mail client.</p>
                    <p>Why reinvent the wheel you say? Elementary! My dear Watson, I need to know how it works! That is exactly what this website will be, a place for me to display what I have learned.</p>
                </article>
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
                </ul>
            </section>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
        <script src="js/bubbles.js"></script>
    </body>
</html>

