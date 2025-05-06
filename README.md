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

Фреймворк построен вокруг двух ключевых компонентов:

#### Network (app/Config/Network.php)
- Центральный компонент для обработки всех сетевых запросов
- Управляет HTTP-запросами и ответами
- Обрабатывает заголовки и куки
- Контролирует сессии
- Обеспечивает безопасность запросов

Пример использования Network:
```php
use App\Config\Network;

// Инициализация сетевого компонента
$network = new Network();

// Получение данных запроса
$requestData = $network->getRequestData();

// Отправка ответа
$network->sendResponse($data, $statusCode);
```

#### Router (app/Config/Router.php)
- Управляет всеми маршрутами приложения
- Определяет контроллеры и методы для каждого URL
- Обрабатывает параметры маршрутов
- Обеспечивает middleware функциональность
- Интегрируется с Network для обработки запросов

Пример настройки маршрутов:
```php
use App\Config\Router;

$router = new Router();

// Регистрация маршрутов
$router->get('/', 'HomeController@index');
$router->post('/api/users', 'UserController@store');
$router->get('/users/{id}', 'UserController@show');
```

### Взаимодействие компонентов

Network и Router тесно взаимодействуют:
1. Network получает входящий запрос
2. Передает управление Router'у
3. Router определяет нужный контроллер
4. Network обрабатывает ответ

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