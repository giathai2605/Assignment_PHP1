<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
$id=$_SESSION['auth']['id'];
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
require_once './comon.php';
$product_id = $_GET['product_id'];
// lấy ra thông tin của sản phẩm dựa vào id
$sqlQuery = "select * from products where id = $product_id";
$product =executeQuery($sqlQuery,false);
$cart = $_SESSION['cart'];
$flag = -1;
foreach($cart as $key => $item) {
    if($product_id == $item['id']){
        $flag = $key;
        break;
    }
}
if($flag == -1){
    // bổ sung thêm thuộc tính quantity = 1 vào mảng thông tin của sản phẩm
    $product['quantityNew'] = 1;
    // add sản phẩm vào mảng giỏ hàng
    $cart[] = $product;
}else{
    // nếu id của sp đã có trong giỏ hàng rồi
    // lấy ra số index của sản phẩm bị trùng
    // cập nhật số lượng quantity ++
    $cart[$flag]['quantityNew']++;
}
$_SESSION['cart'] = $cart;
header("location: index.php?id=$id");
?>