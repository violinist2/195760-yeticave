<?php
require_once 'massive.php';
require_once 'functions.php';
$users = is_authorized(); // проверка, вошёл ли пользователь. Лишнее?
if (!empty($users)) {
    $is_auth = true;
  } else {
    header('HTTP/1.1 403 incorrect user');
    exit(); 
  }
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
connect_code('templates/header.php', [$users, $is_auth]);  

$mybets = json_decode($_COOKIE['mybets'], true);
connect_code('templates/main_mylots.php', [$items, $mybets]);

connect_code('templates/footer.php', '');
?>
</body>
</html>