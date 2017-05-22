<?php

class UserRecord extends BaseRecord {

    private $tableName = "users";
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