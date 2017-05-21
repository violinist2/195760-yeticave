<?php

/**
 * Класс с данными пользователя из базы данных
 *
 * @param $id integer ID пользователя в базе
 * @param $dt_add string Дата регистрации пользователя
 * @param $email string Email пользователя
 * @param $name string Имя пользователя
 * @param $password string Хэш пароля пользователя
 * @param $avatar string Путь к аватару пользователя
 * @param $contacts string Контактная информация пользователя
 *
 * @return pwd bool Почему bool, если мы вернуть должны как-то хэш пароля изменённый в базу???
 */
class UserRecord extends BaseRecord {

    private $id;
	private $dt_add;
	private $email;
	private $name;
	private $password;
	private $avatar;
	private $contacts;

    public function changePassword($pwd) {
        return password_hash($pwd, PASSWORD_DEFAULT); // хэш пароля
    }
}
?>