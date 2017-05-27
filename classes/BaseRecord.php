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

    /**
     * Метод для вставки в базу данных нового значения
     * @param array $new_data Ассоциативный массив с набором свойств и значений для вставки в базу данных
     * @return int ID строки, вставленной в базу
     */
    public function insert($new_data) {
        $sql = "INSERT INTO ".$this->tableName." SET id = NULL, ";
        foreach ($new_data as $key => $value) {
            if ($new_data[$key][key($value)]=='') {
                // mysql_helper не принимает в качестве значения параметра передачей из класса NULL ни в какой форме,
                // поэтому его приходится исключением в запрос писать напрямую
                // такая же недокументированная непонятность, что и с NOW()
                $sql .= key($value)." = NULL";
            } else {
                $arguments[] = $new_data[$key][key($value)];
                $sql .= key($value)." = ?";
            }
            if ($key < count($new_data) - 1) $sql .= ", ";
        }
        $sql .= ";";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, $arguments);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_stmt_insert_id($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    /**
     * Метод для изменения значений в базе данных
     * @param array $changes_data Ассоциативный массив с набором свойств и значений для изменения
     * @param array $conditions Ассоциативный массив с набором условий, которыми определяются изменяемые записи
     * @return int Количество строк, успешно изменённых выполненным запросом
     */
    public function update($changes_data, $conditions) {
        $sql = "UPDATE ".$this->tableName." SET ";
        foreach ($changes_data as $key => $value) {
            $arguments[] = $changes_data[$key][key($value)];
            $sql .= key($value)." = ?";
            if ($key < count($changes_data) - 1) $sql .= ", ";
        }
        $sql .= " WHERE ";
        unset($key);
        foreach ($conditions as $key => $value) {
            $arguments[] = $conditions[$key][key($value)];
            $sql .= key($value)." = ?";
            if ($key < count($conditions) - 1) $sql .= " AND ";
        }
        $sql .= ";";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, $arguments);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    /**
     * Метод для удаления значений в базе данных
     * @param array $conditions Ассоциативный массив с набором условий, которыми определяются удаляемые записи
     * @return bool Результат выполнения
     */
    public function delete($conditions) {
        $sql = "DELETE FROM ".$this->tableName." WHERE ";
        foreach ($conditions as $key => $value) {
            $arguments[] = $conditions[$key][key($value)];
            $sql .= key($value)." = ?";
            if ($key < count($conditions) - 1) $sql .= " AND ";
        }
        $sql .= ";";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, $arguments);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
?>
