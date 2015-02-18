<?php $userStars = 4; ?>
<div class="wrapper">
<body class="cbp-spmenu-push">
	<div class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $mt_url; ?>">
					<img src="<?php echo $mt_url; ?>assets/img/logo-img.png" alt="MINETRACT">
					<img src="<?php echo $mt_url; ?>assets/img/logo.png" alt="MINETRACT">
				</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<?php
						foreach($navbar2 as $x => $x_value) {

							if (!empty($x_value["active"])) {
								$class = $x_value["active"];
							} else {
								$class = "";
							}

							if (!empty($x_value["url"])) {
								$url = $x_value["url"];
							} else {
								$url = $x;
							}

							if ($x == $activeTab) {
								$class = "current";
							}

							if (!empty($x_value["submenu"])) {
								echo "<li class='" . $class . "'>";
									echo "<a class='animate'>" . $x . " <i class='fa fa-caret-down'></i></a>";
									foreach($x_value["submenu"][0] as $y => $y_value) {
										echo "<li><a href='" . $url . "'>" . $x_value["submenu"][0][1] . "</a></li>";
									}
								echo "</li>";
								
							} else {
								echo "<li class='" . $class . "'><a class='animate' href='$url'>";
								echo $x;
								echo "</a></li>";
							}
						}
					?>
					<li>
					<?php 

						// if logged in display content
						if ($login->isUserLoggedIn() == true) {
							echo "<button 
									type='button' class='navbar-toggle sidenav collapsed' 
									id='showRightPush' data-toggle='collapse'
									data-target='.navbar-collapse'
								>";
						} else {							
							echo "<button 
									type='button' class='navbar-toggle sidenav collapsed'
									data-placement='bottom' title='sign up or login.'
									 data-target='#login-popup' data-toggle='modal' data-tooltip='tooltip'
								>";
						}

					?>
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<!-- Modal -->
						<div class="modal fade" id="login-popup" tabindex="-1" role="dialog" aria-labelledby="login-popup" aria-hidden="true">
							<div class="modal-dialog">
								<form method="post" action="<?php echo $mt_url; ?>" name="loginform">
									<div class="modal-content">

										<div class="modal-header">
											<h4 class="modal-title" id="login-popup">Minetract</h4>
										</div>
										<div class="modal-body">								
											<input type="email"    id="login_input_username" placeholder="email address" name="user_name">
											<input type="password" id="login_input_password" placeholder="password" name="user_password">
										</div>
										<div class="modal-footer">
											<button type="submit" value="Login" name="login" class="btn btn-primary">Sign In</button>
											
										    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
										    <label class="save" for="user_rememberme">Keep me logged in</label><br>
											<div><a href="forgot">forgotten details?</a></div>
											<div><a href="register">sign up</a></div>
										</div>

									</div>
								</form>
							</div>
						</div>

					</li>
				</ul>
				<script type="text/javascript">
					$(function () {
					$('[data-toggle="tooltip"]').tooltip()
					})
					$(document).ready(function() {
					    $('body').tooltip({
					        selector: "[data-tooltip=tooltip]",
					        container: "body"
					    });
					});
				</script>
			</div>
		</div>
	</div>


	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
		<h3>Profile</h3>
		<img src="<?php echo $grav_url; ?>" alt="..." class="img-circle">
		<h3 class="title"><?php echo $_SESSION['user_first']; ?> <?php echo $_SESSION['user_last']; ?></h3>
		<span class="rating">
			<?php
				$i = $userStars;
				while ( $i > 0) {
					echo "<span class='star'><i class='fa fa-star'></i></span>";
					$i--;
				}
				$i = (5 - $userStars);
				while ( $i > 0) {
					echo "<span class='star'><i class='fa fa-star-o'></i></span>";
					$i--;
				}
			?>
		</span>
		<a href="<?php echo $mt_url; ?>commissions">Commissions</a>
		<a href="<?php echo $mt_url; ?>shop-dashboard">Shop</a>
		<a href="<?php echo $mt_url; ?>analytics">Analytics</a>
		<a href="<?php echo $mt_url; ?>settings">Settings</a>
		<a href="<?php echo $mt_url; ?>upgrade">Upgrade Account</a>
		<a href="<?php echo $mt_url; ?>?logout">Logout</a>
	</nav>


	<?php
		// if debug is on and the user is not an admin shut down the system.
		if ($_SESSION['user_type'] != 6 && $isThisTheMaintenancePage == false && $shutdown) {
			echo "<script>window.location.href ='". $fullUrl . "/maintenance';</script>";
		}
	?>


