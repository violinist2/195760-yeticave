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

function bet_save($cost, $lot_id) {
    if (!empty($_COOKIE['mybets'])) $mybets = json_decode($_COOKIE['mybets'], true); // если уже были ставки, читаем массив с ними, чтобы дописать туда
    $mybets[$lot_id] = ['cost' => $cost, 'time' => time()];
    $expire =  time()+86400*30; // хранить 30 суток, в задании не конкретизировано
    setcookie('mybets', json_encode($mybets), $expire, '/');
}

function bet_check($lot_id) { // проверка, хранится ли ставка по лоту
    $mybets = json_decode($_COOKIE['mybets'], true);
    if (isset($mybets[$lot_id])) return true;
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
?>