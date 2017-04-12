<?php
session_name("SecretSessionName");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
// Décommenter la ligne suivante pour afficher le tableau $_SESSION pour le debuggage
//print_r($_SESSION);

require("utilities/menu.php");
require("utilities/database.php");
$dbh = MyDatabase::connect();
require("utilities/logInOut.php");

// Traitement des contenus de formulaires

if (isset($_GET['todo']) && $_GET['todo'] == "login") {
    login($dbh);
}
if (isset($_GET['todo']) && $_GET['todo'] == "logout") {
    logout($dbh);
}

// Selection des pages

if (isset($_GET["page"])) {
    $askedPage = $_GET["page"];
    if ($askedPage != "login" && !isLogged()) {
        $askedPage = "home";
    }
} else {
    $askedPage = "home";
}
$authorized = checkPage($askedPage);
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
    $pageSubtitle = getPageSubtitle($askedPage);
} else {
    $pageTitle = "Failure";
    $pageSubtitle = "(Terrible failure)";
}
generateHTMLHeader($pageTitle);

?>

<div class="row">
    <?php
    //echo "POST <br>";
    //print_r($_POST);
    //echo "<br> SESSION <br>";
    //print_r($_SESSION);
    generateMenu($askedPage);
    ?>
</div>

<div class="row">
    <div class="page header">
        <h1 id="custom-title">
            <?php
            echo $pageTitle;
            ?>
            <br>
            <?php
            echo "<small id='custom-subtitle'>$pageSubtitle</small>";
            ?>
        </h1>
    </div>
</div>

<div id="content">

    <?php
    if ($authorized) {
        require("content/content_" . $askedPage . ".php");
    } else {
        echo <<<CHAINE_DE_FIN
            <div class="alert alert-danger">
                <strong>Oops, something went wrong.</strong> Please don't do that again..
            </div>

CHAINE_DE_FIN;
    }
    ?>
</div>

<?php
generateHTMLFooter();
?>
