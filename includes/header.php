<div class="top-bar" id="navigation-menu">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li>
                <img style="float:left;" width="30px" height="30px" src="images/wl-logo.png" alt="leakywiks logo" />
            </li>

            <li class="menu-text">LeakyWiks</li>

                <li class="menu-alignment"><a href="/hoofdpagina.php">Home</a></li>
<?php if (isset($_SESSION['user']) && $_SESSION['user'] !== '') { 
                echo '<li class="menu-alignment"><a href="/index.php?logoff=true">Logoff</a></li>';
} ?>

        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>
        </ul>
    </div>
</div>

<!--
  <h2>Leakywiks</h2>
  <p>
  <?php  /*
   if (isset($_SESSION['msg'])) { 
     echo $_SESSION['msg'];
     $_SESSION['msg'] = "";
   } */
  ?>
  </p>
</div> -->

