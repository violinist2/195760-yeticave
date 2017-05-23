<?php

abstract class BaseFinder {

    private $tableName;
    private $dbInstance;

    public function __construct($dbInstance) {
        $this->dbInstance = $dbInstance;
    }

    public function findByID($id) {
        // и что здесь?
        $stmt = db_get_prepare_stmt($this->dbInstance, "SELECT * FROM ". $this->tableName, ['id' => $id]);
        //... и прочее
    }

    public function findAllBy($where) {
        $stmt = db_get_prepare_stmt($this->dbInstance, "SELECT * FROM ".$this->tableName." ORDER BY id ASC;", '');
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }
}
?>