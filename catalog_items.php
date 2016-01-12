<?php

$category = (int) $_GET['category'];
echo "<a href='add_product.php?category={$category}'>Добавить продукт</a><br><br>";
if($category) { 
	require_once 'db.php';

	$sql = "SELECT products.id, products.title, products.mark, products.count, products.description, products.id_catalog 
			FROM products 
			WHERE products.id_catalog = ?";
	
	if ($stmt = $mysqli->prepare($sql)) {
	    
		$stmt->bind_param('i', $category);
		$stmt->execute();
		$res = $stmt->get_result();

		if($res->num_rows) {
			$products = $res->fetch_all(MYSQLI_ASSOC);
			

			echo <<<TABLE
			<table border='1'>
				<thead>
					<th>Название товара</th>
					<th>Марка</th>
					<th>Количество (шт.)</th>
					<th>Описание</th>
					<th></th>
				</thead>
				<tbody>		
TABLE;
			foreach ($products as $product) {
				echo "<tr>
					<td>{$product['title']}</td>
					<td style='text-align: center;'>{$product['mark']}</td>
					<td style='text-align: center;'>{$product['count']}</td>
					<td>{$product['description']}</td>
					<td>
					<a href='edit_product.php?product={$product['id']}'>Редактировать</a>&nbsp;
					<a href='delete_product.php?product={$product['id']}&catalog={$category}'>Удалить</a>
					</td>
				</tr>";
			}

			echo <<<ENDTABLE
			</tbody>
			</table><br>
ENDTABLE;
		} else {
			echo "Нет товара.<br><br>";
		}
	}
} else {
	echo "Нет товара.<br><br>";
}
	echo "<a href='catalog.php'>Вернуться к каталогу</a>";