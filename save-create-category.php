<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php';
$name=isset($_POST['name'])?$_POST['name']:"";
$name_err="";
if(strlen(trim($name)) == 0){
    $name_err = "Hãy nhập tên";
}else{
    $sqlCheckName = "select 
                                count(*) as total 
                        from categories 
                        where name = '$name'";
    $countData = executeQuery($sqlCheckName, false);
    if($countData['total'] > 0){
        $name_err = "Danh mục đã tồn tại, vui lòng nhập danh mục khác";
    }
}
if( !empty($name_err)){
    header("location: create-category.php?name_err=$name_err");
    die;
}
$sqlQuery="insert into categories (name) values ('$name')";
executeQuery($sqlQuery,true);

header("location: list-categories.php");