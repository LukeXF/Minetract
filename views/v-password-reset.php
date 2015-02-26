<?php echo $SiteFunctions->displayJumbotron('Password Reset') ?>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 contentbox">

        <?php
        // show potential errors / feedback (from login object)
        if (isset($login)) {
            if ($login->errors) {
                foreach ($login->errors as $error) {
                    echo $error;
                }
            }
            if ($login->messages) {
                foreach ($login->messages as $message) {
                    echo $message;
                }
            }
        }
        ?>

        <?php
        // show potential errors / feedback (from registration object)
        if (isset($registration)) {
            if ($registration->errors) {
                foreach ($registration->errors as $error) {
                    echo $error;
                }
            }
            if ($registration->messages) {
                foreach ($registration->messages as $message) {
                    echo $message;
                }
            }
        }
        ?>

        <?php if ($login->passwordResetLinkIsValid() == true) { ?>
        <form method="post" action="<?php echo $domain; ?>password_reset<?php echo $dotPHP; ?>" name="new_password_form">
            <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
            <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />

            <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" placeholder="New password" required autocomplete="off" />

            <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" placeholder="Repeat new password" required autocomplete="off" />
            <input type="submit" name="submit_new_password" class="btn btn-primary" value="Submit new password" />
        </form>
        <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
        <?php } else { ?>
        <form method="post" action="password_reset.php" name="password_reset_form">
            <input id="user_name" type="text" name="user_name" required placeholder="Enter your username"/>
            <input type="submit" name="request_password_reset" class="btn btn-primary" value="Reset my password" />
        </form>
        <?php } ?>

        <a href="<?php echo $domain; ?>login<?php echo $dotPHP; ?>">Back to login</a>


        </div>
    </div>
</div>
