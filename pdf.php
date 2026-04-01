<?php 
require "vendor/autoload.php";
include 'db.php';
$result=$conn->query("select * from emp");
 $pdf=new TCPDF();
 $pdf->addpage();
 $pdf->setfont("times","I","25");
 $pdf->cell(0,20,"EMPLOYEE DETAILS",1,1,"C");
 $html='<table border="1">
 <tr>
 <th>Id</th>
 <th>Name</th>
<th>Sal</th>
 </tr>
 ';
 while ($row=$result->fetch_assoc()) {
   $html .='
   <tr>
<td>' .$row["id"].'</td>
 <td>' .$row["name"].'</td>
 <td>' .$row["sal"].'</td>
   </tr>
   ';
 }
$html .="</table>";
$pdf->writeHtml($html,true,false,true,false,"");
$pdf->output("emp.pdf","D");

?>