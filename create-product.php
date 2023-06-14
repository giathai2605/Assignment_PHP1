<?php
session_start();
if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
    header('location: log-in.php');
    die;
}
require_once './comon.php';
?>
<?php

$splQuery = "select * from categories";

$data = executeQuery($splQuery, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #1DA1F3;
        }

        .container {
            position: relative;
            width: 700px;
            height: 750px;
            border-radius: 20px;
            padding: 40px;
            box-sizing: border-box;
            background: #ecf0f3;
            margin: auto;
            margin-top: 50px;
        }

        h1 {
            margin-left: 200px;
            margin-top: 10px;
            font-weight: 900;
            font-size: 1.8rem;
            color: #1DA1F2;
            letter-spacing: 1px;
            text-align: center;
            padding: auto;

        }

        label,
        input {
            display: block;
            width: 100%;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
        }

        input {
            text-align: left;
            margin-top: 30px;
            background: #ecf0f3;
            padding: 10px;
            padding-left: 20px;
            height: 50px;
            font-size: 14px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
        }

        button {
            display: block;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
            color: white;
            margin-top: 20px;
            background: #1DA1F2;
            height: 40px;
            width: 100%;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 900;
            box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
            transition: 0.5s;
        }

        button:hover {
            box-shadow: none;
        }

        a {
            position: absolute;
            font-size: 8px;
            bottom: 4px;
            right: 4px;
            text-decoration: none;
            color: black;
            background: yellow;
            border-radius: 10px;
            padding: 2px;
        }

        h1 {
            position: absolute;
            top: 0;
            left: 0;
        }


        label {
            margin-bottom: 4px;
            margin-top: 20px;
        }

        label:nth-of-type(2) {
            margin-top: 12px;
        }

        input::placeholder {
            color: gray;
        }

        .form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        textarea {
            width: 100%;
            height: 150px;
            resize: none;
            border-radius: 10px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            background: #ecf0f3;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="save-create-product.php" method="post" enctype="multipart/form-data">
            <h1>Create New Product</h1>
            <div class="form">
                <div class="left">
                    <label for="">Name: </label>
                    <div>
                        <input type="text" name="name" id="" placeholder="Name">
                        <br>
                        <?php if (isset($_GET['name_err'])) : ?>
                            <span style="color: red"><?= $_GET['name_err'] ?></span>
                        <?php endif ?>
                    </div>
                    <label for="">Sku: </label>
                    <div>
                        <input type="text" name="sku" id="" placeholder="Sku">
                        <br>
                        <?php if (isset($_GET['sku_err'])) : ?>
                            <span style="color: red"><?= $_GET['sku_err'] ?></span>
                        <?php endif ?>
                    </div>
                    <label for="">Image: </label>
                    <div>
                        <input type="file" name="image" id="" placeholder="Image">
                        <br>
                        <?php if (isset($_GET['image_err'])) : ?>
                            <span style="color: red"><?= $_GET['image_err'] ?></span>
                        <?php endif ?>
                    </div>
                    <label for="">Price: </label>
                    <div>
                        <input type="number" name="price" id="" placeholder="Price">
                        <br>
                        <?php if (isset($_GET['price_err'])) : ?>
                            <span style="color: red"><?= $_GET['price_err'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="right">
                    <label for="">Quantity: </label>
                    <div>
                        <input type="number" name="quantity" id="" placeholder="Quantity">
                        <br>
                        <?php if (isset($_GET['quantity_err'])) : ?>
                            <span style="color: red"><?= $_GET['quantity_err'] ?></span>
                        <?php endif ?>
                    </div>
                    <label for="">Category_Id: </label>
                    <div>
                        <select name="category_id" id="">
                            <option value="">--- Chọn danh mục ---</option>
                            <?php foreach ($data as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <br>
                        <?php if (isset($_GET['category_id_err'])) : ?>
                            <span style="color: red"><?= $_GET['category_id_err'] ?></span>
                        <?php endif ?>
                    </div>
                    <label for="">Detail: </label>
                    <div>
                        <textarea name="detail" id="" placeholder="Detail product">

                       </textarea>
                       <br>
                        <?php if (isset($_GET['detail_err'])) : ?>
                            <span style="color: red"><?= $_GET['detail_err'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>


            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>