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
<section class="bg-1 widewrapper text-center small-wrap">	
	<h1 class="not_timer">
		<span class="not_timer">
			You are already Logged in
		</span>
	</h1>
</section>
<div class="container" style="margin-top: 50px;">
	<div class="row">
		<div class="col-md-4 col-md-offset-2">
			<a href="?logout">
				<button type="submit" value="Login" name="login" class="btn btn-blue btn-hot">Logout</button>
			</a>
		</div>
		<div class="col-md-4">
			<a href="settings">
				<button type="submit" value="Login" name="login" class="btn btn-blue btn-hot">Your Account</button>
			</a>
		</div>
	</div>
</div>
