$(document).ready(function () {

    $("#change_email").click(function () {
        $.post("utilities/profileChanger.php?todo=change_email",
                {newEmail: $("#newEmail").val()},
                function (rep) {
                    $("#change_result").show();
                    $("#change_result").html(rep);
                });
        return false;
    });

    $("#change_description").click(function () {
        $.post("utilities/profileChanger.php?todo=change_description",
                {newDescription: $("#newDescription").val()},
                function (rep) {
                    $("#change_result").show();
                    $("#change_result").html(rep);
                });
        return false;
    });

    $("#change_phone").click(function () {
        $.post("utilities/profileChanger.php?todo=change_phone",
                {newPhone: $("#newPhone").val()},
                function (rep) {
                    $("#change_result").show();
                    $("#change_result").html(rep);
                });
        return false;
    });

    $("#change_password").click(function () {
        $.post("utilities/profileChanger.php?todo=change_password",
                {newPassword: $("#newPassword").val(), oldPassword: $("#oldPassword").val()},
                function (rep) {
                    $("#password_change_result").html(rep);
                });
        return false;
    });

    $(".show_changer").mouseenter(function () {
        $(this).css("color", "red");
    });

    $(".show_changer").click(function () {
        $("#" + $(this).attr("id") + "_form").toggle();
    });

    $(".show_changer").mouseout(function () {
        $(this).css("color", "black");
    });


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
        $.post("utilities/userHandler.php?todo=create_user",
                {user_login: $("#user_login").val(), user_password: $("#user_password").val(), user_admin: $("#user_admin").val(), user_name: $("#user_name").val(), user_cabinet: $("#user_cabinet").val(), user_character: $("#user_character").val(), user_description: $("#user_description").val()},
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

    $(".delete_user").mouseenter(function () {
        $(this).css("color", "red");
    });

    $(".delete_user").mouseout(function () {
        $(this).css("color", "black");
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

    $(".delete_cabinet").mouseenter(function () {
        $(this).css("color", "red");
    });

    $(".delete_cabinet").mouseout(function () {
        $(this).css("color", "black");
    });

    $(".delete_user").click(function () {
        var id = $(this).attr("id").substr(12);
        console.log(id);
        $.post("utilities/userHandler.php?todo=delete_user",
                {user_id: id},
                function () {
                    $("tr#user_" + id).hide();
                });
    });

    function drawRegionsMap() {

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

    /*
     $("#regions_div").ready(function () {
     google.charts.load('current', {'packages': ['geochart']});
     google.charts.setOnLoadCallback(drawRegionsMap);
     });
     */

});