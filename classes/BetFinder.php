<?php

class BetFinder extends BaseFinder {

    public $tableName = "bets";
    public $usersTableName = "users";
    public $categoriesTableName = "categories";
    public $itemsTableName = "items";
    
    public function getBetsByItem($id) {
        $sql = "SELECT ".$this->usersTableName.".username, ".$this->tableName.".bet_amount, 
        ".$this->tableName.".date_betmade FROM ".$this->tableName." JOIN 
        ".$this->usersTableName." ON ".$this->tableName.".user_id = ".$this->usersTableName.".id 
        WHERE ".$this->tableName.".item_id = ? ORDER BY ".$this->tableName.".bet_amount DESC;";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, [$id]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }
    
    public function getBetsByUser($user_id) {
        // вообще какое-то дикое количество лишнего и повторяющегося кода(
        $sql = "SELECT ".$this->itemsTableName.".id, ".$this->itemsTableName.".item_name, 
        ".$this->itemsTableName.".image_path, ".$this->tableName.".bet_amount, 
        ".$this->tableName.".date_betmade, ".$this->categoriesTableName.".category_name 
        FROM ".$this->tableName." JOIN ".$this->itemsTableName." ON 
        ".$this->tableName.".item_id = ".$this->itemsTableName.".id JOIN 
        ".$this->categoriesTableName." ON ".$this->itemsTableName.".category_id = 
        ".$this->categoriesTableName.".id WHERE ".$this->tableName.".user_id = ? 
        ORDER BY ".$this->tableName.".date_betmade DESC;";
        $stmt = db_get_prepare_stmt($this->dbInstance, $sql, [$user_id]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }
}
?>