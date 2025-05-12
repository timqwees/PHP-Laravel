<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PROДетали</title>
    <link rel="stylesheet" href="./src/css/normalize.css" />
    <link rel="stylesheet" href="./src/css/style.css" />
    <link rel="stylesheet" href="./src/css/parts/header.css" />
    <link rel="stylesheet" href="./src/css/parts/footer.css" />
    <link rel="stylesheet" href=".//src/css/parts/history.css" />
    <link rel="stylesheet" href=".//src/css/pages/constractorPA.css" />
    <link rel="stylesheet" href=".//src/css/pages/servicefix.css" />
  </head>
  <body>
    <header>
      <div class="header__container">
        <a class="header__content-left" href="index.php">
          <img
            class="header__logo"
            src="public/logo_and_text.svg"
            alt="Main logo here"
          />
        </a>
        <div class="header__content-right">
          <nav class="header__navigation navigation">
            <ul class="navigation__list">
              <li class="navigation__item">
                <a class="navigation__link" href="ads.php">Объявления</a>
              </li>
              <li class="navigation__item">
                <a class="navigation__link" href="contractors.php"
                  >Исполнители</a
                >
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
                <?php
              if (isset($user['id'])) {
                echo '<a class="navigation__link navigation__authenticate" href="/Prodetali/_next/regist/account.php">Личный кабинет</a>';
              } else {
                echo '<a class="navigation__link navigation__authenticate" href="/Prodetali/_next/regist/log-in.php">Войти</a>';
              }
              ?>
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
      <section class="history">
        <p class="history__text history__links">
          <a href="index.php">Главная</a> >> Личный кабинет >> Услуги >>
          Изменить услугу
        </p>
        <p class="history__text history__location">Местоположение: Москва</p>
      </section>
    </header>

    <main>
      <aside class="main__navigation">
        <ul class="main__navigation-list">
          <li class="main__navigation-item">
            <button class="main__navigation-button button-profile">
              Профиль
            </button>
          </li>
          <li class="main__navigation-item">
            <button class="main__navigation-button button-services">
              Услуги
            </button>
          </li>
          <li class="main__navigation-item">
            <button class="main__navigation-button button-requests">
              Заказы
            </button>
          </li>
          <li class="main__navigation-item main__navigation-item-exit">
            <a href="index.php" class="main__navigation-button button-exit"
              >Выйти</a
            >
          </li>
        </ul>
      </aside>
      <section class="service">
        <button class="service__close-button">X</button>
        <div class="service__container">
          <div class="service__content-upper">
            <div class="service__image-wrapper">
              <img
                src="public/servicelaser.png"
                alt="Service image"
                class="service__image"
              />
              <button class="service__attach-button">
                <img src="public/attach.svg" alt="attach" />
              </button>
            </div>
            <div class="service__text-wrapper">
              <h2 class="service__title">Лазерная резка металла</h2>
              <p class="service__description">
                Категория: Лазерная резка металла
              </p>
              <p class="service__description">Цена: от 50 000 руб</p>
              <p class="service__description">
                Оборудование: Оптоволоконная установка лазерного раскроя IRONMAC
                C, автоматизированные комплексы лазерной резки YAWEI SMD HLE
              </p>
              <p class="service__description">
                Описание: В нашем парке оборудования 3 станка лазерной резки
                листового металла и станок лазерной резки труб
              </p>
            </div>
          </div>
          <div class="service__content-lower">
            <button class="service__button">Удалить услугу</button>
            <button class="service__button">Сохранить изменения</button>
          </div>
        </div>
      </section>
    </main>
    <footer>
      <div class="footer__wrapper">
        <div class="footer__block">
          <img
            src="./public/logo_and_text__footer.svg"
            alt=""
            class="footer__logo"
          />
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
          <a href="tel:+79999999999" class="footer__link_tel"
            >+7 999 999 99 99</a
          >
          <a href="mailto:name@gmail.com" class="footer__link_email"
            >name@gmail.com</a
          >
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
