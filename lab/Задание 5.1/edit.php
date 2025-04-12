<?php
require_once __DIR__ . '/db.php';

function getEditForm($id = null)
{
    global $pdo;

    // Get all contacts for the list
    $stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '<div style="max-width: 800px; margin: 0 auto;">';

    // Display contact list
    $html .= '<div style="margin-bottom: 20px;">';
    foreach ($contacts as $contact) {
        $activeClass = ($contact['id'] == $id) ? ' style="color: red;"' : '';
        $html .= '<a href="index.php?action=edit&id=' . $contact['id'] . '"' . $activeClass . '>' .
            htmlspecialchars($contact['surname'] . ' ' . $contact['name']) . '</a><br>';
    }
    $html .= '</div>';

    // If no contact selected, select first one
    if (!$id && !empty($contacts)) {
        $id = $contacts[0]['id'];
    }

    // Get contact data if ID is provided
    $contactData = null;
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$id]);
        $contactData = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Display edit form
    $html .= '<form method="POST" action="index.php?action=edit&id=' . $id . '">';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = updateContact($id);
        if ($result) {
            $html .= '<p style="color: green;">Запись обновлена</p>';
            // Refresh contact data
            $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
            $stmt->execute([$id]);
            $contactData = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $html .= '<p style="color: red;">Ошибка: запись не обновлена</p>';
        }
    }

    $html .= '
        <div style="margin-bottom: 10px;">
            <label>Фамилия: <input type="text" name="surname" value="' . htmlspecialchars($contactData['surname'] ?? '') . '" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Имя: <input type="text" name="name" value="' . htmlspecialchars($contactData['name'] ?? '') . '" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Отчество: <input type="text" name="patronymic" value="' . htmlspecialchars($contactData['patronymic'] ?? '') . '"></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Пол: 
                <select name="gender" required>
                    <option value="male" ' . (($contactData['gender'] ?? '') === 'male' ? 'selected' : '') . '>Мужской</option>
                    <option value="female" ' . (($contactData['gender'] ?? '') === 'female' ? 'selected' : '') . '>Женский</option>
                </select>
            </label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Дата рождения: <input type="date" name="birthdate" value="' . ($contactData['birthdate'] ?? '') . '" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Телефон: <input type="tel" name="phone" value="' . htmlspecialchars($contactData['phone'] ?? '') . '" required></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Адрес: <textarea name="address">' . htmlspecialchars($contactData['address'] ?? '') . '</textarea></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Email: <input type="email" name="email" value="' . htmlspecialchars($contactData['email'] ?? '') . '"></label>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Комментарий: <textarea name="comment">' . htmlspecialchars($contactData['comment'] ?? '') . '</textarea></label>
        </div>
        <div>
            <input type="submit" value="Сохранить">
        </div>
    </form>';

    $html .= '</div>';
    return $html;
}

function updateContact($id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("UPDATE contacts SET surname = ?, name = ?, patronymic = ?, gender = ?, birthdate = ?, phone = ?, address = ?, email = ?, comment = ? WHERE id = ?");
        return $stmt->execute([
            $_POST['surname'],
            $_POST['name'],
            $_POST['patronymic'],
            $_POST['gender'],
            $_POST['birthdate'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['email'],
            $_POST['comment'],
            $id
        ]);
    } catch (PDOException $e) {
        return false;
    }
}
?>