<?php
session_start();
require_once '../class.user.php';
$user = new USER();
if($user->is_logged_in()!=""){
    $user->redirect('home.php');
}
if(isset($_POST['btn-submit'])){
    $email = $_POST['txtemail'];
    $stmt = $user->runQuery("SELECT userID FROM users WHERE email=:email LIMIT 1");
    $stmt->execute(array(":email"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    if($stmt->rowCount() == 1){
        $id = base64_encode($row['userID']);
        $code = md5(uniqid(rand()));
        $stmt = $user->runQuery("UPDATE users SET token=:token WHERE email=:email");
        $stmt->execute(array(":token"=>$code,"email"=>$email));
        $message= "Hello , $email<br /><br />We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,<br /><br />Click Following Link To Reset Your Password <br /><br /><a href='http://www.roflrogue.com/resetpw.php?id=$id&code=$code'>click here to reset your password</a><br /><br />thank you :)";
        $subject = "Password Reset";
        $user->sendMail($email,$message,$subject);
        $msg = "We've sent an email to $email.Please click on the password reset link in the email to generate new password.";
    } else {
        $msg = "Sorry! this email was not found.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password</title>
    </head>
    <body id="login">
        <div class="container">
            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Forgot Password</h2><hr />
                <?php
                if(isset($msg)){
                    echo $msg;
                } else {
                ?>
                <div class='alert alert-info'>
                    Please enter your email address. You will receive a link to create a new password via email.!
                </div>
                <?php } ?>
                <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
                <hr />
                <button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate new Password</button>
            </form>
        </div>
    </body>
</html>