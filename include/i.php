<?php 
					date_default_timezone_set("Asia/kolkata");
						$todayExp = $yesterdayExp = $weeklyExp = $monthlyExp = $yearlyExp = $totalExp = 0;

						$todayIncome = $yesterdayIncome = $weeklyIncome = $monthlyIncome = $yearlyIncome = $totalIncome = 0;

						$current_date = date("Y-m-d " , strtotime("now"));
						$yesterday_date = date("Y-m-d " , strtotime("yesterday"));
						$weekly_date = date("Y-m-d " , strtotime("-1 week"));
						$monthly_date = date("Y-m-d " , strtotime("-1 month"));
						$yearly_date =  date("Y-m-d " , strtotime("-1 year"));

						// database connection
						require_once "connect.php";

					// Today's expense
						$sql_command_todayExp = "SELECT price , date FROM expenses Where date= '$current_date' AND email = '$_SESSION[email]' ";
						$result = mysqli_query($conn ,$sql_command_todayExp);
						$rows =  mysqli_num_rows($result);
						
						if($rows > 0){
							while ($rows = mysqli_fetch_assoc($result) ){
								$todayExp += $rows["price"];
							}
						}

					//todays income
						$sql_command_todayIncome = "SELECT amount , date FROM income Where date= '$current_date' AND email = '$_SESSION[email]' ";
						$result = mysqli_query($conn ,$sql_command_todayIncome);
						$rows =  mysqli_num_rows($result);
						
						if($rows > 0){
							while ($rows = mysqli_fetch_assoc($result) ){
								$todayIncome += $rows["amount"];
							}
						}

					// Yesterday's Expense
					$sql_command_yesterdayExp = "SELECT price , date FROM expenses Where date = '$yesterday_date' AND email = '$_SESSION[email]' ";
					$result_y = mysqli_query($conn ,$sql_command_yesterdayExp);
					$rows_y =  mysqli_num_rows($result_y);

					if($rows_y > 0){
						while ($rows_y = mysqli_fetch_assoc($result_y) ){
							$yesterdayExp += $rows_y["price"];
						}
					}

					// Yesterday's Income
					$sql_command_yesterdayIncome = "SELECT amount , date FROM income Where date = '$yesterday_date' AND email = '$_SESSION[email]' ";
					$result_y = mysqli_query($conn ,$sql_command_yesterdayIncome);
					$rows_y =  mysqli_num_rows($result_y);

					if($rows_y > 0){
						while ($rows_y = mysqli_fetch_assoc($result_y) ){
							$yesterdayIncome += $rows_y["amount"];
						}
					}

					// weekly expense
					$sql_command_weeklyExp = "SELECT price , date FROM expenses Where date BETWEEN '$weekly_date' AND '$current_date' AND email = '$_SESSION[email]'  ORDER BY date ";
					$result_w = mysqli_query($conn , $sql_command_weeklyExp) ;
					$rows_w =  mysqli_num_rows($result_w);
					if($rows_w > 0){
						while ($rows_w = mysqli_fetch_assoc($result_w) ){
							$weeklyExp += $rows_w["price"];
						}
					}

					// weekly income
					$sql_command_weeklyIncome = "SELECT amount , date FROM income Where date BETWEEN '$weekly_date' AND '$current_date' AND email = '$_SESSION[email]'  ORDER BY date ";
					$result_w = mysqli_query($conn , $sql_command_weeklyIncome) ;
					$rows_w =  mysqli_num_rows($result_w);
					if($rows_w > 0){
						while ($rows_w = mysqli_fetch_assoc($result_w) ){
							$weeklyIncome += $rows_w["amount"];
						}
					}


					// monthly expense
					$sql_command_monthlyExp = "SELECT price , date FROM expenses Where date BETWEEN '$monthly_date' AND '$current_date' AND email = '$_SESSION[email]' ORDER BY date ";
					$result_m = mysqli_query($conn , $sql_command_monthlyExp) ;
					$rows_m =  mysqli_num_rows($result_m);
					if($rows_m > 0){
						while ($rows_m = mysqli_fetch_assoc($result_m) ){
							$monthlyExp += $rows_m["price"];
						}
					}

					// monthly Income
					$sql_command_monthlyIncome = "SELECT amount , date FROM income Where date BETWEEN '$monthly_date' AND '$current_date' AND email = '$_SESSION[email]' ORDER BY date ";
					$result_m = mysqli_query($conn , $sql_command_monthlyIncome) ;
					$rows_m =  mysqli_num_rows($result_m);
					if($rows_m > 0){
						while ($rows_m = mysqli_fetch_assoc($result_m) ){
							$monthlyIncome += $rows_m["amount"];
						}
					}

					// yearly expense
					$sql_command_yearlyExp = "SELECT price , date  FROM expenses Where date BETWEEN '$yearly_date' AND '$current_date' AND  email = '$_SESSION[email]' ";
					$result_year = mysqli_query($conn , $sql_command_yearlyExp) ;
					$rows_year =  mysqli_num_rows($result_year);
					if($rows_year > 0){
						while($rows_year = mysqli_fetch_assoc($result_year)){
							$yearlyExp += $rows_year['price'];  
						}
					}

					// yearly income
					$sql_command_yearlyIncome = "SELECT amount , date  FROM income Where date BETWEEN '$yearly_date' AND '$current_date' AND  email = '$_SESSION[email]' ";
					$result_year = mysqli_query($conn , $sql_command_yearlyIncome) ;
					$rows_year =  mysqli_num_rows($result_year);
					if($rows_year > 0){
						while($rows_year = mysqli_fetch_assoc($result_year)){
							$yearlyIncome += $rows_year['amount'];  
						}
					}

					
					// total expense
					$sql_command_totalExp = "SELECT price , date FROM expenses Where email = '$_SESSION[email]' ORDER BY date ";
					$result_t = mysqli_query($conn , $sql_command_totalExp) ;
					$rows_t =  mysqli_num_rows($result_t);
					if($rows_t > 0){
						while ($rows_t = mysqli_fetch_assoc($result_t) ){
							$totalExp += $rows_t["price"];
						}
					}

					// total income
					$sql_command_totalIncome = "SELECT amount , date FROM income Where email = '$_SESSION[email]' ORDER BY date ";
					$result_t = mysqli_query($conn , $sql_command_totalIncome) ;
					$rows_t =  mysqli_num_rows($result_t);
					if($rows_t > 0){
						while ($rows_t = mysqli_fetch_assoc($result_t) ){
							$totalIncome += $rows_t["amount"];
						}
					}

					//search
					if (isset($_POST['search'])) {
						$search_term = mysql_real_escape_string($_POST['search_box']);

						$sql .= "WHERE item = '(search_term)'";
					}

					?>


					<div class="row">
						<h1 class=" display " > <i> DASHBOARD </i> </h1>

						<div class="search">
							<form name="search_form" method="POST" action="dashboard.php">
								Serach: <input type="text" name="search_box" value="">
								<input type="submit" name="search" value="search transactions">
							</form>
						</div>
						<br>

						<div class="row2">
							<div class="col">
								<div class="card gradient-1">
									<div class="card-body">
										<h3 class="card-title text-white">Today's Expense</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $todayExp; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F " , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card gradient-1">
									<div class="card-body">
										<h3 class="card-title text-white">Today's Income</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $todayIncome; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F " , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="card gradient-2">
									<div class="card-body">
										<h3 class="card-title text-white">Yesterday's Expense</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $yesterdayExp; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F " , strtotime("yesterday")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="card gradient-2">
									<div class="card-body">
										<h3 class="card-title text-white">Yesterday's Income</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $yesterdayIncome; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F " , strtotime("yesterday")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col3">
								<div class="card gradient-3">
									<div class="card-body">
										<h3 class="card-title text-white">Last 7 Day's Expense</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $weeklyExp; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F" , strtotime("-7 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-dollar"></i></span>
									</div>
								</div>
							</div>
							<div class="col3">
								<div class="card gradient-3">
									<div class="card-body">
										<h3 class="card-title text-white">Last 7 Day's Income</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $weeklyIncome; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F" , strtotime("-7 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-dollar"></i></span>
									</div>
								</div>
							</div>
							<div class="col4">
								<div class="card gradient-7">
									<div class="card-body">
										<h3 class="card-title text-white">Last 30 Day's Expense</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $monthlyExp; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F" , strtotime("-30 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col4">
								<div class="card gradient-7">
									<div class="card-body">
										<h3 class="card-title text-white">Last 30 Day's Income</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $monthlyIncome; ?></h2>
											<p class="text-white mb-0"><?php echo date("jS F" , strtotime("-30 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class = "col-3">

							</div>
							<div class="col5">
								<div class="card gradient-5">
									<div class="card-body">
										<h3 class="card-title text-white">One Year Expense</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $yearlyExp; ?></h2>
											<p class="text-white mb-0"><?php echo date("d F Y" , strtotime("-1 year")); echo " - " . date("d F Y" , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col5">
								<div class="card gradient-5">
									<div class="card-body">
										<h3 class="card-title text-white">One Year Income</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $yearlyIncome; ?></h2>
											<p class="text-white mb-0"><?php echo date("d F Y" , strtotime("-1 year")); echo " - " . date("d F Y" , strtotime("now")); ?></p>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col6">
								<div class="card gradient-9">
									<div class="card-body">
										<h3 class="card-title text-white">Total Expense</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $totalExp; ?></h2>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
							<div class="col6">
								<div class="card gradient-9">
									<div class="card-body">
										<h3 class="card-title text-white">Total Income</h3>
										<div class="d-inline-block">
											<h2 class="text-white"><?php echo $totalIncome; ?></h2>
										</div>
										<span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
									</div>
								</div>
							</div>
						</div>
					</div>