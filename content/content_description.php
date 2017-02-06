<?php
$tableauLangues = array("allemand", "anglais", "arabe", "chinois", "espagnol", "francais", "italien", "japonais", "portugais", "russe");
?>

<div class="row" style="background-color: black; border-radius: 20pt" id="up">
    <?php
    foreach ($tableauLangues as $lg) {
        echo "<div class='col-md-2  col-sm-4 col-6'>";
        echo "<br>";
        echo "<a href=#$lg><img src='medias/" . $lg . ".png' alt='drapeau' class='img-responsive img-rounded'></a>";
        echo"<br>";
        echo "</div>";
    }
    ?>

</div>

<br>

<div class="row">

     <?php
     foreach ($tableauLangues as $lg) {
         echo "<div class='panel panel-danger'>";
         echo "<div class='panel-heading'>";
         echo "<h2 id = " . $lg . ">" . $lg . "</h2>";
         echo "<a class='retour-haut' href='#up'>retour haut</a>";
         echo "</div>";
         echo "<div class='panel-body'>";
         echo "</div>";
         echo "</div>";
     }
     ?>

</div>