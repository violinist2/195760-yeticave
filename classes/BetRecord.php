<?php

class BetRecord extends BaseRecord {

    public $tableName = "bets";
    public $id;
	public $bet_amount;
    public $user_id;
    public $item_id;
    public $date_betmade;

    /**
     * Особый метод для подачи запроса на добавление в базу новой ставки
     * @param int $bet_amount Сумма сделанной пользователем ставки
     * @param int $user_id ID пользователя, который делает ставку
     * @param int $item_id ID лота, по которому делается ставка
     * @return int ID новой ставки в базе
     */
    public function betSave($bet_amount, $user_id, $item_id) {
        return $this->insert([
            ['bet_amount' => $bet_amount],
            ['user_id' => $user_id],
            ['item_id' => $item_id],
            ['date_betmade' => date('Y-m-d H:i:s')]
        ]);
    }
}
?>
