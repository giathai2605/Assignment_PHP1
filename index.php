<?php
session_start();
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
    header('location: log-in.php');
    die;
}

require_once './comon.php';
$id=isset($_SESSION['auth']['id'])?$_SESSION['auth']['id']:"";
$banner=executeQuery("select * from products limit 3",true);
$products=executeQuery("select * from products ",true);
if($id!=""){
    $user=executeQuery("select * from users where id=$id",false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Thaingph26876</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap');

:root {
    --green: #27ae60;
    --black: #192a56;
    --light-color: #666;
    --box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
}
body{
    width: 1440px;
}
* {
    font-family: 'Nunito', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    outline: none;
    border: none;
    text-transform: capitalize;
    transition: all .2s linear;
}

html {
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-padding-top: 5.5rem;
    scroll-behavior: smooth;
}

section {
    padding: 2rem 9%;
}

section:nth-child(even) {
    background: #eee;
}

.sub-heading {
    text-align: center;
    color: var(--green);
    font-size: 2rem;
    padding-top: 1rem;
}

.heading {
    text-align: center;
    color: var(--black);
    font-size: 3rem;
    padding-bottom: 2rem;
    text-transform: uppercase;
}

.btn {
    margin-top: 1rem;
    display: inline-block;
    font-size: 1.7rem;
    color: #fff;
    background: var(--black);
    border-radius: .5rem;
    cursor: pointer;
    padding: .8rem 3rem;
}

.btn:hover {
    background: var(--green);
    letter-spacing: .1rem;
}

header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: #fff;
    padding: 1rem 7%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
    box-shadow: var(--box-shadow);
}

header .logo {
    color: var(--black);
    font-size: 2.5rem;
    font-weight: bolder;
}

header .logo i {
    color: var(--green);
}

header .navbar a {
    font-size: 1.7rem;
    border-radius: .5rem;
    padding: .5rem 1.5rem;
    color: var(--light-color);
}

header .navbar a.active,
header .navbar a:hover {
    color: #fff;
    background: var(--green);
}

header .icons i,
header .icons a {
    cursor: pointer;
    margin-left: .5rem;
    height: 4.5rem;
    line-height: 4.5rem;
    width: 4.5rem;
    text-align: center;
    font-size: 1.7rem;
    color: var(--black);
    border-radius: 50%;
    background: #eee;
}

header .icons i:hover,
header .icons a:hover {
    color: #fff;
    background: var(--green);
    transform: rotate(360deg);
}

header .icons #menu-bars {
    display: none;
}

#search-form {
    position: fixed;
    top: -110%;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1004;
    background: rgba(0, 0, 0, .8);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 1rem;
}

#search-form.active {
    top: 0;
}

#search-form #search-box {
    width: 50rem;
    border-bottom: .1rem solid #fff;
    padding: 1rem 0;
    color: #fff;
    font-size: 3rem;
    text-transform: none;
    background: none;
}

#search-form #search-box::placeholder {
    color: #eee;
}

#search-form #search-box::-webkit-search-cancel-button {
    -webkit-appearance: none;
}

#search-form label {
    color: #fff;
    cursor: pointer;
    font-size: 3rem;
}

#search-form label:hover {
    color: var(--green);
}

#search-form #close {
    position: absolute;
    color: #fff;
    cursor: pointer;
    top: 2rem;
    right: 3rem;
    font-size: 5rem;
}

.home .home-slider .slide {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 2rem;
    padding-top: 9rem;
}

.home .home-slider .slide .content {
    flex: 1 1 45rem;
}

.home .home-slider .slide .image {
    flex: 1 1 45rem;
}

.home .home-slider .slide .image img {
    width: 100%;
}

.home .home-slider .slide .content span {
    color: var(--green);
    font-size: 2.5rem;
}

.home .home-slider .slide .content h3 {
    color: var(--black);
    font-size: 7rem;
}

.home .home-slider .slide .content p {
    color: var(--light-color);
    font-size: 2.2rem;
    padding: .5rem 0;
    line-height: 1.5;
}

.swiper-pagination-bullet-active {
    background: var(--green);
}



.about .row {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    align-items: center;
}

.about .row .image {
    flex: 1 1 45rem;
}

.about .row .image img {
    width: 100%;
}

.about .row .content {
    flex: 1 1 45rem;
}

.about .row .content h3 {
    color: var(--black);
    font-size: 4rem;
    padding: .5rem 0;
}

.about .row .content p {
    color: var(--light-color);
    font-size: 1.5rem;
    padding: .5rem 0;
    line-height: 2;
}

.about .row .content .icons-container {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    padding: 1rem 0;
    margin-top: .5rem;
}

