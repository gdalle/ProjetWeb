<div class="row">
  <?php require('utilities/newsHandler.php');
    displayNews();
  ?>
    <div class="col-sm-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Cabinet chat</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php
                    if (isLogged()) {
                        echo <<<CHAINE_DE_FIN
                        <script type="text/javascript" src="js/chat.js"></script>
                        <div id="chatbox" class="pre-scrollable"></div><br/>
                        <div id="chatMessage">
                        <form id="sendMessageForm">
                            <input type='text' placeholder='Message' id='message' name='message'/>
                            <input type="submit" id='sendMessage' value='Send message!'/>
                          </form>
                        </div>
CHAINE_DE_FIN;
                    } else {
                        echo "<b>You are not logged in yet.</b> ";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

</div>
