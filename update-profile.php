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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>

                    <?php 

                            $nameErr = $emailErr = $dobErr = "";
                        $name = $email = $dob = "";

                        if(  $_SERVER["REQUEST_METHOD"] == "POST" ){
                            require "include/database-connection.php";


                            if( empty($_POST["fname"]) ){
                            $nameErr = "<p style='color:red'>* Name Is required </p>";
                            } else {
                            $name = trim($_POST["fname"]);
                            }

                            if( empty($_POST["email"]) ){
                                $emailErr = "<p style='color:red'>* Email Is required </p>";
                            } else {
                                $email = trim($_POST["email"]);
                            }

                            if( empty($_POST["dob"]) ){
                                $dobErr = "<p style='color:red'>* Date-of-Birth Is required </p>";
                            } else {
                                $dob = trim($_POST["dob"]);
                            }

                            if( !empty($name) && !empty($email) && !empty($dob)  ){
                                
                            //    database connection 

                            $session_email = $_SESSION['email'];
                        
                            $sql = "SELECT email FROM users WHERE email = '$email' ";
                            $existing_email = mysqli_query($conn , $sql);
                            $rows= mysqli_num_rows($existing_email);

                            if( $rows > 0 ){

                                echo "<script>
                                $(document).ready(function() {
                                    $('#addMsg').text( 'Email Already Assign to other User!');
                                    $('#changeHrefForAdding').hide();
                                    $('#changeHrefToShowReport').text('OK');
                                
                                    $('#showModal').modal('show');
                                });
                                </script>";
                                
                            }else {
                                $sql_command = "UPDATE users SET name = '$name', email = '$email' , dob = '$dob' WHERE email = '$session_email' ";
                                $result = mysqli_query($conn , $sql_command);
                                
                                $update_email_in_expenses_table = "UPDATE expenses SET email = '$email'  WHERE email = '$session_email' ";
                                    $result1 = mysqli_query($conn , $update_email_in_expenses_table);
                                        echo "update success";
                                        $_SESSION["email"] = $email;
                                        $_SESSION["name"] = $name;
                                        $_SESSION["dob"] = $dob;
                                        echo "<script>
                                        $(document).ready(function() {
                                            $('#addMsg').text( 'Profile updated successfully!');
                                            $('#changeHrefForAdding').attr('href','profile.php');
                                            $('#changeHrefForAdding').text('Check Profile');
                                            $('#changeHrefToShowReport').hide();
                                            $('#modal_cross_btn').text('');
                                            $('#showModal').modal('show');
                                        });
                                        </script>";
                                    }


                            
                        }
                    } 
                    ?>


                    <div style="margin-top:100px"> 
                    <div class="login-form-bg h-100">
                            <div class="container mt-5 h-100">
                                <div class="row justify-content-center h-100">
                                    <div class="col-xl-6">
                                        <div class="form-input-content">
                                            <div class="card login-form mb-0">
                                                <div class="card-body pt-5 shadow">                       
                                                        <h4 class="text-center">Update Your Profile</h4>
                                                    <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                                
                                                    <div class="form-group">
                                                        <label >Full Name :</label>
                                                        <input type="text" class="form-control" value="<?php echo trim($name); ?>" name="fname" >
                                                        <?php echo $nameErr; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label >Email :</label>
                                                        <input type="email" class="form-control" value="<?php echo $email; ?> "  name="email" >  
                                                        <?php echo $emailErr; ?>     
                                                    </div>

                                                    <div class="form-group">
                                                        <label >Date-of-Birth :</label>
                                                        <input type="date" class="form-control" value="<?php echo $dob; ?>"  name="dob" >  
                                                        <?php echo $dobErr; ?>     
                                                    </div>

                                                

                                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                                        <div class="btn-group">
                                                    <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes" >        
                                                        </div>
                                                        <div class="input-group">
                                                            <a href="profile.php" class="btn btn-primary w-20">Close</a>
                                                        </div>
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