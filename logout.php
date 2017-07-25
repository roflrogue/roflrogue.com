<?php
session_start();
require_once '../class.user.php';
$user = new USER();
$user->logout();
header("Location: index.php");
?>