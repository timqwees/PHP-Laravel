<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $type = htmlspecialchars($_POST['type']);
    $message = htmlspecialchars($_POST['message']);
    $response = isset($_POST['response']) ? $_POST['response'] : [];
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
            <h1>Форма ответа:</h1>
        </header>

        <main>
            <?
            // Обработка данных
            echo "<h1>Ваше обращение</h1>";
            echo "<p><strong>Имя пользователя:</strong> $username</p>";
            echo "<p><strong>E-mail:</strong> $email</p>";
            echo "<p><strong>Тип обращения:</strong> $type</p>";
            echo "<p><strong>Текст обращения:</strong> $message</p>";
            if (!empty($response)) {
                echo "<p><strong>Предпочитаемый вариант ответа:</strong> " . implode(", ", $response) . "</p>";
            } else {
                echo "<p><strong>Вы не выбрали вариант ответа.</strong></p>";
            }
} else {
    echo "Некорректный запрос.";
}
?>
        <form action="https://httpbin.org/post" method="POST" id="feedbackForm">
            <input type="hidden" name="username" id="username" value="<? echo $username; ?>" />
            <input type="hidden" name="email" id="email" value="<? echo $email; ?>" />
            <input type="hidden" name="type" id="type" value="<? echo $type; ?>" />
            <input type="hidden" name="message" id="message" value="<? echo $message; ?>" />
            <input type="hidden" name="response" id="sms" value="<? echo implode(", ", $response); ?>" />
            <button>Посмотреть POST-ответы</button>
            <a href="index.php"><span>вернуться к форме</span></a>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 МосПолитех. Все права защищены.</p>
    </footer>
</body>

</html>