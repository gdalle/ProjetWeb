<?php
require("utilities/utils.php");
if (array_key_exists("page", $_GET)) {
    $askedPage = $_GET["page"];
} else {
    $askedPage = "accueil";
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
        <h1>
            <?php
            echo $pageTitle;
            ?>
            <br>
            <?php
            echo "<small>$pageSubtitle</small>";
            ?>
        </h1>
    </div>
</div>

<div class="row" id="content">
    <?php
    if ($authorized) {
        require("content/content_" . $askedPage . ".php");
    } else {
        echo <<<CHAINE_DE_FIN
            <div class="row">    
                <div class="alert alert-danger">
                    <strong>Une erreur s'est produite !</strong> Je vais m'en occuper...
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