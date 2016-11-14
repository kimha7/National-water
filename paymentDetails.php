	<?php 
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
<?php
include 'connect.php';
?>
  <tr height="">
    <td>
     <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Payment Details</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
    <br/>
<?php

$row = array();
if(isset($_GET['id'])){
	$cust = $_GET['id'];
	
	$result = mysql_query("SELECT * FROM payment WHERE cust = '$cust' ORDER BY PaymentId ASC");
	if(mysql_num_rows($result) > 0){
		
		
	echo  " <div> <table border='1' align='center' width='90%' cellspacing = '0' style='background-color:#ffffff' style='top:=100px;'>
<tr style='background-color:#00CCFF;' >
<th>property reference NO.</th>
<th>customer refeference No.</th>
<th>name</th>
<th>date date of payment</th>
<th>amount paid</th>
<th>Old Balace</th>
<th>New Balance</th>
</tr>
";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
   echo "<td style='background-color:#EEEEEE;'>" . $row['prop'] . "</td>";
  echo "<td>" . $row['cust'] . "</td>";
  echo "<td style='background-color:#EEEEEE;'>" . $row['Cname'] . "</td>";
  echo "<td>" . $row['date_pay'] . "</td>";
  echo "<td style='background-color:#EEEEEE;'>" . $row['amount'] . "</td>";
  echo "<td>" . $row['oldBal'] . "</td>";
  echo "<td style='background-color:#EEEEEE;'>" . ($row['oldBal'] - $row['amount']) . "</td>";
  echo "</tr>";
  }
  
  
echo "</div></table>"; 
	
	} else {
	echo "No Payment history available";
	}
} else {
echo "Error: Wrong Access To This Page. Go to <a href = \"index.php\">Home</a>";
}
?><p align="center"><a href="cutomerDetails.php?id=<?php echo $cust; ?>">Back</a></p>
</div>
</td></tr>
	<?php 
	include("includes/footer.php");
	?>