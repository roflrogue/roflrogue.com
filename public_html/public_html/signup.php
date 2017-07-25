
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
                $data_invalid[] = 'Sorry your first name contains invalid characters';
            }
        }
        //Last Name///////////////////////////////////////////////////////////////
        if(empty($_POST['form_lname'])){//if empty add to data missing array
            $data_missing[] = 'Last Name';  
        } else {
            if(ctype_alpha($_POST['form_lname'])){//if contains invalid chars echo error
                $l_name = strtolower(trim($_POST['form_lname']));
            } else {
                $data_invalid[] = 'Sorry your last name contains invalid characters';
            }
        }
        //User Name///////////////////////////////////////////////////////////////////
        if(empty($_POST['form_uname'])){//if empty add to data missing array
            $data_missing[] = 'User Name';
        } else {
            if(ctype_alnum($_POST['form_uname'])){//if contains invalid chars echo error
                $u_name = strtolower(trim($_POST['form_uname']));
            } else {
                $data_invalid[] = 'Sorry your user name may only contain alphanumeric characters';
            } 
        }
        //Email///////////////////////////////////////////////////////////////////////////
        if(empty($_POST['form_email'])){//if empty add to data missing array
            $data_missing[] = 'Email';
        } else {
	        if(filter_var($_POST['form_email'], FILTER_VALIDATE_EMAIL)){//if invalid email echo error
                $email = strtolower(trim($_POST['form_email']));
	        } else {
                $data_invalid[] = 'Sorry the email address you entered is invalid';
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
                    $data_invalid[] = 'Sorry but the password you entered does not meet complexity standards';
                }
            } else {
                $data_invalid[] = 'Sorry but the passwords you entered do not match'; 
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
                $msg = 'user name or email is already in use';
            }else{
                if($reg_user->register($f_name, $l_name, $u_name, $email, $pw, $code)){
                    $id = $reg_user->lasdID();
                    $key = base64_encode($id);
                    $id = $key;
                    $message = "Hello $uname,<br /><br />Welcome to Rolfrogues Den!<br/>To complete your registration please, click following link<br/><br /><br /><a href='http://www.roflrogue.com/verify.php?id=$id&code=$code'>Click HERE to Activate</a><br /><br />Thanks,";
                    $subject = "Confirm Registration";
                    $reg_user->sendMail($email,$message,$subject); 
                    $msg = "We've sent an email to $email. Please click on the confirmation link in the email to create your account.";
                }else{
                    echo "sorry , query could not be executed...";
                }
            }
        }else{
            if(!empty($data_missing)){
                echo 'The following data is needed to register: <br  />';
                foreach($data_missing as $missing){
                    echo $missing . '<br  />';
                }
            }else{
                echo 'The following inputs are invalid:  <br  />';
                foreach($data_invalid as $invalid){
                    echo $invalid . '<br  />';
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up Roflrogue</title>
    </head>
    <body id="login">
        <?php echo $msg;?>
        <div class="container">
            <form method="post">
                <h2>Sign Up</h2>
                <table>
                    <tr>
                        <td>
                            <input type="text" placeholder="First Name" name="form_fname" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" placeholder="Last Name" name="form_lname" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" placeholder="User Name" name="form_uname" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" placeholder="Email" name="form_email" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" placeholder="Password" name="form_pw1" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" placeholder="Retype Password" name="form_pw2" required />
                        </td>
                    </tr>
                </table>
                <button type="submit" name="form_signup">Sign Up</button>
            </form>
        </div>
    </body>
</html>