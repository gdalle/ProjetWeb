<?php
session_start();
require("utilities/utils.php");

if (array_key_exists("page", $_GET)) {
    $askedPage = $_GET["page"];
} else {
    $askedPage = "home";
}
$authorized = checkPage($askedPage);
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
    $pageSubtitle = getPageSubtitle($askedPage);
} else {
    $pageTitle = "Erreur";
    $pageSubtitle = "(Grosse erreur)";
}
generateHTMLHeader($pageTitle);
?>

<div class="row">
    <?php
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
            <div class="row">
                <div class="alert alert-danger">
                    <strong>Oups, petit bug !</strong> Je vais m'en occuper...
                </div>
            </div>
            <div class="row">
                <img src="medias/sid.jpg" class="img-responsive">
            </div>

CHAINE_DE_FIN;
    }
    ?>
</div>


<?php
generateHTMLFooter();
?>
