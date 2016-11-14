<?php 
	session_start();
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
		
		function downloadForm(){
$filename = 'All_Cusomer_Details.xls';
header( 'Content-type: application/ms-excel' );
header( 'Content-Disposition: attachment; filename=' . $filename );
}
if(isset($_GET['print'])){
downloadForm();
}
	?>
<?php
include 'connect.php';

$result = mysql_query("SELECT * FROM details");
echo  " <div> <table border='1' align='center'  cellspacing = '0' style='background-color:#ffffff' style='top:=100px;'>
<tr style='color:#EEEEEE;' bgcolor='#0033FF'>


<th>customer reference No.</th>
<th>property reference No.</th>
<th>customer name</th>
<th>date of signing</th>
<th>phone number</th>
<th>period of payment (months)</th>
<th>actual balancing</th>
<th>balancing at signing APA</th>
<th>deadline</th>
<th>completion date</th>
<th>remarks</th>


</tr>
";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
   
   
 
  echo "<td style='background-color:#EEEEEE;'>" . $row['cust'] . "</td>";
  echo "<td>" . $row['prop'] . "</td>";
  echo "<td style='background-color:#EEEEEE;'>" . $row['name'] . "</td>";
  echo "<td>" . $row['date_sign'] . "</td>";
    echo "<td style='background-color:#EEEEEE;'>" . $row['phone'] . "</td>";
  echo "<td>" . $row['amount'] . "</td>";
  echo "<td style='background-color:#EEEEEE;'>" . $row['actual_balance'] . "</td>";
  echo "<td>" . $row['balance_sign'] . "</td>";
  echo "<td style='background-color:#EEEEEE;'>" . $row['deadline'] . "</td>";
 echo "<td>" . $row['completion_date'] . "</td>";
   echo "<td style='background-color:#EEEEEE;'>" . $row['remarks'] . "</td>";
   echo "</tr>";
  }
echo "</div></table>"; 

echo "<a href=\"allCustomerDetails.php?print=1\">Print</a> ";
?>

<?php 
	include("includes/footer.php");
	?>