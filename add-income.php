<?php

session_start();
include "connect.php" ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/sb-admin-2.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<link href="js/plugins/fullcalender/fullcalendar.css" rel="stylesheet">

 <!-- Datepicker CSS -->
 <link href="css/datepicker.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="css/plugins/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.11.0.js"></script>
 <script src="js/plugins/metisMenu/metisMenu.js"></script>
</head>
<body>
<div id='mainContent'>
        <div class="sidebar" id="sidebar">
            <h3 class="logo" id="logo">E & I Tracker </h3>
            <div class="user">
                <img src="user-image.jpg" alt="user image" id="userimage">
                <span><?php echo $_SESSION['first_name']; ?> </span>
            </div>
            <div class="menu">
                <ul class="menulist">
                    <li class="active">
                        <a href="dashboard.php"><img src="icon/dashboard.png" height="20px" style="margin-right:10px;background-color:#000;" alt=""><span class="menuicon">Dashboard</span></a>
                    </li>
                    <li >
                        <a class="parent" href="javascript:void(0)" ><img src="icon/expense.png" height="20px" style="margin-right:10px;background-color:#000;" alt="">Expenses<img src="icon/arrow.png" height="12px" style="margin-left:10px;background-color:#0000ff;" ></a>
						<ul class="nav nav-second-level" id="subitem" style="display:none;">
                            <li ><a href="add-expenses.php">Add Expense</a></li>
                            <li ><a href="manage-expenses.php">Manage Expense</a></li>

                        </ul>
                    </li>
                    <li >
                        <a class="parent" href="javascript:void(0)"><img src="icon/income3.png" height="20px" style="margin-right:10px;background-color:#000;" alt="">Incomes
                        <img src="icon/arrow.png" height="12px" style="margin-left:10px;background-color:#0000ff;" ><span class="menuicon"></span></a>
						<ul class="nav nav-second-level" id="subitem"  style="display:none;">
                        	<li><a href="add-income.php">Add Income</a></li>
                        	<li><a href="manage-income.php">Manage Income</a></li>

                    	</ul>
                    </li>
                    <li>
                        <a class="parent" href="javascript:void(0)" ><img src="icon/report.png" height="20px" style="margin-right:10px;background-color:#000;" alt=""><span class="menuicon" >Expenses Report<img src="icon/arrow.png" height="12px" style="margin-left:10px;background-color:#0000ff;" ></span></a>
						<ul class="nav nav-second-level" id="subitem" style="display:none;">
                            <li><a href="daywise.php">Daily Expense</a></li>
                            <li><a href="weekwise.php">Weekly Expense</a></li>
                            <li><a href="monthwise.php">Monthly Expense</a></li>


                        </ul>
                    </li>
                    <li>
                        <a class="parent" href="javascript:void(0)"><img src="icon/report.png" height="20px" style="margin-right:10px;background-color:#000;" alt=""><span class="menuicon">Income Report<img src="icon/arrow.png" height="12px" style="margin-left:10px;background-color:#0000ff;" ></span></a>
						<ul class="nav nav-second-level" id="subitem" style="display:none;">
                            <li><a href="daywise-in.php">Daily Income</a></li>
                            <li><a href="weekwise-in.php">Weekly Incomes</a></li>
                            <li><a href="monthwise-in.php">Monthly Incomes</a></li>


                        </ul>
                    </li>
                    <li>
                        <a href="transaction.php"><img src="icon/transaction.png
                        " height="20px" style="margin-right:10px;background-color:#000;" alt=""><span class="menuicon">Transactions</span></a>
                    </li>
                    <li>
                        <a href="profile.php"><img src="icon/profile.png" height="20px" style="margin-right:10px;background-color:#000;" alt=""><span class="menuicon">Profile</span></a>
                    </li>
                </ul>
        </div>
    </div>
    <div class="contentcontainer" id="contentcontainer">
        <div class="topnav">
            <a href="" id="toggleBtn"><img src="icon/icons8-menu-24.png" alt="menu"></a>
            <a href="logout.php" id="logoutBtn"><i></i>Log-out</a>
        </div>
        <div class="content">
            <div class="maincontent">
                <?php

                $date = $amount =  $income_added = "";
                $dateErr = $amountErr = "";
                $email = $_SESSION["email"];



                    if($_SERVER["REQUEST_METHOD"] == "POST" ){
                        
                require_once "connect.php";

                        if( empty($_POST["income_date"]) ){
                            $dateErr = "<P style='color:red'>* Please Add an Income Date </p>";
                    }else {
                        $date = trim($_POST["income_date"]);
                    }

                    if( empty($_POST["income_amount"]) ){
                        $amountErr = "<P style='color:red'>* Please Add an amount </p>";
                    }else {
                    $amount = trim($_POST["income_amount"]);
                    }


                        if ( !empty($date) && !empty($amount) ){
                        
                                $add_income = "INSERT INTO income( date , amount , email ) VALUES ( '$date','$amount','$email' )" ;
                                $result = mysqli_query($conn , $add_income);
                                $date = $amount = "";

                                $income_added = " <div class='alert alert-warning alert-dismissible fade show'>
                                Item added to the Income List !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button> " ;
                                
                        }

                    }

                ?>

                <div class="container">
                        <?php   echo $income_added; ?>

                        </div>
                    <div class="form-input-content m-5">
                                <div class="card login-form mb-0">
                                    <div class="card-body pt-5 shadow">
                                            <h4 class="text-center">Add Income </h4>

                                        <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="">
                                    
                                        <div class="form-group">
                                            <label >Date :</label>
                                            <input type="date" class="form-control" value="<?php echo $date; ?>"  name="income_date" >
                                            <?php echo $dateErr; ?>                     
                                        </div>

                                        <div class="form-group">
                                            <label >Amount :</label>
                                            <input type="number" class="form-control " value="<?php echo $amount; ?>"  name="income_amount" >
                                            <?php echo $amountErr; ?>        
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value="Add" class="btn login-form__btn submit w-10 " name="submit_income" >
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function () {
            $(this).parent().addClass("collapse");
            $(".parent").on('click', function () {
                $(this).parent().find("#subitem").slideToggle();
            });
        });
    </script>
</body>
</html>
   
