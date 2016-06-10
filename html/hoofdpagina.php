<?php
// Start session for user actions...
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
    header("location: /index.php");
}

// Heading - Header SECTION
include "../includes/heading.php";
include "../includes/header.php";
require_once "classes/Database.php";
$db = new Database();
$bookaction_token = $_SESSION['bookaction_token'] = base64_encode(openssl_random_pseudo_bytes(32));
// END Heading - Header SECTION
?>
<div class="row content-home">
    <div class="small-8 columns content-left-wrapper">

            <div class="small-12 image-content content-image-dashboard">
                <h3>Dashboard</h3>
            </div>

            <div class="small-3 columns counter counter-bg">
                <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                    <span class="number columns small-12">
<?php 
    if (isset($_SESSION['user'])) {
        echo $db->selectStatement("select count(*) as count from user_bestandid where invite = 0 and bestandid in (
            select id from bestand where upper(owner) = upper(:usr))", array("usr"=>$_SESSION['user']))[0][0] ;
    } 
?>
                    </span>
                </span>
                <div class="clear"></div>
                <h5 class="small-12 columns">Requests</h5>
            </div>
            <div class="small-3 columns counter counter-bg">
                 <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                    <span class="number columns small-12">
<?php 
    if (isset($_SESSION['user'])) {
      echo $db->selectStatement("select count(*) from user_bestandid where username = :usr and invite = 1", array("usr"=>$_SESSION['user']))[0][0] ;
    } 
?>
                    </span>
                </span>
                <div class="clear"></div>
                <h5>Books</h5>
            </div>
            <div class="small-3 columns counter counter-bg">
                 <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                    <span class="number columns small-12">
<?php 
    if (isset($_SESSION['user'])) {
      echo $db->selectStatement("select count(*) from bestand where owner = :usr", array("usr"=>$_SESSION['user']))[0][0] ;
    }
?>
                    </span>
                </span>
                <div class="clear"></div>
                <h5>My Books</h5>
            </div>
            <div class="small-3 columns counter counter-bg">
                 <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                 <span class="number columns small-12"> 
<?php 
    if (isset($_SESSION['user'])) {
        echo $db->selectStatement("select count(*) from comment where username = :usr", array("usr"=>$_SESSION['user']))[0][0];
    }
