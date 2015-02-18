<?php //Background Randomisation By Luke Brown
	$bg = array(
		"These are not the droids you are looking for.",
		"My dog ate that page.",
		"Woah there!",
		"Uh-oh",
		"You done broke'ded it." 
		);

	$i = rand(0, count($bg)-1);  
	$errorMessage = "$bg[$i]";
?>
<ol class="breadcrumb_menu">
	<div class="container breadcrumb">
		<li><a href="#">Home</a></li>
		<li class="active">404 Page</li>
	</div>
</ol>
<div class="page_title">
	<div class="container">
		<h2 class="center">Page Not Found</h2>
	</div>
</div>

<div class="container">
	<h1 align="center"><?php echo $errorMessage ?></h1>
	<h4 align="center">That page was not found</h4>
	<form style="margin-bottom:50px;" method="post" action="http://dev.gunsdaily.net/login">


	<div class="row">
		<div class="col-md-4 col-md-offset-4">	

			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 right">
							<a type="button" class="btn btn-standard animate" href="<?php echo $mainurl; ?>">Return Home</a>
						</div>
						<div class="col-md-6">
							<a type="button" class="btn btn-standard animate" onclick="goBack()" style="margin-right: 10px; float: left !important;">Go Back</a>
						</div>
					</div>
					
				</div>


			</div>
		</div>
	</div>


	</form>
</div>
