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
require_once 'functions.php';
require_once 'massive.php';
$users = is_authorized();
if (!empty($users)) $is_auth = true;
connect_code('templates/header.php', [$users, $is_auth]); 
connect_code('templates/main.php', [$product_category, $items, $lot_time_remaining]);
connect_code('templates/footer.php', '');

?>
</body>
</html>