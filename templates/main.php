<?php
date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');
// временная метка для настоящего времени
$now = time();


$lot_time_remaining = date('H:i' ,$tomorrow - $now - 3600 * 3);
$product_category = [
    'Доски и лыжи', 
    'Крепления', 
    'Ботинки', 
    'Одежда', 
    'Инструменты', 
    'Разное'
]; 


$items = [
    [
        'itemsname' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи', 
        'price' => '10999', 
        'image' => 'img/lot-1.jpg'
    ], 
    [
        'itemsname' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' =>'Доски и лыжи',
        'price' => '159999', 
        'image' => 'img/lot-2.jpg'
    ], 
    [
        'itemsname' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'image' => 'img/lot-3.jpg'
     ],
    [
        'itemsname' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => '10999',
        'image' => 'img/lot-4.jpg'
     ], 
    [
        'itemsname' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => '7500', 
        'image' => 'img/lot-5.jpg'
    ],
    [
        'itemsname' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5400', 
        'image' => 'img/lot-6.jpg'
    ]
];
?>


<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="promo__item promo__item--attachment">
                <a class="promo__link" href="all-lots.html">Крепления</a>
            </li>
            <li class="promo__item promo__item--boots">
                <a class="promo__link" href="all-lots.html">Ботинки</a>
            </li>
            <li class="promo__item promo__item--clothing">
                <a class="promo__link" href="all-lots.html">Одежда</a>
            </li>
            <li class="promo__item promo__item--tools">
                <a class="promo__link" href="all-lots.html">Инструменты</a>
            </li>
            <li class="promo__item promo__item--other">
                <a class="promo__link" href="all-lots.html">Разное</a>
            </li>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
            <select class="lots__select">
            <option>Все категории</option>
                <?php foreach ($product_category as $category):?>
                <option><?=$category;?></option> 
               <?php endforeach;?> 
            </select>
        </div>
        <ul class="lots__list">
           <?php foreach  ($items as $item):?>
            <li class="lots__item lot">
               
                <div class="lot__image">
                    <img src="<?=strip_tags($item['image']);?>" width="350" height="260" alt="Сноуборд">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=strip_tags($item['category']);?></span>
                    <h3 class="lot__title"><a class="text-link" href="#"><?=strip_tags($item['itemsname']);?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=strip_tags($item['price']);?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=$lot_time_remaining;?>
                        </div>
                    </div>
                </div>
            </li>
<?php endforeach;?> 

</ul>
 
            
    </section>
</main>