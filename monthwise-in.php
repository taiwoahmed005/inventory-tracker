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
                        
                        $firstDayErr = $lastDayErr = "";

                        $firstDay= $lastDay = "";

                            $date = $amount =  "";

                            $i= 1;
                            require_once "connect.php";
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                
                                // echo "clicked";

                                if(empty($_REQUEST["first-day"])){
                                    $firstDayErr =" <p style='color:red'>* Please Select a Date </p>";
                                } else {
                                    $firstDay = $_REQUEST["first-day"];
                                } 
                                
                                if(  $_POST["last-day"] == "0" ){
                                $lastDayErr = " <p style='color:red'>* Please Select a Operation </p>";

                                } elseif ($_POST["last-day"] == "1" ){
                                    $temp_lastDay = strtotime( $firstDay."-1 month");
                                    $lastDay= date( "Y-m-d", $temp_lastDay);

                                    
                                    $sql_command = "SELECT date , amount FROM income WHERE date   BETWEEN '$lastDay' AND '$firstDay' AND email = '$_SESSION[email]' ORDER BY date " ;
                                
                                    $result = mysqli_query($conn , $sql_command);
                                    $rows = mysqli_num_rows($result);
                                    
                                    ?>
                                    
                    <div class='container '> 
                        <h4 class='text-center pt-5 hide'>Monthwise Income Report </h4>
                            <table class='table table-bordered table-hover border-primary mt-5 bg-light shadow hide'>
                                <thead> 
                                    <tr>
                                        <th> id </th>
                                        <th> Date </th>
                                        <th> Amount in $</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if( $rows > 0){
                                        while($rows = mysqli_fetch_assoc($result)){
                                        $date = $rows["date"]; 
                                        $date = date("jS F" , strtotime($date) );
                                        $amount =  $rows["amount"];
                                        echo "<tr> <th> $i   </th> <th>  $date  </th> <th>" .  " </th> <th>   $amount</th> </tr> ";
                                        $i++;
                                } 
                                    echo "</tbody> </table> ";
                                    echo "<style> #form{ display:none } </style>";
                                    echo "<div class='text-center pt-4 pb-5'> <a href='monthwise-in.php' class='btn btn-primary btn-lg'> Check More </a> 
                                    <a href='pdf_gen.php?firstDay={$firstDay}&lastDay={$lastDay}' class='btn btn-danger btn-lg text-white'> Save as PDF </a> </div>";

                                    } else {
                                        $firstDay = date( 'jS F' , strtotime("$firstDay") );
                                        $lastDay = date( 'jS F' , strtotime("$lastDay") );

                                        echo "<script>
                                        $(document).ready(function() {
                                            $('#addMsg').text( 'Sorry! No result Found between $lastDay and $firstDay. '  );
                                            $('#changeHrefForAdding').attr('href', 'add-income.php');
                                            $('#changeHrefForAdding').text('Add Income For the Week');
                                            $('#showModal').modal('show');
                                            $('.hide').hide();
                                        });
                                    </script>";
                                    }

                                }  else {
                                    $temp_lastDay = strtotime( $firstDay."+1 month");
                                    $lastDay= date( "Y-m-d", $temp_lastDay);    
                                    $sql_command = "SELECT date , amount FROM income WHERE date   BETWEEN '$firstDay' AND '$lastDay' AND email = '$_SESSION[email]' ORDER BY date " ;
                                    
                                    $result = mysqli_query($conn , $sql_command);
                                    $rows = mysqli_num_rows($result);
                                    

                                    ?>

                                    <div class='container '> 
                                        <h4 class='text-center pt-5 hide'> MonthWise Income Report </h4>
                                            <table class='table table-bordered table-hover border-primary bg-light shadow mt-5 hide'>
                                                <thead> 
                                                    <tr>
                                                        <th> id </th>
                                                        <th> Date </th>
                                                        <th> Amount in $</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    <?php 
                                    if( $rows > 0){
                                    while( $rows = mysqli_fetch_assoc($result) ){
                                        $date = $rows["date"];
                                        $date = date("jS F" , strtotime($date) );
                                        $amount = $rows["amount"];

                                            echo "<tr> <th> $i   </th> <th>  $date  </th> <th>   $amount</th> </tr> ";
                                            $i++;
                                            } 
                                    echo "</tbody> </table> ";
                                    echo "<style> #form{ display:none } </style>";
                                    echo "<div class='text-center pt-4 pb-5'> <a href='monthwise-in.php' class='btn btn-primary btn-lg'> Check More </a> 
                                    <a href='pdf_gen.php?firstDay={$firstDay}&lastDay={$lastDay}' class='btn btn-danger btn-lg text-white'> Save as PDF </a> </div>";

                                    } else {
                                        $firstDay = date( 'jS F' , strtotime("$firstDay") );
                                        $lastDay = date( 'jS F' , strtotime("$lastDay") );
                                        echo "<script>
                                        $(document).ready(function() {
                                            $('#addMsg').text( 'Sorry! No result Found between $firstDay and $lastDay. '  );
                                            $('#changeHrefForAdding').attr('href', 'add-income.php');
                                            $('#changeHrefForAdding').text('Add Income For the Week');
                                            $('#showModal').modal('show');
                                            $('.hide').hide();
                                        });
                                    </script>";
                                    }
                                }    
                    }

                    ?>

                    <div class="container ">

                                <div id="form" class="pt-5 form-input-content">
                                            <div class="card login-form mb-0">
                                                <div class="card-body pt-5 shadow">
                                                        <h4 class="text-center">Month Income Report </h4>
                                                    <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                                
                                                    <div class="form-group">
                                                        <label >Select First Day of the Month:</label>
                                                        <input type="date" class="form-control" value="<?php echo $firstDay; ?>" name="first-day" >  
                                                        <?php echo  $firstDayErr; ?>                   
                                                    </div>

                                                    <div class="form-group">
                                                        <select class="form-control" name = "last-day">
                                                            <option value="0"> Report Before/After Selected Date </option>
                                                        <option value="1"> Monthly Report Before Selected Date</option>
                                                            <option value="2"> Monthly Report After Selected Date</option>     
                                                        </select> 
                                                    <?php echo $lastDayErr; ?>               

                                                    </div>

                                                    <div class="form-group">
                                                        <input type="submit" value="Show Report" class="btn login-form__btn submit w-10 " name="submit_income" >
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