.about .row .content .icons-container .icons {
    background: #eee;
    border-radius: .5rem;
    border: .1rem solid rgba(0, 0, 0, .2);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    flex: 1 1 17rem;
    padding: 1.5rem 1rem;
}

.about .row .content .icons-container .icons i {
    font-size: 2.5rem;
    color: var(--green);
}

.about .row .content .icons-container .icons span {
    font-size: 1.5rem;
    color: var(--black);
}

.menu .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
    gap: 1.5rem;
}

.menu .box-container .box {
    background: #fff;
    border: .1rem solid rgba(0, 0, 0, .2);
    border-radius: .5rem;
    box-shadow: var(--box-shadow);
}

.menu .box-container .box .image {
    height: 25rem;
    width: 100%;
    padding: 1.5rem;
    overflow: hidden;
    position: relative;
}

.menu .box-container .box .image img {
    height: 100%;
    width: 100%;
    border-radius: .5rem;
    object-fit: cover;
}

.menu .box-container .box .image .fa-heart {
    position: absolute;
    top: 2.5rem;
    right: 2.5rem;
    height: 5rem;
    width: 5rem;
    line-height: 5rem;
    text-align: center;
    font-size: 2rem;
    background: #fff;
    border-radius: 50%;
    color: var(--black);
}

.menu .box-container .box .image .fa-heart:hover {
    background-color: var(--green);
    color: #fff;
}

.menu .box-container .box .content {
    padding: 2rem;
    padding-top: 0;
}

.menu .box-container .box .content .stars {
    padding-bottom: 1rem;
}

.menu .box-container .box .content .stars i {
    font-size: 1.7rem;
    color: var(--green);
}

.menu .box-container .box .content h3 {
    color: var(--black);
    font-size: 2.5rem;
}

.menu .box-container .box .content p {
    color: var(--light-color);
    font-size: 1.6rem;
    padding: .5rem 0;
    line-height: 1.5;
    height: 150px;
}

.menu .box-container .box .content .price {
    color: var(--green);
    margin-left: 2.5rem;
    font-size: 2.5rem;
}

.review .slide {
    padding: 2rem;
    box-shadow: var(--box-shadow);
    border: .1rem solid rgba(0, 0, 0, .2);
    border-radius: .5rem;
    position: relative;
}

.review .slide .fa-quote-right {
    position: absolute;
    top: 2rem;
    right: 2rem;
    font-size: 6rem;
    color: #ccc;
}

.review .slide .user {
    display: flex;
    gap: 1.5rem;
    align-items: center;
    padding-bottom: 1.5rem;
}

.review .slide .user img {
    height: 7rem;
    width: 7rem;
    border-radius: 50%;
    object-fit: cover;
}

.review .slide .user h3 {
    color: var(--black);
    font-size: 2rem;
    padding-bottom: .5rem;
}

.review .slide .user i {
    font-size: 1.3rem;
    color: var(--green);
}

.review .slide p {
    font-size: 1.5rem;
    line-height: 1.8;
    color: var(--light-color);
}



.footer .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
    gap: 1.5rem;
}

.footer .box-container .box h3 {
    padding: .5rem 0;
    font-size: 2.5rem;
    color: var(--black);
}

.footer .box-container .box a {
    display: block;
    padding: .5rem 0;
    font-size: 1.5rem;
    color: var(--light-color);
}

.footer .box-container .box a:hover {
    color: var(--green);
    text-decoration: underline;
}

.footer .credit {
    text-align: center;
    border-top: .1rem solid rgba(0, 0, 0, .1);
    font-size: 2rem;
    color: var(--black);
    padding: .5rem;
    padding-top: 1.5rem;
    margin-top: 1.5rem;
}

.footer .credit span {
    color: var(--green);
}

.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 10000;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.loader-container img {
    width: 35rem;
}

.loader-container.fade-out {
    top: -110%;
    opacity: 0;
}

/* media queries  */

@media (max-width:991px) {

    html {
        font-size: 55%;
    }

    header {
        padding: 1rem 2rem;
    }

    section {
        padding: 2rem;
    }


}

@media (max-width:768px) {

    header .icons #menu-bars {
        display: inline-block;
    }

    header .navbar {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border-top: .1rem solid rgba(0, 0, 0, .2);
        border-bottom: .1rem solid rgba(0, 0, 0, .2);
        padding: 1rem;
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
    }

    header .navbar.active {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    }

    header .navbar a {
        display: block;
        padding: 1.5rem;
        margin: 1rem;
        font-size: 2rem;
        background: #eee;
    }

    #search-form #search-box {
        width: 90%;
        margin: 0 1rem;
    }

    .home .home-slider .slide .content h3 {
        font-size: 5rem;
    }

}

