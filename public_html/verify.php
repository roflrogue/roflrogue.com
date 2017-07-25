<?php
session_start();
require_once '../class.user.php';
$user = new USER();
if(empty($_GET['id']) && empty($_GET['code'])){
    $user->redirect('index.php');
}
if(isset($_GET['id']) && isset($_GET['code'])){
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];
    $statusY = "Y";
    $statusN = "N";
    $stmt = $user->runQuery("SELECT userID, isActive FROM users WHERE userID=:uID AND token=:code LIMIT 1");
    $stmt->bindparam(":uID",$id);
    $stmt->bindparam(":code",$code);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        if($row['isActive']==$statusN){
            $stmt = $user->runQuery("UPDATE users SET isActive=:status WHERE userID=:uID");
            $stmt->bindparam(":status",$statusY);
            $stmt->bindparam(":uID",$id);
            $stmt->execute(); 
            $_SESSION['msg'] = "Your Account is Now Activated"; 
        } else {
            $_SESSION['msg'] = "Your Account is allready Activated";
        }
    } else {
        $_SESSION['msg'] = "No Account Found";
    }
$user->redirect('index.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Confirm Registration</title>
  </head>
  <body id="login">
    <div class="container">
        <?php if(isset($msg)) { echo $msg; }?>
    </div>
  </body>
</html>