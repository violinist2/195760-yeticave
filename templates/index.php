<?php
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
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
include_once('functions.php');
$user_name = strip_tags($user_name);
$user_avatar = strip_tags($user_avatar);
$data = [$is_auth, $user_name, $user_avatar];

connect_code('templates/header.php', $data);
connect_code('templates/main.php', '');
connect_code('templates/footer.php', '');
?>


</body>
</html>