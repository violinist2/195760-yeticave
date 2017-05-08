<main>
  <nav class="nav">
    <ul class="nav__list container">
      <li class="nav__item">
        <a href="all-lots.html">Доски и лыжи</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Крепления</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Ботинки</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Одежда</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Инструменты</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Разное</a>
      </li>
    </ul>
  </nav>
  <form class="form container<?php if ($data['form-sent']==true) echo ' form--invalid'; ?>" action="login.php" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item<?php if ($data['form-sent']==true and $data['email']=="") echo ' form__item--invalid'; ?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$data['email']; ?>" required>
      <span class="form__error">Введите e-mail</span>
    </div>
    <div class="form__item form__item--last<?php if ($data['form-sent']==true and ($data['password']=="" || $data['password_incorrect']==true)) echo ' form__item--invalid'; ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=$data['password']; ?>" required>
      <span class="form__error"><?php if ($data['form-sent']==true and $data['password']=="") {
          echo 'Введите пароль';
        } elseif ($data['form-sent']==true and $data['password_incorrect']==true)  {
          echo 'Вы ввели неверный пароль';  
        } ; ?></span>
    </div>
    <button type="submit" class="button" name="form-sent" value="1">Войти</button>
  </form>
</main>