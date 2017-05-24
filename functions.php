<?php
date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');
// временная метка для настоящего времени
$now = time();
$lot_time_remaining = date('H:i' ,$tomorrow - $now - 3600 * 3);

$database = new Database;
$connection = $database->connectData();
require_once('mysql_helper.php');

function convert_time_unix($in_time) {
    return date_format(date_create_from_format('Y-m-d H:i:s', $in_time), U);
}

function convert_time($time_lot) {
    $date = convert_time_unix($time_lot);
    $difference = time() - $date;
    if ($difference < 60*60*24) { // меньше суток
        if ($difference < 3600) return round($difference / 60).' минут назад'; // меньше  часа - минуты
        if ($difference > 3600) return round($difference / 3600).' часов назад'; // больше часа - часы
        if ($difference == 3600) return 'Час назад';
    } else { // больше суток
        return date('j.m.y '.'в'.' H:i', $date);
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

function item_save($name, $description, $image, $rate, $finishdate, $step, $author, $category) { // будет заменена методом класса
    $database = new Database;
    $sql = "INSERT INTO items SET id = NULL, date_add = NOW(), item_name = ?, 
    description = ?, image_path = ?, price_start = ?, date_end = ?, 
    bet_step = ?, favorites_count = NULL, user_author_id = ?, 
    user_winner_id = NULL, category_id = ?;";
    $newitem = $database->insertData($sql, [$name, $description, $image, $rate, $finishdate, $step, $author, $category]);
    return $newitem;
}

function email_used($email, $connection) { // в эту вспомогательную функцию приходится передавать соединение(
    $email = protect_code($email, $connection);
    if (!empty($email)) {
        $emails = new UserFinder($connection);
        return $emails->findAllBy('email', $email);
    }
}
?>