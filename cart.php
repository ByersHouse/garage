<?php 

session_start();


//var_dump($_SESSION);

if($_SESSION['cart'][0]['total'] > 0) { 

include_once 'LiqPay.php';

$order_id = substr(sha1(md5(microtime().'valera'.rand(1,56))),-12);

$_SESSION['order_id'] = $order_id;

//var_dump($order_id);

$package = $_SESSION['cart'][0]['item'];
if($package == 'econom'){ $p = 'ЭКОНОМ'; } else { $p = strtoupper($_SESSION['cart'][0]['item']); }


$liqpay = new LiqPay('i73597616648', 'xMjw3rMuzZlRpUm6w28sQWjOQzj43AsijGxcb5DI');
$html = $liqpay->cnb_form(array(
'action'         => 'pay',
'amount'         =>  $_SESSION['cart'][0]['total'],
'currency'       => 'UAH',
'description'    => 'Оплата годового пакета '.$p,
'order_id'       =>  $order_id,
'version'        => '3',
'language'      => 'ru',
'result_url'    => 'http://sitecare.vn.ua/last/cart'
));

}

else
{

  header("Location: /last/empty");
}


?>




<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
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
       			
       				<div class="header__menu">
              <div class="container container-r">
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

       		</header>

       		

          <div class="cart__order">
            <div class="container">
              <div class="block__header">
                  <i class="borderBo borderBo2 borderBo3"></i>
                  <div class="block__innerText">
                    <span class="block__headerRow2 cartorder">Оформление заказа</span>
                  </div>
              </div>
              <div class="cartContent">
                <div class="cartContentLeft">
                  <div class="cartContentPackage">
                    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ) { ?>
                        <?php if($_SESSION['cart'][0]['item'] == 'econom') { ?>
                            Годовой пакет:   <span class="packageValue packageValue--green"> ЭКОНОМ </span>
                        <?php } else if($_SESSION['cart'][0]['item'] == 'comfort') {  ?>

                             Годовой пакет:   <span class="packageValue packageValue--yellow"> COMFORT </span>
                        <?php } else if($_SESSION['cart'][0]['item'] == 'vip') {  ?>

                         Годовой пакет:   <span class="packageValue packageValue--orange"> VIP </span>
                        <?php } else { ?> 

                        <?php } ?>
                    <?php } ?>
                    <span class="chooseAnother"><a href='/last/#cart'>Выбрать другой пакет</a></span>
                  </div>
                  <div class="cartContentCard">
                    <img src="img/newcarta.png" />
                  </div>
                  <div class="cartItogo">

                     <!--Итого: <span class="itogoPrice itogoPrice--green"> 99 <small>грн</small> </span>-->

                     <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ) { ?>
                        <?php if($_SESSION['cart'][0]['item'] == 'econom') { ?>
                           Итого: <span class="itogoPrice itogoPrice--green"> <?php echo $_SESSION['cart'][0]['total']; ?> <small>грн</small> </span>
                        <?php } else if($_SESSION['cart'][0]['item'] == 'comfort') {  ?>

                            Итого: <span class="itogoPrice itogoPrice--yellow"> <?php echo $_SESSION['cart'][0]['total']; ?> <small>грн</small> </span>
                        <?php } else if($_SESSION['cart'][0]['item'] == 'vip') {  ?>

                        Итого: <span class="itogoPrice itogoPrice--orange"> <?php echo $_SESSION['cart'][0]['total']; ?> <small>грн</small> </span>
                        <?php } else { ?> 

                        <?php } ?>
                    <?php } ?>


                  </div>
                </div>
                <div class="cartContentRight">
                  <div class="ccu cartContentUser">
                    <div class="ccuH">Персональные данные</div>
                    <div class="ccuC">
                      <label class="ccuCL">
                        <span class="ccuCS ccuC--inline">Ваше полное Имя</span>
                        <span class="errorSpanClass">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="name" />
                      </label>
                      <label class="ccuCL">
                        <span class="ccuCS ccuC--inline">телефон*</span>
                        <span class="errorSpanClass">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="phone" />
                      </label>
                      <label class="ccuCL">
                        <span class="ccuCS ccuC--inline">E-mail</span>
                        <span class="errorSpanClass">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="email" />
                      </label>
                    </div>
                  </div>
                   <div class="ccu ccu2 cartContentUser">
                    <div class="ccuH">Доставка</div>
                    <div class="ccuC">
                      <label class="ccuCL">
                        <span class="ccuCS ccuC--inline">Город</span>
                        <span class="errorSpanClass">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="gorod" />
                      </label>
                      <label class="ccuCL">
                        <span class="ccuCS ccuC--inline">Улица</span>
                        <span class="errorSpanClass">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="street" />
                      </label>
                      <div class="ccuHalf">
                        <label class="ccuCL ccuCL--l1">
                          <span class="ccuCS ccuC--inline">Дом</span>
                          <span class="errorSpanClass">Это поле обязательное</span>
                          <input type="text" class="ccuCI" id="dom" />
                        </label>
                        <label class="ccuCL ccuCL--l1 ccuCL--ll">
                          <span class="ccuCS ccuC--inline">Квартира</span>
                          <input type="text" class="ccuCI" id="flat" />
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="ccu cartContentUser">
                    <div class="ccuH">Оплата</div>
                    <div class="ccuC">
                      <label class="ccuCL ">
                        <span class="ccuCS">Выберите способ оплаты</span>
                        <select class="ccuCSS" id="payment">
                          <option value="1">Наличными</option>
                          <option value="2">Картой онлайн</option>
                        </select>
                      </label>

                      <label class="ccuCL ccuCL--abs" >
                        <span class="ccuCS">Комментарии к заказу</span>
                        <textarea class="ccuCT" id="comment"></textarea> 
                      </label>
                     
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>

          <div class="agreement">
            <div class="container">
               <input type="checkbox" name="agree" class="agreeCheck" id="agreed" />
               <span>Я подтверждаю заказ и согласен с условиями <a href="/last/oferta" target="_blank">Публичной оферты</a></span>
            </div>
          </div>

          <div class="buyButton">
            <a href="javascript:;" class="grbg" id="buyCard">Купить</a>
            <div class="hiddenLiqPay" style="display:none"><?php echo $html; ?></div>
          </div>

          

         <?php include 'footer.php'; ?>