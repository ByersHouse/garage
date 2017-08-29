<?php 


session_start();


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



if(isset($_POST['getCaptcha']))
{
	include("libs/captcha/simple-php-captcha.php");
	$_SESSION['captcha'] = simple_php_captcha();
	echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" />';
}

if(isset($_POST['package']))
{

	unset($_SESSION['cart']);
	$cart = array();
	
	
	if($_POST['package'] == 'econom'){$price = 99;} else
	if($_POST['package'] == 'comfort'){$price = 550;} else
	if($_POST['package'] == 'vip'){$price = 9988;} else
	{
		$price = 'fail';

		echo "error";
		exit;
	}

	$package = $_POST['package'];
	$total = $price;

	$cart[] = array('item'=>$package, 'total'=>$total);

	$_SESSION['cart'] = $cart;

	echo '<a href="/last/cart.php" class="header__cartLink"><i class="icon icon--cart"></i><span class="cartdivider"></span><span class="cartcount">'.count($_SESSION['cart']).'</span><span class="hiddenText">Оформить заказ</span></a>';

}



if(isset($_POST['payCash']))
{
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$city = $_POST['city'];
	$street = $_POST['street'];
	$dom = $_POST['dom'];
	$flat = $_POST['flat'];

	$comment = $_POST['comment'];

	$body = "<b>МЕТОД ОПЛАТЫ: НАЛИЧНЫМИ ПРИ ПОЛУЧЕНИИ</b><br>";
	$body .= "<b>Полное имя: </b>".$name . "<br>";
	$body .= "<b>Телефон: </b>".$phone . "<br>";
	$body .= "<b>Email: </b>".$email . "<br>";

	if($city)
	{
		$body .= "<b>Город: </b>".$city . "<br>";
	}

	if($street)
	{
		$body .= "<b>Улица: </b>".$street . "<br>";
	}

	if($dom)
	{
		$body .= "<b>Дом: </b>".$dom . "<br>";
	}

	if($flat)
	{
		$body .= "<b>Квартира: </b>".$flat . "<br>";
	}

	if($comment)
	{
		$body .= "<b>Комментарий: </b>".$comment . "<br>";
	}
	
	

	require 'mailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->CharSet = "UTF-8";


	$mail->setFrom('info@sitecare.vn.ua', 'Demo');
	$mail->addAddress('zadrotello@gmail.com');     // Add a recipient
	$mail->addAddress('bhcompanyua@gmail.com');

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Новый заказ - ПАКЕТ '. strtoupper($_SESSION['cart'][0]['item']);
	$mail->Body    = $body;
	$mail->AltBody = $altbody;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {

		$mail2 = new PHPMailer;
		$mail2->CharSet = "UTF-8";
		$mail2->setFrom('info@sitecare.vn.ua', 'Demo');
		$mail2->addAddress($email);

		$mail2->isHTML(true);                                  // Set email format to HTML

		$mail2->Subject = 'Вы заказали ПАКЕТ '. strtoupper($_SESSION['cart'][0]['item']);
		$mail2->Body    = 'Ваш заказ принят. Ожидайте звонка нашего менеджера';
		$mail2->AltBody = 'Ваш заказ принят. Ожидайте звонка нашего менеджера';
		$mail2->send();
	    echo 'success';
	}



}


if(isset($_POST['payCard']))
{
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$city = $_POST['city'];
	$street = $_POST['street'];
	$dom = $_POST['dom'];
	$flat = $_POST['flat'];
	$comment = $_POST['comment'];


	$body = "<b>МЕТОД ОПЛАТЫ: НА КАРТУ</b> <br>";

	$body .= "<b>Полное имя: </b>".$name . "<br>";
	$body .= "<b>Телефон: </b>".$phone . "<br>";
	$body .= "<b>Email: </b>".$email . "<br>";

	if($city)
	{
		$body .= "<b>Город: </b>".$city . "<br>";
	}

	if($street)
	{
		$body .= "<b>Улица: </b>".$street . "<br>";
	}

	if($dom)
	{
		$body .= "<b>Дом: </b>".$dom . "<br>";
	}

	if($flat)
	{
		$body .= "<b>Квартира: </b>".$flat . "<br>";
	}

	if($comment)
	{
		$body .= "<b>Комментарий: </b>".$comment . "<br>";
	}

	require 'mailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->CharSet = "UTF-8";


	$mail->setFrom('info@sitecare.vn.ua', 'Demo');
	$mail->addAddress('zadrotello@gmail.com');     // Add a recipient
		$mail->addAddress('bhcompanyua@gmail.com');

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Новый заказ #'.$_SESSION['order_id'].' - ПАКЕТ '. strtoupper($_SESSION['cart'][0]['item']);
	$mail->Body    = $body;
	$mail->AltBody = $altbody;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {

		$mail2 = new PHPMailer;
		$mail2->CharSet = "UTF-8";
		$mail2->setFrom('info@sitecare.vn.ua', 'Demo');
		$mail2->addAddress($email);

		$mail2->isHTML(true);                                  // Set email format to HTML

		$mail2->Subject = 'Вы заказали ПАКЕТ '. strtoupper($_SESSION['cart'][0]['item']);
		$mail2->Body    = 'Ваш заказ принят. Ожидайте звонка нашего менеджера';
		$mail2->AltBody = 'Ваш заказ принят. Ожидайте звонка нашего менеджера';

		$mail2->send();
	    echo 'success';
	}
}