?>
                </span>
                </span>
                <div class="clear"></div>
                <h5>My Comments</h5>
            </div>

            <div class="clear"></div>
            <div class="gap-30"></div>

            <div class="small-12 grey-border image-content content-file-invitation">
                <h3>Book requests</h3>
            </div>

              <?php 
    $res = $db->selectStatement("select b.id as id, b.owner as owner, b.name as name, ub.username as requester 
        from user_bestandid ub, bestand b
        where ub.invite = 0 
        and ub.bestandid = b.id 
        and b.owner = :usr ", array("usr"=>$_SESSION['user']));
//  echo "<pre>"; print_r($res); echo "</pre>";die;
                foreach ($res as &$value) { 
                ?>
                <form method="post" action="bookaction.php">
                  <div class="small-12 grey-border-no-bottom item-wrapper columns">
                    <p class="default-p small-8 columns in-item-p">
                    Requested by    <?php echo $value['requester']; ?>:<br>
                    <a href="boekpagina.php?id=<?php echo $value['id'];?>" class="highlight bold">
                    <?php echo $value['name'] ; ?>
                    </a> by <a href="#" class="highlight author">Author: <?php echo $value['owner']; ?></a>
                </p>
                    <input type="hidden" name="bestandid" value=<?php echo $value['id'] ?> />
                    <input type="hidden" name="bookaction_token" value=<?php echo $bookaction_token; ?> />
                    <input type="submit" name="bookaction" value="accept" class="small-2 button cta-button in-item-btn round-button" />
            </div>
                </form>
              <?php } ?>

            <div class="clear"></div>
            <div class="gap-30"></div>

            <div class="small-12 grey-border image-content content-my-books">
                <h3>Books</h3>
            </div>
              <?php 
                $res = $db->selectStatement("select * from bestand b, gebruiker g, user_bestandid ub 
                    where b.id = ub.bestandid and g.username = ub.username and upper(g.username) = upper(:usr) and invite = 1", array("usr" => $_SESSION['user']));
//  echo "<pre>"; print_r($res); echo "</pre>";die;
                foreach ($res as &$value) { 
                ?>
                <form method="post" action="bookaction.php">
                  <div class="small-12 grey-border-no-bottom item-wrapper columns">
                    <p class="default-p small-8 columns in-item-p">
                    <a href="boekpagina.php?id=<?php echo $value['id'];?>" class="highlight bold">
                    <?php echo $value['name'] ; ?>
                    </a> by <a href="#" class="highlight author">Author: <?php echo $value['owner']; ?></a>
                    <input type="hidden" name="bestandid" value=<?php echo $value['id'] ?> />
                    <input type="hidden" name="bookaction_token" value=<?php echo $bookaction_token; ?> />
                    <br>
                    <input type="submit" name="bookaction" value="download"  class="small-3 button cta-button in-item-btn round-button"  />
                    </p>
                  </div>
                </form>
              <?php } ?>

            <div class="clear"></div>
            <div class="gap-30"></div>

            <div class="small-12 grey-border image-content content-my-uploaded-books">
                <h3>My Uploaded Books</h3>
            </div>
              <?php 
                  $res = $db->selectStatement("select * from bestand where upper(owner) = upper(:ownr)", array("ownr" => $_SESSION['user']));
                  foreach ($res as &$value) { 
                ?>
                <form method="post" action="bookaction.php">
                <div class="small-12 grey-border-no-bottom item-wrapper columns">
                  <p class="default-p small-8 columns in-item-p">
                  <a href="boekpagina.php?id=<?php echo $value['id']; ?>" class="highlight bold">
                  <?php echo $value['name'] ; ?>
                  </a> by <a href="#" class="highlight author">Author: <?php echo $value['owner']; ?> </a>
                  <input type="hidden" name="bestandid" value=<?php echo $value['id'] ?> />
                  <input type="hidden" name="bestandloc" value="<?php echo $value['location'] ?>" />
                  <input type="hidden" name="bookaction_token" value=<?php echo $bookaction_token; ?> />
                  <br>
                  <input type="submit" name="bookaction" value="delete" class="small-2 button cta-button in-item-btn round-button"  />
                  <input type="submit" name="bookaction" value="download" class="small-3 button cta-button in-item-btn round-button text-center"   />
                  </p>
                  <p class="default-p small-4 columns in-item-p">
                  <input type="submit" name="bookaction" value="share"  class="small-4 button cta-button in-item-btn round-button"  />
                  <br>
                  <input type="text" name="username" placeholder="naam sharing gebruiker" />
                  </p>
                </div>
                </form>
              <?php } ?>
    </div>


    <div class="small-4 columns content-right-wrapper">
        <div class="small-12 small-centered columns login-form-bg grey-border">
            <h4 class="text-align-center black no-padding">Upload PDF File</h4>

            <div class="login-box">
                <div class="row">
                    <div class="small-8 small-push-2 columns">
                        <form action="fuproxy.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="small-12 columns">
                                    <input type="file" name="filename" id="filename">
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 small-centered columns">
                                    <input type="submit" value="Upload" class="button expand login-btn small-12" name="fupload">
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                  <?php echo $_SESSION['msg']; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="gap-30"></div>

        <div class="small-12 small-centered columns login-form-bg grey-border comment-box" id="x">
            <h4 class="text-align-center black no-padding">My Recent Comments</h4>

           <?php
             $res = $db->selectStatement("select * from comment where upper(username) = upper(:user) order by date desc", 
                    array("user" => $_SESSION['user']));
             foreach ($res as &$value) { 
             ?>
            <div class="small-12 comment-wrapper">
            <p class="small-12 no-padding default-p text-align-left"><?php echo $value['comment']; ?> </p>
            <div class="small-6 columns no-padding text-align-left">Posted by: <span class="highlight"><?php echo $value['username']; ?> </div>
            <div class="small-6 columns no-padding text-align-right"></span> Datum: <span class="date"><?php echo $value['date']; ?> </span></div>
            </div>
          <?php } ?>
        </div>

    </div>
</div>
<?php if (isset($_SESSION['msg'])) { $_SESSION['msg'] = ''; } ?>
<script>
    function documentClick(bookid) {
        var inputvelddata = $('#searchInput').val();
        $.ajax({
            type: "GET",
            url: "boekpagina.php",
            data: {"id":bookid},
            success: function( returnedData ) {
                $( '#x' ).html( returnedData );
            }
        });
    }

$('.button').click(function() {
    var inputvelddata = $('#searchInput').val();
    $.ajax({
        type: "POST",
        url: "searchpage.php",
        data: {"zoek": inputvelddata} ,
        success: function( returnedData ) {
            $( '#x' ).html( returnedData );
        }
    });
});
</script>
