<?php
// Start session for user actions...
session_start();
// Heading - Header SECTION
include "../includes/header.php";
include "../includes/heading.php";
// END Heading - Header SECTION
?>

<div class="row content-home">
    <div class="small-8 columns content-left-wrapper">

            <div class="small-12 image-content content-image-dashboard">
                <h3>Dashboard</h3>
            </div>

            <div class="small-3 columns counter counter-bg">
                <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                    <span class="number columns small-12">3</span>
                </span>
                <div class="clear"></div>
                <h5 class="small-12 columns">Invitations</h5>
            </div>
            <div class="small-3 columns counter counter-bg">
                 <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                    <span class="number columns small-12">3</span>
                </span>
                <div class="clear"></div>
                <h5>My Files</h5>
            </div>
            <div class="small-3 columns counter counter-bg">
                 <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                    <span class="number columns small-12">3</span>
                </span>
                <div class="clear"></div>
                <h5>My Books</h5>
            </div>
            <div class="small-3 columns counter counter-bg">
                 <span class="small-6 small-push-3 no-padding-left no-padding-right columns counter-number">
                    <span class="number columns small-12">0</span>
                </span>
                <div class="clear"></div>
                <h5>My Comments</h5>
            </div>

            <div class="clear"></div>
            <div class="gap-30"></div>

            <div class="small-12 grey-border image-content content-file-invitation">
                <h3>File invitations</h3>
            </div>
            <div class="small-12 grey-border-no-bottom item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> TheMostHardToAccess Book Ever </a> by <a href="#" class="highlight author">Author: Piet</a>
                </p>

                <div class="small-3 columns button cta-button in-item-btn round-button">
                    Accept invitation
                </div>
            </div>
            <div class="small-12 grey-border-no-bottom item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> Leaked Files  </a> by <a href="#" class="highlight author">Author: Pirate</a>
                </p>

                <div class="small-3 columns button cta-button in-item-btn round-button">
                    Accept invitation
                </div>
            </div>
            <div class="small-12 grey-border item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> Hack Resistent </a> by <a href="#" class="highlight author">Author: Ed</a>
                </p>

                <div class="small-3 columns button cta-button in-item-btn round-button">
                    Accept invitation
                </div>
            </div>

            <div class="clear"></div>
            <div class="gap-30"></div>

            <div class="small-12 grey-border image-content content-my-books">
                <h3>My Books</h3>
            </div>
            <div class="small-12 grey-border-no-bottom item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> TheMostHardToAccess Book Ever </a> by <a href="#" class="highlight author">Author: Piet</a>
                </p>

            </div>
            <div class="small-12 grey-border-no-bottom item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> Leaked Files  </a> by <a href="#" class="highlight author">Author: Pirate</a>
                </p>

            </div>
            <div class="small-12 grey-border item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> Hack Resistent </a> by <a href="#" class="highlight author">Author: Ed</a>
                </p>

            </div>

            <div class="clear"></div>
            <div class="gap-30"></div>

            <div class="small-12 grey-border image-content content-my-uploaded-books">
                <h3>My Uploaded Books</h3>
            </div>
            <div class="small-12 grey-border-no-bottom item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> TheMostHardToAccess Book Ever </a> by <a href="#" class="highlight author">Author: Piet</a>
                </p>

            </div>
            <div class="small-12 grey-border-no-bottom item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> Leaked Files  </a> by <a href="#" class="highlight author">Author: Pirate</a>
                </p>

            </div>
            <div class="small-12 grey-border item-wrapper columns">

                <p class="default-p small-8 columns in-item-p">
                    <a href="#" class="highlight bold"> Hack Resistent </a> by <a href="#" class="highlight author">Author: Ed</a>
                </p>

            </div>

    </div>


    <div class="small-4 columns content-right-wrapper">
        <div class="small-12 small-centered columns login-form-bg grey-border">
            <h4 class="text-align-center black no-padding">Upload File</h4>

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
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="gap-30"></div>

        <div class="small-12 small-centered columns login-form-bg grey-border">
            <h4 class="text-align-center black no-padding">My Recent Comments</h4>

            <div class="login-box">
                <div class="row">
                    <div class="small-8 small-push-2 columns">

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