if(isset($_POST['phoneCall']))
{
	$phone = $_POST['phone'];

	if($phone)
	{
		require 'mailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->CharSet = "UTF-8";


		$mail->setFrom('info@sitecare.vn.ua', 'Demo');
		$mail->addAddress('zadrotello@gmail.com');     // Add a recipient

		$mail->addAddress('bhcompanyua@gmail.com');	
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Заказ обратного звонка';
		$mail->Body    = "<b>Позвоните мне на номер:</b>". $phone;
		$mail->AltBody = "Позвоните мне на номер:". $phone;

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'success';
		}
	}

	else
	{
		echo 'fail';
	}
}



if(isset($_POST['phoneCallBlock']))
{
	$phone = $_POST['phone'];
	if($phone)
	{
		require 'mailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->CharSet = "UTF-8";


		$mail->setFrom('info@sitecare.vn.ua', 'Demo');
		$mail->addAddress('zadrotello@gmail.com');     // Add a recipient

		$mail->addAddress('bhcompanyua@gmail.com');	
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Заказ обратного звонка';
		$mail->Body    = "<b>Позвоните мне на номер:</b>". $phone;
		$mail->AltBody = "Позвоните мне на номер:". $phone;

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'success';
		}
	}
	else
	{
		echo 'fail';
	}
}



if(isset($_POST['checkCap']))
{
	if($_SESSION['captcha']['code'] == $_POST['checkCap'])
	{
		echo 'correct';
	}
	else
	{
		echo $_SESSION['captcha']['code'];
	}
}

if(isset($_POST['updateCap']))
{
	include("libs/captcha/simple-php-captcha.php");
	$_SESSION['captcha'] = simple_php_captcha();
	echo $_SESSION['captcha']['image_src'];
}



if(isset($_POST['makeReview']))
{
	$name = $_POST['name'];
	$car = $_POST['car'];
	$email = $_POST['email'];
	$rate = $_POST['rate'];
	$comment = $_POST['comment'];
	$dater = date("Y-m-d H:i:s");

	$q = "INSERT INTO reviews SET name = ?, car = ?, email = ?, rate = ?, review = ?, status = ?, date = ?";
	$qr = $dbh->prepare($q);
	$qr->execute(array($name, $car, $email, $rate, $comment, 0, $dater));

	if($name && $car && $email && $rate && $comment)
	{
		$body = "<b>Имя: </b>".$name."<br>";
		$body .= "<b>Авто: </b>".$car."<br>";
		$body .= "<b>Email: </b>".$email."<br>";
		$body .= "<b>Оценка: </b>".$rate."<br>";
		$body .= "<b>Отзыв: </b>".$comment."<br>";

		require 'mailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->CharSet = "UTF-8";


		$mail->setFrom('info@sitecare.vn.ua', 'Demo');
		$mail->addAddress('zadrotello@gmail.com');     // Add a recipient

		$mail->addAddress('bhcompanyua@gmail.com');	
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Новый отзыв';
		$mail->Body    = $body;
		$mail->AltBody =  "Имя: ".$name.". "."Авто: ".$car.". "."Email: ".$email.". ". "Оценка: ".$rate.". ". "Отзыв: ".$comment;

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			unset($_SESSION['captcha']);
			$mail2 = new PHPMailer;
			$mail2->CharSet = "UTF-8";
			$mail2->setFrom('info@sitecare.vn.ua', 'Demo');
			$mail2->addAddress($email);

			$mail2->isHTML(true);                                  // Set email format to HTML

			$mail2->Subject = 'Спасибо за Ваш отзыв!';
			$mail2->Body    = 'Ваш отзыв получен, и появится на сайте после проверки модератором.';
			$mail2->AltBody = 'Ваш отзыв получен, и появится на сайте после проверки модератором.';

			$mail2->send();

		    echo 'success';
		}
	}

	else
	{
		echo $_SESSION['captcha']['code'];
	}
}