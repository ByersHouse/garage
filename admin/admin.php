<?php

session_start();

/* Connect to a MySQL database using driver invocation */
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

include 'fnc.php';

function checkLogin($dbh,$login,$pass)
{
	$sql = "SELECT * FROM users WHERE login = ? && password = ?";
	$q = $dbh->prepare($sql);
	$q->execute(array($login, md5(sha1($pass))));

	$res = $q->fetchAll();

	return $res;
}


if(isset($_POST['login']))
{
	$login = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
	$pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);

	if($login && $pass)
	{
		$check = checkLogin($dbh,$login, $pass);
		if($check)
		{
			$user_id = $check[0]["id"];
			$_SESSION['user_id'] = $user_id;
			echo 'success';
			exit();
		}
		else
		{
			echo 'fail';
			exit();
		}
	}
}




$action = $_GET['action'];

function checkRoute()
{
	if(isset($_SESSION['user_id']))
	{
		return true;
	}else{
		header("Location: /last/admin/admin.php?action=login");
	}
}

function defaultAction()
{
	echo 'its default action';
}

function indexAction()
{
	$html = file_get_contents("_index.php");
	echo $html;
}

function reviewsAction($dbh)
{
	if(isset($_GET['review_id']))
	{
		$header =  file_get_contents("_header.php");
		$footer =  file_get_contents("_footer.php");

		$q = $dbh->prepare("SELECT * FROM reviews WHERE id = ?");
		$q->execute(array($_GET['review_id']));
		$res = $q->fetch();
		$selected1;
		$selected2;
		$selected3;
		$selected4;
		$selected5;
		$selected6;
		$selected7;

		switch($res['rate'])
		{
			case '1':
			$selected1 = 'selected';
			break;

			case '2':
			$selected2 = 'selected';
			break;

			case '3':
			$selected3 = 'selected';
			break;

			case '4':
			$selected4 = 'selected';
			break;

			case '5':
			$selected5 = 'selected';
			break;
		}
		switch($res['status'])
		{
			case '0':
			$selected6 = 'selected';
			break;
			case '1':
			$selected7 = 'selected';
			break;
		}

		echo $header;
		echo '<div class="row"><div class="col-md-12"><div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Редактировать отзыв</h3>
            </div>
            <div class="box-body">
             	<div class="form-group">
                  <label for="revName">Имя</label>
                  <input type="text" class="form-control" id="revName" placeholder="Введите имя" value="'.$res['name'].'">
                </div>
                <div class="form-group">
                  <label for="revAuto">Авто</label>
                  <input type="text" class="form-control" id="revAuto" placeholder="Введите марку и модель авто" value="'.$res['car'].'">
                </div>
                <div class="form-group">
                  <label for="revReview">Отзыв</label>
                  <textarea class="form-control" id="revReview" placeholder="Ваш отзыв">'.$res['review'].'</textarea>
                </div>
                <div class="form-group">
                  <label for="revRate">Оценка</label>
                  <select class="form-control" id="revRate">
                  <option value="1" '.$selected1.'>1</option><option value="2" '.$selected2.'>2</option><option value="3" '.$selected3.'>3</option><option value="4" '.$selected4.'>4</option><option value="5" '.$selected5.'>5</option></select>
                </div>
                <div class="form-group">
                  <label for="revDate">Дата</label>
                  <input type="text" class="form-control" id="revDate" placeholder="Дата отзыва" value="'.$res['date'].'">
                </div>
                 <div class="form-group">
                  <label for="revStatus">Статус</label>
                  <select class="form-control" id="revStatus">
                  <option value="0" '.$selected6.'>Выкл</option><option value="1" '.$selected7.'>Вкл</option></select>
                </div>
                 <div class="form-group">
                 <a href="javascript:;" class="btn btn-success" onclick="updateReview('.$res['id'].')">Обновить отзыв</a> <a href="javascript:;" class="btn btn-danger" onclick="deleteReview('.$res['id'].')">Удалить отзыв</a>
                 </div>

            </div>
            <!-- /.box-body -->
          </div></div></div>';
		echo $footer;
	}else
	{
		$header =  file_get_contents("_header.php");
	$footer =  file_get_contents("_footer.php");
	echo $header;

	$reviews = getReviews($dbh);

	echo '<div class="row">
	<div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Отзывы</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Имя</th>
                  <th>Email</th>
                  <th>Отзыв</th>
                  <th>Дата</th>
                  <th>Статус</th>
                  <th>Действия</th>
                </tr>
                ';
                foreach($reviews as $review)
                {
                	if(!$review['status'])
                	{
                		$selected0 = '<span style="cursor:pointer" class="btn btn-danger">Выкл<span>';
                		
                	}
                	else
                	{
                		
                		$selected0 = '<span style="cursor:pointer" class="btn btn-success">Вкл<span>';
                	}

                	echo '<tr><td>'.$review['id'].'</td>
                	<td>'.$review['name'].'</td>
                	<td>'.$review['email'].'</td>
                	<td>'.$review['review'].'</td>
                	<td>'.$review['date'].'</td>
                	<td>'.$selected0.'</td>
                	<td><a href="/last/admin/admin.php?action=reviews&review_id='.$review['id'].'" data-id="'.$review['id'].'" class="btn btn-warning">редактировать</a></td>';
                }
  echo '
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <!--<div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>-->
          </div>
          <!-- /.box -->

        </div></div>';


	echo $footer;
	}
	
}

