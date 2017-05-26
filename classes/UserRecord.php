<?php

class UserRecord extends BaseRecord {

    public $tableName = "users";
    public $id;
	public $dt_add;
	public $email;
	public $name;
	public $password;
	public $avatar;
	public $contacts;

    public function changePassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function userRegister($email, $username, $password, $avatar_path, $contacts) {
        // Специальный метод для подачи запроса на запись нового юзера
        return $this->insert([
            ['date_register' => date('Y-m-d H:i:s')],
            ['email' => $email],
            ['username' => $username],
            ['password' => $password],
            ['avatar_path' => $avatar_path],
            ['contacts' => $contacts]
        ]);
    }
}
?>
