<?php 
  session_start();
?>
<body>
  <div id="wrapper">
    <div id="content">
      <h2>Login</h2>
      <p>
      <form method="post" action="chkproxy.php" />
        <label for="name">username:</label><br />
        <input type="text" id="username" name="username" value="" /><br />
   
        <label for="mail">password:</label><br />
        <input type="text" id="password" name="password" value="" /><br />
      
        <input type="submit" name="submit" value="login" />
        <input type="submit" name="submit" value="register" />
      </form>
      </p>
    </div> <!-- end #content -->
  </div> <!-- End #wrapper -->
</body>
</html>


