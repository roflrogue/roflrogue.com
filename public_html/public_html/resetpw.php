<?php
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
<html>
    <head>
        <title>Password Reset</title>
    </head>
    <body id="login">
        <div class="container">
            <div class='alert alert-success'>
                <strong>Hello !</strong>  <?php echo $row['userName'] ?> you are here to reset your forgetton password.
            </div>
            <form class="form-signin" method="post">
                <h3 class="form-signin-heading">Password Reset.</h3><hr />
                <?php
                    if(isset($msg)){echo $msg;}
                ?>
                <input type="password" placeholder="New Password" name="pass" required />
                <input type="password" placeholder="Confirm New Password" name="conf-pass" required />
                <hr />
                <button type="submit" name="reset-pass">Reset Your Password</button>
            </form>
        </div>
    </body>
</html>