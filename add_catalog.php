<?php

if($_SERVER["REQUEST_METHOD"] == 'POST'){
	$category = trim(strip_tags($_POST['title']));
	require_once 'db.php';
	$sql = "INSERT INTO catalog (`title`) VALUES (?)";
	
	if ($stmt = $mysqli->prepare($sql)) {
	    
		$stmt->bind_param('s', $category);
		$stmt->execute();
		$stmt->close();

		header("Location: catalog.php");
		exit;
	}
}

?>

<!DOCTYPE html>
	<html lang="RU">
	<head>
		<meta charset="UTF-8">
		<title>Добавить категорию</title>
	</head>
	<body>
		<form action="add_catalog.php" method="POST">
			<label for="inp">Название категории
			<input id="inp" type="text" name="title"></label><br>
			<input type="submit" value="Добавить">
		</form>
		<br>
		<a href="catalog.php">Вернуться к каталогу</a>
	</body>
	</html>