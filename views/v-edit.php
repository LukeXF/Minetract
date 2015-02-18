<section class="bg-1 widewrapper text-center not_timer">    
    <h1 class="not_timer">
        <span class="not_timer">
            Edit your Profile
        </span>
    </h1>
</section>

<div class="container">
    <div class="row change_settings">
        <div class="col-md-3">
            <div class="backing-grey" style="height: 309px; text-align:center;">
                <div class="row">
                    <div class="col-xs-12">

                        <?php $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $_SESSION['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size; ?>

                        <img src="<?php echo $grav_url;?>" alt="..." class="img-circle img-profile" width="120px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12"> 
                        <h3 class="settings">
                            <?php echo $user[0]['user_name_first']; ?> <?php echo $user[0]['user_name_first']; ?></h3>
                        <p><?php echo $user[0]['user_main_type']; ?></p>
                        <span class="rating">
                            <span class="star star-inverse"><i class="fa fa-star fa-lg"></i></span><span class="star star-inverse"><i class="fa fa-star fa-lg"></i></span><span class="star star-inverse"><i class="fa fa-star fa-lg"></i></span><span class="star star-inverse"><i class="fa fa-star fa-lg"></i></span><span class="star star-inverse"><i class="fa fa-star-o fa-lg"></i></span>                               </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">

                    <div class="top-title">
                        Username                  
                    </div>
                    <div class="backing-grey" style="height: 268px;">
                        <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
                        <form method="post" action="edit.php" name="user_edit_form_name">
                            <label for="user_name">Username must be between 2-15 characters</label>
                            <input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_name']; ?>)
                            <input type="submit" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
                        </form>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="top-title">
                        Email                  
                    </div>
                    <div class="backing-grey" style="height: 268px;">
                        <!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
                        <form method="post" action="edit.php" name="user_edit_form_email">
                            <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
                            <input id="user_email" type="email" name="user_email" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_email']; ?>)
                            <input type="submit" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
                        </form>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="top-title">
                        Password                  
                    </div>
                    <div class="backing-grey" style="height: 268px;">
                        <!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
                        <form method="post" action="edit.php" name="user_edit_form_password">
                            <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
                            <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

                            <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
                            <input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

                            <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
                            <input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />

                            <input type="submit" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
                        </form>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="top-title">
                        Personal Details                  
                    </div>
                    <div class="backing-grey" style="height: 268px;">
                        <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
                        <form method="post" action="edit.php" name="user_personal_details">
                            <input id="user_name_first" type="text" name="user_name_first" placeholder="First Name" required /> 
                            <input id="user_name_last" type="text" name="user_name_last" placeholder="Last Name" required /> 
                            <input id="user_main_type" type="text" name="user_main_type" placeholder="Account Type" required /> 
                            <input type="submit" name="user_personal_details" value="user_personal_data" />
                        </form>
                    </div>

                </div>
            </div>
            
        </div>


    </div>
  
</div>