<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $type = htmlspecialchars($_POST['type']);
    $message = htmlspecialchars($_POST['message']);
    $response = isset($_POST['response']) ? $_POST['response'] : [];

    // Обработка данных
    echo "<h1>Ваше обращение</h1>";
    echo "<p><strong>Имя пользователя:</strong> $username</p>";
    echo "<p><strong>E-mail:</strong> $email</p>";
    echo "<p><strong>Тип обращения:</strong> $type</p>";
    echo "<p><strong>Текст обращения:</strong><br>$message</p>";

    if (!empty($response)) {
        echo "<p><strong>Предпочитаемый вариант ответа:</strong> " . implode(", ", $response) . "</p>";
    } else {
        echo "<p><strong>Вы не выбрали вариант ответа.</strong></p>";
    }

    echo '<a href="index.php">Вернуться к форме</a>';
} else {
    echo "Некорректный запрос.";
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма обратной связи</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header,
        footer {
            text-align: center;
            margin: 20px 0;
        }

        main {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <img src="https://avatars.mds.yandex.net/i?id=f9f8e3d35c366d89c264b6a69070abfe_l-7451997-images-thumbs&n=13"
            alt="Логотип МосПолитеха" style="width: 100px;">
        <h1>Форма обратной связи</h1>
    </header>

    <main>
        <form action="result.php" method="POST" id="feedbackForm">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="email">E-mail пользователя:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="type">Тип обращения:</label>
            <select id="type" name="type" required>
                <option value="жалоба">Жалоба</option>
                <option value="предложение">Предложение</option>
                <option value="благодарность">Благодарность</option>
            </select><br>

            <label for="message">Текст обращения:</label><br>
            <textarea id="message" name="message" required></textarea><br>

            <label>Вариант ответа:</label><br>
            <input type="checkbox" id="sms" name="response[]" value="sms">
            <label for="sms">SMS</label><br>
            <input type="checkbox" id="email_response" name="response[]" value="email">
            <label for="email_response">Email</label><br>

            <button type="submit">Отправить</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 МосПолитех. Все права защищены.</p>
    </footer>
</body>

</html>