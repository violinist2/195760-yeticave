<?php
date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');
// временная метка для настоящего времени
$now = time();
$lot_time_remaining = date('H:i' ,$tomorrow - $now - 3600 * 3);

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

function is_authorized() {
    if (isset($_SESSION['user'])) {
        foreach ($_SESSION['user'] as $key => $value) { // на всякий случай каждый параметр пользователя из сессии чистится
            $userdata[protect_code($key)] = protect_code($value);     
        }
        if ($userdata['auth_avatar_path']=='') $userdata['auth_avatar_path'] = 'img/default.jpg'; // пустой аватар, если пользователь не поставил
        return $userdata;
    }
}

function bet_save($cost, $user_id, $lot_id) {
    $connection = connect_data();
    $sql = "INSERT INTO bets SET id = NULL, 
    bet_amount = ?, user_id = ?, item_id = ?, date_betmade = NOW();";
    $newbet = insert_data($connection, $sql, [$cost, $user_id, $lot_id]);
    return $newbet;
}

function item_save($name, $description, $image, $rate, $finishdate, $step, $author, $category) {
    $connection = connect_data();
    $sql = "INSERT INTO items SET id = NULL, date_add = NOW(), item_name = ?, 
    description = ?, image_path = ?, price_start = ?, date_end = ?, 
    bet_step = ?, favorites_count = NULL, user_author_id = ?, 
    user_winner_id = NULL, category_id = ?;";
    $newitem = insert_data($connection, $sql, [$name, $description, $image, $rate, $finishdate, $step, $author, $category]);
    return $newitem;
}

require_once('mysql_helper.php');

function connect_data() {
    $connection = mysqli_connect("localhost", "root", "", "195760-yeticave");
    if ($connection == false) {
        print("Ошибка подключения: " . mysqli_connect_error());
    } else {
       return $connection;
    }
}

function select_data($connection, $sql, $arguments) {
    $stmt = db_get_prepare_stmt($connection, $sql, $arguments);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $data = mysqli_fetch_all($result, MYSQLI_NUM);
    mysqli_close($connection);
    return $data;
}

function insert_data($connection, $sql, $arguments) {
    $stmt = db_get_prepare_stmt($connection, $sql, $arguments);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_stmt_insert_id($stmt); 
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    return $result;    
}

function update_data($connection, $table, $changes_data, $conditions_data) {
    $sql = "UPDATE ".$table." SET ";
    foreach ($changes_data as $key => $value) {
        $arguments[] = $changes_data[$key][key($value)];
        $sql .= key($value)." = ?";
        if ($key < count($changes_data) - 1) $sql .= ", ";
    }
    $sql .= " WHERE ".key($conditions_data)." = ?;";
    $arguments[] = $conditions_data[key($conditions_data)];
    $stmt = db_get_prepare_stmt($connection, $sql, $arguments);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);   
    return $result;    
}

function email_used($email) {
    $email = protect_code($email);
    if (!empty($email)) {
        $connection = connect_data();
        $sql = "SELECT email FROM users WHERE email = ?;";
        $arguments = [$email];
        $result = select_data($connection, $sql, $arguments);
        return $result;
    }
}

function get_next_id($table) {
    $table = protect_code($table);
    $connection = connect_data();
    $sql = "SELECT MAX(id) FROM $table;"; // похоже, не всегда +1 от максимального id == auto_increment, но пусть так
    $result = select_data($connection, $sql, ''); // имя таблицы в виде подготовленного значения, к сожалению, передать не удаётся
    return intval($result[0][0]) + 1;
}
?>