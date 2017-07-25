<?php
session_start();
require_once '../class.user.php';
$user = new USER();
if($user->is_logged_in()!=true){
    $user->redirect('index.php');
}
if(isset($_POST['create-blog'])){
    if(ctype_alnum($_POST['txturl'])){
        $url = strtolower(trim($_POST['txturl']));
        $stmt = $user->runQuery("SELECT * FROM users WHERE url=:url");
        $stmt->bindparam(":url",$url);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            $msg = 'Sorry, That URL is already in use.';
        }else{
            if($user->registerBlog($url)){
                $user->redirect('home.php');
            }
        }
    } else {
        $msg = 'Sorry, but your url can only contain numbers and letters.';
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
                <li><a href="blog/<?php echo $_SESSION['blogURL'];?>">Blog</a></li>
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
            <?php if($_SESSION['blogURL']==''){ ?>
            <section>
                <h2>Enter a name for your blog</h2>
                <span>You can then get there by typing HTTPS://roflrogue.com/blog/yourBlogNameHere</span>
                <span>Alternativly once logged in you can simply open the navigation menu you click on the blog link</span>
                <form method="post" id="create-blog">
                    <input type="text" placeholder="Your URL" name="txturl" required />
                    <button type="submit" name="create-blog">Create Blog</button>
                </form>
                <span><?php echo $msg;?></span>
            </section>
            <?php } ?>
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

