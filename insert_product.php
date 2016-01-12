<?php
require_once 'db.php';

$id_catalog = abs ((int) $_POST['id_catalog']);
$count = abs ((int) $_POST['count']);
$title = trim(strip_tags($_POST['title']));
$mark = trim(strip_tags($_POST['mark']));
$description = trim(strip_tags($_POST['description']));

$sql = "INSERT INTO products(title, mark, count, description, id_catalog)
		VALUES (?, ?, ?, ?, ?)";

if($stmt = $mysqli->prepare($sql)) {

	$stmt->bind_param('ssisi', $title, $mark, $count, $description, $id_catalog);
	$stmt->execute();

	header('HTTP/1.1 307 Temporary Redirect');
	header('Location: catalog_items.php?category='.$id_catalog);
	exit;
}
