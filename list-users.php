<?php
require_once './comon.php';
session_start();

if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}

$data=executeQuery("select * from users",true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
   *{
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  /* vertical-align: baseline; */
  outline: none;
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
html { overflow-y: scroll; }
body { 
  background: #eee url('https://i.imgur.com/eeQeRmk.png'); /* https://subtlepatterns.com/weave/ */
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 62.5%;
  line-height: 1;
  color: #585858;
  padding: 22px 10px;
  padding-bottom: 55px;
}

::selection { background: #5f74a0; color: #fff; }
::-moz-selection { background: #5f74a0; color: #fff; }
::-webkit-selection { background: #5f74a0; color: #fff; }

br { display: block; line-height: 1.6em; } 

article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
ol, ul { list-style: none; }

input, textarea { 
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  outline: none; 
}

blockquote, q { quotes: none; }
blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
strong, b { font-weight: bold; } 
tr{
  text-align: center;
  align-items: center;
}
table { border-collapse: collapse; border-spacing: 0; }
img { border: 0; max-width: 100%; }

h1 { 
  font-family: 'Amarante', Tahoma, sans-serif;
  font-weight: bold;
  font-size: 3.6em;
  line-height: 1.7em;
  margin-bottom: 10px;
  margin-left: 300px;
  text-align: center;
  display: block;
}
.header{
  display: flex;
  justify-content: space-between;
}

/** page structure **/
#wrapper {
  display: block;
  width: 850px;
  background: #fff;
  margin: 50px auto;
  padding: 10px 17px;
}

#keywords {
  margin: 0 auto;
  font-size: 1.2em;
  margin-bottom: 15px;
}

td{
  padding: auto;
  align-items: center;
}
#keywords thead {
  cursor: pointer;
  background: #c9dff0;
}
#keywords thead tr th { 
  font-weight: bold;
  padding: 12px 30px;
  padding-left: 42px;
}
#keywords thead tr th span { 
  padding-right: 20px;
  background-repeat: no-repeat;
  background-position: 100% 100%;
}

#keywords tbody tr { 
  color: #555;
}
#keywords tbody tr td {
  text-align: center;
  padding: 15px 10px;

}
#keywords tbody tr td.lalign {
  text-align: center;
  align-items: center;
}
a{
    text-decoration: none;
    color: orangered;
}
button{
  width: 80px;
  height: 30px;
  font-size: 15px;
  color: white;
  background-color: orangered;
  border: 1px solid orangered;
  border-radius: 5px;
}
button:focus{
  color: yellow;
}
header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: #c9dff0;
    padding: 1rem 7%;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: space-around;
    z-index: 1000;
    box-shadow: var(--box-shadow);
}


header .navbar a {
    font-size: 1.7rem;
    border-radius: .5rem;
    padding: .5rem 1.5rem;
    color: var(--light-color);
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
<div id="wrapper">
<div class="header">
<h1>List Users</h1> 
</div>
<table border="1" id="keywords">
     <thead>
        <th>Họ và Tên</th>
        <th>Email</th>
        <th>Avatar</th>
        <th colspan="2">
            <a href="create-user.php">Add</a>
        </th>
    </thead>
    <tbody>
        <?php foreach($data as $item ): ?>
            <tr>
                <td><?= $item[1] ?></td>
                <td><?= $item[2] ?></td>
                <td><img src="<?= './images/'. $item[3] ?>" width="100px" height="100px" alt=""></td>
                <td>
                    <a href="remove-user.php?id=<?= $item[0] ?>">Xóa</a>
                </td>
                <td>
                    <a href="edit-user.php?id=<?= $item[0] ?>">Sửa</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>
   
</body>
</html>