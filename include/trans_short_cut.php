                    <div class="transaction" >
                        <div class="expenses" >
                            <?php 
                            require "connect.php";


                                    $i = 1;
                                    $email = $_SESSION["email"];
                                    $date = $item = $price =  $id =  "";
                                
                                    $sql_command = "SELECT * FROM expenses  WHERE email = '$email'  ORDER BY date ";
                                    $result = mysqli_query($conn ,$sql_command ) ;
                                        $row = mysqli_num_rows($result);
                            
                            ?>

                            <div class="container bg-light shadow mt-5" >
                                <center><h4 class='text-center pt-5 hide'> Expenses </h4></center>

                                <table class="table table-striped table-bordered" >
                                    <thead >
                                        <tr>
                                            <th scope="col">S.No.</th>
                                            <th scope="col">Register Date</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Price in $</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if( $row > 0){
                                        while( $row = mysqli_fetch_assoc($result)){  
                                            $id = $row["id"];
                                            $date = $row["date"];
                                            $datef = date("jS F" , strtotime($date) );
                                            $item = $row["item"];
                                            $price = $row["price"];

                                            $edit_icon = "<span ><i class='fa fa-edit'></i></span> ";
                                            $edit = " <a href='edit-expense.php?id={$id}&item={$item}&price={$price}&date={$date}' class='btn-sm btn-primary float-right'> $edit_icon </a> ";
                                            $bin = " <a href='delete-expense.php?id={$id}' id='bin' class='btn-sm btn-primary float-right ml-2'> <span ><i class='fa fa-trash '></i></span> </a> ";
                                        echo " <tr> <th> {$i}. </th> <th> {$datef} </th> <th> {$item} </th> <th> {$price} {$bin} {$edit}  </th>
                                            "; 
                                        $i++;
                                        }
                                    }else {
                                    echo "<script>
                                    $(document).ready(function() {
                                        $('#addMsg').text( 'You dont have any expenses!');
                                        $('#changeHrefForAdding').attr('href','add-expense.php');
                                        $('#changeHrefToShowReport').text('Reminde me latter');
                                        $('#changeHrefForAdding').text('Add Expenses');
                                        $('#showModal').modal('show');
                                    });
                                    </script>";
                                    }
                                    ?>
                            </tbody>
                            </table>
                            </div>
                        </div>

                        <div class="income" >
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

                            <div class="container bg-light shadow mt-5" >
                                <center><h4 class='text-center pt-5 hide'>Incomes</h4></center>

                                <?php if(!empty($statusMsg)){ ?>
                                <div class="col-xs-12">
                                    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
                                </div>
                                <?php } ?>

                                <table class=" table table-striped table-bordered" >
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