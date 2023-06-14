<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
$cart = $_SESSION['cart'];
$totalPrice = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        
        table { border-collapse: collapse; border-spacing: 0; 
        box-sizing: border-box;}
         *{
  margin: 0;
  padding: 0;
  font-size: 100%;
  font: inherit;
  /* vertical-align: baseline; */
text-align: center;
  box-sizing: border-box;
}
table td{
    padding: 15px 10px;
}
table th{
    padding: 10px 10px;
    font-weight: bold;
}
table{
    margin: 50px auto;
}
thead{
    background-color: #E6B663;
}
h1{
    margin-top: 30px;
    font-size: 40px;
   font-weight: 800;
}
header {
    top: 0;
    left: 0;
    right: 0;
    background: #EDB75A;
    padding: 1rem 7%;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: space-around;
    z-index: 1000;
    box-shadow: var(--box-shadow);
    margin-bottom: 15px;
    border: 1px solid #E6E4E4;
}
a{
    text-decoration: none;
    color: black;
}

header .navbar a {
    font-size: 1.7rem;
    border-radius: .5rem;
    padding: .5rem 1.5rem;
    color: wheat;
}

header .navbar a:hover {
    color: orangered;
    background: var(--green);
}
body{
    background: url('https://static.vecteezy.com/system/resources/thumbnails/003/502/781/small/watercolor-orange-abstract-background-design-template-free-vector.jpg');
}
    </style>
</head>
<body>
<header>
<nav class="navbar">
        <a class="active" href="./index.php?id=<?= $_SESSION['auth']['id'] ?>">Home</a>
        <a href="list-users.php">Users</a>
        <a href="list-products.php">Products</a>
        <a href="list-categories.php">Categories</a>
        <a href="log-out.php" class="fas fa-sign-out-alt"></a>
    </nav>
</header>
<h1>YOUR DETAIL CART</h1>
<table border="2">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
    </thead>
    <tbody>
        <?php foreach ($cart as $value): ?>
            <?php
                
                $totalPrice += $value['quantityNew']*$value['price'];    
            ?>
            <tr>
                <td><?= $value['id']?></td>
                <td><?= $value['name']?></td>
                <td><img src="./images/<?= $value['image'] ?>" width="100px" height="100px" alt=""></td>
                <td style="color:red;"><?= $value['price']?>$</td>
                <td><?= $value['quantityNew']?></td>
            </tr>
        <?php endforeach?>
        <tr>
            <th colspan="4">Tổng tiền:</th>
            <th style="color: red;"><?= $totalPrice?>$</th>
        </tr>
    </tbody>
</table>
</body>
</html>