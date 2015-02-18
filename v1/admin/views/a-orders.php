<div class="container" style='margin-top:75px;'>


	<div class="row">
		<!--<div class="col-md-6">
			<pre>
				<?php // print_r($orderArray); ?>
			</pre>
		</div>-->
		<!--<div class="col-md-6">
			<pre>
				<?php // print_r($totalUsers); ?>
			</pre>
		</div>-->
		<!--<div class="col-md-6">
			<pre>
				<?php // print_r($finalOrderList);

				//	$amountOfProducts = 2;
				//	$height = ($amountOfProducts * 130) + 74 . "px";
				?>
			</pre>
		</div>-->

		<div class="col-md-12">

		<div id="users" class="row">
			<div class="col-md-8">
				<h1 class="admin-title left">Incoming Orders</h1>
			</div>
			<div class="form col-md-4">
				<input class="search" placeholder="SEARCH" />
			</div>
			<table class="table-fill">
				<thead>
					<tr>
						<th class="sort" data-sort='order_user'>User</th>
						<th class="sort" data-sort='order_amount'>Amount Ordered</th>
						<th class="sort" data-sort='order_time'>Order Time</th>
						<th class="sort" data-sort='order_status'>Status</th>
						<th class="sort" data-sort='order_notes'>Users Notes</th>
					</tr>
				</thead>
				<tbody class="list table-hover">

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
						$o_user_id		  = $finalOrderList['Order ' . $displayCounter]['OrderInfo']['user_id'] -1;
						$o_user_id2		  = $finalOrderList['Order ' . $displayCounter]['OrderInfo']['user_id'];


							// Open Table
							echo "<tr data-toggle='modal' data-target='#editorder-" . $o_order_id . "'>";

							// Gratar intergration to load email from array and display
							$email2 = $totalUsers["User " . $o_user_id]['user_email'];
							$size2 = "40px";
							$default2 = "http://dev.gunsdaily.net/assets/img/avatar.jpg";
							$grav_url2 = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email2 ) ) ) . "?d=" . urlencode( $default2 ) . "&s=" . $size2;
							echo "<td class='order_user'><img src=" . $grav_url2 . " alt='' style='border-radius:5px;' width='" . $size2 . "'> " . $totalUsers["User " . $o_user_id]['user_email'] . "</td>";


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

							switch ($countProductOrders) {
								case "0": $countProductOrders =  "Zero";	break;
								case "1": $countProductOrders =  "One";		break;
								case "2": $countProductOrders =  "Two";		break;
								case "3": $countProductOrders =  "Three";	break;
								case "4": $countProductOrders =  "Four";	break;
								case "5": $countProductOrders =  "Five";	break;
								case "6": $countProductOrders =  "Six";		break;
								case "7": $countProductOrders =  "Seven";	break;
								case "8": $countProductOrders =  "Eight";	break;
								case "9": $countProductOrders =  "Nine";	break;
								case "69": $countProductOrders = "69 hehe :)"; break; // That's right
								default: $countProductOrders; 
							}

							// Display first name and last name
							echo "<td class='order_amount'>" . $countProductOrders . " Items - <b>$" .  array_sum( $totalPriceOrder[$displayCounter] ) . "</b></div></td>";

							// Creates date for the order array
							$phpdate = strtotime( $o_date );
							$o_date2 = date( 'l jS', $phpdate );
							$o_date3 = date( 'H:ia', $phpdate );
							echo "<td class='order_time'><b>" . $o_date2 . " " . date('M') . "</b> - " . $o_date3 . "</td>";



							switch ($o_status) {
								case "0": $finalStatus = "New Order";		break;
								case "1": $finalStatus = "Order Accepted";	break;
								case "2": $finalStatus = "Order Dispatched";	break;
								case "3": $finalStatus = "Order Completed";		break;
								default:  $finalStatus = $o_status; 
							}
							
							echo "<td class='order_status'>" . $finalStatus . "</td>";

							echo "<td class='order_notes'>" . $o_user_comments . "</td>";

							echo "</tr></a>";

							echo "<div class='modal fade' id='editorder-" . $o_order_id . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
								echo "<div class='modal-dialog modal-lg'>";
									echo "<div class='modal-content'>";
										echo "<div class='modal-header account-overview'>";
											echo "<span type='button' class='close2'><h4>";
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
											echo " Items - $" .  array_sum( $totalPriceOrder[$displayCounter] ) . "</h4><span class='sr-only'>Close</span></span>";
											echo "<h4 class='modal-title' id='myModalLabel'>Order ID Number " . $o_order_id . "</h4>";
										echo "</div>";
										echo "<div class='modal-body'>";
											echo "<div class='col-md-9'>";
												echo "<div class='thumbnail account-overview modalorder' style='min-height:" . $height . "'>";
													echo "<div class='title row' style='background-color: transparent !important;'>";
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
								
														echo "</div>";


														// Displays all the products inside the order
														while ($displayProductCounter < $countProductOrders) { 
															echo "<div class='row force-padding'>";
															echo "<div class='col-md-3'>";
															echo "		<img src='http://dev.gunsdaily.net/assets/img/store/" . $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter]['Product Number'] . ".png' style='height:75px; width:160px;' alt='Image not found' />";
															echo "	</div>";

															echo "<div class='col-md-9'>";
															echo "<div class='caption'>";
															$p_number   = $finalOrderList['Order ' . $displayCounter]['ProductInfo']['Product ' . $displayProductCounter]['Product Number'];
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
											echo "</div>";
											echo "<div class='col-md-3'>";
											echo "<div class='thumbnail account-overview account-right overview-modal' style='min-height:" . $height . "'>";
											echo "<div class='title2 row'>";

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
									echo "</div>";

									echo "<div class='modal-footer'>";
										echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
										echo "<button type='button' class='btn btn-primary'>Save changes</button>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
			
						$displayCounter++;
					}
					?>
				</tbody>
			</table>

		</div>

<script type="text/javascript">
	var options = {
	  valueNames: [ 'order_user', 'order_amount', 'order_time', 'order_status', 'order_notes' ]
	};

	var userList = new List('users', options);
</script>


</div>
</div>

