<?php 
require_once 'massive.php';
$id = htmlspecialchars(strip_tags(trim($_GET['id'])));
if ($items[$id]=="") {
   header("Location: /", true, 404);
   exit(); 
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>DC Ply Mens 2016/2017 Snowboard</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
require_once 'functions.php';

connect_code('templates/header.php', '');
connect_code('templates/main_lot.php', [$bets, $items[$id]]);
connect_code('templates/footer.php', '');
?>
</body>
</html>