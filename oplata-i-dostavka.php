
<?php session_start(); ?>
<?php include 'header_static.php'; ?>

       		<!--

          <div class="reviews">
            <div class="container">
              <div class="block__header">
                  <i class="borderBo borderBo2  borderBo3"></i>
                  <div class="block__innerText">
                    <span class="block__headerRow2 cartorder">Оплата</span>
                  </div>
              </div>
             
              <div class="contactContainer contactContainer--nom">
              	<div class="staticContainerLeft">
                 <p>Для Вашего удобства оплатить выбранный пакет можно несколькими способами:</p>

                 <div class="cardLeft">
                   <img src="img/newcarta.png" />
                 </div>
                 <div class="cardRight">
                   <div class="cardRightBlock">
                     <i class="card--first"></i>
                     <span><span class="uPB">ОНЛАЙН ОПЛАТА</span> картой VISA или MasterCard через систему безопасных платежей LiqPay</span>
                   </div>
                    <div class="cardRightBlock cardRightBlock--second">
                     <i class="card--second"></i>
                     <span><span class="uPB">ОПЛАТА</span> наличными <span class="uPB">КУРЬЕРУ</span> при получении карты в руки</span>
                   </div>
                 </div>

                </div>
              </div>


              <div class="block__header">
                  <i class="borderBo borderBo2 borderBo3"></i>
                  <div class="block__innerText">
                    <span class="block__headerRow2 cartorder">Доставка</span>
                  </div>
              </div>
             
              <div class="contactContainer contactContainer50">
                <div class="staticContainerLeft">
                 <p>Наши курьеры максимально быстро доставят Вам карту в любой удобный для Вас уголок Одессы. Время доставки с 10.00 до 17.00 по будням.  
                  </p>
                  <p class="uPB">Доставка бесплатная</p>
                </div>
              </div>


         </div>
              
          </div>-->

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



            include 'function.php';

            getPage($dbh,5);

          ?>

          

        <?php include 'footer.php'; ?>