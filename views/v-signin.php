<div class="container">
	<h1 align="center">Login</h1>
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

			</div>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<button style="display: inline" type="submit" value="Login" name="login" class="form-button green">login</button>
					<input type="button" style="display: inline; margin-right: 10px" name="complete1" class="form-button red" value="Register" onClick="parent.location='register'">
				</div>
			</div>
		</div>


	</form>
</div>
