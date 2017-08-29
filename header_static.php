<?php
$dsn = 'mysql:dbname=teapla00_garage;host=teapla00.mysql.ukraine.com.ua';
$user = 'teapla00_garage';
$password = 'ywcjd7dx';

try {
    $dbh = new PDO($dsn, $user, $password,array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


if($_SERVER["REQUEST_URI"] == '/last/')
{
  $page_id = 1;
}

if($_SERVER["REQUEST_URI"] == '/last/faq/')
{
  $page_id = 2;
}

if($_SERVER["REQUEST_URI"] == '/last/tarify/')
{
  $page_id = 3;
}

if($_SERVER["REQUEST_URI"] == '/last/contacts/')
{
  $page_id = 4;
}

if($_SERVER["REQUEST_URI"] == '/last/oplata-i-dostavka/')
{
  $page_id = 5;
}


if($_SERVER["REQUEST_URI"] == '/last/reviews/')
{
  $page_id = 6;
}



if($page_id && $page_id < 6)
{
   $q = "SELECT title, decsription FROM pages WHERE id = ?";
   $qr = $dbh->prepare($q);
   $qr->execute(array($page_id));

   $r = $qr->fetchAll();
}

?>



<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php if(isset($r[0]['title'])) { echo $r[0]['title']; } ?></title>
        <meta name="description" content="<?php if(isset($r[0]['decsription'])) { echo $r[0]['decsription']; } ?>">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/fa.png" />
        <link rel="apple-touch-icon" href="img/fa.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/responsive.css">
          <link rel="stylesheet" href="libs/modal/jquery.modal.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body class="cart">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
       	<div class="wrapper">
       		<div class="mobilemenu r234">
           <div class="mobilemenuIcon r234"><a href="javascript:;" class="r234"><img class="r234" src="img/mobile_menu.png" /></a></div> 
           <div class="mobileContent r234">
             <div class="header__card r234">
                      <a href="javascript:;" class="r234"><i class="r234 icon icon--card"></i>
                      <span class="r234">Активация карты</span></a>
                    </div>
                    <div class="r234 header__account">
                      <a href="javascript:;" class="r234"><i class="r234 icon icon--user"></i>
                      <span class="r234">Личный кабинет</span></a>
                    </div>

                    <div class="r234 mobileDivider"></div>
                    <ul class="r234 mobileMenuUl">
                  <li class="r234"><a class="r234" href="/last">Главная</a></li>
                  <li class="r234"><a class="r234" href="/last/faq">FAQ</a></li>
                  <li class="r234"><a class="r234" href="/last/oplata-i-dostavka">Оплата и доставка</a></li>
                  <li class="r234"><a class="r234" class="r234" href="/last/reviews">Отзывы</a></li>
                  <li class="r234 last"><a class="r234" hclass="r234" ref="/last/contacts">Контакты</a></li>
                </ul>
                  </div>
          </div>
       		<header class="home">
       			<div class="header__topBg">
              
            </div>
       			<div class="container container-r">
       				<div class="header__menu">
                
         					<ul>
         						 <li><a href="/last">Главная</a></li>
                    <li><a href="/last/faq">FAQ</a></li>
                    <li><a href="/last/oplata-i-dostavka">Оплата и доставка</a></li>
                    <li><a href="/last/reviews">Отзывы</a></li>
                    <li><a href="/last/contacts">Контакты</a></li>
         					</ul>
         					<div class="header__phone">
         						<div class="header__phoneSpan">0 800 754 888</div>
         						<div class="header__phoneText">по украине бесплатно</div>
         					</div>
         					<div class="header__buttons">
         						<div class="header__card">
         							<a href="#"><i class="icon icon--card"></i>
         							<span>Активация карты</span></a>
         						</div>
         						<div class="header__account">
         							<a href="#"><i class="icon icon--user"></i>
         							<span>Личный кабинет</span></a>
         						</div>
         					</div>
       					<div class="clearfix"></div>
       				</div>
            </div>
       				
       			<div class="header__cart header__cart--f">
       					<a href="/last/cart" class="header__cartLink">
       						<i class="icon icon--cart"></i>
       						<span class="cartdivider"></span>
       						<span class="cartcount"><?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {  echo  count($_SESSION['cart']); ?><?php } else { ?>0<?php } ?></span>
                  <span class="hiddenText">Оформить заказ</span>
       					</a>
       				</div>		
       		</header>