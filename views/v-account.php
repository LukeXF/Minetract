<div class="container">
	<div class="row" style="margin-top:50px;">

		<div class="col-md-2" style="padding-top:20px;">
			<div class="avatar">
				<img class="avatar" src="<?php echo $grav_url; ?>"><br>
				<a class="logout" href="account.php?logout">Logout</a>
			</div>
		</div>

		<div class="col-md-5">
			<div class="form-box">
					<h3><i class="fa fa-shopping-cart"></i> <b>0</b> products are in your cart.</h3>
					<h5><a href="t">View your cart now</a></h5>
					<h3><i class="fa fa-paper-plane"></i> <b>0</b> products are on the way to you.</h3>
					<h5><a href="t">Track your orders</a></h5>
			</div>
		</div>

		<div class="col-md-5">
			<div class="form-box">
					<h3><i class="fa fa-pencil"></i> <b>0</b> products awaiting your review</h3>
					<h5><a href="t">Write your opinion now</a></h5>
					<h3><i class="fa fa-warning"></i> <b>0</b> issues that need addressing</h3>
					<h5><a href="t">Address issues at hand</a></h5>
			</div>
		</div>

	</div>
	<hr>
	<div class="row">
		<h3>Your Details</h3>
		<div class="col-md-3">
			<p class="form">
				<label class="et_pb_contact_form_label">First Name</label>
				<input type="text" class="input et_pb_contact_name" readonly=readonly placeholder="<?php echo $_SESSION['user_name']; ?>" name="et_pb_contact_name">
			</p>
		</div>
		<div class="col-md-3">
			<p class="form">
				<label class="et_pb_contact_form_label">Last Name</label>
				<input type="text" class="input et_pb_contact_name" readonly=readonly placeholder="<?php echo $_SESSION['user_last'];?>" name="et_pb_contact_name">
			</p>
		</div>
		<div class="col-md-5">
			<p class="form">
				<label class="et_pb_contact_form_label">Email Address</label>
				<input type="text" class="input et_pb_contact_email" readonly=readonly value="<?php echo $_SESSION['user_email'];?>" name="et_pb_contact_email">
			</p>
		</div>

	</div>
	<div class="row" style="margin-top:30px;">
		<div class="col-md-4">
			<p class="form">
				<?php
					switch ($_SESSION['user_type']) {
						case "0": $accountType = "Disabled Account";	break;
						case "1": $accountType = "Normal Account (Client";	break;
						case "2": $accountType = "Business Account";	break;
						case "3": $accountType = "Joint Account (Business & Shop)";	break;
						case "4": $accountType = "Admin Account";	break;
						default: $accountType = $_SESSION['user_type']; 
					}
				?>
				<label class="et_pb_contact_form_label">Account Type</label>
				<input type="text" class="input et_pb_contact_name" readonly=readonly value="<?php echo $accountType; ?>" name="et_pb_contact_name">
			</p>
		</div>
		<div class="col-md-4">
			<p class="form">
				<?php
					// Sets the date joined into a human format
					$userjoined = strtotime($_SESSION['user_date']);
					$userjoined_1 = date( 'l jS F Y', $userjoined );
					$userjoined_2 = date( 'H:ia', $userjoined );
				?>
				<label class="et_pb_contact_form_label">Date Registered</label>
				<input type="text" class="input et_pb_contact_name" readonly=readonly value="<?php echo $userjoined_1 . " " . $userjoined_2; ?>" name="et_pb_contact_name">
			</p>
		</div>

	</div>


	<hr>


	<div class="row">
		<h3>Your Orders</h3>
		<!--<div class="col-md-6">
			<pre>
				<?php // print_r($orderArray); ?>
			</pre>
		</div>-->
		<!--<div class="col-md-6">
			<pre>
				<?php // print_r($productsInArray); ?>
			</pre>
		</div>-->
		<div class="col-md-6">
			<pre>
				<?php print_r($finalOrderList);

				$amountOfProducts = 2;
				$height = ($amountOfProducts * 130) + 74 . "px";
				?>
			</pre>
		</div>

		<div class="col-md-12">
			<?php
				reset($finalOrderList);

				// Counts finalOrderList array to stop the while loop going on forever if an error occurs.
				$countOrders = count($finalOrderList);
				// Sets the counter to 1 for use in the while loop
				$displayCounter = 1; 

				while ($displayCounter <= $countOrders) {
					$o_order_id       = $finalOrderList['Order ' . $displayCounter]['OrderInfo']['order_id'];
					$o_date           = $finalOrderList['Order ' . $displayCounter]['OrderInfo']['date'];
					$o_status         = $finalOrderList['Order ' . $displayCounter]['OrderInfo']['status'];
					$o_user_comments  = $finalOrderList['Order ' . $displayCounter]['OrderInfo']['user_comments'];
					$o_admin_comments = $finalOrderList['Order ' . $displayCounter]['OrderInfo']['admin_comments'];

					echo "<div class='col-md-9'>";
					echo "<div class='thumbnail account-overview' style='min-height:" . $height . "'>";
					echo "<div class='title row'>";
					echo "<div class='col-md-4 order-title'><b>Latest Order " . $displayCounter . "</b> <i>OrderID #" . $o_order_id . "</i> </div>";



					// Gets the product count for that order
					$countProductOrders = count($finalOrderList['Order ' . $displayCounter]['ProductInfo']);
					$displayProductCounter2 = 0; // The total order amount counter
					$displayProductCounter = 0; // The product display counter

					// Sets the value of the totalPriceOrder array for later use and later calculation
					while ($displayProductCounter2 < $countProductOrders) { 
						$p_price2 = $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter2]['Price'];
						// Adds to the total price order array the price of each product for later displaying
						$totalPriceOrder[$displayCounter][$displayProductCounter2] = $p_price2;
						$displayProductCounter2++;
					}

					// displays the total amount of products inside an order
					echo "<div class='col-md-4 col-md-offset-4 title-right'>";
					switch ($countProductOrders) {
						case "0": echo "Zero";	break;
						case "1": echo "One";	break;
						case "2": echo "Two";	break;
						case "3": echo "Three";	break;
						case "4": echo "Four";	break;
						case "5": echo "Five";	break;
						case "6": echo "Six";	break;
						case "7": echo "Seven";	break;
						case "8": echo "Eight";	break;
						case "9": echo "Nine";	break;
						case "69": echo "69 hehe :)"; break; // That's right
						default: echo $countProductOrders; 
					}
					echo " Items - <b>$" . array_sum( $totalPriceOrder[$displayCounter] ) . "</b></div>";
					echo "</div>";


					// Displays all the products inside the order
					while ($displayProductCounter < $countProductOrders) { 
						echo "<div class='row force-padding'>";
						echo "<div class='col-md-3'>";
						echo "		<img src='/assets/img/store/" . $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter]['Product Number'] . ".png' style='height:75px; width:160px;' alt='Image not found' />";
						echo "	</div>";

						echo "<div class='col-md-9'>";
						echo "<div class='caption'>";
						$p_number   = $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter]['Order_id'];
						$p_quantity = $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter]['Quantity'];
						$p_price    = $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter]['Price'];
						echo "<h4 class='pull-right'>" . $p_quantity . " ordered. <b>$" . $p_price . "</b></h4>";

						// Gets product ID for the product that is been echoed in the while loop
						$whileProductID = $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter]['Product Number'];

						echo "<h4><a href='#'>" .  $fullProductArray['Product ' . $whileProductID ]['Product Name'] . " </a> ";
						echo " <i> ProductID #" .  $fullProductArray['Product ' . $whileProductID ]['Product ID'] . "</i></h4>";
						echo "<p>" .  limit_desc($fullProductArray['Product ' . $whileProductID ]['Product Desc'],25) . "</p>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
						echo "<hr>";
						$displayProductCounter++;
					}

					echo "</div>";
					echo "</div>";

					echo "<div class='col-md-3'>";
					echo "<div class='thumbnail account-overview account-right' style='min-height:" . $height . "'>";
					echo "<div class='title row'>";

					// Creates date for the order array
					$phpdate = strtotime( $o_date );
					$o_date2 = date( 'l jS', $phpdate );
					$o_date3 = date( 'H:ia', $phpdate );
					echo "<div class='col-md-12 title-right'>Placed <b>" . $o_date3 . "</b> - <b>" . $o_date2 . " " . date('M') . "</b></div>";
					echo "</div>";
					echo "<div class='row force-padding'>";

					// Displays the order status
					switch ($o_status) {
						case "0": $finalStatus = "We&#39;ve recived your order";		break;
						case "1": $finalStatus = "We&#39;re getting your order ready";	break;
						case "2": $finalStatus = "Order is on it&#39;s way - Dispatched";	break;
						case "3": $finalStatus = "Order Completed";		break;
						default: echo $o_status; 
					}
					echo "<p class='form'>";
					echo "<label class='et_pb_contact_form_label'>Status</label>";
					echo "<input type='text' class='input et_pb_contact_name' readonly='readonly' placeholder='" . $finalStatus . "' name='et_pb_contact_name'>";
					echo "</p>";

					// Displays user comments
					echo "<p class='form'>";
					echo "<label class='et_pb_contact_form_label'>User Comments</label>";
					echo "<input type='text' class='input et_pb_contact_name' readonly='readonly' placeholder='" . $o_user_comments . "' name='et_pb_contact_name'>";
					echo "</p>";

					// Displays Admin comments
					echo "<p class='form'>";
					echo "<label class='et_pb_contact_form_label'>Admin Comments</label>";
					echo "<input type='text' class='input et_pb_contact_name' readonly='readonly' placeholder='" . $o_admin_comments . "' name='et_pb_contact_name'>";
					echo "</p>";

					echo "</div>";
					echo "</div>";
					echo "</div>";

					
					$displayCounter++;
				}
			?>


	</div>
</div>