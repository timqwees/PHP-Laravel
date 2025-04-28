<?php
/**
 * 
 *  _____                                                                                _____ 
 * ( ___ )                                                                              ( ___ )
 *  |   |~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|   | 
 *  |   |                                                                                |   | 
 *  |   |                                                                                |   | 
 *  |   |    ________  ___       __   _______   _______   ________                       |   | 
 *  |   |   |\   __  \|\  \     |\  \|\  ___ \ |\  ___ \ |\   ____\                      |   | 
 *  |   |   \ \  \|\  \ \  \    \ \  \ \   __/|\ \   __/|\ \  \___|_                     |   | 
 *  |   |    \ \  \\\  \ \  \  __\ \  \ \  \_|/_\ \  \_|/_\ \_____  \                    |   | 
 *  |   |     \ \  \\\  \ \  \|\__\_\  \ \  \_|\ \ \  \_|\ \|____|\  \                   |   | 
 *  |   |      \ \_____  \ \____________\ \_______\ \_______\____\_\  \                  |   | 
 *  |   |       \|___| \__\|____________|\|_______|\|_______|\_________\                 |   | 
 *  |   |             \|__|                                 \|_________|                 |   | 
 *  |   |    ________  ________  ________  _______   ________  ________  ________        |   | 
 *  |   |   |\   ____\|\   __  \|\   __  \|\  ___ \ |\   __  \|\   __  \|\   __  \       |   | 
 *  |   |   \ \  \___|\ \  \|\  \ \  \|\  \ \   __/|\ \  \|\  \ \  \|\  \ \  \|\  \      |   | 
 *  |   |    \ \  \    \ \  \\\  \ \   _  _\ \  \_|/_\ \   ____\ \   _  _\ \  \\\  \     |   | 
 *  |   |     \ \  \____\ \  \\\  \ \  \\  \\ \  \_|\ \ \  \___|\ \  \\  \\ \  \\\  \    |   | 
 *  |   |      \ \_______\ \_______\ \__\\ _\\ \_______\ \__\    \ \__\\ _\\ \_______\   |   | 
 *  |   |       \|_______|\|_______|\|__|\|__|\|_______|\|__|     \|__|\|__|\|_______|   |   | 
 *  |   |                                                                                |   | 
 *  |   |                                                                                |   | 
 *  |___|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|___| 
 * (_____)                                                                              (_____)
 * 
 * Эта программа является свободным программным обеспечением: вы можете распространять ее и/или модифицировать
 * в соответствии с условиями GNU General Public License, опубликованными
 * Фондом свободного программного обеспечения (Free Software Foundation), либо в версии 3 Лицензии, либо (по вашему выбору) в любой более поздней версии.
 *
 * @author TimQwees
 * @link https://github.com/TimQwees/Qwees_CorePro
 * 
 */

namespace App\Models\User;

use App\Config\Database;
use App\Models\Network\Network;
use PDO;

class User
{
    private static $db;
    private $verifyTable;
    private $className = 'users_php';
    private $network;

    public function __construct()
    {
        self::$db = Database::getConnection();
        $this->network = new Network();
        $this->verifyTable = Network::onTableCheck($this->className);
    }

    public function getUser(string $type, int $index)
    {
        try {
            $this->verifyTable;//check table
            switch ($type) {
                case 'id':
                    $stmt = $this->network->QuaryRequest__User['getUser_id'];
                    $stmt->execute([$index]);
                    break;
                case 'username':
                    $stmt = $this->network->QuaryRequest__User['getUser_username'];
                    $stmt->execute([$index]);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function onUpdateGroup(int $userId, int $newGroup)
    {
        try {
            $this->verifyTable;//check table
            $stmt = $this->network->QuaryRequest__User['onUpdateGroup'];
            return $stmt->execute([$newGroup, $userId]);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function onSessionUser($index)
    {
        try {
            $this->verifyTable;//check table
            $stmt = $this->network->QuaryRequest__User['onSessionUser_id'];
            $stmt->execute([$index]);
            if (!$stmt->rowCount() > 1) {
                $stmt = $this->network->QuaryRequest__User['onSessionUser_username'];
                $stmt->execute([$index]);
                $found = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($found == 'off') {
                    Network::onRedirect('/login.php');
                    return false;
                }
                return true;
            } else {
                error_log("Пользовательский id = `$index` зарегестрирован " . $stmt->rowCount() . " раз в таблице $this->className!");
            }
            if (!$stmt->rowCount() > 0) {
                Network::onRedirect('/login.php');
            }
        } catch (\PDOException $e) {
            return false;
        }
    }
}