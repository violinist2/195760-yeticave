<?php

/**
 * Класс с данными ставок из базы данных
 *
 * @param $id integer ID ставки
 * @param $bet_amount integer Название категории
 * @param $user_id integer  ID пользователя, сделавшего ставку
 * @param $item_id integer ID лота, на который сделана ставка
 * @param $date_betmade string Дата и время, когда сделана ставка
}
 */
class BetRecord extends BaseRecord {

    private $id;
	private $bet_amount;
    private $user_id;
    private $item_id;
    private $date_betmade;
}
?>