<?php
session_start();
require_once '../class.user.php';
$user = new USER();
if(isset($_POST['btn-login'])){
    $email = $_POST['txtemail'];
    $pass = $_POST['txtpass'];
    if($user->login($email,$pass)){
        
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
                <li><label for="toggle-login"></label></li>
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
                <article class="page-header">
                    <h1>Welcome to Roflrogues Den</h1>
                    <span>A site I built to display my skill!</span>	
                </article>
                <div class="slide-box" id="slide-box">
                    <ul class="slides">
                        <li class="slide">
                            <h2>Something New</h2>
                            <article>
                                <p>Click here to see a new video about the shiny new features included in CSS4. CSS variables, new selectors, and a whole lot more</p>
                                <a href="https://www.youtube.com/watch?v=yDD8MN8nDT4">
                                    <img src="https://img.youtube.com/vi/yDD8MN8nDT4/2.jpg" />
                                </a>
                            </article>
                        </li>
                        <li class="slide">
                            <h2>Something Old</h2>
                            <article>
                                <p>This is the video that exposed me to flexbox, if it’s something that you're interested in learning DevTips does a great job at explaining the topic.</p>
                                <a href="https://www.youtube.com/watch?v=G7EIAgfkhmg&t">
                                    <img src="https://img.youtube.com/vi/G7EIAgfkhmg/1.jpg" />
                                </a>
                                <p>Alternatively you can click <a href="https://css-tricks.com/snippets/css/a-guide-to-flexbox/">here</a> to see a great guide written by Chris Coyier on the subject.</p>
                            </article>
                        </li>
                        <li class="slide">
                            <h2>Something Cool</h2>
                            <p></p>
                        </li>
                        <li class="slide">
                            <h2>Something Funny</h2>
                        </li>
                    </ul>
                    <div class="slide-btns">
                        <span class="material-icons pre">keyboard_arrow_left</span>
                        <span class="material-icons next">keyboard_arrow_right</span>
                    </div>
                </div>
            </section>
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
    </body>
</html>

