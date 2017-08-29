<?php session_start(); ?>
<?php include 'header_static.php'; ?>
       <!--		

          <div class="reviews">
            <div class="container">
              <div class="block__header">
                  <i class="borderBo borderBo2 borderBo3"></i>
                  <div class="block__innerText">
                    <span class="block__headerRow2 cartorder">Контакты</span>
                  </div>
              </div>
             
              <div class="contactContainer">
              	<div class="contactContainerLeft">
                  <div class="cCL__block">
                    <span class="cCL__title">Адрес: </span>
                    <span class="cCL__value">65088, г. Одесса, Люстдорфская дорога д. 92/94</span>
                  </div>
                  <div class="cCL__block">
                  <span class="cCL__title">Телефон:</span> 
                  <span class="cCL__value">0 800 754 888</span>
                   </div>
                  <div class="cCL__block">
                  <span class="cCL__title">Email: </span>
                   <span class="cCL__value">info@bh.od.ua</span>
                    </div>
                  <div class="cCL__block">
                  <span class="cCL__title">Сайт Buyer's House </span>
                   <span class="cCL__value"><a href="http://company-bh.com" target="_blank">http://company-bh.com</a></span>
                    </div>
                   <div class="cCL__block">
                  <span class="cCL__title cCL__title-cc">Мы в социальных сетях: </span>
                  <div class="cCL__title ">
                    <!--<a href="#" class="ym"><i class="iconblueF iconblueF--fb"></i></a>
                    <a href="#" class="ym"><i class="iconblueF iconblueF--in"></i></a>
                    <a href="#" class="nom"><i class="iconblueF iconblueF--vk"></i></a>
                    <a href="#" class="nom"><i class="iconblueF iconblueF--yt"></i></a>
                    <a class="ym" href="https://www.facebook.com/AutoassistanceOdessa" target="_blank" class="footer__iconsLink"><i class="icon--fb"></i></a>
                  <a class="ym" href="https://www.instagram.com/garage_bh" target="_blank" class="footer__iconsLink"><i class="icon--in"></i></a>
                  <a class="nom" href="https://vk.com/garage_bh" target="_blank" class="footer__iconsLink"><i class="icon--vk "></i></a>
                  <a class="nom" href="javascript:;" class="footer__iconsLink footer__iconsLink--last"><i class="icon--yt "></i></a>
                  </div>
                  </div>
                </div>
                <div class="contactContainerRight" id="map" >

                </div>

                <div class="clearfix"></div>

              </div>

            </div>
         </div>
              -->

          

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

            getPage($dbh,4);

          ?>

<?php include 'footer.php'; ?>