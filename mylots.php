<?php
session_start();
require_once 'classes/Database.php';
require_once 'functions.php';
require_once 'classes/Authorization.php';
require_once 'classes/BaseFinder.php';
require_once 'classes/CategoryFinder.php';
require_once 'classes/BetFinder.php';
$auth = new Authorization;

if (!$auth->isAuthorized()) {
    header('HTTP/1.1 403 incorrect user');
    exit(); 
}
$userdata = $auth->getUserdata();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Мои ставки</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<?php
connect_code('templates/header.php', $userdata);  

$category = new CategoryFinder($connection);
$categories = $category->getCategories();

$bets = new BetFinder($connection);
$mybets = $bets->getBetsByUser($userdata['auth_user_id']);
connect_code('templates/main_mylots.php', [$mybets, $categories]);

connect_code('templates/footer.php', $categories);
?>
</body>
</html>