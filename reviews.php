<?php session_start(); ?>
<?php include 'header_static.php'; ?>
<?php include("libs/captcha/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

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

function formatDate($date)
{
  $r = explode(" ", $date);
  $ymd = $r[0];
  $hms = $r[1];

  $r2 = explode("-", $ymd);
  $year = $r2[0];
  $month = $r2[1];
  $day = $r2[2];

  switch($month)
  {
    case '01':
    $textm = 'января';
    break;
     case '02':
    $textm = 'февраля';
    break;
     case '03':
    $textm = 'марта';
    break;
     case '04':
    $textm = 'апреля';
    break;
     case '05':
    $textm = 'мая';
    break;
     case '06':
    $textm = 'июня';
    break;
     case '07':
    $textm = 'июля';
    break;
     case '08':
    $textm = 'августа';
    break;
     case '09':
    $textm = 'сентября';
    break;
     case '10':
    $textm = 'октября';
    break;
    case '11':
    $textm = 'ноября';
    break;
    case '12':
    $textm = 'декабря';
    break;
  }
  return $day . ' ' . $textm . ' ' . $year;
}


function getTotalReviews($dbh)
{
     $query = "SELECT COUNT(*) FROM reviews WHERE status = 1";
     $q = $dbh->prepare($query);
     $q->execute();
     $r = $q->fetch();

     return $r[0];
}

function getReviews($dbh, $page, $total)
{
   if($page)
   {
      if($page == 1)
      {
        $query = "SELECT * FROM reviews WHERE status = 1 ORDER BY date DESC LIMIT 8";
        $qr = $dbh->prepare($query);
        $qr->execute();
        return $qr->fetchAll();
      }
      else
      {
        $offset = ($page-1)*8;
         $query = "SELECT * FROM reviews WHERE status = 1 ORDER BY date DESC LIMIT 8,".$offset;
          $qr = $dbh->prepare($query);
          $qr->execute();
          return $qr->fetchAll();
      }
   }
   else
   {
      $query = "SELECT * FROM reviews WHERE status = 1 ORDER BY date DESC LIMIT 8";
      $qr = $dbh->prepare($query);
      $qr->execute();
      return $qr->fetchAll();
   }
  
}

function formatRate($rate)
{
  switch ($rate) {
    case '1':
      return '<span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                      </span>';
      break;
    case '2':
      return '<span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                      </span>';
      break;
      case '3':
     return '<span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                      </span>';
      break;
         case '4':
      return '<span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                      </span>';
      break;
          case '5':
      return '<span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                      </span>';
      break;



  }
}


?>
          

          <div class="reviews">
            <div class="container">
              <div class="block__header">
                  <i class="borderBo borderBo2 borderBo3"></i>
                  <div class="block__innerText">
                    <span class="block__headerRow2 cartorder">Отзывы</span>
                  </div>
              </div>
              <div class="revContainer">

              <?php 

              if(isset($_GET['page'])) { 
                 $page = $_GET['page'];
              }
              else
              {
                $page = 0;
              }

              $total = getTotalReviews($dbh);

              $reviews = getReviews($dbh, $page, $total);


              ?>

              <?php $i = 1; ?>
              <?php foreach($reviews as $review) { ?>
              <?php if(($i==1) || ($i%2) == 1) { $class = 'revOne--left'; } else { $class = 'revOne--right';  } ?>
                <div class="revOne <?php echo $class; ?>">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop"><?php echo $review['name']; ?>, <?php echo $review['car']; ?></span>
                      <?php echo formatRate($review['rate']); ?>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText"><?php echo $review['review']; ?></div>
                    <div class="revOne__textDate"><?php echo formatDate($review['date']); ?></div>
                    </div>
                  </div>
                </div>
              <?php $i++; } ?>
                <!-- <div class="revOne revOne--left">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop">Андрей, Понтиак</span>
                      <span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                        <i class="star star--o"></i>
                      </span>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText">Проверка работоспособности!</div>
                    <div class="revOne__textDate">4 июля 2017</div>
                    </div>
                  </div>
                </div>


                 <div class="revOne revOne--right">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop">Николай, Ланцер 2015 года</span>
                      <span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                      </span>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText">Пользуюсь уже 2 месяца. За это время сэкономил кучу денег на топливе, ведь я часто мотаюсь по делам по всей Украине. Жене тоже подключил Гараж, теперь я за нее спокоен!</div>
                    <div class="revOne__textDate">4 июля 2017</div>
                    </div>
                  </div>
                </div>


                <div class="revOne revOne--left">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop">Виктор, Лада 99</span>
                      <span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                      </span>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText">Хороший сервис, спасибо! Твердая 4-ка!</div>
                    <div class="revOne__textDate">23 июня 2017</div>
                    </div>
                  </div>
                </div>


                <div class="revOne revOne--right">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop">Александр, Toyota Corolla 2015</span>
                      <span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                      </span>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText">Купил себе абонемент за 99 грн ради покупки со скидкой талонов на топливо. За 2 недели отбил стоимость абонемента и уже во всю экономлю! Спасибо вам!</div>
                    <div class="revOne__textDate">6 июня 2017</div>
                    </div>
                  </div>
                </div>

                <div class="revOne revOne--left">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop">Александр, Toyota Corolla 2015</span>
                      <span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                      </span>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText">Купил себе абонемент за 99 грн ради покупки со скидкой талонов на топливо. За 2 недели отбил стоимость абонемента и уже во всю экономлю! Спасибо вам!</div>
                    <div class="revOne__textDate">6 июня 2017</div>
                    </div>
                  </div>

                </div>

                <!--<div class="revOne revOne--right">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop">Александр, Toyota Corolla 2015</span>
                      <span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                      </span>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText">Купил себе абонемент за 99 грн ради покупки со скидкой талонов на топливо. За 2 недели отбил стоимость абонемента и уже во всю экономлю! Спасибо вам!</div>
                    <div class="revOne__textDate">6 июня 2017</div>
                    </div>
                  </div>
                </div>

                <div class="revOne revOne--left">
                  <div class="revOne__image">
                    <img src="img/usericon.png" />
                  </div>
                  <div class="revOne__text">
                    <div class="revOne__textTop">
                      <span class="revOne__textTop">Александр, Toyota Corolla 2015</span>
                      <span class="revOne__textRate">
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--full"></i>
                        <i class="star star--o"></i>
                      </span>
                    </div>
                    <div class="revOne__textBot">
                    <div class="revOne__reviewText">Купил себе абонемент за 99 грн ради покупки со скидкой талонов на топливо. За 2 недели отбил стоимость абонемента и уже во всю экономлю! Спасибо вам!</div>
                    <div class="revOne__textDate">6 июня 2017</div>
                    </div>
                  </div>

                </div>-->



              </div>
              <?php if($total > 8) { ?>
              <div class="pagination">
                <ul>
                  <?php 
                    $reminder = (int) ($total % 8);
                    $base = (int) ($total / 8);
                    if($reminder > 0 && $base > 0)
                    {
                      $j=1;
                      for($i=1; $i<=$base+1; $i++)
                      {

                        if((isset($_GET['page']) && $_GET['page'] == $i) || (!isset($_GET['page']) && $j==1)) { 
                  ?>

                        <li class="pagination__Li">
                          <span class="pagination__Span"><?php echo $i; ?></span>
                        </li>

                        <?php $j++;} else { ?>

                        <li class="pagination__Li">
                          <a href="/last/reviews?page=<?php echo $i; ?>" class="pagination__Link"><?php echo $i; ?></a>
                        </li>

                        <?php 
                      }
                    }


                  }
                  ?>
                  <!--<li class="pagination__Li">
                    <a href="#" class="pagination__Link">1</a>
                  </li>
                  <li class="pagination__Li">
                    <span class="pagination__Span">2</span>
                  </li>
                  <li class="pagination__Li">
                    <a href="#" class="pagination__Link">3</a>
                  </li>
                  <li class="pagination__Li">
                    <a href="#" class="pagination__Link">4</a>
                  </li>-->
                </ul>
              </div>
              <?php } ?>


              <div class="whiteReview">
                 <div class="block__header">
                  <i class="borderBo borderBo2 borderBo3"></i>
                  <div class="block__innerText">
                    <span class="block__headerRow2 cartorder">Оставить отзыв</span>
                  </div>
                </div>

                <div class="whiteReview__container">
                  <div class="wrLeft">
                    <label class="ccuCL ccuCLRe">
                        <span class="ccuCS">Имя</span>
                        <span class="errorSpanClass2">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="r_name">
                      </label>
                      <label class="ccuCL ccuCLRe">
                        <span class="ccuCS">Какой у Вас автомобиль?</span>
                        <span class="errorSpanClass2">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="r_car">
                      </label>
                      <label class="ccuCL ccuCLRe">
                        <span class="ccuCS">Адрес электронной почты</span>
                        <span class="errorSpanClass2">Это поле обязательное</span>
                        <input type="text" class="ccuCI" id="r_email">
                      </label>

                      <div class="ccCap ccuCLRe">
                         <span class="errorSpanClass2 esc3">Это поле обязательное</span>
                        <input class="capInput" type="text" id="r_captcha" />
                        <?php echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" />'; ?>
                      </div>
                  </div>

                  <div class="wrRight ccuCLRe ">
                    <div class="rw__rating">
                      <div class="r_title">Рейтинг:</div>
                      <a href="javascript:;"><i class="star star1" data-rate="1"></i></a>
                      <a href="javascript:;"><i class="star star2" data-rate="2"></i></a>
                      <a href="javascript:;"><i class="star star3" data-rate="3"></i></a>
                      <a href="javascript:;"><i class="star star4" data-rate="4"></i></a>
                      <a href="javascript:;"><i class="star star5 checked" data-rate="5"></i></a>
                    </div>
                     <span class="errorSpanClass2">Это поле обязательное</span>
                    <textarea class="rw__textarea" id="r_review"></textarea>
                    <a href="javascript:;" class="bluebutton lr" id="leftReview">оставить отзыв</a>
                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>


            </div>
         </div>
              

          
 <?php include 'footer.php'; ?>
