<?php
// session_start(); // будем считать, что на страницу регистрации может попасть только неавторизованный?
ob_start();
require_once 'functions.php';

$form_errors = [];
if ($_POST['form-sent']) {
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    $_POST['email'] = protect_code($_POST['email']);
    $_POST['password'] = protect_code($_POST['password']);
    $_POST['name'] = protect_code($_POST['name']);
    $_POST['message'] = protect_code($_POST['message']);
    $_POST['form-sent'] = protect_code($_POST['form-sent']);
    if (empty($_POST['email']) or (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)==false)) { // если почта не указана или указана некорректно
        $form_errors['email'] = 'Введите корректный адрес электронной почты.';
    } else {
        if (!empty(email_used($_POST['email']))) $form_errors['email'] = 'Этот адрес уже использован при регистрации на сайте.';
    }
    if (empty($_POST['password'])) $form_errors['password'] = 'Придумайте и укажите пароль.';
    if (empty($_POST['name'])) $form_errors['name'] = 'Укажите своё имя, оно будет отображаться на сайте.';
    if (empty($_POST['message'])) $form_errors['message'] = 'Нужно указать ваши контактные данные для покупателей.';
    if (empty($form_errors)) { // если ошибок никаких нет
        // загрузка аватара на сервер ведь должна происходить, если других ошибок формы нет?
        if (isset($_FILES['avatar'])) {
            // здесь будет проверка, является ли аватар изображением!
            $file = $_FILES['avatar'];
            $fileto = "img/users/".$file['name']; // а вдруг пользователь в название файла инъекцию умудрится записать? или вряд ли?
            // !! менять имя согласно ID пользователя! и в лотах аналогично!
            move_uploaded_file($file['tmp_name'], $fileto);
        }
        if ($file['name']=="") $fileto = ""; // если файла нет, пустая переменная для аватара
        // записываем пользователя в базу
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);// хэш пароля
        $connection = connect_data();
        $sql = "INSERT INTO users SET id = NULL, date_register = NOW(), email = ?, username = ?, password = ?, avatar_path = ?, contacts = ?;";
        $insert = insert_data($connection, $sql, [$_POST['email'], $_POST['name'], $password_hash, $fileto, $_POST['message']]);
        // добавить проверку, успешно ли записаны данные в базу? где и какое сообщение в случае ошибки добавления в базу показать?
        session_start();
        $_SESSION['user'] = ['new' => true]; // метка о новом пользователе пишется в сессию
        header("Location: /login.php");
        exit(); // сценарий закончен: регистрация успешна, перешли на логин с приветствием новому пользователю
    }
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<?php
connect_code('templates/header.php', ''); // хедер для неавторизованного, ведь авторизованный на регистрацию не должен придти?

$connection = connect_data();
$sql = "SELECT * FROM categories ORDER BY id ASC;";
$categories = select_data($connection, $sql, '');

$form_olddata = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'name' => $_POST['name'],
    'message' => $_POST['message']
]; // и здесь загруженный аватар всё-таки?

connect_code('templates/main_sign-up_form.php', [$categories, $form_errors, $form_olddata]);

connect_code('templates/footer.php', $categories); 
?>

</body>
</html>