<?php
require_once '../connection.php';

$sql = "SELECT * FROM catalog";
$result = $pdo->query($sql);
$categories = $result->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT products.id, products.title, products.mark, products.count, products.description,
        catalog.title as category
        FROM products
        LEFT JOIN catalog ON products.id_catalog = catalog.id";

$products_records = $pdo->query($sql);
$products = $products_records->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление товара в каталог</title>
    <link rel="stylesheet" href="../jslibs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../jslibs/bootstrap/dist/css/bootstrap-theme.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="addproduct" action="" method="post">
                            <div class="form-group">
                                <label for="name">Название товара</label>
                                <input type="text" class="form-control" id="name" name="title" placeholder="Укажите название товара">
                            </div>

                            <div class="form-group">
                                <label for="count">Количество товара</label>
                                <input type="text" class="form-control" id="count" name="count" placeholder="Укажите количество товара">
                            </div>

                            <div class="form-group">
                                <label for="mark">Марка товара</label>
                                <input type="text" class="form-control" id="mark" name="mark" placeholder="Укажите марку товара">
                            </div>

                            <div class="form-group">
                                <label for="mark">Категория товара товара</label>
                                <select name="category" class="form-control">
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?php echo $category['id'] ?>"><?php echo $category['title']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Описание товара</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-success" value="Добавить товар">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead style="background-color: #d2e8ff">
                            <th>Название товара</th>
                            <th>Марка товара</th>
                            <th>Количество товара</th>
                            <th>Описание товара</th>
                            </thead>
                            <tbody id="tablecontent">
                                <?php foreach($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['title']; ?></td>
                                    <td><?php echo $product['mark']; ?></td>
                                    <td><?php echo $product['count']; ?></td>
                                    <td><?php echo $product['description']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../jslibs/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#addproduct').on({
                'submit': function(e){
                    e.preventDefault();

                    var formdata = $(this).serialize();
                    $.ajax({
                        url: 'addcategory.php',
                        type: 'post',
                        data: formdata,
                        dataType: 'json',
                        success: function(dataSuccess){
                            if(dataSuccess.result.status == 0){
                                alert("Toвар успешно добавлен в БД");
                                var item = '<tr>';
                                item += '<td>' + dataSuccess.result.data.title + '</td>';
                                item += '<td>' + dataSuccess.result.data.mark + '</td>';
                                item += '<td>' + dataSuccess.result.data.count + '</td>';
                                item += '<td>' + dataSuccess.result.data.description + '</td>';
                                item += '</tr>';

                                $('#tablecontent').prepend(item);

                            } else {
                                alert(dataSuccess.result.message);
                            }

                            $("#addproduct").trigger('reset');
                        }

                    });
                }
            });

        });
    </script>
</body>
</html>