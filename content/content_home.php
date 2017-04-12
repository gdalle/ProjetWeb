
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Information</h3>
            </div>
            <div class="panel-body">
                <?php
                if (!isLogged()) {
                    echo "<b>You are not logged in yet.</b> ";
                } else {
                    echo "<b>Welcome " . $_SESSION['name'] . " !</b>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8" id="calendar">
            
    </div>
</div>
