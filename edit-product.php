<?php
//1. Tạo câu lệnh lấy dữ liệu   

require_once './comon.php';

$products = executeQuery("select * from products", true);

$id = $_GET['id'];
$cate_id = $_GET['cate_id'];
// var_dump($cate_id);die;
$index = [];
foreach ($products as $value) {
  if ($value[0] == $id) {
    $index = $value;
    break;
  }
}

$cates = executeQuery("select * from categories", true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <style>
    html {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: linear-gradient(#141e30, #243b55);
    }

    .login-box {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 400px;
      padding: 40px;
      transform: translate(-50%, -50%);
      background: rgba(0, 0, 0, .5);
      box-sizing: border-box;
      box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
      border-radius: 10px;
    }

    .login-box h1 {
      margin: 0 0 30px;
      padding: 0;
      color: #fff;
      text-align: center;
    }

    .login-box input {
      position: relative;
    }

    .login-box input {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      margin-bottom: 30px;
      border: none;
      border-bottom: 1px solid #fff;
      outline: none;
      background: transparent;
    }

    .login-box label {
      top: 0;
      left: 0;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      transition: .5s;
    }

    .login-box input:focus~label,
    .login-box input:valid~label {
      top: -20px;
      left: 0;
      color: #03e9f4;
      font-size: 12px;
    }

    .login-box form button {
      position: relative;
      display: inline-block;
      padding: 10px 20px;
      color: #03e9f4;
      font-size: 16px;
      text-decoration: none;
      text-transform: uppercase;
      overflow: hidden;
      transition: .5s;
      margin-top: 40px;
      letter-spacing: 4px;
      display: block;
      margin: auto;
    }

    .login-box button:hover {
      background: #03e9f4;
      color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px #03e9f4,
        0 0 25px #03e9f4,
        0 0 50px #03e9f4,
        0 0 100px #03e9f4;

    }


    @keyframes btn-anim1 {
      0% {
        left: -100%;
      }

      50%,
      100% {
        left: 100%;
      }
    }



    @keyframes btn-anim2 {
      0% {
        top: -100%;
      }

      50%,
      100% {
        top: 100%;
      }
    }



    @keyframes btn-anim3 {
      0% {
        right: -100%;
      }

      50%,
      100% {
        right: 100%;
      }
    }


    @keyframes btn-anim4 {
      0% {
        bottom: -100%;
      }

      50%,
      100% {
        bottom: 100%;
      }
    }

    textarea {
      width: 100%;
      resize: none;
      height: 100px;
    }
  </style>
</head>

<body>
  <div class="login-box">
    <form action="save-edit-product.php?id=<?= $id ?>&cate_id=<?= $cate_id?>" method="post" enctype="multipart/form-data">
      <h1>Edit Product</h1>
      <label for="">Name: </label>
      <div>
        <input type="text" name="name" id="" value="<?= $index[1] ?>">
        <br>
        <?php if (isset($_GET['name_err'])) : ?>
          <span style="color: red"><?= $_GET['name_err'] ?></span>
        <?php endif ?>
      </div>
      <label for="">Sku: </label>
      <div>
        <input type="text" name="sku" id="" value="<?= $index[2] ?>">
        <br>
        <?php if (isset($_GET['sku_err'])) : ?>
          <span style="color: red"><?= $_GET['sku_err'] ?></span>
        <?php endif ?>
      </div>
      <label for="">Image: </label>
      <div>
        <input type="file" name="image" id="" value="<?= $index[3] ?>">

      </div>
      <label for="">Price: </label>
      <div>
        <input type="number" name="price" id="" value="<?= $index[4] ?>">
        <br>
        <?php if (isset($_GET['price_err'])) : ?>
          <span style="color: red"><?= $_GET['price_err'] ?></span>
        <?php endif ?>
      </div>
      <label for="">Quantity: </label>
      <div>
        <input type="number" name="quantity" id="" value="<?= $index[5] ?>">
        <br>
        <?php if (isset($_GET['quantity_err'])) : ?>
          <span style="color: red"><?= $_GET['quantity_err'] ?></span>
        <?php endif ?>
      </div>
      <label for="">Category_Id: </label>
      <div>
        <select name="category_id" id="">
          <?php foreach ($cates as $value) : ?>
            <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $cate_id) echo "selected"; ?>><?= $value['name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <label for="">Detail: </label>
      <div>
        <textarea name="detail" id=""><?= trim($index[7]); ?></textarea>
        <br>
        <?php if (isset($_GET['detail_err'])) : ?>
          <span style="color: red"><?= $_GET['detail_err'] ?></span>
        <?php endif ?>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</body>

</html>