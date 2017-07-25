<?php
require_once 'class.config.php';
class USER{
    private $connect;
    public function __construct(){
        $database = new DATABASE();
        $db = $database->dbc();
        $this->connect = $db;
    }
    public function runQuery($sql){
        $stmt = $this->connect->prepare($sql);
        return $stmt;
    }
    public function lasdID(){
        $stmt = $this->connect->lastInsertId();
        return $stmt;
    }
    public function register($fname,$lname,$uname,$email,$pass,$token){
        try{
            require_once 'getSalt.php';
            $options = [
                'cost' => 11,
                'salt' => mkSalt()
            ];
            $password = password_hash($pass, PASSWORD_BCRYPT, $options);
            $stmt = $this->connect->prepare("INSERT INTO users (fname, lname, uname, email, pass, token) VALUES(:first_name, :last_name, :user_name, :email, :password, :token)");
            $stmt->bindparam(":first_name",$fname);
            $stmt->bindparam(":last_name",$lname);
            $stmt->bindparam(":user_name",$uname);
            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":password",$password);
            $stmt->bindparam(":token",$token);
            $stmt->execute();
            return true;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function registerBlog($url){
        try{
            $uid = $_SESSION['isIn'];
            $stmt = $this->connect->prepare("UPDATE users SET url=:url WHERE userID=:uid;INSERT INTO blogs (userID) VALUES (:uid);");
            $stmt->bindparam(":url",$url);
            $stmt->bindparam(":uid",$uid);
            $stmt->execute();
            $stmt = $this->connect->prepare("select * from users inner join blogs on users.userID=blogs.userID AND users.userID=:uid");
            if($stmt->execute(array(":uid"=>$_SESSION['isIn']))){
                $user=$stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['blogID'] = $user['blogID'];
                $_SESSION['blogURL'] = $user['url'];
            }
            return true;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function postResource($uid,$href,$title,$description){
        try{
            $stmt = $this->connect->prepare("INSERT INTO resources (userID, href, title, description) VALUES(:uid, :href, :title, :description)");
            $stmt->bindparam(":uid",$uid);
            $stmt->bindparam(":href",$href);
            $stmt->bindparam(":title",$title);
            $stmt->bindparam(":description",$description);
            $stmt->execute();
            return true;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function postBlog($blogID,$title,$msg){
        try{
            $stmt = $this->connect->prepare("INSERT INTO blogMsgs (blogID, msgTitle, msgBody) VALUES(:blogID, :title, :msg)");
            $stmt->bindparam(":blogID",$blogID);
            $stmt->bindparam(":title",$title);
            $stmt->bindparam(":msg",$msg);
            $stmt->execute();
            return true;    
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function login($email,$pass){
        try{
            $stmt = $this->connect->prepare("select * from users where users.email=:email");
            $stmt->execute(array(":email"=>$email));
            $user=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1){
                if($user['isActive'] == "Y"){
                    //verify hash is correct
                    if(password_verify($pass,$user['pass'])){
                        $_SESSION['isIn'] = $user['userID'];
                        $_SESSION['blogURL'] = $user['url'];
                        $blogID = $this->connect->prepare("select * from users inner join blogs on users.userID=blogs.userID AND users.email=:email");
                        if($blogID->execute(array(":email"=>$email))){
                            $_SESSION['blogID'] = $user['blogID'];
                        }
                        return true;
                    }
                    else{
                        $_SESSION['errorMsg'] = "Password invalid";
                        header("Location: index.php");
                        exit;
                    }
                }
                else{
                    $_SESSION['errorMsg'] = "Please check your email and verify your account";
                    header("Location: index.php?inactive");
                    exit;
                }
            }
            else{
                header("Location: index.php?error");
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function is_logged_in(){
        if(isset($_SESSION['isIn'])){
            return true;
        }
    }
    public function redirect($url){
        header("Location: $url");
    }
    public function logout(){
        session_destroy();
        $_SESSION['isIn'] = false;
    }
    function sendMail($email,$message,$subject){
        require_once("PHPMailer/PHPMailerAutoload.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.zoho.com';
        $mail->Port = 465;
        $mail->AddAddress($email);
        $mail->Username="info@roflrogue.com";
        $mail->Password="strOngW3Bp@Ssword~";
        $mail->SetFrom('info@roflrogue.com','Aaron');
        $mail->AddReplyTo('info@roflrogue.com','Aaron');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}
?>