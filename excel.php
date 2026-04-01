<?php 
include 'db.php';
header("content-type:text/csv");
header("content-disposition:attachment;filename=emp.csv");
$output=fopen("php://output","w");
fputcsv($output,array("id","name","sal"));
$result=$conn->query("select * from emp");
while ($row=$result->fetch_assoc()) {
    fputcsv($output,$row);
}



?>