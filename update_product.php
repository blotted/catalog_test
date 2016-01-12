<?php

require_once 'db.php';

$id_product = abs ((int) $_POST['id']);
$id_catalog = abs ((int) $_POST['id_catalog']);

$count = abs ((int) $_POST['count']);
$title = trim(strip_tags($_POST['title']));
$mark = trim(strip_tags($_POST['mark']));
$description = trim(strip_tags($_POST['description']));

$sql = "UPDATE products SET title = ?, mark = ?, count = ?, description = ?, id_catalog = ?
		WHERE id = ?";

if($stmt = $mysqli->prepare($sql)) {

	$stmt->bind_param('ssisii', $title, $mark, $count, $description, $id_catalog, $id_product);
	$stmt->execute();

	header('HTTP/1.1 307 Temporary Redirect');
	header('Location: catalog_items.php?category='.$id_catalog);
	exit;
}
