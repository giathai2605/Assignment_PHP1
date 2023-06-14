<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php';
$id=$_GET['id'];
$name=isset($_POST['name'])?$_POST['name']:"";
$name_err="";
if(strlen(trim($name)) == 0){
    $name_err = "Hãy nhập tên";
}else{
    $sqlCheckName = "select 
                                count(*) as total 
                        from categories 
                        where name = '$name'
                        and id!=$id";
    $countData = executeQuery($sqlCheckName, false);
    if($countData['total'] > 0){
        $name_err = "Danh mục đã tồn tại, vui lòng nhập danh mục khác";
    }
}
if( !empty($name_err)){
    header("location: edit-category.php?id=$id&name_err=$name_err");
    die;
}

$sqlQuery = "update categories set name='$name' where id=$id";
executeQuery($sqlQuery,true);
header("location: list-categories.php");