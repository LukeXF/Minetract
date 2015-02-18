

<section class="bg-1 widewrapper text-center small-wrap">	
	<h1 class="not_timer">
		<span class="not_timer">
			<?php 
				if ($shutdown) {
					echo "We are busy fixing things";
				} else {
					echo "We are back up now! Yey!";
				}
			?>
		</span>
	</h1>
</section>


<div class="container" style="margin-top: 50px;">
	<div class="row" style="display:table; margin: auto;">		
		<div class="col-md-12" style="display:table; margin: auto; display-center">

		<h3 style="color:#444;">
			<?php 
				if ($shutdown) {
					echo "Come check back in a little while";
				} else {
					echo "Try going to another page and it should work.";
				}
			?>
			</h3>
		</div>
	</div>

	<?php 
		if ($shutdown) {
			echo "
			<div class='row' style='display:table; margin: auto;'>
				<div class='col-md-4 col-md-offset-4' style='display:table; margin: auto;'>
					<a href='https://twitter.com/minetract'>
						<button type='submit' value='Login' name='login' class='btn btn-blue btn-hot'>Twitter</button>
					</a>
				</div>
			</div>";
		}
	?>
</div>