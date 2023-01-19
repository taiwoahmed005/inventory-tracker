<?php

include_once 'connect.php';

$delimeter = ",";
$filename = "transaction_" . date('Y-m-d') . ".csv";

$f = fopen('php://memory','w');

$fields = array('id','date','amount','email');
fputcsv($f, $fields, $delimeter);

$sql_query = "SELECT * FROM income ORDER BY id DESC";
$result = mysqli_query($conn , $sql_query);
if($result->num_rows > 0){


    while($row = $result->fetch_assoc()){
        $lineData = array($row['id'],$row['date'],$row['amount'],$row['email']);
        fputcsv($f,$lineData,$delimeter);
    }
}

$fields = array('id','date','item', 'price','email');
fputcsv($f, $fields, $delimeter);

$sql_query = "SELECT * FROM expenses ORDER BY id DESC";
$result = mysqli_query($conn , $sql_query);
if($result->num_rows > 0){


    while($row = $result->fetch_assoc()){
        $lineData = array($row['id'],$row['date'],$row['item'],$row['price'],$row['email']);
        fputcsv($f,$lineData,$delimeter);
    }
}

    fseek($f,0);

    header('Content-Type:text/csv');
    header('content-Disposition:attachment; filename="' . $filename . '";');

    fpassthru($f);
