<section class="bg-1 widewrapper text-center not_timer">    
    <h1 class="not_timer">
        <span class="not_timer">
            Forgot your password?
        </span>
    </h1>
</section>

<div class="container">
    <div class="row">

        <div class="col-md-6 col-md-offset-3">
            <div class="modal-content" style="margin-top:60px; padding-top:20px;">
        
                    <?php if ($login->passwordResetLinkIsValid() == true) { ?>

                    <div class="modal-body">
                        <form method="post" action="forgot.php" name="new_password_form">
                            <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
                            <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />
            
                            <input id="user_password_new" type="password" placeholder="<?php echo WORDING_NEW_PASSWORD; ?>" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
            
                            <input id="user_password_repeat" type="password" placeholder="<?php echo WORDING_NEW_PASSWORD_REPEAT; ?>" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
                                    <div class="modal-footer">
                                <button type="submit" name="request_password_reset" value="<?php echo WORDING_SUBMIT_NEW_PASSWORD; ?>" class="btn btn-primary"><?php echo WORDING_SUBMIT_NEW_PASSWORD; ?></button>
                                
                                <div><a href=""></a></div>
                                <div><a href="" data-target="#login-popup" data-toggle="modal">log in</a></div>
                            </div>
                        </form>
                    </div>

                    <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
                    <?php } else { ?>

                    <form method="post" action="forgot.php" name="password_reset_form">
                        <div class="modal-body">
                            <input id="user_name" type="text" name="user_name" placeholder="Your Username" required />
       
                            <div class="modal-footer">
                                <button type="submit" name="request_password_reset" value="<?php echo WORDING_RESET_PASSWORD; ?>" class="btn btn-primary"><?php echo WORDING_RESET_PASSWORD; ?></button>
                                
                                <div><a href=""></a></div>
                                <div><a href="" data-target="#login-popup" data-toggle="modal">log in</a></div>
                            </div>
                        </div>
                    </form>

                    <?php } ?>
    
                </div>
            </div>
        </div>
    </div>
</div>