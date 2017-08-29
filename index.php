<?php
session_start();



?>

<?php include 'header.php'; ?>
 <link rel="stylesheet" type="text/css" href="libs/tooltipster/css/tooltipster.bundle.min.css" />
<link rel="stylesheet" type="text/css" href="libs/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css" />


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

            getPage($dbh,1);

          ?>

          <?php include 'footer.php'; ?>