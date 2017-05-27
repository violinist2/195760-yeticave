<?php

abstract class BaseFinder {

    public $tableName;
    public $dbInstance;

    public function __construct($dbInstance) {
        $this->dbInstance = $dbInstance;
    }

    /**
     * Вывода всех данных записи по определённому ID записи
     * @param int $id ID записи, которую следует вывести
     * @return array Ассоциативный массив с данными записи
     */
    public function findById($id) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE id = ?;";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, [$id]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }

    /**
     * Вывод всех данных записи по одному определённому условию
     * @param var $where Имя параметра, который будет условием
     * @param var $condition Значение параметра, который будет условием
     * @return array Ассоциативный массив с данными записи
     */
    public function findAllBy($where, $condition) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE ".$where." = ?;";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, [$condition]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }

    /**
     * Получение последнего (незанятого) ID в таблице
     * @return int Следующее (незанятое) ID в таблице в базе данных
     */
    public function getNextId() {
        $sql = "SELECT MAX(id) FROM ".$this->tableName.";";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, '');
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return intval($data[0][0]) + 1;
    }
}
?>
