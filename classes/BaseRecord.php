<?php

abstract class BaseRecord {

    private $tableName;
    private $dbInstance;

    public function __construct($dbInstance) {
        $this->dbInstance = $dbInstance;
    }

    public function __get($name) {
        return $this->$name;
        // ерунда какая-то, но вроде так
    }

    public function __set($prop, $val) {
        $this->$prop = $val;
        // ерунда какая-то, но вроде так
    }

    public function select($sql, $arguments) {
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, $arguments);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    } 

    public function insert($sql, $arguments) {
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, $arguments);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_stmt_insert_id($stmt); 
        mysqli_stmt_close($stmt);
        return $result; 
    }

    public function update($sql, $arguments) {
        $sql = "UPDATE ".$table." SET ";
        foreach ($changes_data as $key => $value) {
            $arguments[] = $changes_data[$key][key($value)];
            $sql .= key($value)." = ?";
            if ($key < count($changes_data) - 1) $sql .= ", ";
        }
        $sql .= " WHERE ".key($conditions_data)." = ?;";
        $arguments[] = $conditions_data[key($conditions_data)];
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, $arguments);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt); 
        return $result;  
    }

    public function delete($sql, $arguments) {
        // это будет метод для удаления.. или уже не будет(
    }          
}
?>