<div class="container" style="margin-top:50px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
			<p align='center'>Please note the view system is all inside a <b>class</b>. The code needs to be moved outside of the <b>/assets/</b> directory and placed in <b>/classes/</b> directory and the viewing code must be moved into <b>/views/v-rating.php</b> later on.
			<p align='center'>The <b>.htaccess</b> file needs to allow clean urls on this page along with this system been locked to only users who have <b>admin</b> access on the site.

			<hr>

			<pre>
				<?php print_r($sqlIntoArray); ?>
			</pre>

			<hr> 

			<pre>
				<?php print_r($finalAverageRating); ?>
			</pre>
			<?php
				echo "<h3 align='center'> The average rating for product <b>" . $selectAverage . "</b> is <b>" . $finalAverageRating["Product " . $selectAverage] . "</b> 	stars.<br>";
				echo "<p>";
				$starsCounter = 1;
				while($starsCounter <= ceil($finalAverageRating["Product " . $selectAverage])) {
					echo "<span class='fa fa-star'>";
					$starsCounter++;
				} 
				echo "</p>";
				echo "<br><p align='center'>Please note, half numbers round up to make the product look better.</p>";
				echo "<hr>"; // SECTION FOUR - TESTING AND DEVELOPEMENT
			?>
        </div>
    </div>
</div>