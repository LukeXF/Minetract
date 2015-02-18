<div class="container">
	<div class="row" style="margin-top:50px;">

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
	<hr>

	<div id="users" class="row">
		<div class="col-md-8">
			<h1 class="admin-title left">Registered Users</h1>
		</div>
		<div class="form col-md-4">
			<input class="search" placeholder="SEARCH" />
		</div>
		<table class="table-fill">
			<thead>
				<tr>
					<th class="sort" data-sort="user_email">Email</th>
					<th class="sort" data-sort="user_name">First Name</th>
					<th class="sort" data-sort="user_last">Last Name</th>
					<th class="sort" data-sort="user_type">Account Type</th>
					<th class="sort" data-sort="user_date">Date Joined</th>
				</tr>
			</thead>
			<tbody class="list table-hover">
				<?php 
					$totalUserCounter = 0;
					while( $totalUserCounter < count($totalUsers) ) {

						// Open Table
						echo "<tr>";

						// Gratar intergration to load email from array and display
						$email2 = $totalUsers["User " . $totalUserCounter]['user_email'];
						$size2 = "40px";
						$default2 = "http://dev.gunsdaily.net/assets/img/avatar.jpg";
						$grav_url2 = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email2 ) ) ) . "?d=" . urlencode( $default2 ) . "&s=" . $size2;
						echo "<td class='user_email'><img src=" . $grav_url2 . " alt='' style='border-radius:5px;' width='" . $size2 . "'> " . $totalUsers["User " . $totalUserCounter]['user_email'] . "</td>";


						// Display first name and last name
						echo "<td class='user_name'>" . $totalUsers["User " . $totalUserCounter]['user_name'] . "</td>";
						echo "<td class='user_last'>" . $totalUsers["User " . $totalUserCounter]['user_last'] . "</td>";


						switch ($totalUsers["User " . $totalUserCounter]['user_type']) {
							case "0": $accountType = "Disabled";	break;
							case "1": $accountType = "Normal Client";	break;
							case "2": $accountType = "Business Client";	break;
							case "3": $accountType = "Joint Account";	break;
							case "4": $accountType = "Admin Account";	break;
							default: $accountType = $totalUsers["User " . $totalUserCounter]['user_type']; 
						}
						echo "<td class='user_type'>" . $accountType . "</td>";

						// Sets the date joined into a human format
						$date1 = strtotime( $totalUsers["User " . $totalUserCounter]['user_date'] );
						$date2 = date( 'l jS F Y', $date1 );
						// $date3 = date( 'H:ia', $date1 );
						$date3 = '';
						echo "<td class='user_date'>" . $date2 . $date3 . "</td>";

						echo "</tr></a>";

						$totalUserCounter++;	
					}
				?>
			</tbody>
		</table>

	</div>

<script type="text/javascript">
	var options = {
	  valueNames: [ 'user_name', 'user_last', 'user_date', 'user_email', 'user_type' ]
	};

	var userList = new List('users', options);
</script>
