<?php
session_start();
ob_start();
require_once 'classes/Database.php';
require_once 'functions.php';
require_once 'classes/Authorization.php';
require_once 'classes/BaseFinder.php';
require_once 'classes/CategoryFinder.php';
require_once 'classes/ItemFinder.php';
require_once 'classes/BetFinder.php';
require_once 'classes/BaseRecord.php';
require_once 'classes/BetRecord.php';
$auth = new Authorization;

$id = intval(protect_code($_GET['id']));

$items = new ItemFinder($connection);
$item_data = $items->getItemData($id);
if ($item_data==false) {
   header("Location: /", true, 404);
   exit();
}
$item_data = $item_data[0];

$userdata = $auth->getUserdata();
connect_code('templates/header.php', $userdata);

$bet = new BetFinder($connection);
$bets = $bet->getBetsByItem($id);
if (empty($bets)) { // ставок нет,
    $cost[0] = protect_code($item_data[4]); // текущая цена - стартовая
    $cost[1] = $cost[0]; // можно купить по текущей цене (сделать ставку, равную текущей)
} else {
    $cost[0] = protect_code($bets[0][1]); // текущая цена = максимальная из ставок
    $cost[1] = $cost[0] + protect_code($item_data[6]); // минимальная новая ставка = максимальная из поставленных + шаг ставки
}

if ($_POST['form-sent']) {
    $_POST['cost'] = protect_code($_POST['cost']);
    // проверяем, все ли параметры введены и соответствуют: авторизация, ставка, целое ли число ставка, больше ли минимальной ставки
    if (!empty($userdata['auth_user_id']) && !empty($_POST['cost']) && (intval($_POST['cost'])>0) && intval($_POST['cost'])>=intval($cost[1])) {
        // не кончился ли лот тем временем - тоже надо проверить бы? в идеале?
        $betdata = new BetRecord($connection); // здесь $connection есть
        $newbet = $betdata->betSave($_POST['cost'], $userdata['auth_user_id'], $id); // а здесь $connection уже куда-то пропадает...
        // здесь будет проверка на сохранение??
        header("Location: /lot.php?id=".$id); // редирект временно отключен
        exit();
    }
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
$category = new CategoryFinder($connection);
$categories = $category->getCategories();

connect_code('templates/main_lot.php', [$categories, $bets, $userdata, $item_data, $cost, $id]);
connect_code('templates/footer.php', $categories);
?>
</body>
</html>
