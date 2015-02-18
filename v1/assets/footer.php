  <div class="push"></div>

</div>		
		<div class="grey footergrey">
			<div class="container">
				<div class="row footer">
					<div class="col-md-4">				
						<h3>MINETRACT</h3>						
					</div>
					<div class="col-md-4">
						<h3><a href="">Terms &amp; Conditions</a></h3>
					</div>
					<div class="col-md-4">
						<span>&copy; Minetract 2014 Not affiliated or endorsed by Mojang AB</span>
					</div>
				</div>
			</div>
		</div>


		<script src="assets/js/classie.js"></script>
				<script>
				menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRightPush = document.getElementById( 'showRightPush' ),
				body = document.body;

			showRightPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toleft' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRightPush', body );
			};

			function disableOther( button ) {
				if( button !== 'showRightPush' ) {
					classie.toggle( showRightPush, 'disabled' );
				}
			}

			
			(function($) {
			    $.fn.countTo = function(options) {
			        // merge the default plugin settings with the custom options
			        options = $.extend({}, $.fn.countTo.defaults, options || {});

			        // how many times to update the value, and how much to increment the value on each update
			        var loops = Math.ceil(options.speed / options.refreshInterval),
			            increment = (options.to - options.from) / loops;

			        return $(this).each(function() {
			            var _this = this,
			                loopCount = 0,
			                value = options.from,
			                interval = setInterval(updateTimer, options.refreshInterval);

			            function updateTimer() {
			                value += increment;
			                loopCount++;
			                $(_this).html(value.toFixed(options.decimals));

			                if (typeof(options.onUpdate) == 'function') {
			                    options.onUpdate.call(_this, value);
			                }

			                if (loopCount >= loops) {
			                    clearInterval(interval);
			                    value = options.to;

			                    if (typeof(options.onComplete) == 'function') {
			                        options.onComplete.call(_this, value);
			                    }
			                }
			            }
			        });
			    };

			    $.fn.countTo.defaults = {
			        from: 0,  // the number the element should start at
			        to: 100,  // the number the element should end at
			        speed: 1000,  // how long it should take to count between the target numbers
			        refreshInterval: 100,  // how often the element should be updated
			        decimals: 0,  // the number of decimal places to show
			        onUpdate: null,  // callback method for every time the element is updated,
			        onComplete: null,  // callback method for when the element finishes updating
			    };
			})(jQuery);

			jQuery(function($) {
			        $('.timer').countTo({
			            from: 50,
			            to: 90002,
			            speed: 1000,
			            refreshInterval: 50,
			            onComplete: function(value) {
			                console.debug(this);
			            }
			        });
			    });

		</script>
	</body>
</html>
