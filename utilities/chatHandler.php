<?php
session_name("SecretSessionName");
session_start();

require("database.php");
require("logInOut.php");

if(!isLogged())
{
  echo "ERROR!";
  exit();
}

if(isset($_GET['todo']) && $_GET['todo']=='sendMessage')
{
  if(!isset($_POST['message']))
  {
    echo "ERROR!";
    exit();
  }
  $message = $_POST["message"];
  $UID = $_SESSION["userId"];
  $cabinet = $_SESSION["cabinet"];
  $db = MyDatabase::connect();
  $req = $db->prepare("INSERT INTO chat (user, message_date, cabinet, message) VALUES(?, ?, ?, ?)");
  $success = $req->execute(array($UID, date("H:i"), $cabinet, $message));
}

if(isset($_GET['todo']) && $_GET['todo']=='getMessages')
{
  $db = MyDatabase::connect();
  $messages = $db->query("SELECT * FROM chat INNER JOIN users ON chat.user = users.id WHERE chat.cabinet = ".$_SESSION['cabinet'].";");
  while($message = $messages->fetch())
  {
    ?>
      <p>
        <b><?php echo($message['name']); ?></b>: <br/>
        <?php echo($message['message']); ?>
      </p>
    <?
  }
}

?>
