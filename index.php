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
include_once('functions.php');

connect_code('templates/header.php', ''); 
connect_code('templates/main.php', [$product_category, $items, $lot_time_remaining]);
connect_code('templates/footer.php', '');

?>
</body>
</html>