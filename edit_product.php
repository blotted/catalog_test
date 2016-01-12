<?php
require_once 'db.php';

$product = (int) $_GET['product'];

$sql = "SELECT id, title, mark, count, description, id_catalog
		FROM products
		WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $product);
$stmt->execute();

$res = $stmt->get_result();
$row = $res->fetch_row();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Редактирование товара</title>
	<style type="text/css">
		div{margin-bottom: 10px;}
	</style>
</head>
<body>
	<form action="update_product.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="id_catalog" value="<?php echo $row[5]; ?>">
		<div>
			<label for="title">Название товара</label>
			<input id="title" type="text" name="title" value="<?php echo $row[1]; ?>">
		</div>
		<div>
			<label for="mark">Марка товара</label>
			<input id="mark" type="text" name="mark" value="<?php echo $row[2]; ?>">
		</div>
		<div>
			<label for="count">Количество товара</label>
			<input id="count" type="text" name="count" value="<?php echo $row[3]; ?>">
		</div>
		<div>
			<label for="desc">Описание товара</label><br>
			<textarea id="desc" rows="10" cols="45" name="description"><?php echo $row[4]; ?></textarea>
		</div>
		<div>
			<input type="submit" value="Редактировать товар">
		</div>
	</form>
</body>
</html>