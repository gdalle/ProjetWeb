<?php
  session_start();
  require("../utilities/utils.php");
  if(!isset($_GET["todo"]) || !isLogged()) { echo "ERROR"; header("Location: ../index.php?page=error"); exit;}
  if($_GET["todo"]=="send")
  {
    if(!isset($_POST["title"]) || !isset($_POST["content"]) || !isset($_POST["recipient"])) { echo "FILL_ALL_FIELDS"; exit; }
    $title = $_POST["title"];
    $content = $_POST["content"];
    $recipient = $_POST["recipient"];
    $db = new PDO("mysql:host=localhost;dbname=MUN;charset=utf8mb4", "root", "");
    $req = $db->prepare("INSERT INTO messages(sender, recipient, title, content) VALUES(:sender, :recipient, :title, :content)");
    $success = $req->execute(array(
      "sender" => htmlspecialchars($_SESSION["id"]),
      "recipient" => htmlspecialchars($recipient),
      "title" => htmlspecialchars($title),
      "content" => htmlspecialchars($content)
    ));
    if($success)
    {
      echo "TRUE";
      header("Location: ../index.php?page=news_messages");
      exit;
    } else {
      echo("Très grave erreur!!!");
      exit;
    }
  }
  if($_GET["todo"]=="getMessages")
  {
    $db = new PDO("mysql:host=localhost;dbname=MUN;charset=utf8mb4", "root", "");
    $req = $db->prepare("SELECT * FROM messages WHERE recipient = ?");
    $req->execute(array($_SESSION["id"]));
    echo '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
    echo "<messages>\r\n";
    while($data = $req->fetch())
    {
      echo "<message><sender>".$data["sender"]."</sender><recipient>".$data["recipient"]."</recipient><title>".$data["title"]."</title><time>".$data["time"]."</time><content>".$data["content"]."</content></message>\r\n";
    }
    echo "</messages>";
  }
 ?>
