<?php

$title = $_POST['title'];
$mark = $_POST['mark'];
$count = (int)$_POST['count'];
$description = $_POST['description'];
$category = (int)$_POST['category'];

require_once '../connection.php';
$sql = "INSERT INTO products (title, count, mark, description, id_catalog)
        VALUES(:title, :count, :mark, :description, :category)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':count', $count, PDO::PARAM_INT);
$stmt->bindParam(':mark', $mark);
$stmt->bindParam(':description', $description, PDO::PARAM_STR);
$stmt->bindParam(':category', $category, PDO::PARAM_INT);

header("Content-Type: application/json");
$data = null;
if($stmt->execute()){
    $data = array(
        'result' => array(
            'status' => 0,
            'message' => 'OK',
            'data' => array(
                'title' => $title,
                'count' => $count,
                'mark' => $mark,
                'description' => $description
            )
        )
    );
} else {
    $data = array(
        'result' => array(
            'status' => 200,
            'message' => 'ERROR to database'
        )
    );
}

echo json_encode($data);