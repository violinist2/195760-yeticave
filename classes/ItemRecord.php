<?php

/**
 * Класс с данными лотов из базы данных
 *
 * @param $id integer ID ставки
 * @param $date_add string Дата добавления лота в базу
 * @param $item_name string Название лота
 * @param $description string Описание лота
 * @param $image_path string Путь к изображению лота
 * @param $price_start integer Стартовая цена
 * @param $date_end string Дата окончания продаж
 * @param $bet_step integer Шаг ставки
 * @param $favourites_count integer Количество добавлений в избранное
 * @param $user_author_id integer ID пользователя, добавившего лот
 * @param $user_winner_id integer ID пользователя, ставка которого выиграла
 * @param $category_id integer ID категории, к которой относится лот
 */
class BetRecord extends BaseRecord {

    private $id;
	private $date_add;
    private $item_name;
    private $description;
    private $image_path;
    private $price_start;
    private $date_end;
    private $bet_step;
    private $favourites_count;
    private $user_author_id;
    private $user_winner_id;
    private $category_id;
}
?>