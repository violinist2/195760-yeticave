<?php
$error_text = "Заполните это поле!";
// echo "<pre>";
// print_r($data);
// echo "</pre>";
$categories = $data[0];
$data = $data[1];
?>
<main>
  <nav class="nav">
    <ul class="nav__list container">
      <?php foreach ($categories as $category) { ?>
        <li class="nav__item">
          <a href="/catalog.php?category=<?=$category[0]; ?>"><?=$category[1]; ?></a>
        </li>
      <?php } ?>
    </ul>
  </nav>
  <form class="form form--add-lot container<?php if ($data['form-sent']==true) echo ' form--invalid'; ?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item<?php if (($data['form-sent']==true) and ($data['lot-name']=="")) echo ' form__item--invalid'; ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$data['lot-name']; ?>" required>
        <span class="form__error"><?=$error_text; ?></span>
      </div>
      <div class="form__item<?php if (($data['form-sent']==true) and ($data['category']=="Выберите категорию")) echo ' form__item--invalid'; ?>">
        <label for="category">Категория</label>
        <select id="category" name="category">
          <option>Выберите категорию</option>
          <option<?php if($data['category']=="Доски и лыжи") echo ' selected'; ?>>Доски и лыжи</option>
          <option<?php if($data['category']=="Крепления") echo ' selected'; ?>>Крепления</option>
          <option<?php if($data['category']=="Ботинки") echo ' selected'; ?>>Ботинки</option>
          <option<?php if($data['category']=="Одежда") echo ' selected'; ?>>Одежда</option>
          <option<?php if($data['category']=="Инструменты") echo ' selected'; ?>>Инструменты</option>
          <option<?php if($data['category']=="Разное") echo ' selected'; ?>>Разное</option>
        </select>
        <span class="form__error"><?=$error_text; ?></span>
      </div>
    </div>
    <div class="form__item form__item--wide<?php if (($data['form-sent']==true) and ($data['message']=="")) echo ' form__item--invalid'; ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required><?=$data['message']; ?></textarea>
      <span class="form__error"><?=$error_text; ?></span>
    </div>
    <div class="form__item form__item--file<?php if (($data['form-sent']==true) and ($data['file']!=="")) echo ' form__item--uploaded'; ?>"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="../<?=$data['file']; ?>" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="photo" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small<?php if (($data['form-sent']==true) and ($data['lot-rate']=="")) echo ' form__item--invalid'; ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$data['lot-rate']; ?>" required>
        <span class="form__error"><?=$error_text; ?></span>
      </div>
      <div class="form__item form__item--small<?php if (($data['form-sent']==true) and ($data['lot-step']=="")) echo ' form__item--invalid'; ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$data['lot-step']; ?>" required>
        <span class="form__error"><?=$error_text; ?></span>
      </div>
      <div class="form__item<?php if (($data['form-sent']==true) and ($data['lot-date']=="")) echo ' form__item--invalid'; ?>">
        <label for="lot-date">Дата завершения</label>
        <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" value="<?=$data['lot-date']; ?>" required>
        <span class="form__error"><?=$error_text; ?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button" name="form-sent" value="1">Добавить лот</button>
  </form>
</main>