<?php

class MyDatabase {

    public static function connect() {
        $dsn = 'mysql:dbname=MUN;host=127.0.0.1';
        $user = 'root';
        $password = '';
        $dbh = null;
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
        $success = $sth->execute(array($id));
        $user = $sth->fetch();
        $sth->closeCursor();
        return $user;
    }
    
    public static function getUserLogin($dbh, $login) {
        $query = "SELECT * FROM `users` WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
        $success = $sth->execute(array($login));
        $user = $sth->fetch();
        $sth->closeCursor();
        return $user;
    }

    public static function insertUser($dbh, $login, $password, $admin, $name, $cabinet, $character, $description) {
        $query = "INSERT INTO `users` (`id`, `login`, `password_hash`, `admin`, `name`, `cabinet`, `character`, `description`, `alive`, `email`, `phone`) VALUES (NULL, ?, SHA1(?), ?, ?, ?, ?, ?, '1', NULL, NULL)";
        $sth = $dbh->prepare($query);
        $user = User::getUserLogin($dbh, $login);
        $success = false;
        if ($user == NULL) {
            $sth = $dbh->prepare($query);
            $success = $sth->execute(array($login, $password, $admin, $name, $cabinet, $character, $description));
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
        if ($user != NULL && $user->password_hash == SHA1($password)) {
            return true;
        } else {
            return false;
        }
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
        $success = $sth->execute(array($id));
        $cabinet = $sth->fetch();
        $sth->closeCursor();
        return $cabinet;
    }
    
    public static function getCabinetName($dbh, $name) {
        $query = "SELECT * FROM `cabinets` WHERE name = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Cabinet');
        $success = $sth->execute(array($name));
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

    public function __toString() {
        $string = "Directive " . $this->id;
        return $string;
    }

    public static function getDirective($dbh, $id) {
        $query = "SELECT * FROM `directives` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Directive');
        $success = $sth->execute(array($id));
        $directive = $sth->fetch();
        $sth->closeCursor();
        return $directive;
    }

    public static function insertDirective($dbh, $delegate, $cabinet, $title, $content, $collective) {
        $query = "INSERT INTO `directives` (`id`, `delegate`, `cabinet`, `time`, `title`, `content`, `collective`, `answer`, `answered`) VALUES (`NULL`, ?, ?, `NULL`, ?, ?, ?, `NULL`, `NULL`)";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($dbh, $delegate, $cabinet, $title, $content, $collective));
        return $success;
    }

    public static function deleteDirective($dbh, $id) {
        $query = "DELETE FROM `directives` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($id));
        return $success;
    }

}

class Message {

    public $id;
    public $sender;
    public $recipient;
    public $time;
    public $title;
    public $content;

    public function __toString() {
        $string = "Message " . $this->id;
        return $string;
    }

    public static function getMessage($dbh, $id) {
        $query = "SELECT * FROM `messages` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Message');
        $success = $sth->execute(array($id));
        $directive = $sth->fetch();
        $sth->closeCursor();
        return $directive;
    }

    public static function insertMessage($dbh, $sender, $recipient, $title, $content) {
        $query = "INSERT INTO `messages` (`id`, `sender`, `recipient`, `time`, `title`, `content`) VALUES (`NULL`, ?, ?, `NULL`, ?, ?)";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($dbh, $sender, $recipient, $title, $content));
        return $success;
    }

    public static function deleteMessage($dbh, $id) {
        $query = "DELETE FROM `dmessages` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($id));
        return $success;
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
        $success = $sth->execute(array($id));
        $directive = $sth->fetch();
        $sth->closeCursor();
        return $directive;
    }

    public static function insertNewsItem($dbh, $title, $content) {
        $query = "INSERT INTO `messages` (`id`, `time`, `title`, `content`) VALUES (`NULL`, `NULL`, ?, ?)";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($dbh, $title, $content));
        return $success;
    }

    public static function deleteNewsItem($dbh, $id) {
        $query = "DELETE * FROM `news` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $success = $sth->execute(array($id));
        return $success;
    }

}
?>