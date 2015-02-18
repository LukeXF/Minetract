<?php
	// Count all the users inside our users table
	require('classes/CountUsersFunction.php');
	$field = 'user_id';
	$condition = "";
	$DB_Table = 'users';
	$fieldArray = fieldCount($field, $condition, $DB_Table);
	$i=0;
	while( $i < count ($fieldArray) )
	{
	    $totalCount = $totalCount + $fieldArray[$i]['count'];
	    $i++;
	}
?>	


<section class="bg-1 widewrapper text-center">
		<?php 
			// show potential errors / feedback (from login object)
				    if ($login->errors) {
				        foreach ($login->errors as $error) {
				            echo $error;
				        }
				    } elseif ($login->messages) {
				        foreach ($login->messages as $message) {
				            echo $message;
				        }
				    } else {
						echo "
							<h1><span class='timer'>" . $totalCount . "</span></h1>
							<p class='lead'>freelancers that are ready for you.</p>";
					}
		?>
	<button type="button" class="btn btn-minetract btn-lg">About</button>
	<button type="button" class="btn btn-minetract btn-lg">Marketplace</button>
</section>

<div class="container">
	<div class="main">
		<section>
			<h3>Featured</h3>
			<p class="lead">just for you</p>
		</section>
		<div class="row featured">
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
		</div>
	</div>
</div>

<div class="grey">
	<div class="container">
		<div class="row grey-featured featured">
			<div class="col-md-6">				
				<h3>Recent Changes</h3>

				<p class="lead">view all</p>
				<div class="row">
					

					<div class="col-md-2"><p align="right">30/10/24:</p></div>
					<div class="col-md-10"><p> 
						Profile beta launched, <a href="">read more</a>.
					</p></div>

					<div class="col-md-2"><p align="right">28/10/24:</p></div>
					<div class="col-md-10"><p> 
						New payment options, you can now complete payment by card.
					</p></div>

					<div class="col-md-2"><p align="right">25/10/24:</p></div>
					<div class="col-md-10"><p> 
						Website production started, see what is to come <a href="">read more</a>.
					</p></div>

				</div>
				
			</div>
			<div class="col-md-6">
				<h3>Latest Tweets</h3>
				<p class="lead">@minetract</p>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="main">
		<div class="row">
			<div class="col-md-6">
				<section>
					<h3>Freelancers</h3>
					<p class="lead">by popularity</p>
				</section>
			</div>
			<div class="col-md-6">
				<section class="spacing">
					<h3><br></h3>
					<span class="lead">Builders</span>
					<span class="lead">Artists</span>
					<span class="lead">Programmers</span>
				</section>
			</div>
		</div>
		<div class="row featured">
			<div class="col-md-2 col-xs-4"><div class="inner-featured square"></div></div>
			<div class="col-md-2 col-xs-4"><div class="inner-featured square"></div></div>
			<div class="col-md-2 col-xs-4"><div class="inner-featured square"></div></div>
			<div class="col-md-2 col-xs-4"><div class="inner-featured square"></div></div>
			<div class="col-md-2 col-xs-4"><div class="inner-featured square"></div></div>
			<div class="col-md-2 col-xs-4"><div class="inner-featured square"></div></div>
		</div>
	</div>
</div>
