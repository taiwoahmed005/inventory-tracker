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
                        $old_passErr = $new_passErr = $confirm_passErr = "";
                        $old_pass = $new_pass = $confirm_pass = "";

                        if($_SERVER["REQUEST_METHOD"] == "POST"){

                            if(empty($_REQUEST["old_pass"])){
                                $old_passErr = " <p style='color:red'>* Old Password Is required </p>";
                            }else{
                                $old_pass = trim($_REQUEST["old_pass"]);
                            }
                            
                            if(empty($_REQUEST["new_pass"])){
                                $new_passErr = " <p style='color:red'>* New Password Is required </p>";
                            }else{
                                $new_pass = trim($_REQUEST["new_pass"]);
                            }

                            if(empty($_REQUEST["confirm_pass"])){
                                $confirm_passErr = " <p style='color:red'>* Please Confirm new Password! </p>";
                            }else{
                                $confirm_pass = trim($_REQUEST["confirm_pass"]);
                            }

                            if(!empty($old_pass) && !empty($new_pass) && !empty($confirm_pass) ){

                                require_once "include/database-connection.php";

                                $check_old_pass = "SELECT password FROM users WHERE email = '$_SESSION[email]' && password = '$old_pass' ";
                                $result = mysqli_query($conn , $check_old_pass);
                                if( mysqli_num_rows($result) > 0 ){
                                
                                    if( $new_pass === $confirm_pass ){
                                    
                                        $change_pass_query = "UPDATE users SET password = '$new_pass' WHERE email = '$_SESSION[email]' ";
                                        if (mysqli_query($conn , $change_pass_query) ){
                                            session_unset();
                                            session_destroy();
                                            echo "<script>
                                            $(document).ready(function() {
                                                $('#addMsg').text( 'Password Updated successfully! Log in With New Password');
                                                $('#changeHrefForAdding').attr('href','profile.php');
                                                $('#changeHrefForAdding').text('OK, Understood');
                                                $('#changeHrefToShowReport').hide();
                                                $('#modal_cross_btn').text('');
                                                $('#showModal').modal('show');
                                            });
                                            </script>";
                                        }
                                        
                                    }else{
                                        $confirm_passErr = "<p style='color:red'>* Confirm did not matched new Password! </p>";
                                    }

                                }else{
                                $old_passErr = " <p style='color:red'>*Sorry! Old Password is Wrong </p> ";
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
                                                        <h4 class="text-center">Change Password</h4>
                                                        <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                                            <div class="form-group">
                                                                <label >Old Password : </label>
                                                                <input type="password" name="old_pass" class="form-control">
                                                                <?php echo $old_passErr; ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label >New Password : </label>
                                                                <input type="password" name="new_pass" class="form-control">
                                                                <?php echo $new_passErr; ?>

                                                            </div>
                                                            <div class="form-group">
                                                                <label >Confirm Password : </label>
                                                                <input type="password" name="confirm_pass" class="form-control">
                                                                <?php echo $confirm_passErr; ?>

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

