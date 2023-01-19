<?php
    include "connect.php";
    session_start();
    if(isset($_POST["submit"])){
        $first_name = mysqli_real_escape_string($conn,($_POST["first_name"]));
        $last_name = mysqli_real_escape_string($conn, ($_POST["last_name"]));
        $email = mysqli_real_escape_string($conn, ($_POST["email"]));
        $dob = mysqli_real_escape_string($conn, ($_POST["dob"]));	
        $password = mysqli_real_escape_string($conn, ($_POST["password"]));

        $sql = "INSERT INTO users (id, first_name, last_name, email, dob, password) VALUES ('$id', '$first_name', '$last_name', '$email', '$dob', '$password')";
        if(mysqli_query($conn,$sql)){
            echo "<h2><font color=blue>New record added to database.</font></h2>";
            header("location: dashboard.php");
            exit;
        }else{
            die(mysqli_error($conn));
        }
        
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js
" ></script>
</head>
<body>
    <div class="container">
        <center><h1> Registration Form</h1></center><br>
        <form class="form-horizontal" method="post" enctype="multipart/form">
            <div class="form-group">
                <label for="first_name" class="control-label col-sm-2 col-sm-offset-2">First Name:</label>
                <input type="text" name="first_name" class="form-control" placeholder='first Name'>
            </div>
            <br><br>

            <div class="form-group">
                <label for="last_name" class="control-label col-sm-2 col-sm-offset-2">Last Name:</label>
                <input type="text" name="last_name" class="form-control" placeholder='last Name'>
            </div>
            <br><br>

            <div class="form-group">
                <label for="dob" class="control-label col-sm-2 col-sm-offset-2">Date Of Birth:</label>
                <input type="date" class="form-control" name="dob" placeholder='0000/00/00' required class="form-control">
            </div>
            <br><br>

            <div class="form-group">
                <label for="pwd" class="control-label col-sm-2 col-sm-offset-2">Password:</label>
                <input type="password" class="form-control" name="password" placeholder='....' required class="form-control">
            </div>
            <br><br>

            <div class="form-group">
                <label for="pwd" class="control-label col-sm-2 col-sm-offset-2">Confirm password:</label>
                <input type="password" class="form-control" placeholder='....' required>
            </div>
            <br><br>

            <div class="form-group">
                <label for="email" class="control-label col-sm-2 col-sm-offset-2">Email:</label>
                <input type="email"name="email" class="form-control" placeholder='Email Id'>
            </div>
            <br><br>

            <div class="form-group">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label">I agree to the terms and conditions</label>
            </div>
            <br><br>

            <div class="form-group">
                <button type='submit' value="submit" name="submit" class="btn btn-primary">REGISTER</button>
            </div>
            <a href="login.php">already have an account</a>
        </form>
    </div>
</body>
</html>