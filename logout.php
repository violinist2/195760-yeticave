<?php
if (isset($_COOKIE['authorized_user'])) {
    unset($_COOKIE['authorized_user']); // удаляем куку из памяти
    setcookie('authorized_user', '', time() - 3600, '/'); // записываем пользователю куку пустую (удаляем куку)
}
header("Location: /");
?>