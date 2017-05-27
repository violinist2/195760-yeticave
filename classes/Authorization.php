<?php

/**
 * Класс для работы с авторизацией пользователя
 */
class Authorization {

    /**
     * Проверяет наличие пользователя в базе и соответствие хэша пароля
     * Если введенный пароль пользователя верен, записывает пользовательские данные в сессию
     *
     * @param string $email E-mail пользователя
     * @param string $password Пароль пользователя
     * @param mysqli $connection Ресурс соединения
     * @return bool Результат операции
     */
    public function doAuthorize($email, $password, $connection) { // приходится сюда передавать соединение с базой данных, а как ещё?
        $users = new UserFinder($connection);
        $found_user = $users->findAllBy('email', $email);
        if (!empty($found_user) and password_verify($password, $found_user[0][4])) { // пользователь найден, введенный пароль найденного пользователя совпадает с хэшем из базы
            $_SESSION['user'] = [  // в сессии будем хранить по-минимуму
                'auth_user_id' => $found_user[0][0],
                'auth_username' => $found_user[0][3],
                'auth_avatar_path' => $found_user[0][5]
                ];
            return true;
        }
    }

    /**
     * Проверяет наличие в сессии данных пользователя
     *
     * @return bool Результат операции
     */
    public function isAuthorized() {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Удаляет из сессии данные авторизованного пользователя
     */
    public function finishAuthorization() {
        if ($this->isAuthorized()) {
            unset($_SESSION['user']);
        }
    }

    /**
     * Записывает в ассоциативный массив данные авторизованного пользователя
     *
     * @return array Массив с данными пользователя
     */
    public function getUserdata() {
        if ($this->isAuthorized()) {
           foreach ($_SESSION['user'] as $key => $value) {
                $userdata[protect_code($key)] = protect_code($value);
           }
           if ($userdata['auth_avatar_path']=='') $userdata['auth_avatar_path'] = 'img/default.jpg';
           return $userdata;
        }
    }
}
?>
