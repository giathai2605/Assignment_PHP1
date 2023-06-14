<?php
$id=$_GET['id'];
$cate_id = $_GET['cate_id'];
require_once './comon.php';


$products = executeQuery("select * from products",true);
$index=[];
foreach($products as $value){
    if($value[0] == $id){
        $index= $value;
        break;
    }
}
$name=isset($_POST['name'])?$_POST['name']:"";
$sku=isset($_POST['sku'])?$_POST['sku']:"";
$image=$_FILES['image'];
$imageName=uniqid() . '-' . $image['name'];
move_uploaded_file($image['tmp_name'],'./uploads/' . $imageName);
$price=isset($_POST['price'])?$_POST['price']:"";
$quantity=isset($_POST['quantity'])?$_POST['quantity']:"";
$category_id=isset($_POST['category_id'])?$_POST['category_id']:"";
$detail=isset($_POST['detail'])?$_POST['detail']:"";

$sqlQuery = "";
//2. Tạo kết nối
if($image['tmp_name']!=""){
    unlink("./uploads/$index[3]");
    $sqlQuery = "update products set name='$name',sku='$sku',image='$imageName',price='$price',quantity='$quantity',category_id='$category_id',detail='$detail' where id=$id";
}else{
    $sqlQuery = "update products set name='$name',sku='$sku',price='$price',quantity='$quantity',category_id='$category_id',detail='$detail' where id=$id";
}
$name_err="";
$sku_err="";
$price_err="";
$quantity_err="";
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
                        and id!=$id
                        ";
    $countData = executeQuery($sqlCheckSku, false);
    if($countData['total'] > 0){
        $sku_err = "Sku đã tồn tại, vui lòng nhập Sku khác";
    }
}

if(strlen(trim($price)) == 0){
    $price_err = "Hãy nhập giá sản phẩm";
}
if(strlen(trim($quantity)) == 0){
    $quantity_err = "Hãy nhập cố lượng sản phẩm";
}

if(strlen(trim($detail)) == 0){
    $detail_err = "Hãy nhập chi tiết sản phẩm";
}

if(!empty($name_err) || !empty($sku_err) ||  !empty($price_err) || !empty($quantity_err)  || !empty($detail_err)){
    header("location: edit-product.php?id=$id&cate_id=$cate_id&name_err=$name_err&sku_err=$sku_err&price_err=$price_err&quantity_err=$quantity_err&category_id_err=$category_id_err&detail_err=$detail_err");
    die;
}
executeQuery($sqlQuery,false);
header("location: list-products.php");