<?php

class CategoryFinder extends BaseFinder {

    public $tableName = "categories";
    public $id;

    /**
     * Получение всех категорий
     * @return array Ассоциативный массив с выборкой из базы данных
     */
    public function getCategories() {
        $stmt = db_get_prepare_stmt($this->dbInstance, "SELECT * FROM ".$this->tableName." ORDER BY id ASC;", '');
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }
}
?>
