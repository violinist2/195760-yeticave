<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Добавление лота</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<?php
require_once 'functions.php';
connect_code('templates/header.php', ''); 

if (isset($_FILES['photo'])) {
  $file = $_FILES['photo'];
  $fileto = "img/".$file['name'];
  move_uploaded_file($file['tmp_name'], $fileto);
}

if ($file['name']=="") $fileto = "";

// if (isset($_POST)) echo "Форма отправлена!"; эта проверка не работает корректно почему-то и вообще не проверяется isset

$_POST['lot-name'] = htmlspecialchars(strip_tags(trim($_POST['lot-name'])));
$_POST['category'] = htmlspecialchars(strip_tags(trim($_POST['category'])));
$_POST['message'] = htmlspecialchars(strip_tags(trim($_POST['message'])));
$_POST['lot-rate'] = htmlspecialchars(strip_tags(trim($_POST['lot-rate'])));
$_POST['lot-step'] = htmlspecialchars(strip_tags(trim($_POST['lot-step'])));
$_POST['lot-date'] = htmlspecialchars(strip_tags(trim($_POST['lot-date'])));

if (!is_numeric($_POST['lot-rate'])) {
  $_POST['lot-rate'] = "";
}

if (!is_numeric($_POST['lot-step'])) {
  $_POST['lot-step'] = "";
}

if (($_POST['lot-name']=='') or ($_POST['category']=='Выберите категорию') or ($_POST['lot-rate']=='') or ($_POST['message']=='') or ($_POST['lot-step']=='') or ($_POST['lot-date']=='') or ($fileto=='')) {
  connect_code('templates/add_form.php', ['form-sent' => $_POST['form-sent'], 'file' => $fileto, 'lot-name' => $_POST['lot-name'], 'category' => $_POST['category'], 'lot-rate' => $_POST['lot-rate'], 'message' => $_POST['message'], 'photo' => $_POST['photo'], 'lot-step' => $_POST['lot-step'], 'lot-date' => $_POST['lot-date']]); 
} else {
  $items = [
        'itemsname' => $_POST['lot-name'],
        'category' => $_POST['category'], 
        'price' => $_POST['lot-rate'], 
        'image' => $fileto
        ]; 
  connect_code('templates/main_lot.php', [$bets, $items]);
}

connect_code('templates/footer.php', ''); 
?>

</body>
</html>