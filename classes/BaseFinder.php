<?php

abstract class BaseFinder {

    public $tableName;
    public $dbInstance;

    public function __construct($dbInstance) {
        $this->dbInstance = $dbInstance;
    }

    public function findByID($id) {
        // и что здесь?
        $stmt = db_get_prepare_stmt($this->dbInstance, "SELECT * FROM ". $this->tableName, ['id' => $id]);
        //... и прочее
    }

    public function findAllBy($where, $condition) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE ".$where." = ?;";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, [$condition]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }

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