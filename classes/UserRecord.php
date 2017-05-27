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

    /**
     * Метод для изменения (или задания нового) пароля пользователя
     * @param string Пароль для хэширования
     * @return string Хэш нового пароля
     */
    public function changePassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Особый метод для подачи запроса на добавление в базу нового пользователя
     * @param string $email E-mail пользователя
     * @param string $username Имя пользователя
     * @param string $password Хэш пароля пользователя
     * @param string $avatar_path Путь к файлу аватара
     * @param string $contacts Контактные данные
     * @return int ID нового пользователя в базе
     */
    public function userRegister($email, $username, $password, $avatar_path, $contacts) {
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
