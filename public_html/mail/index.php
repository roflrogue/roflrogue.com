<?php
    session_start();
    require_once '../../class.user.php';
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
        <link rel='stylesheet' type='text/css' href='../stylesheets/style.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="../js/bubbles.js"></script>
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
                <li><a href="../index.php">Home</a></li>
                <li><a href="../resources.php">Resources</a></li>
                <li><a href="index.php">Mail</a></li>
                <li><a href="../blog/<?php echo $_SESSION['blogURL'];?>">Blog</a></li>
                <?php
                    if($user->is_logged_in()==""){
                ?>
                <li><label for="toggle-login"></label></li>
                <?php }else{ ?>
                <li><a href="../../logout.php">Log Out</a></li>
                <?php } ?>
            </ul>
            <form method="post" action="index.php" class="nav-login">
                    <input type="email" placeholder="Email Address" name="txtemail" required />
                    <input type="password" placeholder="Password" name="txtpass" required />
                    <button type="submit" name="btn-login">Sign in</button>
                    <a href="../signup.php">Sign Up</a>
                    <a href="../forgot.php">Lost your Password?</a> 
            </form>
        </nav>
        <main>
            <canvas id="header-canvas"></canvas>   
            <section>
                <header class="page-header">
                    <h1>Roflrogue Mail</h1>
                    <span>This project is still in development. Messages are not yet decoded into human readable formats</span>	
                </header>
            </section>
            <section>
            <?php if(empty($_POST['imap-login'])){?>
                <form method="post" action="index.php" class="post-resource">
                    <?php 
                    echo $errorMsg;
                    echo $msg;
                    ?>
                    <h2>IMAP login</h2>
                    <input type="email" placeholder="Email" name="txtemail" required />
                    <input type="password" placeholder="Password" name="txtpw" required />
                    <button type="submit" name="imap-login">Sign Up</button>
                </form>
            <?php } ?>
            </section>
            <section>
            <?php
            if(isset($_POST['imap-login'])){
                $path = '{imap.gmail.com:993/imap/ssl}';
                $user = $_POST['txtemail'];
                $pw = $_POST['txtpw'];
                $imap = imap_open($path,$user,$pw);
                
                $folders = imap_list($imap, '{imap.gmail.com:993/imap/sslvalidate-cert}', '*');
                $numFolders = count($folders);
                for($i = 0; $i < $numFolders; $i++){
                    echo $folders[$i].'<br  />';
                }
                
                $numMsgs = imap_num_msg($imap);
                
                for($i = $numMsgs; $i > ($numMsgs - 25); $i--){

                    $header = imap_header($imap, $i);
                    $bodyStr = imap_fetchbody($imap, $i,1);
                    $sub = $header -> subject;
                    $fromAdr = $header -> from[0] -> mailbox . "@" . $header -> from[0] -> host;
                    $from = $header -> from[0]->personal;
                    $replyTo = $header->reply_toaddress;
                    $udate = $header->udate;
                    $date = date('D j M Y', $udate);

                    echo "<p><strong>From: </strong>" . $fromAdr . " (" . $from . ")" . "</p>";
                    echo "<p><strong>Subject: </strong>" . $sub . "</p>";
                    echo "<p><strong>Sent: </strong>" . $date . "</p>";


                    echo $bodyStr."<br/>";

                    $structure = imap_fetchstructure($imap,$i);
                    echo "Type: ".$structure->type . "<br  />";
                    echo "Encoding: " . $structure->encoding . "<br />";
                    echo "ifsubtype: " . $structure->ifsubtype . "<br />";
                    echo "subtype: " . $structure->subtype . "<br />";
                    echo "ifdescription: " . $structure->ifdescription . "<br />";
                    echo "description: " . $structure->description . "<br />";
                    echo "ifid: " . $structure->ifid . "<br />";
                    echo "id: " . $structure->id . "<br />";
                    echo "lines: " . $structure->lines . "<br />";
                    echo "bytes: " . $structure->bytes . "<br />";
                    echo "ifdisposition: " . $structure->ifdisposition . "<br />";
                    echo "disposition: " . $structure->disposition . "<br />";
                    echo "ifdparameters: " . $structure->ifdparameters . "<br />";
                    echo "dparameters: " . $structure->dparameters . "<br />";
                    echo "ifparameters: " . $structure->ifparameters . "<br />";
                    echo "parameters: " . var_dump($structure->parameters) . "<br />";
                    if(!$structure->parts){
                        echo 'This is a simple message and has no parts.'
                    }
                    echo "parts: " . $structure->parts . "<br />";
                    echo "<hr  />";
                }
                
            }    
            ?>
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
<?php imap_close($imap);?>