<?php
date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');
// временная метка для настоящего времени
$now = time();
$lot_time_remaining = date('H:i' ,$tomorrow - $now - 3600 * 3);

$is_auth = (bool) rand(0, 1);
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$product_category = [
    'Доски и лыжи', 
    'Крепления', 
    'Ботинки', 
    'Одежда', 
    'Инструменты', 
    'Разное'
]; 

$items = [
    [
        'itemsname' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи', 
        'price' => '10999', 
        'image' => 'img/lot-1.jpg'
    ], 
    [
        'itemsname' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' =>'Доски и лыжи',
        'price' => '159999', 
        'image' => 'img/lot-2.jpg'
    ], 
    [
        'itemsname' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'image' => 'img/lot-3.jpg'
     ],
    [
        'itemsname' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => '10999',
        'image' => 'img/lot-4.jpg'
     ], 
    [
        'itemsname' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => '7500', 
        'image' => 'img/lot-5.jpg'
    ],
    [
        'itemsname' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5400', 
        'image' => 'img/lot-6.jpg'
    ]
];

$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

function convertTime($time_lot) {
  $now = time();
  if ($now - $time_lot < 86400) {  
      if ($now - $time_lot < 3600 * 24 and $now - $time_lot < 3600) {   
        return intval(date('i', $time_lot)).' минут назад';
      } elseif ($now - $time_lot < 3600 * 24 and $now - $time_lot > 3600) {
        return date('G'.' часов назад', $time_lot);
      } else {
        return 'Час назад';  
      }
 } else {
     return date('d.m.y '.'в'.' H:i', $time_lot);
   }
}

function connect_code($address, $data) {
    if  (file_exists($address)) {
        require_once $address;
    } else { 
        return '';
    }
}
?>