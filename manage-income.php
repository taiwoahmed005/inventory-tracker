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
                    require "connect.php";

                        //get status msg
                        if(!empty($_GET['status'])){
                            switch($_GET['status']){
                                case 'succ':
                                    $statusType = 'alert-success';
                                    $statusMsg = 'Data has been imported successfully.';
                                    break;
                                case 'err':
                                    $statusType = 'alert-danger';
                                    $statusMsg = 'Some problem occured, please try again.';
                                    break;
                                case 'invalid_file':
                                    $statusType = 'alert-danger';
                                    $statusMsg = 'Please upload a valid CSV file.';
                                    break;
                                default:
                                    $statusType = '';
                                    $statusMsg = '';
                            }
                        }
                        //status msg ends


                            $i = 1;
                            $email = $_SESSION["email"];
                            $date = $amount =  $id =  "";
                        
                            $sql_command = "SELECT * FROM income WHERE email = '$email'  ORDER BY date ";
                            $result = mysqli_query($conn ,$sql_command ) ;
                                $row = mysqli_num_rows($result);
                    
                    ?>
                    <div class="row"
                        <div class="container bg-light shadow mt-5">
                            <h4 class='text-center pt-5 hide'>All Incomes  </h4>


                            <?php if(!empty($statusMsg)){ ?>
                            <div class="col-xs-12">
                                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
                            </div>
                            <?php } ?>

                            <div class="import">
                                <a href="javascript:void(0)" class="btn btn-success" onclick="formToggle{'importfrm'};"></a>
                            </div>
                            <div class="col-md-12" id="importfrm" style="display:none;">
                                <form action="importData.php" mehod="post" enctype="multipart/form-data">
                                    <input type="file" name="file">
                                    <input type="submit" class="btn-primary" name="importSubmit" value="IMPORT">
                                </form>
                            </div>

                            <table class=" table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Register Date</th>
                                        <th scope="col">Amount in $</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                if( $row > 0){
                                    while( $row = mysqli_fetch_assoc($result)){  
                                        $id = $row["id"];
                                        $date = $row["date"];
                                        $datef = date("jS F" , strtotime($date) );
                                        $amount = $row["amount"];

                                        $edit_icon = "<span ><i class='fa fa-edit'></i></span> ";
                                        $edit = " <a href='edit-income.php?id={$id}&amount={$amount}&date={$date}' class='btn-sm btn-primary float-right'> $edit_icon </a> ";
                                        $bin = " <a href='delete-income.php?id={$id}' id='bin' class='btn-sm btn-primary float-right ml-2'> <span ><i class='fa fa-trash '></i></span> </a> ";
                                    echo " <tr> <th> {$i}. </th> <th> {$datef} </th> <th> {$amount} {$bin} {$edit}  </th>
                                        "; 
                                    $i++;
                                    }
                                }else {
                                echo "<script>
                                $(document).ready(function() {
                                    $('#addMsg').text( 'You dont have any income!');
                                    $('#changeHrefForAdding').attr('href','add-income.php');
                                    $('#changeHrefToShowReport').text('Reminde me latter');
                                    $('#changeHrefForAdding').text('Add Income');
                                    $('#showModal').modal('show');
                                });
                                </script>";
                                }
                                ?>
                        </tbody>
                        </table>
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
