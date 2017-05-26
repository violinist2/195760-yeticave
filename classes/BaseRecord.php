<?php

abstract class BaseRecord {

    public $tableName;
    public $dbInstance;

    public function __construct($dbInstance) {
        $this->dbInstance = $dbInstance;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($prop, $val) {
        $this->$prop = $val;
    }

    public function insert($changes_data) {
        $sql = "INSERT INTO ".$this->tableName." SET id = NULL, ";
        foreach ($changes_data as $key => $value) {
            if ($changes_data[$key][key($value)]=='') {
                // mysql_helper не принимает в качестве значения параметра передачей из класса NULL ни в какой форме,
                // поэтому его приходится исключением в запрос писать напрямую
                // такая же недокументированная непонятность, что и с NOW()
                $sql .= key($value)." = NULL";
            } else {
                $arguments[] = $changes_data[$key][key($value)];
                $sql .= key($value)." = ?";
            }
            if ($key < count($changes_data) - 1) $sql .= ", ";
        }
        $sql .= ";";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, $arguments);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_stmt_insert_id($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function update($arguments) { // пока в работе, не сделано
        $sql = "UPDATE ".$tableName." SET ";
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
        // это будет метод для удаления.. потом
    }
}
?>
