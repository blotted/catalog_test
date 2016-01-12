<?php

$category = (int) $_GET['category'];

if($category) {
	require_once 'db.php';
	$sql = "DELETE FROM catalog WHERE id = ?";

	if($stmt = $mysqli->prepare($sql)) {
		$stmt->bind_param('i', $category);
		$stmt->execute();
	}
}

header('HTTP/1.1 307 Temporary Redirect');
header('Location: catalog.php');
exit;