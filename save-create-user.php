<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php';
$name=isset($_POST['name'])?$_POST['name']:"";
$email=isset($_POST['email'])?$_POST['email']:"";
$avatar=$_FILES['avatar'];
$avatarName=uniqid() . '-' . $avatar['name'];
move_uploaded_file($avatar['tmp_name'],'./images/' . $avatarName);
$password = $_POST['password'];

//kiểm tra dữ liệu
$nameerr = "";
$emailerr = "";
$passworderr = "";
$avatarerr="";
if(strlen($name) == 0){
    $nameerr = "Hãy nhập tên";
}
if($avatar['size']==0){
    $avatarerr="Vui lòng upload file ảnh";
}
if(strlen($email) == 0){
    $emailerr = "Hãy nhập email";
}else{
    $sqlCheckEmail = "select 
                                count(*) as total 
                        from users 
                        where email = '$email'";
    $countData = executeQuery($sqlCheckEmail, false);
    if($countData['total'] > 0){
        $emailerr = "Email đã tồn tại, vui lòng chọn email khác";
    }
}

if(strlen($password) == 0){
    $passworderr = "Hãy nhập mật khẩu";
}

if(!empty($emailerr) || !empty($passworderr) || !empty($nameerr) || !empty($avatarerr)){
    header("location: create-user.php?emailerr=$emailerr&passworderr=$passworderr&nameerr=$nameerr&avatarerr=$avatarerr");
    die;
}




$password=isset($_POST['password'])?password_hash($_POST['password'],PASSWORD_DEFAULT):"";

$sqlQuery = "insert into users (name,email,avatar,password) values ('$name','$email','$avatarName','$password')";

executeQuery($sqlQuery,true);
header("location: list-users.php");