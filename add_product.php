<?php
$cat = (int) $_GET['category'];

if(!$cat) {
	header('HTTP/1.1 307 Temporary Redirect');
	header('Location: catalog.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Добавление товаров</title>
	<style type="text/css">
		div{margin-bottom: 10px;}
	</style>
</head>
<body>
	<form action="insert_product.php" method="POST">
		<div>
			<label for="title">Название товара</label>
			<input id="title" type="text" name="title">
		</div>
		<div>
			<label for="mark">Марка товара</label>
			<input id="mark" type="text" name="mark">
		</div>
		<div>
			<label for="count">Количество товара</label>
			<input id="count" type="text" name="count">
		</div>
		<div>
			<label for="desc">Описание товара</label><br>
			<textarea id="desc" rows="10" cols="45" name="description"></textarea>
		</div>
		<input type="hidden" name="id_catalog" value="<?php echo $cat; ?>">
		<div>
			<input type="submit" value="Добавить продукт">
		</div>
	</form>
	<a href="catalog_items.php?category=<?php echo $cat; ?>">Вернуться к списку товаров</a>
</body>
</html>