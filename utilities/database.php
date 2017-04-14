<?php

$salt = "Iletaitunebergerequiallaitaumarche314159€€€£££";

class MyDatabase {

    public static function connect() {
        $dsn = 'mysql:dbname=MUN;host=127.0.0.1';
        $user = 'root';
        $password = '';
        //$dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion failed : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }

}

class User {

    public $id;
    public $login;
    public $password_hash;
    public $admin;
    public $name;
    public $cabinet;
    public $character;
    public $description;
    public $alive;
    public $email;
    public $phone;


    public function __toString() {
        $string = "User " . $this->id;
        return $string;
    }

    public static function getUserId($dbh, $id) {
        $query = "SELECT * FROM `users` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
        $sth->execute(array($id));
        $user = $sth->fetch();
        $sth->closeCursor();
        return $user;
    }

    public static function getUserLogin($dbh, $login) {
        $query = "SELECT * FROM `users` WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
        $sth->execute(array($login));
        $user = $sth->fetch();
        $sth->closeCursor();
        return $user;
    }

    public static function insertUser($dbh, $login, $password, $admin, $name, $cabinet, $character, $description) {
        global $salt;
        $query = "INSERT INTO `users` (`id`, `login`, `password_hash`, `admin`, `name`, `cabinet`, `character`, `description`, `alive`, `email`, `phone`) VALUES (NULL, ?, SHA1(?), ?, ?, ?, ?, ?, '1', NULL, NULL)";
        $sth = $dbh->prepare($query);
        $user = User::getUserLogin($dbh, $login);
        $success = false;
        if ($user == NULL) {
            $sth = $dbh->prepare($query);
            $success = $sth->execute(array($login, $password.$salt, $admin, $name, $cabinet, $character, $description));
        }
        return $success;
    }

    public static function deleteUser($dbh, $id) {
        $query = "DELETE FROM `users` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($id));
        return $success;
    }

    public static function existsLogin($dbh, $login) {
        $query = "SELECT * FROM `users` WHERE login = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($login));
        return $success && ($sth->rowCount() == 1);
    }

    public static function testPassword($user, $password) {
        global $salt;
        if ($user != NULL && $user->password_hash == SHA1($password.$salt)) {
            return true;
        } else {
            return false;
        }
    }

    public static function setPassword($dbh, $user, $oldPassword, $newPassword) {
        global $salt;
        if (User::testPassword($user, $oldPassword)) {
            $query = "UPDATE `users` SET `password_hash` = SHA1(?) WHERE id = ?";
            $sth = $dbh->prepare($query);
            $success = $sth->execute(array($newPassword.$salt, $user->id));
            return $success;
        }
        return false;
    }

    public static function setPasswordNoComp($dbh, $user, $newPassword) {
        global $salt;
        $query = "UPDATE `users` SET `password_hash` = SHA1(?) WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($newPassword.$salt, $user->id));
        return $success;
    }

    public static function setDescription($dbh, $user, $newDescription) {
        $query = "UPDATE `users` SET `description` = ? WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($newDescription, $user->id));
        return $success;
    }

    public static function setCharacter($dbh, $user, $newCharacter) {
        $query = "UPDATE `users` SET `character` = ? WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($newCharacter, $user->id));
        return $success;
    }

    public static function setEmail($dbh, $user, $newEmail) {
        $query = "UPDATE `users` SET `email` = ? WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($newEmail, $user->id));
        return $success;
    }

    public static function setPhone($dbh, $user, $newPhone) {
        $query = "UPDATE `users` SET `phone` = ? WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($newPhone, $user->id));
        return $success;
    }

}

class Cabinet {

    public $id;
    public $name;
    public $description;

    public function __toString() {
        $string = "Cabinet " . $this->id;
        return $string;
    }

