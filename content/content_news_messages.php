<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Newsfeed</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item list-group-item-info">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Dapibus ac facilisis in</h3></div>
            <div class="panel-body">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
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
