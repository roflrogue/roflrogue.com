
<?php
    session_start();
    require_once '../class.user.php';
    $reg_user = new USER();
    if($reg_user->is_logged_in()!=""){
        $reg_user->redirect('home.php');
    }
    if(isset($_POST['form_signup'])){
        $data_missing = array();
        $data_invalid = array();
        //First Name////////////////////////////////////////////////////////////
        if(empty($_POST['form_fname'])){//if empty add to data missing array
            $data_missing[] = 'First Name';
        } else {
            if(ctype_alpha($_POST['form_fname'])){//if contains invalid chars echo error
                $f_name = strtolower(trim($_POST['form_fname'])); 
            } else {
                $data_invalid[] = 'Your first name contains invalid characters';
            }
        }
        //Last Name///////////////////////////////////////////////////////////////
        if(empty($_POST['form_lname'])){//if empty add to data missing array
            $data_missing[] = 'Last Name';  
        } else {
            if(ctype_alpha($_POST['form_lname'])){//if contains invalid chars echo error
                $l_name = strtolower(trim($_POST['form_lname']));
            } else {
                $data_invalid[] = 'Your last name contains invalid characters';
            }
        }
        //User Name///////////////////////////////////////////////////////////////////
        if(empty($_POST['form_uname'])){//if empty add to data missing array
            $data_missing[] = 'User Name';
        } else {
            if(ctype_alnum($_POST['form_uname'])){//if contains invalid chars echo error
                $u_name = strtolower(trim($_POST['form_uname']));
            } else {
                $data_invalid[] = 'Your user name may only contain alphanumeric characters';
            } 
        }
        //Email///////////////////////////////////////////////////////////////////////////
        if(empty($_POST['form_email'])){//if empty add to data missing array
            $data_missing[] = 'Email';
        } else {
	        if(filter_var($_POST['form_email'], FILTER_VALIDATE_EMAIL)){//if invalid email echo error
                $email = strtolower(trim($_POST['form_email']));
	        } else {
                $data_invalid[] = 'The email address you entered is invalid';
	        }
        }
        //Password//////////////////////////////////////////////////////////////////////////
        if(empty($_POST['form_pw1'])){//if empty add to data missing array
            $data_missing[] = 'Password';
        } else {
            $pw1 = $_POST['form_pw1'];
            $pw2 = $_POST['form_pw2'];
            if($pw1 == $pw2){//if pw1&2 dont match echo error
                if(preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $pw1)){
                    $pw = $_POST['form_pw1'];                        
                } else{
                    $data_invalid[] = 'The password you entered does not meet complexity standards';
                }
            } else {
                $data_invalid[] = 'The passwords you entered do not match'; 
            }
        }
        //Generate token////////////////////////////////////////////////////////
        $code = md5(uniqid(rand()));
        ////////////////////////////////////////////////////////////////////////
        if(empty($data_missing) && empty($data_invalid)){
            $stmt = $reg_user->runQuery("SELECT * FROM users WHERE email=:email OR uname=:u_name");
            $stmt->execute(array(":email"=>$email,":u_name"=>$u_name));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
                $errorMsg = 'That user name or email is already in use';
            }else{
                if($reg_user->register($f_name, $l_name, $u_name, $email, $pw, $code)){
                    $id = $reg_user->lasdID();
                    $key = base64_encode($id);
                    $id = $key;
                    $message = "Hello $uname,<br /><br />Welcome to Rolfrogues Den!<br/>To complete your registration please, click following link<br/><br /><br /><a href='http://roflrogue.com/verify.php?id=$id&code=$code'>Click HERE to Activate</a><br /><br />Thanks,";
                    $subject = "Confirm Registration";
                    $reg_user->sendMail($email,$message,$subject); 
                    $msg = "We've sent an email to $email. Please click on the confirmation link in the email to create your account.";
                }else{
                    $errorMsg = "sorry , query could not be executed...";
                }
            }
        }else{
            if(!empty($data_missing)){
                $errorMsg = 'The following data is needed to register: <br  />';
                foreach($data_missing as $missing){
                    $errorMsg .=  $missing . '<br  />';
                }
            }else{
                $errorMsg = 'The following inputs are invalid:  <br  />';
                foreach($data_invalid as $invalid){
                    $errorMsg .= $invalid . '<br  />';
                }
            }
        }
    }
?>

<?php
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
            <form method="post" action="signup.php" class="post-resource">
                <?php 
                echo $errorMsg;
                echo $msg;
                ?>
                <h2>Sign Up</h2>
                <input type="text" placeholder="First Name" name="form_fname" required />
                <input type="text" placeholder="Last Name" name="form_lname" required />
                <input type="text" placeholder="User Name" name="form_uname" required />
                <input type="email" placeholder="Email" name="form_email" required />
                <input type="password" placeholder="Password" name="form_pw1" required />
                <input type="password" placeholder="Retype Password" name="form_pw2" required />
                <button type="submit" name="form_signup">Sign Up</button>
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