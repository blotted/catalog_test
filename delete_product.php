<?php

$product = (int) $_GET['product'];
$catalog = (int) $_GET['catalog'];

if($product) {
	require_once 'db.php';
	$sql = "DELETE FROM products WHERE id = ?";

	if($stmt = $mysqli->prepare($sql)) {
		$stmt->bind_param('i', $product);
		$stmt->execute();
	}
}

header('HTTP/1.1 307 Temporary Redirect');
header('Location: catalog_items.php?category='.$catalog);
exit;
