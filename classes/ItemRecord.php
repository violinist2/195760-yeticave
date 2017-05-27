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

    /**
     * Особый метод для подачи запроса на добавление в базу нового лота
     * @param string $item_name Название лота
     * @param string $description Аннотация к лоту
     * @param string $image_path Путь к файлу изображения лота
     * @param int $price_start Стартовая цена
     * @param var $date_end Дата окончания продаж
     * @param int $bet_step Шаг ставки
     * @param int $user_author_id ID пользователя, добавляющего лот
     * @param int $category_id ID категории добавляемого лота
     * @return int ID нового лота в базе
     */
    public function itemAdd($item_name, $description, $image_path, $price_start, $date_end, $bet_step, $user_author_id, $category_id) {
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
