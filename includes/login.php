<form method="post" action="chkproxy.php" />

  <div class="small-12 small-centered columns login-form-bg grey-border">
    <h4 class="text-align-center black no-padding">Login</h4>

    <div class="login-box">
      <div class="row">
        <div class="small-8 small-push-2 columns">
          <form>
            <div class="row">
              <div class="small-12 columns">
                <input type="text" name="username" placeholder="Username" />
              </div>
            </div>
            <div class="row">
              <div class="small-12 columns">
                <input type="password" name="password" placeholder="Password" />
              </div>
            </div>
            <div class="row">
              <div class="small-12 columns g-recaptcha" data-sitekey="6Lf86iETAAAAAHh37QhMWITmO1NnlfzGiAsVCwcd"></div>
            </div>
            <div class="row">
              <div class="small-12 small-centered columns">
                <input type="submit" name="submit" class="button expand login-btn small-12" value="login"/>
                <input type="submit" name="submit" class="button expand login-btn small-12" value="register"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php /*
      $db = new Database();
      $dbh = $db->connectToDB();
      $sql = 'SELECT username, password FROM gebruiker';
      foreach ($dbh->query($sql) as $row) {
        print "<br>";
        print $row['username'] . "\t";
        print $row['password'];
      }

      if(isset($_SESSION['msg'])){
        echo '<br/>';
        echo $_SESSION['msg'];
        $_SESSION['msg'] = "";
      }
  */  ?>
  </div>
</form>

