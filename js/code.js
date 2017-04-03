$(document).ready(function () {
    
    // Password checking
    
    $("#user_password").keydown(function() {
        if ($("#user_password").val().length > 4){
            $("#password_form").removeClass("has-warning");
            $("#password_form").addClass("has-success");
            $("#user_password").removeClass("form-control-warning");
            $("#user_password").addClass("form-control-success");
            $("#password_feedback").html("Password secure");
        } else {
            $("#password_form").removeClass("has-success");
            $("#password_form").addClass("has-warning");
            $("#user_password").removeClass("form-control-success");
            $("#user_password").addClass("form-control-warning");
            $("#password_feedback").html("Password not secure");
        }
    });

    // Data tables

    $(".nice_table").DataTable();

    // Profile changing

    $("#change_description").click(function () {
        $.post("utilities/profileChanger.php?todo=change_description",
                {newDescription: $("#newDescription").val()},
                function (rep) {
                    if (rep === "No change occurred") {
                        $("#change_result").show();
                        $("#change_result").html(rep);
                    } else {
                        $("#show_changer_1_form").hide();
                        $("#content_changer_1").html(rep);
                    }
                });
        return false;
    });

    $("#change_character").click(function () {
        $.post("utilities/profileChanger.php?todo=change_character",
                {newCharacter: $("#newCharacter").val()},
                function (rep) {
                    if (rep === "No change occurred") {
                        $("#change_result").show();
                        $("#change_result").html(rep);
                    } else {
                        $("#show_changer_0_form").hide();
                        $("#content_changer_0").html(rep);
                    }
                });
        return false;
    });

    $("#change_email").click(function () {
        $.post("utilities/profileChanger.php?todo=change_email",
                {newEmail: $("#newEmail").val()},
                function (rep) {
                    if (rep === "No change occurred") {
                        $("#change_result").show();
                        $("#change_result").html(rep);
                    } else {
                        $("#show_changer_2_form").hide();
                        $("#content_changer_2").html(rep);
                    }
                });
        return false;
    });

    $("#change_phone").click(function () {
        $.post("utilities/profileChanger.php?todo=change_phone",
                {newPhone: $("#newPhone").val()},
                function (rep) {
                    if (rep === "No change occurred") {
                        $("#change_result").show();
                        $("#change_result").html(rep);
                    } else {
                        $("#show_changer_3_form").hide();
                        $("#content_changer_3").html(rep);
                    }
                });
        return false;
    });

    $("#change_password_comp").click(function () {
        $.post("utilities/profileChanger.php?todo=change_password_comp",
                {newPassword: $("#newPassword").val(), oldPassword: $("#oldPassword").val()},
                function (rep) {
                    $("#password_change_result").html(rep);
                });
        return false;
    });

    $("#change_password_nocomp").click(function () {
        $.post("utilities/profileChanger.php?todo=change_password_nocomp",
                {newPassword: $("#newPassword").val()},
                function (rep) {
                    $("#password_change_result").html(rep);
                });
        return false;
    });

    $(".show_changer").click(function () {
        $("#" + $(this).attr("id") + "_form").toggle();
    });

    // Users management

    $("#create_cabinet").submit(function () {
        $.post("utilities/userHandler.php?todo=create_cabinet",
                {cabinet_name: $("#cabinet_name").val(), cabinet_description: $("#cabinet_description").val()},
                function (rep) {
                    $("#cabinets_table").append(rep);
                    $(".delete_cabinet").click(function () {
                        var id = $(this).attr("id").substr(15);
                        $.post("utilities/userHandler.php?todo=delete_cabinet",
                                {cabinet_id: id},
                                function () {
                                    $("tr#cabinet_" + id).hide();
                                });
                    });
                });
        return false;
    });

    $("#create_user").submit(function () {
        $admin = $("input[name='user_admin']:checked").val();
        $.post("utilities/userHandler.php?todo=create_user",
                {user_login: $("#user_login").val(), user_password: $("#user_password").val(), user_admin: $admin, user_name: $("#user_name").val(), user_cabinet: $("#user_cabinet").val(), user_character: $("#user_character").val(), user_description: $("#user_description").val()},
                function (rep) {
                    $("#users_table").append(rep);
                    $(".delete_user").click(function () {
                        var id = $(this).attr("id").substr(12);
                        $.post("utilities/userHandler.php?todo=delete_user",
                                {user_id: id},
                                function () {
                                    $("tr#user_" + id).hide();
                                });
                    });
                });
        return false;
    });

    $(".delete_cabinet").click(function () {
        var id = $(this).attr("id").substr(15);
        console.log(id);
        $.post("utilities/userHandler.php?todo=delete_cabinet",
                {cabinet_id: id},
                function () {
                    $("tr#cabinet_" + id).hide();
                });
    });

    $(".delete_user").click(function () {
        var id = $(this).attr("id").substr(12);
        $.post("utilities/userHandler.php?todo=delete_user",
                {user_id: id},
                function () {
                    $("tr#user_" + id).hide();
                });
    });

    // Directives

    $(".show_content").click(function () {
        var id = $(this).attr("id").substr(13);
        $("#answer_form").hide();
        if ($(this).html() === "Hide") {
            $("#content_to_show").html("");
            $(".show_content").html("Show");
            $(".show_content").removeClass("btn-danger");
            $(".show_content").removeClass("btn-primary");
            $(".show_content").addClass("btn-primary");
        } else {
            $("#content_to_show").html($("#content_to_show_" + id).html());
            $(".show_content").html("Show");
            $(".show_content").removeClass("btn-danger");
            $(".show_content").removeClass("btn-primary");
            $(".show_content").addClass("btn-primary");
            $("#directiveId").attr("value", id);
            $(this).html("Hide");
            $(this).addClass("btn-danger");
        }
        $("#answer_form").hide();
        $(".answer_directive").removeClass("btn-success");
        $(".answer_directive").removeClass("btn-warning");
        $(".answer_directive").addClass("btn-success");
        $(".answer_directive").html("Answer");
    });

    $(".vote_favor").click(function () {
        var id = $(this).attr("id").substr(11);
        $("#content_to_show").html("");
        $.post("utilities/directiveHandler.php?todo=vote_directive",
                {directiveId: id, vote: "favor"},
                function (rep) {
                    $("#directive_to_vote_" + id).hide();
                });
    });

    $(".vote_against").click(function () {
        var id = $(this).attr("id").substr(13);
        $("#content_to_show").html("");
        $.post("utilities/directiveHandler.php?todo=vote_directive",
                {directiveId: id, vote: "against"},
                function (rep) {
                    $("#directive_to_vote_" + id).hide();
                });
    });

    $(".delete_directive").click(function () {
        var id = $(this).attr("id").substr(17);
        $.post("utilities/directiveHandler.php?todo=delete_directive",
                {directiveId: id},
                function (rep) {
                    $("#directive_" + id).hide();
                });
    });

    $(".answer_directive").click(function () {
        var id = $(this).attr("id").substr(17);
        if ($(this).html() === "Show / Answer") {
            $("#content_to_show").html($("#content_to_show_" + id).html());
            $(".directiveIdForm").attr("value", id);
            $("#answer_form").show();
            $(this).removeClass("btn-success");
            $(this).removeClass("btn-warning");
            $(this).addClass("btn-warning");
            $(this).html("Hide");
        } else {
            $("#content_to_show").html("");
            $("#answer_form").hide();
            $(".answer_directive").removeClass("btn-success");
            $(".answer_directive").removeClass("btn-warning");
            $(".answer_directive").addClass("btn-success");
            $(".answer_directive").html("Show / Answer");
        }

    });

    // Maps

    /*    function drawRegionsMap() {
     
     var data = google.visualization.arrayToDataTable([
     ['Country', 'Communism rate'],
     ['United States', -100],
     ['Russia', 75],
     ['France', -50],
     ['United Kingdom', -80],
     ['Ukraine', 20],
     ['China', 100]
     ]);
     
     var options = {
     colorAxis: {colors: ['blue', 'red']},
     backgroundColor: 'white',
     datalessRegionColor: 'grey',
     defaultColor: 'purple',
     };
     
     var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
     
     chart.draw(data, options);
     }
     */

    /*
     $("#regions_div").ready(function () {
     google.charts.load('current', {'packages': ['geochart']});
     google.charts.setOnLoadCallback(drawRegionsMap);
     });
     */

});