<?php

class BetRecord extends BaseRecord {

    public $tableName = "bets";
    public $id;
	public $bet_amount;
    public $user_id;
    public $item_id;
    public $date_betmade;

    public function betSave($bet_amount, $user_id, $item_id) {
        // Специальный метод для подачи запроса на сохранение в базу новой ставки
        return $this->insert([
            ['bet_amount' => $bet_amount],
            ['user_id' => $user_id],
            ['item_id' => $item_id],
            ['date_betmade' => date('Y-m-d H:i:s')]
        ]);
    }
}
?>