@media (max-width:450px) {

    html {
        font-size: 50%;
    }

    .dishes .box-container .box img {
        height: auto;
        width: 100%;
    }

    .order form .inputBox .input {
        width: 100%;
    }

}
.circle {
  margin-top: 10px;
  background: #456BD9;
  border: 0.1875em solid #0F1C3F;
  border-radius: 50%;
  box-shadow: 0.375em 0.375em 0 0 rgba(15, 28, 63, 0.125);
  height: 3em;
  width: 3em;
}

  </style>

</head>
<body>
    
<!-- header section starts      -->

<header>

    <a href="#" class="logo"><i class="fas fa-utensils"></i>resto.</a>

    <nav class="navbar">
        <a class="active" href="./index.php?id=<?= $_SESSION['auth']['id'] ?>">home</a>
        <a href="#about">about</a>
        <a href="#menu">menu</a>
        <a href="list-users.php">users</a>
        <a href="list-products.php">products</a>
        <a href="list-categories.php">categories</a>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
        <a href="cart-detail.php" class="fas fa-shopping-cart"></a> 
        <a href="#" ><img src="images/<?= $user['avatar'] ?>" class="circle" alt=""></a>
        <a href="log-out.php" class="fas fa-sign-out-alt"></a>
        
    </div>

</header>

<!-- header section ends-->

<!-- search form  -->

<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form>

<!-- home section starts  -->

<section class="home" id="home">

    <div class="swiper-container home-slider">

        <div class="swiper-wrapper wrapper">
        <?php foreach($banner as $item): ?>
            <div class="swiper-slide slide">
                <div class="content">
                    <span>our special dish</span>
                    <h3><?= $item['name'] ?></h3>
                    <p><?= $item['detail'] ?></p>
                    <a href="#" class="btn">order now</a>
                </div>
                <div class="image">
                    <img src="images/<?= $item['image'] ?>" alt="">
                </div>
            </div>
            <?php endforeach ?>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h3 class="sub-heading"> about us </h3>
    <h1 class="heading"> why choose us? </h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.png" alt="">
        </div>

        <div class="content">
            <h3>best food in the country</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, sequi corrupti corporis quaerat voluptatem ipsam neque labore modi autem, saepe numquam quod reprehenderit rem? Tempora aut soluta odio corporis nihil!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, nemo. Sit porro illo eos cumque deleniti iste alias, eum natus.</p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>free delivery</span>
                </div>
                <div class="icons">
                    <i class="fas fa-dollar-sign"></i>
                    <span>easy payments</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 service</span>
                </div>
            </div>
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- menu section starts  -->

<section class="menu" id="menu">

    <h3 class="sub-heading"> our menu </h3>
    <h1 class="heading"> today's speciality </h1>

    <div class="box-container">
    <?php foreach($products as $value): ?>
        <div class="box">
            <div class="image">
                <img src="images/<?= $value['image'] ?>" alt="">
                <a href="#" class="fas fa-heart"></a>
            </div>
            <div class="content">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3><?= $value['name'] ?></h3>
                <p><?= $value['detail'] ?></p>
                <a href="add-to-cart.php?product_id=<?= $value['id'] ?>" class="btn" >add to cart</a>
                <span class="price">$<?= $value['price'] ?></span>
            </div>
        </div>
    <?php endforeach ?>

    </div>

</section>

<!-- menu section ends -->

<!-- review section starts  -->

<section class="review" id="review">

    <h3 class="sub-heading"> customer's review </h3>
    <h1 class="heading"> what they say </h1>

    <div class="swiper-container review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-1.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-2.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-3.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="images/pic-4.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.</p>
            </div>

        </div>

    </div>
    
</section>

<!-- review section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        

        <div class="box">
            <h3>quick links</h3>
            <a href="#">home</a>
            <a href="#">dishes</a>
            <a href="#">about</a>
            <a href="#">menu</a>
            <a href="#">reivew</a>
            <a href="#">order</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#">0904 609 542</a>
            <a href="#">0399 587 244</a>
            <a href="#">thaingph26876@fpt.edu.vn</a>
            <a href="#">ngocbich21203@gmail.com</a>
            <a href="#">Trịnh Văn Bô - Nam Từ Liêm - Hà Nội</a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="https://www.facebook.com/profile.php?id=100014504314678">facebook</a>
            <a href="#">twitter</a>
            <a href="#">instagram</a>

        </div>

    </div>

    <div class="credit"> copyright @ by <span>mr. Nguyễn Gia Thái</span> </div>

</section>

<!-- footer section ends -->

<!-- loader part  -->
<div class="loader-container">
    <img src="images/loader.gif" alt="">
</div>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>