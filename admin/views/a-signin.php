<div class="container">
	<h1 align="center">Admin Login</h1>
	<form style="margin-bottom:50px;" method="post" action="index.php" name="loginform">

		<div class="col-md-4 col-md-offset-4">
			<div class="row">
				<div class="col-md-12">
					<p class="form">
						<label class="et_pb_contact_form_label">Email Address</label>
						<input required type="text" placeholder="Email Address" id="login_input_username" class="login_input" name="user_name">
					</p>
				</div>
				<div class="col-md-12" style="margin-top:20px;">			
					<p class="form">
						<label class="et_pb_contact_form_label">Password</label>
						<input type="password" placeholder="password" id="login_input_password" class="login_input" name="user_password">
					</p>
				</div>
				<div class="col-md-10 col-md-offset-1" style="margin-top:20px;" align="center">
					<p>
						Your IP is 
						<b><?php
							$ip = getenv('HTTP_CLIENT_IP')?:
							getenv('HTTP_X_FORWARDED_FOR')?:
							getenv('HTTP_X_FORWARDED')?:
							getenv('HTTP_FORWARDED_FOR')?:
							getenv('HTTP_FORWARDED')?:
							getenv('REMOTE_ADDR');
							echo $ip;
						?></b>
						And is <br> been tracked for security reasons.
					</p>
					<p>
						If you do not have permission to view that admin site leave now or you may face blocking from all Gunsdaily related sites.
					</p>
				</div>
			</div>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<button style="display: inline" type="submit" value="Login" name="login" class="form-button green">login</button>
					<input type="button" style="display: inline; margin-right: 10px" name="complete1" class="form-button red" value="Main Site" onClick="parent.location='<?php echo $fullUrl ?>'">
				</div>
			</div>
		</div>


	</form>
</div>
