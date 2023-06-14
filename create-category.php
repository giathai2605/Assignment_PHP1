<?php 
session_start();

if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}
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
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    font-weight: 100;
    font-size: 12px;
    line-height: 30px;
    color: #777;
    background: #fff
}

.container {
    max-width: 400px;
    width: 100%;
    margin: 0 auto;
    position: relative
}

#contactus {
    font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
    background: #F9F9F9;
    padding: 25px;
    margin: 150px 0;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24)
}



#contactus h3 {
    display: block;
    font-size: 30px;
    font-weight: 300;
    margin-bottom: 30px;
    text-align: center;
    margin-top: 10px;
    
}


fieldset {
    border: medium none !important;
    margin: 0 0 10px;
    min-width: 100%;
    padding: 0;
    width: 100%
}

#contactus input[type="text"] {
    width: 94%;
    border: 1px solid #ccc;
    background: #FFF;
    margin: 0 0 5px;
    padding: 10px
}

#contactus input[type="text"]:hover{
    -webkit-transition: border-color 0.3s ease-in-out;
    -moz-transition: border-color 0.3s ease-in-out;
    transition: border-color 0.3s ease-in-out;
    border: 1px solid #aaa
}


#contactus button[type="submit"] {
    cursor: pointer;
    width: 100%;
    border: none;
    background: #f0715f;
    color: #FFF;
    margin: 0 0 5px;
    padding: 10px;
    font-size: 15px
}

#contactus button[type="submit"]:hover {
    background: #f07150;
    -webkit-transition: background 0.3s ease-in-out;
    -moz-transition: background 0.3s ease-in-out;
    transition: background-color 0.3s ease-in-out
}

#contactus button[type="submit"]:active {
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5)
}

#contactus input:focus,
#contactus textarea:focus {
    outline: 0;
    border: 1px solid #aaa
}

::-webkit-input-placeholder {
    color: #888
}

:-moz-placeholder {
    color: #888
}

::-moz-placeholder {
    color: #888
}

:-ms-input-placeholder {
    color: #888
}
    


</style>
</head>
<body>
<div class="container">
    <form id="contactus" action="save-create-category.php" method="post">
        <h3>Edit Category</h3>
        <fieldset> <input placeholder="name" name="name" type="text" tabindex="1"  autofocus > 
        <br>
        <?php if(isset($_GET['name_err'])):?>
                <span style="color: red"><?= $_GET['name_err']?></span>
            <?php endif ?></fieldset>
        <fieldset> <button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Submit</button> </fieldset>
    </form>
</div>
</body>
</html>