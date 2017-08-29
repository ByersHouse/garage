<?php

function getReviews($dbh)
{
	$q = "SELECT * FROM reviews ORDER BY id DESC LIMIT 8";
	$query = $dbh->prepare($q);
	$query->execute();
	$res = $query->fetchAll();

	return $res;
}

