<style type="text/css">
	.tooltip-inner {
		width: 200px;
	}
</style>


<section class="bg-1 widewrapper text-center">	
	<h1 class="not_timer">
		<span class="not_timer">
			<?php echo $_SESSION['user_first']; ?> <?php echo $_SESSION['user_last']; ?> - Profile Settings
		</span>
	</h1>
	<button type="button" class="btn btn-minetract btn-lg">My Commissions</button>
	<button type="button" class="btn btn-minetract btn-lg">My Public Profile</button>
</section>



<div class="container" style="margin: 60px auto;">

	<div class="row change_settings">
		<div class="col-md-7">
			<br><br>
			<h3 class="settings">Forum</h3>
			<textarea class="settings" placeholder="forum signature"></textarea>
		</div>

		<div class="col-md-5">
			<br><br>
			<h3 class="settings">Your Details</h3>
			<img class="settings" data-toggle="tooltip" data-placement="bottom" 
			title="Our profiles images are served by Gravatar, the globally recognized avatar system."
			src="<?php echo $grav_url; ?>">
		</div>
	</div>
	<hr>
	<div class="row change_settings">

		<div class="col-md-7">
			<h3 class="settings">Email me when...</h3>

			<div class="col-md-6 checkboxes">
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox1" value="option1"> There's a newsletter</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox2" value="option2"> Someone creates or quotes a commission</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox3" value="option3"> Someone accepts a commission</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox3" value="option3"> Someone creates a revison</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox3" value="option3"> A commission is ended</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox3" value="option3"> I am rated or reviewed</label>
			</div>

			<div class="col-xs-6 checkboxes">
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox1" value="option1"> Someone PM's you</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox2" value="option2"> Someone Quotes you</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox3" value="option3"> Someone replies to your thread</label>
				<label class="checkbox-inline"><input type="checkbox" name="email_item" id="inlineCheckbox3" value="option3"> There's a reply to other threads you contributed to</label>
				<label class="checkbox-inline"><input type="checkbox" onClick="toggle(this)" /> Toggle All<br/>	</label>
			</div>
		</div>

		<div class="col-md-5">
			<h3 class="settings">Please Note</h3>
			<p>Your privacy is key to us. We will not 
				share your details to any third partys.
				Newsletters are sent once a month at the most.</p>
			<br>
			<p>If you wish to change any account information you
				must re-enter your current password.</p>
		</div>

	</div>
		<script type="text/javascript">
			function toggle(source) {
				checkboxes = document.getElementsByName('email_item');
				for(var i=0, n=checkboxes.length;i<n;i++) {
					checkboxes[i].checked = source.checked;
				}
			}
		</script>


		<div class="row change_settings">
			<div class="col-md-3 change_settings">

	
			</div>
		</div>

		<div class="row">

			<div class="col-md-3 change_settings">
				<br><br>
				<h3 class="settings">Your Personal Details</h3>
				<input type="text" id="login_input_username" value="<?php echo $_SESSION['user_name'];?>" placeholder="First Name" name="user_name">
				<input type="text" id="login_input_username" value="<?php echo $_SESSION['user_last'];?>" placeholder="Last Name" name="user_name">
				<input type="text" id="login_input_username" value="" placeholder="Username" name="user_name">
			</div>

			<div class="col-md-3 change_settings">
				<br><br>
				<h3 class="settings">Password</h3>
				<input type="password" id="login_input_username" readonly placeholder="Current Password" name="user_name">
				<input type="password" id="login_input_username" readonly placeholder="New Password" name="user_name">
				<input type="password" id="login_input_username" readonly placeholder="Confirm Password" name="user_name">
			</div>

			<div class="col-md-3 change_settings">
				<br><br>
				<h3 class="settings">Social</h3>
				<input type="text" id="login_input_username" placeholder="Website" name="user_name">
				<input type="text" id="login_input_username" placeholder="Twitter" name="user_name">
				<input type="text" id="login_input_username" placeholder="Skype" name="user_name">
			</div>

			<div class="col-md-3 change_settings">
				<br><br>
				<h3 class="settings"></h3>
				<input type="text" id="login_input_username" placeholder="YouTube" name="user_name">
				<input type="text" id="login_input_username" placeholder="LinkedIn" name="user_name">
				<input type="text" id="login_input_username" placeholder="Instagram" name="user_name">
			</div>

		</div>

		<?php
			// Sets the date joined into a human format
			$userjoined = strtotime($_SESSION['user_date']);
			$userjoined_1 = date( 'l jS F Y', $userjoined );
			$userjoined_2 = date( 'H:ia', $userjoined );

			switch ($_SESSION['user_type']) {
				case "0": $accountType = "Disabled Account";	break;
				case "1": $accountType = "Normal Account (Client";	break;
				case "2": $accountType = "Business Account";	break;
				case "3": $accountType = "Joint Account (Business & Shop)";	break;
				case "4": $accountType = "Admin Account";	break;
				default: $accountType = $_SESSION['user_type']; 
			}

		?>
		<div class="row" stlye="margin-top:30px">

			<div class="col-md-3 change_settings">
				<h3 class="settings">Other Details</h3>			
				<label class="">Account Type</label>
				<input type="text" id="login_input_username" style="margin-top: -3px;" readonly 
				placeholder="Date Joined" value="<?php echo $accountType; ?>" name="user_name">		
			</div>
			<div class="col-md-3 change_settings">
				<h3 class="settings"></h3>
				<label class="">Date Joined</label>
				<input type="text" id="login_input_username" style="margin-top: -3px;" readonly 
				placeholder="Date Joined" value="<?php echo $userjoined_1; ?>" name="user_name">
			
			</div>	
			<div class="col-md-3 change_settings">
				<h3 class="settings"></h3>
				<label class="">Email Address</label>				
				<input type="text" id="login_input_username" style="margin-top: -3px;" readonly 
				value="<?php echo $_SESSION['user_email'];?>" placeholder="Email Address" name="user_name">
			
			</div>	


		</div>

		<hr>	

		<div class="row" stlye="margin-top:30px">			
			<div class="col-md-2 col-md-offset-10">
				<button type="submit" value="Login" name="login" class="btn btn-main">Save</button>
			</div>
		</div>

	</div>
</div>