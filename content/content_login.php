<div class="row">
    <div class="col-12">
        <form action="utilities/login.php?todo=login" method="post">
          Login: <input type="text" name="login"></input>
          Password: <input type="password" name="password"></input>
          <input type="submit" value="Sign in!">
          <?php if(isset($_GET['error']) && $_GET['error']==true) { echo("<b>Wrong login or password.</b>"); } ?>
        </form>
    </div>
</div>
