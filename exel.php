	<?php 
	session_start();
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
	<script> function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<?php
include 'connect.php';

if(isset($_GET['action']) && isset($_SESSION['result'])){
	$result = $_SESSION['result'];
	if(download($result,0)){
		$_SESSION['result'] = "";
	}
} else {echo "faield";}

$msg = "";
$o = "";
if(isset($_POST["submit"])){
$month=$_POST["month"];
$year=$_POST["year"];
$day=$_POST["day"];
$flag=0;
$sql="SELECT * from payment where ";
if($_POST["day"]!= "" && $_POST["day"] != " "){ 
$sql .="day LIKE '%$day%' AND";
}
$sql .= " month LIKE '%$month%' AND year LIKE '%$year%'";

$result=mysql_query($sql);
$_SESSION['result'] = "$result";

if(mysql_num_rows($result)>=1){
$o = "1";

$msg .=  " <div> <table border='1' align='center' width='100%' cellspacing = '0' style='background-color:#ffffff' style='top:=100px;'>
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
  $id = $row['cust'];
  $msg .=  "<tr>";
   $msg .= "<td style='background-color:#EEEEEE;'>" . $row['prop'] . "</td>";
  $msg .= "<td>" . $row['cust'] . "</td>";
  $msg .= "<td style='background-color:#EEEEEE;'>" . $row['Cname'] . "</td>";
  $msg .= "<td>" . $row['date_pay'] . "</td>";
  $msg .= "<td style='background-color:#EEEEEE;'>" . $row['amount'] . "</td>";
  $msg .= "<td>" . $row['oldBal'] . "</td>";
  $msg .= "<td style='background-color:#EEEEEE;'>" . ($row['oldBal'] - $row['amount']) . "</td>";
  $msg .= "</tr>";
  }
  
  $res = mysql_query("SELECT SUM(amount) FROM payment WHERE month LIKE '%$month%' AND year LIKE '%$year%'");
  $rec = mysql_fetch_array($res);
  
  $msg .= "<tr><td colspan=\"7\" style=\"text-align:center;\"><b>TOTAL:</b> {$rec['SUM(amount)']} </td></tr>";
  
$msg .= "</div></table>"; 


}
else {
$msg = "<tr><td colspan='7' align='center' style='color:red'>Sorry, no payment was made in that period</td></tr>";

}

} else {
$msg = "<tr><td colspan = \"7\">Enter Keyword Above</td></tr>";
}
?>

  <tr height="500">
    <td>
	<div>

<form name="search" method="post" action="">
<table border="1" style=" border:1px solid silver" cellpadding="5px" cellspacing="0px" align="center" border="0">
<tr>
<td colspan="7" style="background:#0033FF; color:#FFFFFF; fontsize:
20px">Search</td></tr>
<tr>
<td>Day</td><td><input type="text" class="textfield" value="" id="extra7" name="day" onKeyPress="return isNumber(event)" /></td>
<td>Month</td>
<td >
<select name="month">
<option>January</option>
<option>February</option>
<option>Match</option>
<option>April</option>
<option>May</option>
<option>June</option>
<option>July</option>
<option>August</option>
<option>September</option>
<option>October</option>
<option>November</option>
<option>December</option>
</select>
</td>
<td>Year</td>
<td><select name="year">

<?php 
$date = date("Y-m-d", strtotime("today"));
$day = str_split($date);
$year = $day[0].$day[1].$day[2].$day[3];


for ($r=0; $r<6;$r++){
$e = $year-$r;
echo "<option>$e</option>";

}

?>
</select></td><td><input type="submit" value="Search" name="submit" /> <?php if($o==1){ ?><a href="test.php?action=1">DOWNLOAD TABLE</a> <?php } ?></td>
</tr>
<?php 
echo $msg;
?>
<tr bgcolor="#CCCCCC">
<td colspan="7" align="right"><a href="index.php">Cancel</a></td>
</tr>
</table>

</form>
</div>
</td></tr>



	<?php 
	function download($setRec, $setCounter){
	$setCounter = mysql_num_fields($setRec);

 $setMainHeader = "";
 $setData = "";

for ($i = 0; $i < $setCounter; $i++) {
    $setMainHeader .= mysql_field_name($setRec, $i)."\t";
}

while($rec = mysql_fetch_row($setRec))  {
  $rowLine = '';
  foreach($rec as $value)       {
    if(!isset($value) || $value == "")  {
      $value = "\t";
    }   else  {
//It escape all the special charactor, quotes from the data.
      $value = strip_tags(str_replace('"', '""', $value));
      $value = '"' . $value . '"' . "\t";
    }
    $rowLine .= $value;
  }
  $setData .= trim($rowLine)."\n";
}
  $setData = str_replace("\r", "", $setData);

if ($setData == "") {
  $setData = "nno matching records foundn";
}

$setCounter = mysql_num_fields($setRec);



//This Header is used to make data download instead of display the data
 header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");

header("Pragma: no-cache");
header("Expires: 0");

//It will print all the Table row as Excel file row with selected column name as header.
echo ucwords($setMainHeader)."\n".$setData."\n";
}
	include("includes/footer.php");
	?>
