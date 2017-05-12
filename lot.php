<?php 
session_start();
ob_start();
require_once 'functions.php';
$id = intval(protect_code($_GET['id']));

$connection = connect_data();
$sql = "SELECT items.item_name, items.description, items.image_path, categories.category_name, 
items.price_start, items.user_author_id, items.bet_step FROM items JOIN categories 
ON items.category_id = categories.id WHERE items.id = ?;";
$item_data = select_data($connection, $sql, [$id]);

if ($item_data==false) {
   header("Location: /", true, 404);
   exit(); 
}
$item_data = $item_data[0];

$userdata = is_authorized();
connect_code('templates/header.php', $userdata); 

if ($_POST['form-sent']) {
    $_POST['cost'] = protect_code($_POST['cost']);
    // проверить, все ли параметры введены и соответствуют
    // есть ли сумма ставки (корректно ли), не кончился ли лот, больше или равна ли сумма минимальной ставке
    $newbet = bet_save($_POST['cost'], $userdata['auth_user_id'], $id);
    // здесь будет проверка на сохранение?? или еще раз параметры ставки
    header("Location: /mylots.php");
    exit();
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=protect_code($item_data[0]); ?></title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
$connection = connect_data();
$sql = "SELECT id, category_name FROM categories ORDER BY id ASC;";
$categories = select_data($connection, $sql, '');

$connection = connect_data();
$sql = "SELECT users.username, bets.bet_amount, bets.date_betmade 
FROM bets JOIN users ON bets.user_id = users.id 
WHERE bets.item_id = ? ORDER BY bets.bet_amount DESC;";
$bets = select_data($connection, $sql, [$id]); 

if (empty($bets)) { // ставок нет, 
    $cost[0] = protect_code($item_data[4]); // текущая цена - стартовая
    $cost[1] = $cost[0]; // можно купить по текущей цене (сделать ставку, равную текущей)
} else {
    $cost[0] = protect_code($bets[0][1]); // текущая цена = максимальная из ставок
    $cost[1] = $cost[0] + protect_code($item_data[6]); // минимальная новая ставка = максимальная из поставленных + шаг ставки
}

connect_code('templates/main_lot.php', [$categories, $bets, $userdata, $item_data, $cost, $id]);
connect_code('templates/footer.php', $categories);
?>
</body>
</html>