<?php
$items = $data[0];
$mybets = $data[1];
?>
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
  <section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
    <?php
      if (!empty($mybets)) { // если ставок нет, будет отображаться пустая страница
        foreach ($mybets as $lot_id => $bet_data) {
    ?>
      <tr class="rates__item">
        <td class="rates__info">
          <div class="rates__img">
            <img src="../<?=$items[$lot_id]['image']; ?>" width="54" height="40" alt="<?=$items[$lot_id]['itemsname']; ?>">
          </div>
          <h3 class="rates__title"><a href="/lot.php?id=<?=$lot_id; ?>"><?=$items[$lot_id]['itemsname']; ?></a></h3>
        </td>
        <td class="rates__category">
          <?=$items[$lot_id]['category']; ?>
        </td>
        <td class="rates__timer">
          <div class="timer timer--finishing">07:13:34</div>
        </td>
        <td class="rates__price">
          <?=protect_code($bet_data['cost']); ?> р
        </td>
        <td class="rates__time">
          <?=protect_code(convertTime($bet_data['time'])); ?>
        </td>
      </tr>
    <?php   }
    }
    ?>
    </table>
  </section>
</main>