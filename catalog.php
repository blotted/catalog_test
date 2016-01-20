<?php
 require_once 'db.php';

 $sql_catalog = "SELECT id, title FROM catalog";
 $res = $mysqli->query($sql_catalog);

 $catalog = $res->fetch_all(MYSQLI_ASSOC);

 echo "<a href=\"add_catalog.php\">Добавить категорию</a>";
 echo "<h1>Список категорий каталога</h1>";

 if(count($catalog)) {
    echo "<table style='border-collapse: collapse'>";

    foreach ($catalog as $value) {
        echo "<tr>
        <td style='padding: 5px; border: 1px solid #333;'><a href='catalog_items.php?category={$value['id']}'>{$value['title']}</a></td>
        <td style='padding: 5px; border: 1px solid #333;'><a href='catalog_delete.php?category={$value['id']}'>Удалить</a></td>
        </tr>";
    }

    echo "</table><hr />";
    echo "Всего категорий в магазине - ".count($catalog);	
 } else {
    echo "<p>Список пуст</p>";
 }