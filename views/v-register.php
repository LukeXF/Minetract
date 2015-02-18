<style type="text/css">
.tooltip-inner {
	font-size: 15px;
	width: 200px;
	white-space: normal;
}
</style>
<section class="bg-1 widewrapper text-center not_timer">    
	<h1 class="not_timer">
		<span class="not_timer">
			Register With Us
		</span>
	</h1>
</section>
<div class="container">
	<div class="row">

		<div class="col-md-6">
			<div class="modal-content" style="margin-top:60px; padding-top:20px;">
				<p style="color:white" align="center">
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
				</p>

				<!-- show registration form, but only if we didn't submit already -->
				<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
				<form method="post" action="register.php" name="registerform">

					<div class="modal-body">                                
							<input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Username" required 
							data-placement="right" data-tooltip="tooltip" data-original-title="only letters and numbers, your unqiue username"/>

													 
							<span class="sr-only">Toggle navigation</span>
							

							<input id="user_email" type="email" name="user_email" placeholder="Email Address" required 
							data-placement="right" data-tooltip="tooltip" data-original-title="We will email you to confirm your account" />

							<input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" placeholder="Password" required autocomplete="off" 
							data-placement="right" data-tooltip="tooltip" data-original-title="Password must be atleast 6 charcters long" />

							<input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" placeholder="Confirm Password" required autocomplete="off" 
							data-placement="right" data-tooltip="tooltip" data-original-title="Please repeat your password for confirmation" />

							<img src="tools/showCaptcha.php" alt="captcha" style="border-radius: 9px;"/>
							<input type="text" name="captcha" placeholder="Enter The Captcha Above" required 
							data-placement="right" data-tooltip="tooltip" data-original-title="Are you a human today?" />

					</div>
					<div class="modal-footer">
						<button type="submit" name="register" value="<?php echo WORDING_REGISTER; ?>"  class="btn btn-primary">Register</button>
						
						<div><a href="forgot">forgotten details?</a></div>
						<div><a href="" data-target="#login-popup" data-toggle="modal">log in</a></div>
					</div>
				</form>
				<?php } ?>

			</div>

		</div>
	</div>
</div>
