<?php
session_start();
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
$userdata = is_authorized();
connect_code('templates/header.php', $userdata); 

$connection = connect_data();
$sql = "SELECT * FROM categories ORDER BY id ASC;";
$categories = select_data($connection, $sql, '');

$connection = connect_data(); // можно не закрывать соединение в функциях, конечно - и тогда не открывать заново, но, вроде, в документации по php так рекомендуют
$sql = "SELECT items.id, items.item_name, items.price_start, items.image_path, categories.category_name
FROM items JOIN categories ON items.category_id = categories.id
WHERE items.date_end > NOW() ORDER BY items.date_end DESC;";
$open_items = select_data($connection, $sql, '');
connect_code('templates/main.php', [$categories, $open_items]);
connect_code('templates/footer.php', $categories);
?>
</body>
</html>