    public static function getCabinet($dbh, $id) {
        $query = "SELECT * FROM `cabinets` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Cabinet');
        $sth->execute(array($id));
        $cabinet = $sth->fetch();
        $sth->closeCursor();
        return $cabinet;
    }

    public static function getCabinetName($dbh, $name) {
        $query = "SELECT * FROM `cabinets` WHERE name = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Cabinet');
        $sth->execute(array($name));
        $cabinet = $sth->fetch();
        $sth->closeCursor();
        return $cabinet;
    }

    public static function insertCabinet($dbh, $name, $description) {
        $query = "INSERT INTO `cabinets` (`id`, `name`, `description`) VALUES (NULL, ?, ?)";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($name, $description));
        return $success;
    }

    public static function deleteCabinet($dbh, $id) {
        $query = "DELETE FROM `cabinets` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($id));
        return $success;
    }

    public function findDelegates($dbh) {
        $query = "SELECT * FROM `users` WHERE cabinet = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Cabinet');
        $sth->execute(array($this->id));
        $delegates = [];
        $i = 0;
        while ($user = $sth->fetch()) {
            $delegates[$i] = $user;
            $i += 1;
        }
        return $delegates;
    }

    public static function populationCabinet($dbh, $id) {
        $query = "SELECT * FROM `users` WHERE cabinet = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Cabinet');
        $sth->execute(array($id));
        $n = 0;
        while ($user = $sth->fetch()) {
            $n += 1;
        }
        return $n;
    }

}

class Directive {

    public $id;
    public $delegate;
    public $cabinet;
    public $time;
    public $title;
    public $content;
    public $collective;
    public $answer;
    public $answered;
    public $favor;
    public $against;
    public $abstention;

    public function __toString() {
        $string = "Directive " . $this->id;
        return $string;
    }

    public static function getDirective($dbh, $id) {
        $query = "SELECT * FROM `directives` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Directive');
        $sth->execute(array($id));
        $directive = $sth->fetch();
        $sth->closeCursor();
        return $directive;
    }

    public static function lastIdDirective($dbh) {
        $query = "SELECT * FROM `directives` ORDER BY id DESC";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Directive');
        $sth->execute(array());
        $directive = $sth->fetch();
        $sth->closeCursor();
        return $directive->id;
    }

