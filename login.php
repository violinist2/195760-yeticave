<?php 
session_start();
require_once 'functions.php';
$_POST['form-sent'] = protect_code($_POST['form-sent']);
$_POST['email'] = protect_code($_POST['email']);
$_POST['password'] = protect_code($_POST['password']);
ob_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Вход</title>
  <link href="css/normalize.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
$connection = connect_data();
$sql = "SELECT * FROM categories ORDER BY id ASC;";
$categories = select_data($connection, $sql, '');

if ($_POST['email']=='' || $_POST['password']=='') { // вывод формы с ошибкой ввода данных в форму (нет логина, пароля, или того и другого)
    ob_end_flush();
    connect_code('templates/header.php', '');
    connect_code('templates/main_login.php', [$categories, 
    ['form-sent' => $_POST['form-sent'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'password_incorrect' => false
    ]]);
} else { // если логин и пароль введены пользователем
    $connection = connect_data();
    $sql = "SELECT id, username, password, avatar_path FROM users WHERE email = ? LIMIT 0,1;";
    $found_user = select_data($connection, $sql, [$_POST['email']]);
    if (!empty($found_user) and password_verify($_POST['password'], $found_user[0][2])) { // пользователь найден, введенный пароль найденного пользователя совпадает с хэшем из базы
        $_SESSION['user'] = [  // в сессии будем хранить по-минимуму
            'auth_user_id' => $found_user[0][0],
            'auth_username' => $found_user[0][1],
            'auth_avatar_path' => $found_user[0][3]           
            ];
        header("Location: /");
        exit(); // раз авторизация успешна, редиректим на главную и досрочно завершаем этот сценарий
    } 
    // вызов формы заново с сообщением об ошибке, будто бы пароль неверный (хотя может быть, что и пользователя такого нет)
    ob_end_flush();
    connect_code('templates/header.php', '');
    connect_code('templates/main_login.php', [$categories, 
    ['form-sent' => $_POST['form-sent'],
    'email' => $_POST['email'], // введенный в форму логин всегда отображается снова. Будто бы пользователь такой в любом случае есть, но только пароль его неверен
    'password' => $_POST['password'], // введённый в форму неверный пароль отображается снова, в явном виде. Зачем? Кто знает. В задании неясно.
    'password_incorrect' => true
    ]]);        
}

connect_code('templates/footer.php', $categories);
?>
</body>
</html>