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


if(isset($_POST['data']) && isset($_SESSION['user_id']))
{
	$q = "UPDATE pages SET code = ?, title = ?, decsription = ? WHERE id = ?";
	$qr = $dbh->prepare($q);
	$qr->execute(array($_POST['data'], $_POST['title'], $_POST['description'], $_POST['id']));

	echo 'success';
}

if(isset($_POST['logout']))
{
	unset($_SESSION['user_id']);
}

if(isset($_POST['pass']))
{
	$password = $_POST['pass'];
	if($password)
	{
		require '../mailer/PHPMailerAutoload.php';
		$newpassword = md5(sha1($_POST['pass']));
		
		$q = "UPDATE users SET password = ? WHERE id = 1";
		$qr = $dbh->prepare($q);
		$qr->execute(array($newpassword));


		$mail2 = new PHPMailer;
		$mail2->CharSet = "UTF-8";
		$mail2->setFrom('info@sitecare.vn.ua', 'Demo');
		$mail2->addAddress('zadrotello@gmail.com');
		$mail2->addAddress('bhcompanyua@gmail.com');	
		$mail2->isHTML(true);                                  // Set email format to HTML
		$mail2->Subject = 'Вы изменили пароль';
		$mail2->Body    = 'Ваш новый пароль: '.$password;
		$mail2->AltBody = 'Ваш новый пароль: '.$password;
		$mail2->send();

		echo 'Пароль успешно обновлен!';
	}
}

if(isset($_POST['ur']))
{
	$name = $_POST['name'];
	$car = $_POST['car'];
	$review = $_POST['review'];
	$status = $_POST['status'];
	$date = $_POST['date'];
	$rate = $_POST['rate'];

	$q = "UPDATE reviews SET name = ?, car = ?, review = ?, status = ?, date = ?, rate = ? WHERE id = ?";
	$qr = $dbh->prepare($q);
	$qr->execute(array($name, $car, $review, $status,$date, $rate, $_POST['id']));

	echo 'success';
}

if(isset($_POST['rr']))
{
	$q = "DELETE FROM reviews WHERE id = ?";
	$qr = $dbh->prepare($q);
	$qr->execute(array($_POST['id']));
}