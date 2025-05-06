# Qwees CorePro Framework

## Содержание
- [Введение](#введение)
- [Установка](#установка)
- [Структура проекта](#структура-проекта)
- [Основные компоненты](#основные-компоненты)
- [Ядро фреймворка](#ядро-фреймворка)
- [Работа с фреймворком](#работа-с-фреймворком)
- [Сетевая конфигурация](#сетевая-конфигурация)
- [Примеры использования](#примеры-использования)
- [Требования](#требования)
- [Лицензия](#лицензия)
- [Маршрутизация](#маршрутизация)

## Введение

Qwees CorePro - это легковесный PHP-фреймворк, разработанный для быстрой разработки веб-приложений. Фреймворк следует принципам MVC (Model-View-Controller) и предоставляет базовую структуру для создания современных веб-приложений.

## Установка

1. Клонируйте репозиторий:
```bash
git clone https://github.com/timqwees/Qwees_CorePro.git
```

2. Установите зависимости через Composer:
```bash
composer install
```

3. Настройте веб-сервер:
- Укажите корневую директорию на папку `public/`
- Убедитесь, что mod_rewrite включен
- Проверьте права доступа к директориям

## Структура проекта

```
project/
├── app/                    # Основной код приложения
│   ├── Controllers/       # Контроллеры приложения
│   ├── Models/           # Модели данных
│   └── Config/           # Конфигурационные файлы
├── public/                # Публичная директория
│   ├── pages/            # Страницы приложения
│   ├── src/              # Исходные файлы (CSS, JS, изображения)
│   └── index.php         # Точка входа
├── vendor/               # Зависимости Composer
├── .htaccess            # Конфигурация Apache
└── composer.json        # Конфигурация Composer
```

## Основные компоненты

### Точка входа
Основной файл `public/index.php` является точкой входа в приложение. Он отвечает за:
- Инициализацию фреймворка
- Загрузку конфигурации
- Маршрутизацию запросов
- Обработку ошибок

### Система аутентификации
Фреймворк включает встроенную систему аутентификации:
- Аутентификация обрабатывается через контроллеры
- Встроенная защита от CSRF
- Управление сессиями

### Структура MVC

#### Контроллеры (app/Controllers/)
- Обработка HTTP-запросов
- Валидация входных данных
- Взаимодействие с моделями
- Формирование ответов

#### Модели (app/Models/)
- Работа с базой данных
- Бизнес-логика
- Валидация данных

#### Представления (public/pages/)
- HTML-шаблоны
- Интеграция с CSS и JavaScript из директории src/
- Форматирование данных

## Ядро фреймворка

### Network и Router - основа фреймворка

Фреймворк построен вокруг двух ключевых компонентов, расположенных в `app/Models/Network/Network.php` и `app/Models/Router/Routes.php`:

#### Network (app/Models/Network/Network.php)
- Центральный компонент для обработки всех сетевых запросов
- Управляет базой данных и таблицами
- Автоматически создает необходимые таблицы при инициализации
- Обрабатывает сессии и аутентификацию
- Предоставляет готовые SQL-запросы для работы с:
  - Статьями (Articles)
  - Пользователями (Users)
  - Аутентификацией (Auth)
- Управляет перенаправлениями
- Обрабатывает ошибки и логирование

Пример использования Network:
```php
use App\Models\Network\Network;

$network = new Network();

// Работа с базой данных
$network->onTableCheck('users');
$network->onColumnExists('new_column', 'users');

// Перенаправление
Network::onRedirect('search/account');

// Подготовленные запросы
$articleQueries = $network->preparerRequestArticle();
$userQueries = $network->preparerRequestUser();
$authQueries = $network->preparerRequestAuth();
```

#### Router (app/Models/Router/Routes.php)
- Управляет всеми маршрутами приложения
- Поддерживает паттерны маршрутизации через регулярные выражения
- Предоставляет готовые маршруты для основных страниц:
  - Главная страница (`/`)
  - Логин (`/search/login`)
  - Регистрация (`/search/regist`)
  - Аккаунт (`/search/account`)
  - Блоги (`/search/account/blogs`)
  - Выход (`/search/logout`)
- Обрабатывает 404 ошибки
- Интегрируется с Network для обработки запросов

Пример настройки маршрутов:
```php
use App\Models\Router\Routes;

// Регистрация GET маршрута
Routes::get('/path', function() {
    // Обработка запроса
});

// Регистрация POST маршрута
Routes::post('/api/data', function() {
    // Обработка данных
});

// Использование контроллера
Routes::get('/users', [UserController::class, 'index']);
```

### Взаимодействие компонентов

Network и Router тесно взаимодействуют:
1. Network инициализирует базу данных и необходимые таблицы
2. Router обрабатывает входящие запросы через паттерны маршрутизации
3. Network предоставляет готовые SQL-запросы для работы с данными
4. Router определяет нужный контроллер или callback-функцию
5. Network обрабатывает ответ и перенаправления

### Структура базы данных

Network автоматически создает и управляет следующими таблицами:

#### users_php
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- mail (VARCHAR(50))
- username (VARCHAR(50))
- password (VARCHAR(255))
- session (VARCHAR(255))

#### articles
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- title (VARCHAR(255))
- content (TEXT)
- user_id (INT, FOREIGN KEY)
- created_at (TIMESTAMP)

## Работа с фреймворком

### Создание нового контроллера
```php
namespace App\Controllers;

class UserController {
    public function index() {
        // Логика контроллера
    }
}
```

### Создание модели
```php
namespace App\Models;

class User {
    public function find($id) {
        // Логика поиска пользователя
    }
}
```

### Работа с представлениями
```php
// В контроллере
public function show() {
    return view('users/show', ['user' => $user]);
}
```

## Сетевая конфигурация

### Настройка Apache (.htaccess)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
```

### Безопасность
- Защита от XSS-атак
- CSRF-токены
- Безопасные сессии
- Валидация входных данных

## Требования

- PHP >= 7.4
- Apache с mod_rewrite
- Composer
- MySQL >= 5.7

## Лицензия

MIT License. См. файл LICENSE для подробностей.

## Поддержка

Если у вас возникли вопросы или проблемы, создайте issue в репозитории проекта.

## Дополнительная документация

Более подробная документация доступна в директории `docs/`:
- [Руководство по установке](docs/installation.md)
- [Руководство по конфигурации](docs/configuration.md)
- [Руководство по развертыванию](docs/deployment.md)

## Маршрутизация

### Базовая настройка

Все маршруты определяются в файле `app/Config/Router.php`:

```php
// GET маршруты
$router->get('/', 'HomeController@index');
$router->get('/about', 'PageController@about');

// POST маршруты
$router->post('/api/data', 'ApiController@store');

// Маршруты с параметрами
$router->get('/users/{id}', 'UserController@show');
$router->get('/posts/{category}/{id}', 'PostController@show');
```

### Middleware

Router поддерживает middleware для обработки запросов:

```php
// Регистрация middleware
$router->middleware('auth', function($request, $next) {
    // Проверка аутентификации
    return $next($request);
});

// Применение middleware к маршруту
$router->get('/admin', 'AdminController@index')->middleware('auth');
```

### Обработка ошибок

Network и Router совместно обрабатывают ошибки:

```php
// В Router.php
$router->setErrorHandler(function($error) {
    return Network::sendError($error->getMessage(), $error->getCode());
});
```

### Примеры использования

#### Простой маршрут с callback-функцией
```php
Routes::get('/hello', function() {
    return "Привет, мир!";
});
```

#### Маршрут с контроллером
```php
Routes::get('/users', [UserController::class, 'index']);
```

#### POST-маршрут с обработкой данных
```php
Routes::post('/submit', function() {
    $data = $_POST;
    // Валидация и обработка данных
    return json_encode(['success' => true]);
});
```

### Обработка ошибок

Если маршрут не найден, система автоматически возвращает 404 ошибку:
```php
header("HTTP/1.0 404 Not Found");
return "404 Not Found";
``` 