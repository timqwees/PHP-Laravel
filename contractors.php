<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PROДетали</title>
  <link rel="stylesheet" href="./src/css/normalize.css" />
  <link rel="stylesheet" href=".//src/css/style.css" />
  <link rel="stylesheet" href=".//src/css/pages/contractors.css" />
  <link rel="stylesheet" href=".//src/css/parts/header.css" />
  <link rel="stylesheet" href=".//src/css/parts/footer.css" />
  <link rel="stylesheet" href=".//src/css/parts/history.css" />
  <link rel="stylesheet" href=".//src/css/parts/filters.css" />
  <link href="https://myfonts.ru/myfonts?fonts=bookman-old-style" rel="stylesheet" type="text/css" />
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
    <p class="history__text history__links"><a href="index.php">Главная</a> >> Исполнители</p>
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
    <section class="list">
      <div class="list__contractor contractor">
        <div class="contractor__header">
          <p class="contractor__name contractor__text">ООО "Металлюга"</p>
          <p class="contractor__location contractor__text">г. Москва</p>
        </div>
        <div class="contractor__info">
          <div class="contractor__left">
            <img class="contractor__logo" src="public/contractor_logo.png">
            <a class="contractor__button button--blue" href="contractor.php">Подробнее</a>
          </div>
          <p class="contractor__right">
            ООО "Металлюга" – это компания, специализирующаяся на поставках, переработке и производстве
            металлических изделий. Мы предлагаем широкий ассортимент продукции, включая прокат черных и
            цветных
            металлов, металлоконструкции, а также услуги по резке, сварке и обработке металла.
            <br><br>
            Наши преимущества:<br>
            ✔ Высокое качество металлопроката и изделий<br>
            ✔ Современное оборудование и технологии обработки<br>
            ✔ Гибкая ценовая политика и индивидуальный подход к каждому клиенту<br>
            ✔ Надежные партнеры и своевременная доставка
          </p>
        </div>
      </div>
      <div class="list__contractor contractor">
        <div class="contractor__header">
          <p class="contractor__name contractor__text">ООО "Металлюга"</p>
          <p class="contractor__location contractor__text">г. Москва</p>
        </div>
        <div class="contractor__info">
          <div class="contractor__left">
            <img class="contractor__logo" src="public/contractor_logo.png">
            <a class="contractor__button button--blue" href="contractor.php">Подробнее</a>
          </div>
          <p class="contractor__right">
            ООО "Металлюга" – это компания, специализирующаяся на поставках, переработке и производстве
            металлических изделий. Мы предлагаем широкий ассортимент продукции, включая прокат черных и
            цветных
            металлов, металлоконструкции, а также услуги по резке, сварке и обработке металла.
            <br><br>
            Наши преимущества:<br>
            ✔ Высокое качество металлопроката и изделий<br>
            ✔ Современное оборудование и технологии обработки<br>
            ✔ Гибкая ценовая политика и индивидуальный подход к каждому клиенту<br>
            ✔ Надежные партнеры и своевременная доставка
          </p>
        </div>
      </div>
    </section>
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