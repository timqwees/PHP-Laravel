<?php
require_once __DIR__ . '/db.php';

function getAddForm()
{
    $html = '<form method="POST" action="index.php?action=add" style="max-width: 600px; margin: 0 auto;">';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = addContact();
        if ($result) {
            $html .= '<p style="color: green;">Запись добавлена</p>';
        } else {
            $html .= '<p style="color: red;">Ошибка: запись не добавлена</p>';
        }
    }

    $html .= '
        <div style="margin-bottom: 10px;">
            <label>Фамилия: <input type="text" name="surname" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Имя: <input type="text" name="name" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Отчество: <input type="text" name="patronymic"></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Пол: 
                <select name="gender" required>
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                </select>
            </label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Дата рождения: <input type="date" name="birthdate" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Телефон: <input type="tel" name="phone" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Адрес: <textarea name="address"></textarea></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Email: <input type="email" name="email"></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Комментарий: <textarea name="comment"></textarea></label>
        </div>
        <div>
            <input type="submit" value="Добавить">
        </div>
    </form>';

    return $html;
}

function addContact()
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("INSERT INTO contacts (surname, name, patronymic, gender, birthdate, phone, address, email, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $_POST['surname'],
            $_POST['name'],
            $_POST['patronymic'],
            $_POST['gender'],
            $_POST['birthdate'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['email'],
            $_POST['comment']
        ]);
    } catch (PDOException $e) {
        return false;
    }
}
?>