$(document).ready(function () {

    $("#sendMessage").click(function () {
        var message = $("#message").val();
        if (message !== "")
        {
            $.post("utilities/chatHandler.php?todo=sendMessage", {message: message});
            $("#message").val("");
        }
        return false;
    });

    function displayMessages()
    {
        $.get('utilities/chatHandler.php?todo=getMessages', 'false', function (data) {
            var oldText = $("#chatbox").html();
            if (oldText !== data)
            {
                $('#chatbox').html(data);
                $('#chatbox').scrollTop($('#chatbox').get(0).scrollHeight);
            }
        }, 'text');
    }

    displayMessages();

    setInterval(displayMessages, 2000);
});
