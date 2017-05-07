<?php 
require_once 'functions.php';
require_once 'userdata.php';
$_POST['form-sent'] = protect_code($_POST['form-sent']);
$_POST['email'] = protect_code($_POST['email']);
$_POST['password'] = protect_code($_POST['password']);
$auth = false;
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
if ($_POST['email']=='' || $_POST['password']=='') { // вывод формы с ошибкой ввода данных в форму (нет логина, пароля, или того и другого)
    ob_end_flush();
    connect_code('templates/header.php', '');
    connect_code('templates/main_login.php', 
    ['form-sent' => $_POST['form-sent'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'password_incorrect' => false
    ]);
} else { // если логин и пароль введены пользователем
    $found_user = array_search($_POST['email'], array_column($users, 'email')); // есть ли пользователь с такой почтой в базе, получить его номер в базе
    if (password_verify($_POST['password'], $users[$found_user]['password'])) { // введенный пароль найденного пользователя совпадает с хэшем из базы
        $name   = "authorized_user"; // уникальное имя куки
        $value  = $found_user; // значение куки, мы кладем туда ключ авторизованного пользователя (вообще, из задания неясно, что надо в куку сохранять)
        $expire =  time()+86400*30; // хранить 30 суток, ну просто так, в задании не конкретизировано
        $path   = "/"; // устанавливаем на весь сайт
        setcookie($name, $value, $expire, $path);
        header("Location: /");
        exit(); // раз авторизация успешна, редиректим на главную и досрочно завершаем этот сценарий
    }    
    // вызов формы заново с сообщением об ошибке, будто бы пароль неверный (хотя может быть, что и пользователя такого нет)
    ob_end_flush();
    connect_code('templates/header.php', '');
    connect_code('templates/main_login.php', 
    ['form-sent' => $_POST['form-sent'],
    'email' => $_POST['email'], // введенный в форму логин всегда отображается снова. Будто бы пользователь такой в любом случае есть, но только пароль его неверен
    'password' => $_POST['password'], // введённый в форму неверный пароль отображается снова, в явном виде. Зачем? Кто знает. В задании неясно.
    'password_incorrect' => true
    ]);        
}

connect_code('templates/footer.php', '');
?>

</body>
</html>