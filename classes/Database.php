<?php

/**
 * Класс для соединения с базой данных
 */
class Database {

    /**
     * @var string $mysql_server Хост (сервер) базы данных
     */
    private $mysql_server = "localhost";

    /**
     * @var string $mysql_user Имя пользователя базы данныхх
     */
    private $mysql_user = "root";

    /**
     * @var string $mysql_password Пароль указанного выше пользователя базы данных
     */
    private $mysql_password = "";

    /**
     * @var string $mysql_base Имя базы данных проекта
     */
    private $mysql_base = "195760-yeticave";

    /**
     * Метод для соединения с базой данных
     * @return mysqli $connection Ресурс соединенияили оишбка соединения
     */
    public function connectData() {
        $connection = mysqli_connect($this->mysql_server, $this->mysql_user, $this->mysql_password, $this->mysql_base);
        if ($connection == false) {
            return mysqli_connect_error();
        } else {
            return $connection;
        }
    }
}
?>
