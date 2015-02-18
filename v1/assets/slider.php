		<section class="demo_wrapper">
			<article class="demo_block">
			<ul id="demo1">
				<li><a href="#slide1"><img src="<?php echo $fullUrl; ?>assets/img/1.jpg" alt="Guns Daily - No politics, just gun."></a></li>
				<li><a href="#slide2"><img src="<?php echo $fullUrl; ?>assets/img/2.jpg" alt="Be sure to folow us on  <a target='_blanks' href='http://instagram.com/gunsdaily1'>Instagram</a>."></a></li>
				<li><a href="#slide3"><img src="<?php echo $fullUrl; ?>assets/img/3.jpg" alt="Interested in <a target='_blanks' href='policy'>Advertising</a> with us?"></a></li>
			</ul>
			</article>
		</section>		

		<script>
			$(function() {
				var demo1 = $("#demo1").slippry({
					transition: 'fade',
					useCSS: true,
					speed: 1000,
					pause: 3000,
					auto: true,
					preload: 'visible'
				});

				$('.stop').click(function () {
					demo1.stopAuto();
				});

				$('.start').click(function () {
					demo1.startAuto();
				});

				$('.prev').click(function () {
					demo1.goToPrevSlide();
					return false;
				});
				$('.next').click(function () {
					demo1.goToNextSlide();
					return false;
				});
				$('.reset').click(function () {
					demo1.destroySlider();
					return false;
				});
				$('.reload').click(function () {
					demo1.reloadSlider();
					return false;
				});
				$('.init').click(function () {
					demo1 = $("#demo1").slippry();
					return false;
				});
			});
		</script>
	
	<div></div>
	<div align="center" id="header">
		<h3>.<h3>
	</div><!--HEADER-->

<?php 	// show potential errors / feedback (from login object)
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