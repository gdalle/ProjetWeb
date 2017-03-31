$(document).ready(function () {
    $(".delete_newsItem").click(function () {
        var id = $(this).attr("id").substr(16);
        $.post("utilities/newsManager.php?todo=delete_newsItem",
                {'id': id},
                function (data) {
                    alert(data);
                    $("tr#newsItem_" + id).hide();
                });
    });

    $(".delete_newsItem").mouseenter(function () {
        $(this).css("color", "red");
    });

    $(".delete_newsItem").mouseout(function () {
        $(this).css("color", "black");
    });

});
