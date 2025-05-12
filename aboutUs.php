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
    <link rel="stylesheet" href=".//src/css/pages/aboutUs.css" />
    <link
      href="https://myfonts.ru/myfonts?fonts=bookman-old-style"
      rel="stylesheet"
      type="text/css"
    />
    <script src="js/contractorAP.js" defer></script>
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
      <p class="history__text history__links">
        <a href="index.php">Главная</a> >> О нас
      </p>
    </section>
    <main>
      <section class="hero">
        <div class="hero__wrapper">
          <h1 class="hero__title">О нас</h1>
          <p class="hero__description">
            Мы — современная платформа, созданная для того, чтобы объединить
            профессионалов в области металлообработки и клиентов, нуждающихся в
            качественных услугах. Наша цель — сделать процесс поиска
            исполнителей простым, быстрым и надежным.
          </p>
        </div>
      </section>
      <section class="advantages">
        <div class="advantages__wrapper">
          <h2 class="advantages__title">Почему выбирают нас?</h2>
          <ul class="advantages__list">
            <li class="advantages__item">
              <p class="advantages__text">
                Широкий выбор исполнителей: Мы сотрудничаем с проверенными
                компаниями и мастерами, которые специализируются на различных
                видах металлообработки: от токарных и фрезерных работ до сложных
                проектов по сварке и изготовлению металлоконструкций.
              </p>
            </li>
            <li class="advantages__item">
              <p class="advantages__text">
                Удобство и прозрачность: Наша платформа позволяет вам легко
                найти подрядчика, сравнить цены и условия, а также ознакомиться
                с отзывами других клиентов.
              </p>
            </li>
            <li class="advantages__item">
              <p class="advantages__text">
                Экономия времени и ресурсов: Мы берем на себя все
                организационные вопросы, чтобы вы могли сосредоточиться на своих
                задачах.
              </p>
            </li>
            <li class="advantages__item">
              <p class="advantages__text">
                Качество и надежность: Все исполнители проходят тщательную
                проверку, чтобы гарантировать высокий уровень услуг.
              </p>
            </li>
          </ul>
        </div>
      </section>
      <div class="slogan">
        <p class="slogan__description">
          Присоединяйтесь к нам и убедитесь, что сотрудничество может быть
          простым, выгодным и эффективным!
        </p>
      </div>
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
