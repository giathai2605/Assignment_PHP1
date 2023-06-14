<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php';
$id=$_GET['id'];
$name=isset($_POST['name'])?$_POST['name']:"";
$email=isset($_POST['email'])?$_POST['email']:"";
$avatar=$_FILES['avatar'];
$avatarName=uniqid() . '-' . $avatar['name'];
move_uploaded_file($avatar['tmp_name'],'./images/' . $avatarName);


$nameerr = "";
$emailerr = "";
if(strlen($name) == 0){
    $nameerr = "Hãy nhập tên";
}
if(strlen($email) == 0){
    $emailerr = "Hãy nhập email";
}else{
    $sqlCheckEmail = "select 
                                count(*) as total 
                        from users 
                        where email = '$email'
                        and id!=$id";
    $countData = executeQuery($sqlCheckEmail, false);
    if($countData['total'] > 0){
        $emailerr = "Email đã tồn tại, vui lòng chọn email khác";
    }
}
if(!empty($emailerr) || !empty($passworderr) || !empty($nameerr) || !empty($avatarerr)){
    header("location: edit-user.php?id=$id&emailerr=$emailerr&nameerr=$nameerr");
    die;
}
$sqlQuery = "";
//2. Tạo kết nối
if($avatar['tmp_name']!=""){
    $sqlQuery = "update users set name='$name',email='$email',avatar='$avatarName' where id=$id";
}else{
    $sqlQuery = "update users set name='$name',email='$email' where id=$id";
}
executeQuery($sqlQuery,true);
header("location: list-users.php");


