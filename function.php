<?php

function getPage($dbh, $id)
{
	$sql = "SELECT code FROM pages WHERE id = ?";
	$q = $dbh->prepare($sql);
	$q->execute(array($id));
	$res = $q->fetch();
	echo $res['code'];
}