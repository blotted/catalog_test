<?php

require_once '../connection.php';

$sql = "SELECT products.id, products.title, products.mark, products.count, products.description,
        catalog.title as category
        FROM products
        LEFT JOIN catalog ON products.id_catalog = catalog.id";

$result = $pdo->query($sql);
$records = $result->fetchAll(PDO::FETCH_ASSOC);
unset($pdo);

header("Content-Type: application/json");
echo json_encode($records);