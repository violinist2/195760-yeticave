<?php

class ItemFinder extends BaseFinder {

    public $tableName = "items";
    public $categoriesTableName = "categories";
    public $id;

    /**
     * Получение всех данных по лоту
     * @param int $id ID лота
     * @return array Ассоциативный массив с выборкой из базы данных
     */
    public function getItemData($id) {
        $sql = "SELECT ".$this->tableName.".item_name, ".$this->tableName.".description,
        ".$this->tableName.".image_path, ".$this->categoriesTableName.".category_name,
        ".$this->tableName.".price_start, ".$this->tableName.".user_author_id,
        ".$this->tableName.".bet_step, ".$this->tableName.".date_end FROM
        ".$this->tableName." JOIN ".$this->categoriesTableName." ON
        ".$this->tableName.".category_id = ".$this->categoriesTableName.".id
        WHERE ".$this->tableName.".id = ?;";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, [$id]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }

    /**
     * Получение выборки открытых лотов (дата завершения продажи которых ещё не наступила)
     * @return array Ассоциативный массив с выборкой из базы данных
     */
    public function getOpenItems() {
        $sql = "SELECT ".$this->tableName.".id, ".$this->tableName.".item_name,
        ".$this->tableName.".price_start, ".$this->tableName.".image_path,
        ".$this->categoriesTableName.".category_name FROM ".$this->tableName."
        JOIN ".$this->categoriesTableName." ON ".$this->tableName.".category_id =
        ".$this->categoriesTableName.".id WHERE ".$this->tableName.".date_end
        > NOW() ORDER BY ".$this->tableName.".date_end DESC;";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, '');
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }
}
?>
