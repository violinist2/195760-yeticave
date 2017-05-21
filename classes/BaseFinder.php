<?php

/**
 * Вот тут уже вообще ничего не понятно, какой-то отдельный класс-файндер (чего и куда)
 *
 * @param $tableName string Видимо, имя таблицы
 * @param $dbInstance object Объект, который надо как-то откуда-то подключить
 */
class BaseFinder {

    private $tableName;
    private $dbInstance;

    public function __construct($dbInstance) {
        // и что здесь?
    }

    public function findByID($id) {
        // и что здесь?
    }

    public function findAllBy($where) {
        // и что здесь?
    }
}
?>