<div id="header">
  <img src="images/wl-logo.png" alt="leakywiks logo" />
  <h2>Leakywiks</h2>
  <p>
  <?php 
   if (isset($_SESSION['msg'])) { 
     echo $_SESSION['msg'];
     $_SESSION['msg'] = "";
   } 
  ?>
  </p>
</div>

