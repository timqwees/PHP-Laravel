<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PROДетали</title>
  <link rel="stylesheet" href="./src/css/normalize.css" />
  <link rel="stylesheet" href=".//src/css/style.css" />
  <link rel="stylesheet" href=".//src/css/parts/header.css" />
  <link rel="stylesheet" href=".//src/css/parts/footer.css" />
  <link rel="stylesheet" href=".//src/css/parts/history.css" />
  <link rel="stylesheet" href=".//src/css/parts/filters.css" />
  <link rel="stylesheet" href="./src/css/pages/ads.css" />
</head>

<body>
  <header>
    <div class="header__container">
      <a class="header__content-left" href="index.php">
        <img class="header__logo" src="public/logo_and_text.svg" alt="Main logo here" />
      </a>
      <div class="header__content-right">
        <nav class="header__navigation navigation">
          <ul class="navigation__list">
            <li class="navigation__item">
              <a class="navigation__link" href="ads.php">Объявления</a>
            </li>
            <li class="navigation__item">
              <a class="navigation__link" href="contractors.php">Исполнители</a>
            </li>
            <li class="navigation__item">
              <a class="navigation__link" href="services.php">Услуги</a>
            </li>
            <li class="navigation__item">
              <a class="navigation__link" href="aboutUs.php">О нас</a>
            </li>
            <li class="navigation__item">
              <a class="navigation__link" href="chat.php">Чат</a>
            </li>
            <li class="navigation__item">
              <a class="navigation__link" href="log-in.php">Войти</a>
            </li>
          </ul>
        </nav>
        <?php
        if (isset($user['id'])) {
          echo '<a href="/Prodetali/_next/regist/contractorPA.php" class="link_to_profile">
          <img class="header__icon" src="' . $user['icon'] . '" alt="' . $user['nickname'] . '" />
        </a>';
        } else {
          echo '<a href="/Prodetali/_next/regist/contractorPA.php" class="link_to_profile">
          <img class="header__icon" src="./public/icon_profile.svg" alt="Profile" />
        </a>';
          // во время разработки href="/_next/regist/log-in.php" в else будет href="/_next/regist/contractorPA.php"
        }
        ?>
      </div>
    </div>
  </header>
  <section class="history">
        <p class="history__text history__links"><a href="index.php">Главная</a> >> Объявления</p>
        <p class="history__text history__location">Местоположение: Москва</p>
  </section>
  <main>
    <aside class="filters">
        <div class="filters__category">
          <h2 class="filters__name">Категория</h2>
          <select class="filters__select">
            <option>Категория</option>
          </select>
        </div>
        <div class="filters__category">
          <h2 class="filters__name">Подкатегория</h2>
          <select class="filters__select">
            <option>Подкатегория</option>
          </select>
        </div>
        <button class="filters__button button--orange">Применить</button>
    </aside>
    <div class="list__wrapper">
        <div class="list__ad">
          <div class="ad__main_part">
            <img src="./public/fon_demo.png" alt="" class="ad__img">
            <p class="ad__author">Василий Л.</p>
            <p class="ad__description">
              Деталь Lego 64567 Light Bluish Gray <br><br>
              Weapon Lightsaber Hilt Straight<br><br>
              Номер Lego: 4212074, 4539481, 4581155<br>
              Категория: Minifigure, Weapon<br>
              Цвет: Light Bluish Gray<br>
              Тип цвета: Solid
            </p> 
          </div>
          <div class="ad__buttons_container">
            <button class="detail button--blue">Подробнее</button>
            <button class="take button--orange">Взять заказ</button>
          </div>
        </div>
        <div class="list__ad">
          <div class="ad__main_part">
            <img src="./public/fon_demo.png" alt="" class="ad__img">
            <p class="ad__author">Александр Б.</p>
            <p class="ad__description">
              Деталь Lego 36017 Flat Silver U<br><br>
              Apтикул: 69088<br>
              Названиe: Дeтaль LEGO Meч Legо 3847 Wеaроn Swоrd<br>
              Цвет: Flat Silvеr<br><br>
              Детaль LEGO Меч Legо 3847 Weaроn Swоrd, <br>
              Shortswоrd U Flаt Silver. 
            </p>
          </div>
          <div class="ad__buttons_container">
            <button class="detail button--blue">Подробнее</button>
            <button class="take button--orange">Взять заказ</button>
          </div>
        </div>
        <div class="list__ad">
          <div class="ad__main_part">
            <img src="./public/fon_demo.png" alt="" class="ad__img">
            <p class="ad__author">Глеб A.</p>
            <p class="ad__description">
              Деталь Canon QC4-3PG 1381115<br><br>
              Canon QC4-3PG<br>
              Правый механизм шпинделя рулона<br>
              для iPF686, iPF685, iPF681, iPF680, iPF671, iPF670<br>
              [разборка нового плоттера IPF 670]
            </p>
          </div>
          <div class="ad__buttons_container">
            <button class="detail button--blue">Подробнее</button>
            <button class="take button--orange">Взять заказ</button>
          </div>
        </div>
        <div class="list__ad">
          <div class="ad__main_part">
            <img src="./public/fon_demo.png" alt="" class="ad__img">
            <p class="ad__author">Виктор С.</p>
            <p class="ad__description">
              Деталь lvpc-2105 luzar<br><br>
              LUZАR, аpтикул: lvрс-2105, Крышка клапаннaя для а/м<br>
              Oрel Cоrsа D (06-)/Astra Н (04-)<br>
              1.2i/1.4i (с пpoкл.) (LVPC 2105). 
            </p>
          </div>
          <div class="ad__buttons_container">
            <button class="detail button--blue">Подробнее</button>
            <button class="take button--orange">Взять заказ</button>
          </div>
        </div>
    </div>    
  </main>
  <footer>
    <div class="footer__wrapper">
      <div class="footer__block">
        <img src="./public/logo_and_text__footer.svg" alt="" class="footer__logo" />
      </div>
      <div class="footer__block">
        <h3 class="footer__block-title">Компания</h3>
        <ul class="footer__block-list">
          <li class="footer__block-item">
            <p class="footer__block-text">О нас</p>
          </li>
          <li class="footer__block-item">
            <p class="footer__block-text">Отзывы</p>
          </li>
          <li class="footer__block-item">
            <p class="footer__block-text">Контакты</p>
          </li>
        </ul>
      </div>
      <div class="footer__block">
        <h3 class="footer__block-title">Документы</h3>

        <ul class="footer__block-list">
          <li class="footer__block-item">
            <p class="footer__block-text">Пользовательское соглашение</p>
          </li>
          <li class="footer__block-item">
            <p class="footer__block-text">Политика конфиденциальности</p>
          </li>
        </ul>
      </div>
      <div class="footer__block">
        <a href="tel:+79999999999" class="footer__link_tel">+7 999 999 99 99</a>
        <a href="mailto:name@gmail.com" class="footer__link_email">name@gmail.com</a>
      </div>
    </div>
    <div class="footer__line"></div>
    <p class="footer__extra">
      Сервис "PRO Детали" - Металлообработка - это важный процесс, который
      играет ключевую роль в промышленности. Она включает в себя различные
      методы обработки металла, такие как резка, сварка, шлифовка и гибка.
      Металлообработка необходима для создания разнообразных изделий - от
      мелких деталей до крупных конструкций.Этот процесс требует высокой
      точности и технического мастерства, чтобы обеспечить качество и
      надежность конечного продукта. В статье мы рассмотрим основные методы
      металлообработки, их применение в различных отраслях промышленности, а
      также новейшие технологии и тенденции в этой области.
    </p>
  </footer>
</body>

</html>
