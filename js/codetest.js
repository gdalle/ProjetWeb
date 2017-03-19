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

    /*    $(".lien").click(function(){
     
     //$("#main").load("content/content_"+$(this).attr('id')+".php");
     $.post("content/content_"+$(this).attr('id')+".php",{id:45,toto:'Olivier'},function(rep){
     $("#main").html(rep);//colle la réponse dans le div d'id main
     });
     window.location.hash = $(this).attr('id');
     return false;
     });
     
     
     $("#login").keyup(function(){
     var loginX = $("#login").val(); 
     $.post("scripts/testUser.php",{login:loginX},function(rep){
     if(rep=="0"){//login OK
     $("#login").css("background-color","green");
     }else{
     $("#login").css("background-color","red");               
     }
     });
     });
     */
});

