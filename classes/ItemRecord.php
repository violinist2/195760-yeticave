<?php

class ItemRecord extends BaseRecord {

    public $tableName = "items";
    public $id;
	public $date_add;
    public $item_name;
    public $description;
    public $image_path;
    public $price_start;
    public $date_end;
    public $bet_step;
    public $favorites_count;
    public $user_author_id;
    public $user_winner_id;
    public $category_id;

    public function itemAdd($item_name, $description, $image_path, $price_start, $date_end, $bet_step, $user_author_id, $category_id) {
        // Специальный метод для подачи запроса на запись нового лота
        return $this->insert([
            ['date_add' => date('Y-m-d H:i:s')],
            ['item_name' => $item_name],
            ['description' => $description],
            ['image_path' => $image_path],
            ['price_start' => $price_start],
            ['date_end' => $date_end],
            ['bet_step' => $bet_step],
            ['favorites_count' => ''], // вместо NULL, см.комментарии метода insert в classes/BaseRecord.php
            ['user_author_id' => $user_author_id],
            ['user_winner_id' => ''], // вместо NULL, см.комментарии метода insert в classes/BaseRecord.php
            ['category_id' => $category_id]
        ]);
    }
}
?>
