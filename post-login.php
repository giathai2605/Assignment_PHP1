<?php 
session_start();
require_once './comon.php';
$email=$_POST['email'];
$password=$_POST['password'];

$sqlQuery ="select * from users where email='$email'";


$user = executeQuery($sqlQuery,false);

if($user && password_verify($password,$user['password'])){
    unset($user['password']);
    $_SESSION['auth'] = $user;
    header("location: index.php?id=$user[0]");
    die;
}
header('location: log-in.php?msg=Tài khoản/mật khẩu không chính xác');
?>