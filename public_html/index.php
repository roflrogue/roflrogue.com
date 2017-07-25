<?php
session_start();
require_once '../class.user.php';
$user = new USER();
if($user->is_logged_in()!=""){
    $user->redirect('home.php');
}
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
            <section>
                <header class="page-header">
                    <h1>Welcome to Roflrogues Den</h1>
                    <span>A site I built to display my skill!</span>
                </header>
                <strong><?php echo $_SESSION['msg'];$_SESSION['msg']='';?></strong>
                <strong><?php echo $_SESSION['errorMsg'];$_SESSION['errorMsg']='';?></strong>
                <div class="slide-box" id="slide-box">
                    <ul class="slides">
                        <li class="slide">
                            <h2>A shiny new toy</h2>
                            <article>
                                <p>Click here to see a new video about the shiny new features included in CSS4. CSS variables, new selectors, and a whole lot more</p>
                                <a href="https://www.youtube.com/watch?v=yDD8MN8nDT4">
                                    <img src="https://img.youtube.com/vi/yDD8MN8nDT4/2.jpg" />
                                </a>
                            </article>
                            <p class="slide-p">Or you can click <a href="http://css4-selectors.com/selectors/">here</a> to see a guide on upcoming features in CSS.</p>
                        </li>
                        <li class="slide">
                            <h2>How I learned Flexbox</h2>
                            <article>
                                <p>This is the video that exposed me to flexbox, if it’s something that you're interested in learning DevTips does a great job at explaining the topic.</p>
                                <a href="https://www.youtube.com/watch?v=G7EIAgfkhmg&t">
                                    <img src="https://img.youtube.com/vi/G7EIAgfkhmg/1.jpg" />
                                </a>
                            </article>
                            <p class="slide-p">Alternatively you can click <a href="https://css-tricks.com/snippets/css/a-guide-to-flexbox/">here</a> to see a great guide written by Chris Coyier on the subject.</p>
                        </li>
                        <li class="slide">
                            <h2>What is Web Assembly?</h2>
                            <article>
                                <p>This speaker breaks down web assembly, taking your through the weeds and explaining what it is and why it may be the next big thing in web development.</p>
                                <a href="https://www.youtube.com/watch?v=kq2HBddiyh0">
                                    <img src="https://img.youtube.com/vi/kq2HBddiyh0/1.jpg" />
                                </a>
                            </article>
                            <p class="slide-p">Just think of it, a compiled web where everything runs much faster without the need for plugins.</p>
                        </li>
                        <li class="slide">
                            <h2>Linux System Administrator</h2>
                            <article>
                                <p>A great series of videos that helped me pick up a few tricks.These videos have made me a more proficient user and administrator.</p>
                                <a href="https://www.youtube.com/watch?v=bju_FdCo42w&list=PLtK75qxsQaMLZSo7KL-PmiRarU7hrpnwK">
                                    <img src="https://img.youtube.com/vi/bju_FdCo42w/1.jpg" />
                                </a>
                            </article>
                            <p>I picked up a few useful tricks watching this series.</p>
                        </li>
                    </ul>
                    <div class="slide-btns">
                        <span class="material-icons pre">keyboard_arrow_left</span>
                        <span class="material-icons next">keyboard_arrow_right</span>
                    </div>
                </div>
            </section>
            <section class="about">
                <article class="section-article">
                    <header class="article-header">
                        <h2>What is this place?</h2>
                    </header>
                    <h3>About Roflrogue</h3>
                    <p>Welcome to my testing ground, this is where I practice new techniques, refine old ones, and experiment with new technologies. That being said, if you encounter any problems, or have any constructive criticism send me an email at <a href="mailto:aaron@hairston.ninja">aaron@hairston.ninja</a>. Alternatively click on the thumb in the top left hand corner of the web page.</p>
                    <h3>Where did the name come from?</h3>    
                    <p>Roflrogue has been my username for many different websites for a number of years, when I realized that the domain was available I bought it and have held onto it since. </p>
                </article>
                <article class="section-article">
                    <header class="article-header">
                        <h2>Need a Web Developer?</h2>
                    </header>
                    <h3>Check out my resume</h3>
                    <p>Be sure to check out my resume, I have a wide variety of skills in both information technology and web development. I have nearly 3 years experience as an independent web developer, as well as experience in dealing with the configuration of linux web servers. Click <a href="hairston.ninja/aaron.html">here</a> to see the rest of my skills and experience. </p>
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
                    <li><a href="#">Green Horizons Lawn Service</a></li>
                </ul>
            </section>
        </footer>
    </body>
</html>

