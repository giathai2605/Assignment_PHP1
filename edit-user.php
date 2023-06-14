<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
require_once './comon.php';
$id=$_GET['id'];
$index=executeQuery("select * from users where id=$id",false);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
<style>
   *,
*:before,
*:after {
  box-sizing: border-box;
}
body {
  padding: 1em;
  font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 15px;
  color: #b9b9b9;
  background-color: #e3e3e3;
}
h1 {
  color: #f0a500;
  text-align: center;
}
form{
    display: block;
    width: 500px;
    height: 400px;
    margin: auto;
    background-color: #f9f9f9;
}

input {
  width: 90%;
  padding: 1em;
  line-height: 1.4;
  background-color: #f9f9f9;
  border: 1px solid #e5e5e5;
  border-radius: 3px;
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
 margin-left: 25px;
}
input:focus {
  outline: 0;
  border-color: #bd8200;
}
input:focus + .input-icon i {
  color: #f0a500;
}
input:focus + .input-icon:after {
  border-right-color: #f0a500;
}
label{
    margin-left: 25px;
    color: gray;
}
input{
    margin-top: 10px;
    margin-bottom: 5px;
}
button{
    display: block;
    background-color: orange;
    color: wheat;
    border: 1px solid orangered;
    width: 100px;
    height: 30px;
    font-size: 15px;
    border-radius: 5px;
    margin: auto;
    margin-top: 20px;
}
span{
  margin-left: 25px;
}
</style>
</head>
<body>
    <form action="save-edit-user.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
        <h1>Edit User</h1>
    <label for="">Name: </label>
    <div>
        <input type="text" name="name" id="" value="<?= $index[1]?>">
        <br>
        <?php if(isset($_GET['nameerr'])):?>
                <span style="color: red"><?= $_GET['nameerr']?></span>
            <?php endif ?>
    </div>
    <label for="">Email: </label>
    <div>
        <input type="text" name="email" id="" value="<?= $index[2]?>" >
        <br>
        <?php if(isset($_GET['emailerr'])):?>
                <span style="color: red"><?= $_GET['emailerr']?></span>
            <?php endif ?>
    </div>
    <label for="">Avatar: </label>
    <div>
        <input type="file" name="avatar" id="" value="<?= $index[3]?>" >
    </div>
    <button type="submit">Submit</button>
    </form>
</body>
</html>