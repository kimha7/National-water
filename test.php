	<?php 
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
<?php
include 'connect.php';

$msg = "";
$o = "";
if(isset($_POST["submit"])){
$month=$_POST["month"];
$year=$_POST["year"];
$day=$_POST["day"];
$flag=0;
$sql="SELECT * from payment where ";
if($_POST["day"]!= "" && $_POST["day"] != " "){ 
$sql .="day = '%$day%' AND";
}
$sql .= " month LIKE '%$month%' AND year LIKE '%$year%'";

if($_POST["submit"] == 'Print'){
	
	function getmonth($months){
	$mon = "";
	$allmonths = array("January","February","March","April","May","June","July","August","September","October","November","December");
		for($k = 0; $k<13; $k++){
			switch ($months){
			case ($allmonths[$k]): 
			if($k>10){
				$mon = "6".$k+1;
				} else{
					$mon = $k+1;
					}
			break;
		}
	}
	return $mon;
	}
	//download_to_excel();
	if($day == "" || $day = " "){ $day = "xx-";}
	$_SESSION['tempo'] = $day."/".getmonth($month)."/".$year;
	echo $_SESSION['tempo'];
	}

$result=mysql_query($sql);

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

  <tr height="">
    <td valign="top">
         <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Report</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
	<div>
    <br /><p style = " margin:0px; padding:0px; border:0px; font-size:24px; margin:0px; padding:0px;" align="center">Enter Your Query</p><br />

<form name="search" method="post" action="">
<table border="1" style=" border:1px solid silver" cellpadding="5px" cellspacing="0px" align="center" border="0">
<tr>
<td colspan="7" style="background:#0033FF; color:#FFFFFF; fontsize:
20px">Search</td></tr>
<tr>
<td>Day</td><td><input type="text" class="textfield"  id="extra7" name="day" onkeypress="return isNumber(event)" <?php if(isset($_POST['day'])){ $dddd = $_POST['day']; echo " value=\"$dddd\"";} ?>  /></td>
<td>Month</td>
<td >
<select name="month">
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="January")){ echo " selected=\"selected\"";} ?> >January</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="February")){ echo " selected=\"selected\"";} ?> >February</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="March")){ echo " selected=\"selected\"";} ?> >March</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="April")){ echo " selected=\"selected\"";} ?> >April</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="May")){ echo " selected=\"selected\"";} ?> >May</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="June")){ echo " selected=\"selected\"";} ?> >June</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="July")){ echo " selected=\"selected\"";} ?> >July</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="August")){ echo " selected=\"selected\"";} ?> >August</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="September")){ echo " selected=\"selected\"";} ?> >September</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="October")){ echo " selected=\"selected\"";} ?> >October</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="November")){ echo " selected=\"selected\"";} ?> >November</option>
<option  <?php if(isset($_POST['month']) && ($_POST['month']=="December")){ echo " selected=\"selected\"";} ?> >December</option>
</select>
</td>
<td>Year</td>
<td><select name="year">

<?php 
$date = date("Y-m-d", strtotime("today"));
$day = str_split($date);
$year = $day[0].$day[1].$day[2].$day[3];


for ($r=0; $r<6;$r++){
$e = $year-$r; ?>
<option <?php if(isset($_POST['year']) && ($_POST['year']==$e)){ echo " selected=\"selected\"";} ?>><?php echo $e; ?></option>
<?php
}

?>
</select></td><td><input type="submit" value="Search" name="submit" /> <?php if($o==1){ ?><input type="submit" value="Print" name="submit" /> <?php } ?></td>
</tr>
<?php 
echo $msg;
?>
<tr bgcolor="#CCCCCC">
<td colspan="7" align="right"><a href="test.php">Cancel</a></td>
</tr>
</table>

</form>
</div>
</td></tr>



	<?php 
	include("includes/footer.php");
	?>
