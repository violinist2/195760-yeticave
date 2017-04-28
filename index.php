<!--//
// устанавливаем часовой пояс в Московское время
//date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
//$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
//$tomorrow = strtotime('tomorrow midnight');
// временная метка для настоящего времени
//$now = time();
// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
// ...

// $lot_time_remaining = date('H:i' ,$tomorrow - $now - 3600 * 3);


// $product_category = [
//     'Доски и лыжи', 
//     'Крепления', 
//     'Ботинки', 
//     'Одежда', 
//     'Инструменты', 
//     'Разное'
// ]; 
// $items = [
//     [
//         'itemsname' => '2014 Rossignol District Snowboard',
//         'category' => 'Доски и лыжи', 
//         'price' => '10999', 
//         'image' => 'img/lot-1.jpg'
//     ], 
//     [
//         'itemsname' => 'DC Ply Mens 2016/2017 Snowboard',
//         'category' =>'Доски и лыжи',
//         'price' => '159999', 
//         'image' => 'img/lot-2.jpg'
//     ], 
//     [
//         'itemsname' => 'Крепления Union Contact Pro 2015 года размер L/XL',
//         'category' => 'Крепления',
//         'price' => '8000',
//         'image' => 'img/lot-3.jpg'
//      ],
//     [
//         'itemsname' => 'Ботинки для сноуборда DC Mutiny Charocal',
//         'category' => 'Ботинки',
//         'price' => '10999',
//         'image' => 'img/lot-4.jpg'
//      ], 
//     [
//         'itemsname' => 'Куртка для сноуборда DC Mutiny Charocal',
//         'category' => 'Одежда',
//         'price' => '7500', 
//         'image' => 'img/lot-5.jpg'
//     ],
//     [
//         'itemsname' => 'Маска Oakley Canopy',
//         'category' => 'Разное',
//         'price' => '5400', 
//         'image' => 'img/lot-6.jpg'
//     ]
// ];-->

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
// $items = strip_tags($items);
// $product_category = strip_tags($product_category);
// $now = strip_tags($now);
// $tomorrow = strip_tags($tomorrow);
// $lot_time_remaining = strip_tags($lot_time_remaining);

$data = [$lot_time_remaining, $tomorrow, $now, $product_category, $items];

connect_code('templates/header.php', $data);
connect_code('templates/main.php',['product_category' => $product_category, 'category' => $items]);
connect_code('templates/footer.php', '');
?>






</body>
</html>