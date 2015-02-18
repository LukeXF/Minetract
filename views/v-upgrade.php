<?php 
	switch ($_SESSION['user_type']) {
		case "0": $accountType = "Disabled Account";		break;
		case "1": $accountType = "Normal Account (Client";	break;
		case "2": $accountType = "Business Account";		break;
		case "3": $accountType = "Enterprise Account";		break;
		case "4": $accountType = "Managed Account";			break;
		case "5": $accountType = "Assistant Account";		break;
		case "6": $accountType = "Admin Account";			break;
		default: $accountType = $_SESSION['user_type']; 
	}

	if ($_SESSION['user_type'] == 0) {

		$one   = "Check Emails";
		$two   = "Check Emails";
		$three = "Check Emails";

	} elseif ($_SESSION['user_type'] == 1) {

		$one   = "You already have this";
		$two   = "Confirm your account";
		$three = "To upgrade";

	} elseif ($_SESSION['user_type'] == 2) {

		$one   = "Downgrade for free";
		$two   = "You already have this";
		$three = "Upgrade - £14.99/month";

	} elseif ($_SESSION['user_type'] == 3) {

		$one   = "Downgrade for free";
		$two   = "Downgrade to £4.99/month";
		$three = "You already have this";

	} elseif ($_SESSION['user_type'] == 4) {

		$one   = "Managed Account";
		$two   = "Managed Account";
		$three = "Managed Account";

	} elseif ($_SESSION['user_type'] == 5) {

		$one   = "Assistant Account";
		$two   = "Assistant Account";
		$three = "Assistant Account";

	} elseif ($_SESSION['user_type'] == 6) {

		$one   = "Admin Account";
		$two   = "Admin Account";
		$three = "Admin Account";
	}
?>
<style type="text/css">
	.tooltip-inner {
		width: 200px;
	}
</style>


<section class="bg-1 widewrapper text-center small-wrap">	
	<h1 class="not_timer">
		<span class="not_timer">
			Upgrade your account
		</span>
	</h1>
</section>



<div class="container" style="margin: 60px auto 100px;">

	<div class="row change_settings">
		<div class="col-md-12">
			<div class="backing-grey">
				<h3 class="settings">Get free Enterprise</h3>
				<p>One of the Minetract mangement perks is free Enterprise! Check out our 'About' page for more infromation</p>
			</div>
		</div>

		<div class="col-md-4">
			<div class="backing-grey" style="min-height: 600px;">
				<h3 class="settings">Free</h3>
				<p>best for starting out.</p>

				<br>

				<ul>
					<li>5% commison rate for Minetract.</li>
					<br>
					<li>Access to a large client or freelancer base.</li>
					<li>Robust review and rating system.</li>
					<li>Streamlined commission and layout to keep track of multiple clients and projects.</li>
					<li>Customizability for your shop and policy.</li>
					<br>
					<li>1 shop per account.</li>
				</ul>
				<button type="submit" value="Login" name="login" class="btn btn-main btn-full-width"><?php echo $one; ?></button>
			</div>
		</div>

		<div class="col-md-4">
			<div class="backing-grey" style="min-height: 600px;">
				<h3 class="settings">Business</h3>
				<p>best for fledging freelancers.</p>

				<br>

				<ul>
					<li>5% commison rate for Minetract.</li>
					<br>
					<li>Everything from 'Free'.</li>
					<li>Highlighted within searches to increase store hitrate.</li>
					<li>Access to analytics for your commissions, such as rate, stages, average prices and more.</li>
				</ul>
				<form action="assets/bill.php" method="post">
					<input type="hidden" name="name" value="Minetract Business Plan">
					<input type="hidden" name="description" value="Gives you access to business plan benefits on minetract.net">
					<input type="hidden" name="paymentID" value="P-0PL08899AA199440S7YG7NQA">
					<button type="submit" value="Login" name="login" class="btn btn-main btn-full-width"><?php echo $two; ?></button>
				</form>
			</div>
		</div>

		<div class="col-md-4">
			<div class="backing-grey" style="min-height: 600px;">
				<h3 class="settings">Enterprise</h3>
				<p>best for freelancer teams.</p>

				<br>

				<ul>
					<li>5% commison rate for Minetract.</li>
					<br>
					<li>Everything from 'Business'.</li>
					<li>Featured on the frontpage based upon the client interest (previous searches).</li>
					<li>Multi-usr permissions.</li>
					<li>Analytics of your viewers, such as rates of views, ratio of listing to store views, demoogrpahics, keywords and more.</li>
					<li>Priority support.</li>
					<br>
					<li>3 shop per account.</li>
				</ul>
				<form action="assets/bill.php" method="post">
					<input type="hidden" name="name" value="Minetract Enterprise Plan">
					<input type="hidden" name="description" value="Gives you access to enterprise plan benefits on minetract.net">
					<input type="hidden" name="paymentID" value="P-5AC558241F423964M7YHGVJQ">
					<button type="submit" value="Login" name="login" class="btn btn-main btn-full-width"><?php echo $three; ?></button>
				</form>
			</div>
		</div>

	</div>
</div>