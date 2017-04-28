<?php

// ставки пользователей, которыми надо заполнить таблицу//lot.php

// $bets = [
//     ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
//     ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
//     ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
//     ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
// ];

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
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>DC Ply Mens 2016/2017 Snowboard</title>
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

$data_lot = [$bets];
connect_code('templates/header_lot.php', $data_lot);
connect_code('templates/main_lot.php',['bets' => $bets]);
connect_code('templates/footer_lot.php', '');
?>




</body>
</html>

