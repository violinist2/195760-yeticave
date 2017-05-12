<?php
session_start();
require_once 'functions.php';

$userdata = is_authorized();
if (empty($userdata)) {
    header('HTTP/1.1 403 incorrect user');
    exit(); 
  }
?>
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
connect_code('templates/header.php', $userdata);  

if (isset($_FILES['photo'])) {
  $file = $_FILES['photo'];
  $fileto = "img/".$file['name'];
  move_uploaded_file($file['tmp_name'], $fileto);
}

if ($file['name']=="") $fileto = "";

$_POST['form-sent'] = protect_code($_POST['form-sent']);
$_POST['lot-name'] = protect_code($_POST['lot-name']);
$_POST['category'] = protect_code($_POST['category']);
$_POST['message'] = protect_code($_POST['message']);
$_POST['lot-rate'] = protect_code($_POST['lot-rate']);
$_POST['lot-step'] = protect_code($_POST['lot-step']);
$_POST['lot-date'] = protect_code($_POST['lot-date']);

if (!is_numeric($_POST['lot-rate'])) {
  $_POST['lot-rate'] = "";
}

if (!is_numeric($_POST['lot-step'])) {
  $_POST['lot-step'] = "";
}

$connection = connect_data();
$sql = "SELECT * FROM categories ORDER BY id ASC;";
$categories = select_data($connection, $sql, '');

if (($_POST['lot-name']=='') || ($_POST['category']=='Выберите категорию') || ($_POST['lot-rate']=='') || ($_POST['message']=='') || ($_POST['lot-step']=='') || ($_POST['lot-date']=='') || ($fileto=='')) {
  connect_code('templates/add_form.php',
    [$categories, 
      ['form-sent' => $_POST['form-sent'],
    'file' => $fileto,
    'lot-name' => $_POST['lot-name'],
    'category' => $_POST['category'],
    'lot-rate' => $_POST['lot-rate'],
    'message' => $_POST['message'],
    'photo' => $_POST['photo'],
    'lot-step' => $_POST['lot-step'],
    'lot-date' => $_POST['lot-date']]]); 
} else {
  $items = [
        'itemsname' => $_POST['lot-name'],
        'category' => $_POST['category'], 
        'price' => $_POST['lot-rate'], 
        'image' => $fileto
        ]; 
  connect_code('templates/main_lot.php', [$categories, $items]); // потом разобраться, чтобы корректно отображал превью лота? или вообще это не нужно, если ок добавление
}

connect_code('templates/footer.php', $categories); 
?>

</body>
</html>