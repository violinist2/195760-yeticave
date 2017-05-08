<?php
date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');
// временная метка для настоящего времени
$now = time();
$lot_time_remaining = date('H:i' ,$tomorrow - $now - 3600 * 3);

$product_category = [
    'Доски и лыжи', 
    'Крепления', 
    'Ботинки', 
    'Одежда', 
    'Инструменты', 
    'Разное'
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

function protect_code($in_data) {
    return htmlspecialchars(strip_tags(trim($in_data)));
}

function is_authorized() {
    if (isset($_COOKIE['authorized_user'])) {
        $auth_user = protect_code($_COOKIE['authorized_user']); // защита, вдруг подлый юзер в кукис положил инъекцию
        require_once 'userdata.php';
        return $users[$auth_user];
    }
}
?>