<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php'; 
$sqlQuery = "select p.*,c.name as category_name  from products p join categories c on p.category_id = c.id;";

$data=executeQuery($sqlQuery,true);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Prducts</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      table {
            border-style: none;
            margin: auto;
            margin-top: 30px;
            text-align: center;
            box-sizing: border-box;
        }

        table tr {
            height: 30px;
        }

        table th {
            padding: 10px;
        }

        table td {
            padding: 10px;
        }

        a {
            color: orangered;
            text-decoration: none;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            padding: 30px 0;
        }

        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        body {
            font-family: Helvetica;
            -webkit-font-smoothing: antialiased;
            background: rgba(71, 147, 227, 1);
        }

        /* Table Styles */

        .table-wrapper {
            margin: 10px 70px 70px;
            box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
        }

        .fl-table {
            border-radius: 5px;
            font-size: 12px;
            font-weight: normal;
            border: none;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            background-color: white;
        }

        .fl-table td,
        .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 12px;
        }

        .fl-table thead th {
            color: #ffffff;
            background: #4FC3A1;
        }


        .fl-table thead th:nth-child(odd) {
            color: #ffffff;
            background: #324960;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        /* Responsive */

        @media (max-width: 767px) {
            .fl-table {
                display: block;
                width: 100%;
            }

            .table-wrapper:before {
                content: "Scroll horizontally >";
                display: block;
                text-align: right;
                font-size: 11px;
                color: white;
                padding: 0 0 10px;
            }

            .fl-table thead,
            .fl-table tbody,
            .fl-table thead th {
                display: block;
            }

            .fl-table thead th:last-child {
                border-bottom: none;
            }

            .fl-table thead {
                float: left;
            }

            .fl-table tbody {
                width: auto;
                position: relative;
                overflow-x: auto;
            }

            .fl-table td,
            .fl-table th {
                padding: 20px .625em .625em .625em;
                height: 60px;
                vertical-align: middle;
                box-sizing: border-box;
                overflow-x: hidden;
                overflow-y: auto;
                width: 120px;
                font-size: 13px;
                text-overflow: ellipsis;
            }

            .fl-table thead th {
                text-align: left;
                border-bottom: 1px solid #f7f7f9;
            }

            .fl-table tbody tr {
                display: table-cell;
            }

            .fl-table tbody tr:nth-child(odd) {
                background: none;
            }

            .fl-table tr:nth-child(even) {
                background: transparent;
            }

            .fl-table tr td:nth-child(odd) {
                background: #F8F8F8;
                border-right: 1px solid #E6E4E4;
            }

            .fl-table tr td:nth-child(even) {
                border-right: 1px solid #E6E4E4;
            }

            .fl-table tbody td {
                display: block;
                text-align: center;
             
            }
       
        }
        header {
    top: 0;
    left: 0;
    right: 0;
    background: #4FC3A1;
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

    </style>
</head>
<body>
<header>
<nav class="navbar">
        <a class="active" href="index.php?id=<?= $_SESSION['auth']['id'] ?>">Home</a>
        <a href="list-users.php">Users</a>
        <a href="list-products.php">Products</a>
        <a href="list-categories.php">Categories</a>
        <a href="log-out.php" class="fas fa-sign-out-alt"></a>
    </nav>
</header>

<a href="./list-products.php" class="list-product"><h1>List Products</h1></a>
<table border="1" class="fl-table">
     <thead>
        <th>Tên sản phẩm</th>
        <th>Sku</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Category_Id</th>
        <th>Detail</th>
        <th colspan="2">
            <a href="create-product.php">Add</a>
        </th>
    </thead>
    <tbody>
        <?php foreach($data as $item ): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['sku'] ?></td>
                <td><img src="<?= './images/'. $item['image'] ?>" width="100px" height="100px" alt=""></td>
                <td><?= $item['price'].'$' ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= $item['category_name'] ?></td>
                <td style="width:300px;"><?= $item['detail'] ?></td>
                <td>
                    <a href="remove-product.php?id=<?= $item[0] ?>">Xóa</a>
                </td>
                <td>
                    <a href="edit-product.php?id=<?= $item[0] ?>&cate_id=<?= $item['category_id'] ?>">Sửa</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
   
</body>
</html>