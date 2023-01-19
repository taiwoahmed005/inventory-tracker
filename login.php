<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="loginBody">

<!--php starts-->

    <?php

    $emailErr = $passwordErr =  "";
    $email = $password = "";

    session_start();

    if ( $_SERVER["REQUEST_METHOD"] == "POST" ){

            include "connect.php";

            if ( empty($_POST["email"] )) {
                $emailErr = " <p style='color:red'>* Email Is required </p>";
            }else{
                $email = trim($_POST["email"]);
            }
            
            if ( empty($_POST["password"] )) {
                $passwordErr = " <p style='color:red'>* Password Is required </p>";
            }else {
                $password = trim($_POST["password"]); 
            }

    if (!empty($email) && !empty($password) ){

        $sql = "SELECT * FROM users WHERE email = '$email ' AND password = '$password ' ";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_num_rows($result);

        if($row > 0){
            while( $row = mysqli_fetch_assoc($result) ){
                
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['dob'] = $row["dob"];
                header("Location: dashboard.php?login-success"); 
            }
        }else{
            echo
            "<script> alert('User Not Registered'); </script>";
        }
    }

    }

    ?>
<!--php ends-->



    <div class="container">
        <div class="header">
            <h1>IMS</h1>
            <p>Prestige</p>
        </div>
        <div class="formBody">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" >
                <div class="loginInput">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                </div>
                <div class="loginInput">
                    <label for="pwd">Password</label>
                    <input type="password" name="password">
                </div>
                <div class="button">
                    <button type="submit" value="submit" name="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>