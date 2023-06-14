<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php';
$name=isset($_POST['name'])?$_POST['name']:"";
$sku=isset($_POST['sku'])?$_POST['sku']:"";
$image=$_FILES['image'];
$imageName=uniqid() . '-' . $image['name'];
move_uploaded_file($image['tmp_name'],'./images/' . $imageName);
$price=isset($_POST['price'])?$_POST['price']:"";
$quantity=isset($_POST['quantity'])?$_POST['quantity']:"";
$category_id=isset($_POST['category_id'])?$_POST['category_id']:"";
$detail=isset($_POST['detail'])?$_POST['detail']:"";

$name_err="";
$sku_err="";
$image_err="";
$price_err="";
$quantity_err="";
$category_id_err="";
$detail_err="";

if(strlen(trim($name)) == 0){
    $name_err = "Hãy nhập tên sản phẩm";
}
if(strlen(trim($sku)) == 0){
    $sku_err = "Hãy nhập sku";
}else{
    $sqlCheckSku = "select 
                                count(*) as total 
                        from products 
                        where sku = '$sku'
                        ";
    $countData = executeQuery($sqlCheckSku, false);
    if($countData['total'] > 0){
        $sku_err = "Sku đã tồn tại, vui lòng nhập Sku khác";
    }
}
if($image['size']==0){
    $image_err = "Hãy tải lên file ảnh";
}
if(strlen(trim($price)) == 0){
    $price_err = "Hãy nhập giá sản phẩm";
}
if(strlen(trim($quantity)) == 0){
    $quantity_err = "Hãy nhập cố lượng sản phẩm";
}
if($category_id == ""){
    $category_id_err = "Hãy nhập category_id cho sản phẩm";
}
if(strlen(trim($detail)) == 0){
    $detail_err = "Hãy nhập chi tiết sản phẩm";
}

if(!empty($name_err) || !empty($sku_err) || !empty($image_err) || !empty($price_err) || !empty($quantity_err) || !empty($category_id_err) || !empty($detail_err)){
    header("location: create-product.php?name_err=$name_err&sku_err=$sku_err&image_err=$image_err&price_err=$price_err&quantity_err=$quantity_err&category_id_err=$category_id_err&detail_err=$detail_err");
    die;
}
$sqlQuery = "insert into products (name,sku,image,price,quantity,category_id,detail) values ('$name','$sku','$imageName','$price','$quantity','$category_id','$detail')";
executeQuery($sqlQuery,true);
header("location: list-products.php");