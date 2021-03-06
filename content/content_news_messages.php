<div class="row">

    <?php

    function displayNews() {
        $db = MyDatabase::connect();
        $news = $db->query("SELECT * FROM news;");
        $newsItems = array();
        while ($newsItem = $news->fetch()) {
            $newsItems[] = $newsItem;
        }
        ?>

        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Newsfeed</h3>
                </div>
                <div class="panel-body pre-scrollable">
                    <ul class="list-group nav nav-tabs nav-stacked">

                        <?php
                        for ($i = 0; $i < sizeOf($newsItems); $i++) {
                            ?>
                            <a href ="#tab<?php echo $i; ?>" data-toggle="tab" class="news_link list-group-item"><?php echo $newsItems[$i]['title']; ?></a>
                                <?php
                            }
                            ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default pre-scrollable">
                <div class="tab-content">

                    <?php
                    for ($i = 0; $i < sizeOf($newsItems); $i++) {
                        ?>
                        <div class="tab-pane fade <?php
                        if ($i == 0) {
                            echo "in active";
                        }
                        ?>" id="tab<?php echo $i; ?>">
                            <div class="panel-heading"><h3 class="panel-title"><b><?php echo($newsItems[$i]["title"]); ?></b></h3></div>
                            <div class="panel-body">
                                <?php echo($newsItems[$i]["content"]); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
    displayNews();
    ?>
    <div class="col-sm-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Cabinet chat</h3>
            </div>
            <div class="panel-body">
                <?php
                if (isLogged()) {
                    echo <<<CHAINE_DE_FIN
                        <script type="text/javascript" src="js/chat.js"></script>
                        <div id="chatbox" class="pre-scrollable"></div><br/>
                        <div id="chatMessage">
                        <form id="sendMessageForm" method="post">
                            <div class="form-group">
                                <div class="textarea col-sm-8">
                                <input type='text' class="form-control" placeholder='Message' id='message' name='message'/>
                                </div>
                                <div class="col-sm-3">
                                <button class="btn btn-danger" type="submit" id='sendMessage'>Send</button>
                                </div>
                            </div>
                        </form>
                        </div>
CHAINE_DE_FIN;
                } else {
                    echo "<b>You are not logged in yet.</b> ";
                }
                ?>
            </div>
        </div>
    </div>

</div>
