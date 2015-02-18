<div class="container">
	<h1 class="et_pb_contact_main_title">Statistics</h1>
	<form style="margin-bottom:50px;" method="post" action="http://gunsdaily.net/contact/">

		<div class="row" style="margin-top:20px;">

			<div class="col-md-12">

					<?php
						$total = (
							(
									$fb["likes"]
								+	$ig["followers"]
								+	$ig["images"]
								+	$fb["talking"]
								+	$tw["followers"]
								+	$tw["tweets"]
								+	$tw["favourites"]
								+	$tw["retweets"]
							)	* 3
						)
					?>		
				
				

				<div class="row pricing">
		
					<div class="col-xs-3">
						<strong><?php echo number_format($fb["likes"]) . "<br>"; ?></strong><br>
						Facebook <br> Likes
					</div>
					<div class="col-xs-3">
						<strong><?php echo number_format($ig["followers"]) . "<br>"; ?></strong><br>
						Instagram Followers
					</div>
					<div class="col-xs-3">
						<strong><?php echo number_format($ig["images"]) . "<br>"; ?></strong><br>
						Instagram Uploads
					</div>
					<div class="col-xs-3">
						<strong><?php echo number_format($fb["talking"]) . "<br>"; ?></strong><br>
						Mentions on Facebook
					</div>
					<div class="col-xs-3">
						<strong><?php echo number_format($tw["followers"]) . "<br>"; ?></strong><br>
						Twitter Followers
					</div>
					<div class="col-xs-3">
						<strong><?php echo number_format($tw["tweets"]) . "<br>"; ?></strong><br>
						Tweets
					</div>
					<div class="col-xs-3">
						<strong><?php echo number_format($tw["favourites"]) . "<br>"; ?></strong><br>
						Twitter Favourites
					</div>
					<div class="col-xs-3">
						<strong><?php echo number_format($total) . "<br>"; ?></strong><br>
						Total interaction
					</div>

				</div>

			</div>


		</div>

		<input type="hidden" id="_wpnonce-et-pb-contact-form-submitted" name="_wpnonce-et-pb-contact-form-submitted" value="22e23944ed"><input type="hidden" name="_wp_http_referer" value="/contact/">
	</form>
</div>
<div class="container" id="about-guns" style="margin-bottom:-30px;">
	<div class="row about-guns">
		<div class="col-md-6">			
			<h2>More Info</h2>
			<p><strong>If you are interested in Sponsoring us here on the website or advertising with us on our instagram or other social media head over our <a href="advertise" target="_blank">Advertise</a> page. If you just want to get ahold of us for any other matter please fill out the form to the left and we will get back to you ASAP. Usually within 24 hours.</strong></p>
		</div>
		<div class="col-md-6">		
			<h2>About Us</h2>
			<p><strong>Gunsdaily was formed on Febuary 3rd 2013, just a few months after the horrible shooting at Sandy Hook school. Our main goal back then and still, is to shine a less evil light on the topic that is guns. For many people, We are a friend business aimed at portaying guns in the right way.</strong></p>

		</div>
	</div>
</div>