<?php
session_start();
require_once 'classes/Database.php';
require_once 'functions.php';
require_once 'classes/Authorization.php';
require_once 'classes/BaseFinder.php';
require_once 'classes/CategoryFinder.php';
require_once 'classes/ItemFinder.php';
$auth = new Authorization;
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
$category = new CategoryFinder($connection);
$categories = $category->getCategories();

$userdata = $auth->getUserdata();
connect_code('templates/header.php', $userdata); 

$items = new ItemFinder($connection);
$open_items = $items->getOpenItems();
connect_code('templates/main.php', [$categories, $open_items]);
connect_code('templates/footer.php', $categories);
?>
</body>
</html>