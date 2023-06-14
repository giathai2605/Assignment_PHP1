<?php 
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php';
$id=$_GET['id'];
$sqlQuery = "delete from categories where id=$id";
$data=executeQuery($sqlQuery,true);
header("location: list-categories.php");