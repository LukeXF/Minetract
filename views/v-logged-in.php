<div class="container">

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
	<h1 align="center">You're already logged in</h1>
	<form style="margin-bottom:50px;" method="post" action="http://dev.gunsdaily.net/login">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">	

				<div class="row" style="margin-top:20px;">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<input type="button" class="form-button green" value="Profile" onClick="parent.location='<?php echo $fullUrl; ?>account'">
							</div>
							<div class="col-md-6">
								<input type="button" class="form-button red  " value="Home"    onClick="parent.location='home'" style="margin-right: 10px; float: left !important;">
							</div>
						</div>
						
					</div>
				</div>

			</div>
		</div>
	</form>
</div>