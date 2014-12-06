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
				<a class="navbar-brand" href="<?php echo $mainurl; ?>"><img src="assets/img/logo-img.png" alt="MINETRACT"><img src="assets/img/logo.png" alt="MINETRACT"></a>
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
								<div class="modal-content">

									<div class="modal-header">									
										<h4 class="modal-title" id="login-popup">Minetract</h4>
									</div>
									<div class="modal-body">								
										
											<div id="error">
											</div>		
										<input type="email"    id="login_input_username" placeholder="email address" name="user_name">
										<input type="password" id="login_input_password" placeholder="password" name="user_password">
									</div>
									<div class="modal-footer">
										<button type="submit" value="Login" name="login" class="btn btn-primary">Sign In</button>
										<div>forgotten details?</div>
										<div>sign up</div>
									</div>

								</div>
							</div>
						</div>

					</li>
				</ul>
				<script type="text/javascript">

					$("#login").click(function() {
						var email = $("#login_input_username").val();
						var password = $("#login_input_password").val();

						if ($.trim(email).length > 0 && $.trim(password).length > 0) {
							$.ajax({
								type: "POST",
								url: "classes/Login.php",
								data: "user_name="+email+"&user_password"+password,
								success: function(html) {
									if (html)
										window.location = "login.php";
									else
										$("#error").html("<p style='color: red;'>There was an error</p>");
								}
							});
						} else {
							$("#error").html("<p style='color: red;'>One Or More Fields Are Empty</p>");
						}
					});

				</script>

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
		<img src="http://root-image.luke.sx/8227.png" alt="..." class="img-circle">
		<h3 class="title"><?php echo $_SESSION['user_name']; ?> <?php echo $_SESSION['user_last']; ?></h3>
		<span class="rating">
			<span class="star"><i class="fa fa-star"></i></span>
			<span class="star"><i class="fa fa-star"></i></span>
			<span class="star"><i class="fa fa-star"></i></span>
			<span class="star"><i class="fa fa-star"></i></span>
			<span class="star"><i class="fa fa-star-o"></i></span>
		</span>
		<a href="#">Commissions</a>
		<a href="#">Shop</a>
		<a href="#">Analytics</a>
		<a href="#">Settings</a>
		<a href="#">Upgrade Account</a>
	</nav>