    public static function insertDirective($dbh, $delegate, $cabinet, $title, $content, $collective) {
        $newId = Directive::lastIdDirective($dbh) + 1;
        $abstention = Cabinet::populationCabinet($dbh, $cabinet);
        $query = "INSERT INTO `directives` (`id`, `delegate`, `cabinet`, `time`, `title`, `content`, `collective`, `answer`, `answered`, `favor`, `against`, `abstention`) VALUES ($newId, ?, ?, NULL, ?, ?, ?, NULL, 0, 0, 0, $abstention)";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($delegate, $cabinet, $title, $content, $collective));
        if ($collective) {
            Directive::startVote($dbh, $newId, $cabinet);
        }
        return $success;
    }

    public static function startVote($dbh, $directiveId, $cabinetId) {
        $cabinet = Cabinet::getCabinet($dbh, $cabinetId);
        $delegates = $cabinet->findDelegates($dbh);
        foreach ($delegates as $delegate) {
            $query = "INSERT INTO `vote` (`id`, `directive`, `delegate`) VALUES (NULL, ?, ?)";
            $sth = $dbh->prepare($query);
            $success = $sth->execute(array($directiveId, $delegate->id));
        }
        return success;
    }

    public static function stopVote($dbh, $directiveId) {
        $query = "DELETE FROM `vote` WHERE `directive`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($directiveId));
        return success;
    }

    public static function deleteDirective($dbh, $id) {
        $query = "DELETE FROM `directives` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($id));
        return $success;
    }

    public function status($dbh) {
        $population = Cabinet::populationCabinet($dbh, $this->cabinet);
        if ($this->answered) {
            return "Answered";
        } else if (!$this->collective || ($this->collective && ($this->favor > $population / 2))) {
            return "Validated";
        } else if ($this->collective && $this->abstention > $population / 3) {
            return "Vote ongoing";
        } else {
            return "Rejected";
        }
        return "Oh, that's not a normal status";
    }

    public function cabinet($dbh) {
        return Cabinet::getCabinet($dbh, $this->cabinet);
    }

    public function delegate($dbh) {
        return User::getUserId($dbh, $this->delegate);
    }

    public function answerDirective($dbh, $id, $answer) {
        $query = "UPDATE `directives` SET `answer`=?,`answered`=1 WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($answer,$id));
        return $success;
    }

    public function voteDirective($dbh, $directiveId, $delegateId, $positive) {

        // Change the number of votes

        $dir = Directive::getDirective($dbh, $directiveId);
        if ($positive) {
            $newFavor = $dir->favor + 1;
            $newAbstention = $dir->abstention - 1;
            $query1 = "UPDATE `directives` SET `favor`=$newFavor,`abstention`=$newAbstention WHERE id = ?";
        } else {
            $newAgainst = $dir->against + 1;
            $newAbstention = $dir->abstention - 1;
            $query1 = "UPDATE `directives` SET `against`=$newAgainst,`abstention`=$newAbstention WHERE id = ?";
        }
        $sth1 = $dbh->prepare($query1);
        $success1 = $sth1->execute(array($directiveId));

        // Tell the delegate he doesn't have to vote anymore

        $query2 = "DELETE FROM `vote` WHERE `delegate`=? AND `directive`=?";
        $sth2 = $dbh->prepare($query2);
        $success2 = $sth2->execute(array($delegateId, $directiveId));

        // If necessary, stop the vote

        $dir2 = Directive::getDirective($dbh, $directiveId);
        if ($dir2->status($dbh) === "Validated") {
            Directive::stopVote($dbh, $directiveId);
        }

        return $success1 && $success2;
    }

}

class NewsItem {

    public $id;
    public $time;
    public $title;
    public $content;

    public function __toString() {
        $string = "News item " . $this->id;
        return $string;
    }

    public static function getNewsItem($dbh, $id) {
        $query = "SELECT * FROM `news` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'NewsItem');
        $sth->execute(array($id));
        $directive = $sth->fetch();
        $sth->closeCursor();
        return $directive;
    }

    public static function insertNewsItem($dbh, $title, $content) {
        $query = "INSERT INTO `news` (`id`, `time`, `title`, `content`) VALUES (NULL, NULL, ?, ?);";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($title, $content));
        return $success;
    }

    public static function deleteNewsItem($dbh, $id) {
        $query = "DELETE FROM news WHERE id = ?;";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($id));
        return $success;
    }

}

class MapPoint
{
  public $id;
  public $title;
  public $latitude;
  public $longitude;

  public static function insertMapPoint($dbh, $title, $latitude, $longitude)
  {
    $query = "INSERT INTO `map_points` (title, latitude, longitude) VALUES (?, ?, ?);";
    $sth = $dbh->prepare($query);
    $success = $sth->execute(array($title, $latitude, $longitude));
    return $success;
  }

  public static function deleteMapPoint($dbh, $id)
  {
    $query = "DELETE FROM map_points WHERE id = ?;";
    $sth = $dbh->prepare($query);
    $success = $sth->execute(array($id));
    return $success;
  }
}

class ChatMessage
{
  public $id;
  public $cabinet;
  public $message;

  public static function insertMessage($dbh, $UID, $cabinet, $message)
  {
    if(strlen($message) == 0) { return true; }
    $message = htmlspecialchars($message);
    $req = $dbh->prepare("INSERT INTO chat (user, cabinet, message) VALUES (:UID, :cabinet, :message)");
    $success = $req->execute(array(':UID'=> $UID, ':cabinet'=> $cabinet, ':message'=>$message,));
    return $success;
  }
}
?>