function homeAction($dbh)
{
	$header =  file_get_contents("_header.php");
	$footer =  file_get_contents("_footer.php");
	$q = $dbh->prepare("SELECT * FROM pages WHERE id = ?");
	$q->execute(array(1));
	$res = $q->fetch();
	echo $header;
	echo '<div class="form-group">
                  <label for="exampleInputEmail1">META TITLE</label>
                  <input type="email" class="form-control" value="'.$res['title'].'" id="metaTitle" placeholder="Meta Title">
                </div>';

                echo '<div class="form-group">
                  <label for="exampleInputEmail1">META DESCRIPTION</label>
                  <input type="email" class="form-control" value="'.$res['decsription'].'" id="metaDescr" placeholder="Meta Description">
                </div>';
	echo ' <textarea name="editor1" id="editor1" rows="10" cols="80">'.$res['code'].'</textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( "editor1" );
            </script>';
    echo '<br><a class="btn btn-success" onclick="update(1);">Сохранить изменения</a>';
	echo $footer;
}

function faqAction($dbh)
{
	$header =  file_get_contents("_header.php");
	$footer =  file_get_contents("_footer.php");
	$q = $dbh->prepare("SELECT * FROM pages WHERE id = ?");
	$q->execute(array(2));
	$res = $q->fetch();
	echo $header;
	echo '<div class="form-group">
                  <label for="exampleInputEmail1">META TITLE</label>
                  <input type="email" class="form-control" value="'.$res['title'].'" id="metaTitle" placeholder="Meta Title">
                </div>';

                echo '<div class="form-group">
                  <label for="exampleInputEmail1">META DESCRIPTION</label>
                  <input type="email" class="form-control" value="'.$res['decsription'].'" id="metaDescr" placeholder="Meta Description">
                </div>';
	echo ' <textarea name="editor1" id="editor1" rows="10" cols="80">'.$res['code'].'</textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( "editor1" );
            </script>';
    echo '<br><a class="btn btn-success" onclick="update(2);">Сохранить изменения</a>';
	echo $footer;
}

function plansAction($dbh)
{
	$header =  file_get_contents("_header.php");
	$footer =  file_get_contents("_footer.php");
	$q = $dbh->prepare("SELECT * FROM pages WHERE id = ?");
	$q->execute(array(3));
	$res = $q->fetch();
	echo $header;
	echo '<div class="form-group">
                  <label for="exampleInputEmail1">META TITLE</label>
                  <input type="email" class="form-control" value="'.$res['title'].'" id="metaTitle" placeholder="Meta Title">
                </div>';

                echo '<div class="form-group">
                  <label for="exampleInputEmail1">META DESCRIPTION</label>
                  <input type="email" class="form-control" value="'.$res['decsription'].'" id="metaDescr" placeholder="Meta Description">
                </div>';
	echo ' <textarea name="editor1" id="editor1" rows="10" cols="80">'.$res['code'].'</textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( "editor1" );
            </script>';
    echo '<br><a class="btn btn-success" onclick="update(3);">Сохранить изменения</a>';
	echo $footer;
}

function odAction($dbh)
{
	$header =  file_get_contents("_header.php");
	$footer =  file_get_contents("_footer.php");
	$q = $dbh->prepare("SELECT * FROM pages WHERE id = ?");
	$q->execute(array(5));
	$res = $q->fetch();
	echo $header;
	echo '<div class="form-group">
                  <label for="exampleInputEmail1">META TITLE</label>
                  <input type="email" class="form-control" value="'.$res['title'].'" id="metaTitle" placeholder="Meta Title">
                </div>';

                echo '<div class="form-group">
                  <label for="exampleInputEmail1">META DESCRIPTION</label>
                  <input type="email" class="form-control" value="'.$res['decsription'].'" id="metaDescr" placeholder="Meta Description">
                </div>';
	echo ' <textarea name="editor1" id="editor1" rows="10" cols="80">'.$res['code'].'</textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( "editor1" );
            </script>';
    echo '<br><a class="btn btn-success" onclick="update(5);">Сохранить изменения</a>';
	echo $footer;
}



function contactsAction($dbh)
{
	$header =  file_get_contents("_header.php");
	$footer =  file_get_contents("_footer.php");
	$q = $dbh->prepare("SELECT * FROM pages WHERE id = ?");
	$q->execute(array(4));
	$res = $q->fetch();
	echo $header;
	echo '<div class="form-group">
                  <label for="exampleInputEmail1">META TITLE</label>
                  <input type="email" class="form-control" value="'.$res['title'].'" id="metaTitle" placeholder="Meta Title">
                </div>';

                echo '<div class="form-group">
                  <label for="exampleInputEmail1">META DESCRIPTION</label>
                  <input type="email" class="form-control" value="'.$res['decsription'].'" id="metaDescr" placeholder="Meta Description">
                </div>';
	echo ' <textarea name="editor1" id="editor1" rows="10" cols="80">'.$res['code'].'</textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( "editor1" );
            </script>';
    echo '<br><a class="btn btn-success" onclick="update(4);">Сохранить изменения</a>';
	echo $footer;
}


function loginAction()
{
	if(!isset($_SESSION['user_id']))
	{
		$html = file_get_contents("login.html");
		echo $html;
	}
	else
	{
		header("Location: /last/admin/admin.php?action=index");
	}
}


if($action)
{
	switch($action)
	{
		case 'index':
		checkRoute();
		indexAction();
		break;

		case 'login':
		loginAction();
		break;

		case 'reviews':
		reviewsAction($dbh);
		break;


		case 'home':
		homeAction($dbh);
		break;

		case 'plans':
		plansAction($dbh);
		break;

		case 'contacts':
		contactsAction($dbh);
		break;

		case 'od':
		odAction($dbh);
		break;

		case 'faq':
		faqAction($dbh);
		break;

		default:
		checkRoute();
		defaultAction();
		break;
	}
}
else
{
	echo '404';
}





?>