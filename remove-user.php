<?php 
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
$id=$_GET['id'];
require_once './comon.php';
$data=executeQuery("select * from users",true);
$index=[];
foreach($data as $value){
    if($value['id'] == $id){
        $index= $value;
        break;
    }
}

unlink("./uploads/$index[3]");
$rmQuery = "delete from users where id=$id";
executeQuery($rmQuery,true);


header("location: list-users.php");