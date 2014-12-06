<div class="container">
	<div class="row" style="margin-top:50px; margin-bottom:50px;" align="center">
		<h2>Hey there <?php echo $_SESSION['user_name'] ?>, your overview today is...</h2>
	</div>
	<div class="row">
		<h1 class="admin-title left">Advertising Schedule</h1>
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="form-box">
					<h3 ><i class="fa fa-users"></i> <b>X</b> total users registered.</h3>
				</div>
			</div>
		</div>
	</div>


	<hr>
	<div class="row">
		<h1 class="admin-title left">Incoming Orders</h1>
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="form-box">
					<h3 ><i class="fa fa-exclamation-triangle"></i> <b>X</b> deactivated Accounts</h3>
				</div>
			</div>
		</div>
	</div>


	<hr>
	<div class="row">
		<h1 class="admin-title left">Registered Users</h1>
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="form-box">
						<h3 ><i class="fa fa-users"></i> <b><?php echo count($totalUsers); ?></b> total users registered.</h3>
						<h3 ><i class="fa fa-exclamation-triangle"></i> <b><?php echo $accountTypeArray["Banned"] ?></b> deactivated Accounts</h3>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-box">
						<h3 ><i class="fa fa-user"></i> <b><?php echo $accountTypeArray["Normal"] ?></b> total normal users.</h3>
						<h3 ><i class="fa fa-suitcase"></i> <b><?php echo $accountTypeArray["Business"] ?></b> total business users.</h3>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-box">
						<h3 ><i class="fa fa-star"></i> <b><?php echo $accountTypeArray["Joint"] ?></b> total joint accounts.</h3>
						<h3 ><i class="fa fa-calendar"></i> <b><?php echo count($newUsersMonth); ?></b> users joined this month.</h3>
				</div>
			</div>
		</div>
	</div>


</div>