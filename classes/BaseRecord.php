<?php

/**
 * Какой-то базовый класс для работы с базой данных
 *
 * @param $tableName string Видимо, имя таблицы
 * @param $dbInstance object Объект, который надо как-то откуда-то подключить
 */
class BaseRecord {

    private $tableName;
    private $dbInstance;

    public function __construct($dbInstance) {
        // и что здесь?
    }

    public function __get($name) {
        return $this->$name;
        // ерунда какая-то, но вроде так
    }

    public function __set($prop, $val) {
        $this->$prop = $val;
        // ерунда какая-то, но вроде так
    }

    public function insert() {
        // и что здесь?
    } 

    public function update() {
        // и что здесь?
    }

    public function delete() {
        // и что здесь?
    }          
}
?>