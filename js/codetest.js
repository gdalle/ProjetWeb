$(document).ready(function() {

    $("#loginVu").hide();

    $(".lien").click(function() {
        var lien = "content/content_" + $(this).attr("id") + ".php";
        var nomUtilisateur = $("#nom").val();
        $.post(lien, {nom: nomUtilisateur},function(rep){
        	$("#main").html(rep);
        });
    });


    $("#login").keyup(function() {
        var loginSaisi = $("#login").val();
        $.post("scripts/testUser.php", {login: loginSaisi}, function(rep) {
            if (rep == "0") {//login non utilisé
                $("#login").css("background-color", "green");
                $("#loginVu").hide();
                $("#btnsubmit").show();

            } else {
                $("#login").css("background-color", "red");
                $("#loginVu").show();
                $("#btnsubmit").hide();
            }
        })
    });


    $("#formFilm").submit(function() {

        var url = "http://www.omdbapi.com/?t="+$("#titre").val()+"&y=&plot=short&r=json";
        //alert(url);
        $.getJSON(url, function(data) {
            $("#annee").val(data.Year);
            $("#infoFilm").html(data.Plot);
        });
        return false;
    }
    );
});
