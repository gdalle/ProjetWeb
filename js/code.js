$(document).ready(function () {

    // Data tables

    $(".nice_table").DataTable();

    // Calendar

    $('#calendar').fullCalendar({
        googleCalendarApiKey: 'AIzaSyDvO8W9r9lRVgB8A4OCNAPk1uf6yS8Cutw',
        events: {
            googleCalendarId: 'kiig8cisrlauu6d3a7jm46bs1c@group.calendar.google.com'
        },
        defaultView: "listWeek"
    });

    // Password checking

    $("#button_user_create").hide();

    $("#user_password").keyup(function () {
        $safe = $("#user_password").val().length > 4 && typeof $("#login_" + $("#user_login").val()).html() === "undefined";
        if ($safe) {
            $("#password_form").removeClass("has-warning");
            $("#password_form").addClass("has-success");
            $("#user_password").removeClass("form-control-warning");
            $("#user_password").addClass("form-control-success");
            $("#button_user_create").show();
            $("#password_feedback").hide();
        } else {
            $("#password_form").removeClass("has-success");
            $("#password_form").addClass("has-warning");
            $("#user_password").removeClass("form-control-success");
            $("#user_password").addClass("form-control-warning");
            $("#button_user_create").hide()
            $("#password_feedback").show();
            $("#password_feedback").html("Password not secure or login used");
        }
    });


    // Profile changing

    $("#change_description").click(function () {
        $.post("utilities/profileChanger.php?todo=change_description",
                {newDescription: $("#newDescription").val()},
                function (rep) {
                    if (rep === "No change occurred" || rep === "ERROR") {
                        alert(rep);
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
                    if (rep === "No change occurred" || rep === "ERROR") {
                        alert(rep);
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
                    if (rep === "No change occurred" || rep === "ERROR") {
                        alert(rep);
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
                    if (rep === "No change occurred" || rep === "ERROR") {
                        alert(rep);
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
                    alert(rep);
                    $("#password_change_result").html(rep);
                });
        return false;
    });

    $("#change_password_nocomp").click(function () {
        $.post("utilities/profileChanger.php?todo=change_password_nocomp",
                {newPassword: $("#newPassword").val()},
                function (rep) {
                    alert(rep);
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
                    if (rep === "Cabinet creation failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("#cabinets_table").append(rep);
                    }
                });
        return false;
    });

    $("#create_user").submit(function () {
        $admin = $("input[name='user_admin']:checked").val();
        if (typeof $admin === "undefined") {
            $admin = 0;
        }
        $.post("utilities/userHandler.php?todo=create_user",
                {user_login: $("#user_login").val(), user_password: $("#user_password").val(), user_admin: $admin, user_name: $("#user_name").val(), user_cabinet: $("#user_cabinet").val(), user_character: $("#user_character").val(), user_description: $("#user_description").val()},
                function (rep) {
                    if (rep === "User creation failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("#users_table").append(rep);
                    }
                });
        return false;
    });

    $(".delete_cabinet").click(function () {
        var id = $(this).attr("id").substr(15);
        console.log(id);
        $.post("utilities/userHandler.php?todo=delete_cabinet",
                {cabinet_id: id},
                function (rep) {
                    if (rep === "Cabinet deletion failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("tr#cabinet_" + id).hide();
                    }
                });
    });

    $(".delete_user").click(function () {
        var id = $(this).attr("id").substr(12);
        $.post("utilities/userHandler.php?todo=delete_user",
                {user_id: id},
                function (rep) {
                    if (rep === "User deletion failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("tr#user_" + id).hide();
                    }
                });
    });

    // News

    $("#publish").click(function () {
        $.post("utilities/newsHandler.php?todo=publish_news",
                {news_form_title: $("#news_form_title").val(), news_form_content: $("#news_form_content").val()},
                function (rep) {
                    if (rep === "News item insertion failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        location.reload();
                    }
                });
        return false;
    });

    $(".delete_newsItem").click(function () {
        var id = $(this).attr("id").substr(16);
        $.post("utilities/newsHandler.php?todo=delete_newsItem",
                {'id': id},
                function (rep) {
                    if (rep === "News item deletion failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("tr#newsItem_" + id).hide();
                    }
                });
    });

    // Directives

    $("#answer_directive").click(function () {
        $.post("utilities/directiveHandler.php?todo=answer_directive",
                {directiveId: $("#directiveId").val(), answer: $("#answer").val()},
                function (rep) {
                    if (rep === "Directive answering failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("#answer_form").hide();
                    }
                });
        return false;
    });

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

    });

    $(".vote_favor").click(function () {
        var id = $(this).attr("id").substr(11);
        $("#content_to_show").html("");
        $.post("utilities/directiveHandler.php?todo=vote_directive",
                {directiveId: id, vote: "favor"},
                function (rep) {
                    if (rep === "Vote failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("#directive_to_vote_" + id).hide();
                    }
                });
    });

    $(".vote_against").click(function () {
        var id = $(this).attr("id").substr(13);
        $("#content_to_show").html("");
        $.post("utilities/directiveHandler.php?todo=vote_directive",
                {directiveId: id, vote: "against"},
                function (rep) {
                    if (rep === "Vote failed." || rep === "ERROR") {
                        alert(rep);
                    } else {
                        $("#directive_to_vote_" + id).hide();
                    }
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

    $(".show_answer_directive").click(function () {
        var id = $(this).attr("id").substr(17);
        if ($(this).html() === "Show / Answer") {
            $(".show_directive").removeClass("btn-success");
            $(".show_directive").removeClass("btn-warning");
            $(".show_directive").addClass("btn-success");
            $(".show_directive").html("Show");
            $(".show_answer_directive").removeClass("btn-success");
            $(".show_answer_directive").removeClass("btn-warning");
            $(".show_answer_directive").addClass("btn-success");
            $(".show_answer_directive").html("Show / Answer");
            $("#content_to_show").html($("#content_to_show_" + id).html());
            $(".directiveIdForm").attr("value", id);
            $("#answer_form").show();
            $("#answer_text").hide();
            $(this).removeClass("btn-success");
            $(this).removeClass("btn-warning");
            $(this).addClass("btn-warning");
            $(this).html("Hide");
        } else {
            $("#content_to_show").html("");
            $("#answer_form").hide();
            $(".show_answer_directive").removeClass("btn-success");
            $(".show_answer_directive").removeClass("btn-warning");
            $(".show_answer_directive").addClass("btn-success");
            $(".show_answer_directive").html("Show / Answer");
            $(this).removeClass("btn-success");
            $(this).removeClass("btn-warning");
            $(this).addClass("btn-success");
        }

    });

    $(".show_directive").click(function () {
        var id = $(this).attr("id").substr(17);
        if ($(this).html() === "Show") {
            $(".show_answer_directive").removeClass("btn-success");
            $(".show_answer_directive").removeClass("btn-warning");
            $(".show_answer_directive").addClass("btn-success");
            $(".show_answer_directive").html("Show / Answer");
            $(".show_directive").removeClass("btn-success");
            $(".show_directive").removeClass("btn-warning");
            $(".show_directive").addClass("btn-success");
            $(".show_directive").html("Show");
            $("#content_to_show").html($("#content_to_show_" + id).html());
            $("#answer_form").hide();
            $("#answer_text").show();
            $("#answer_text").html($("#answer_to_show_" + id).html());
            $(".directiveIdForm").attr("value", id);
            $(this).removeClass("btn-success");
            $(this).removeClass("btn-warning");
            $(this).addClass("btn-warning");
            $(this).html("Hide");
        } else {
            $("#content_to_show").html("");
            $("#answer_text").hide();
            $("#answer_form").hide();
            $(".show_directive").removeClass("btn-success");
            $(".show_directive").removeClass("btn-warning");
            $(".show_directive").addClass("btn-success");
            $(".show_directive").html("Show");
            $(this).removeClass("btn-success");
            $(this).removeClass("btn-warning");
            $(this).addClass("btn-success");
        }

    });

});
