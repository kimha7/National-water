	<?php 
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
<?php
include 'connect.php';
		function getmonth($mm){
	$month = "";
	$allmonths = array("January","February","March","April","May","June","July","August","September","October","November","December");
		for($k = 0; $k<13; $k++){
			switch ($mm){
			case ($k+1): 
			$month = $allmonths[$k];
			break;
		}
	}
	return $month;
	}

$msg = "";
	
if(isset($_POST['name']) &&  isset($_POST['cust']) && isset($_POST['prop']) && isset($_POST['amount'])){
	if(($_POST['name'] != "") && ($_POST['cust'] != "") && ($_POST['prop'] != "") && ($_POST['amount'] != "")){
		if(($_POST['name'] != " ") && ($_POST['cust'] != " ") && ($_POST['prop'] != " ") && ($_POST['amount'] != " ")){
			
			$name  = $_POST['name'];
			$cust  = $_POST['cust'];
			$prop = $_POST['prop'];
			$datepay  = date("Y-m-d", strtotime("today"));
			$amountp  = $_POST['amount'];

			$sql2="select * from details where cust='$cust'";			
			$res=mysql_query($sql2);
			$info=mysql_fetch_array ($res);
			$oldBalance=$info['actual_balance'];
			
			$min = $info['balance_sign']/$info['amount'];;
			
			if($amountp > $min ){
							$nextdeadline = date("Y-m-d",strtotime("$datepay + 30 days"));
			
			//get value of month and year
			$day = str_split($datepay);
			$dd = $day[8].$day[9];
			$mm = $day[5].$day[6];
			$year = $day[0].$day[1].$day[2].$day[3];
			$month = getmonth($mm);

			$re = mysql_query("select * from details where cust = '$cust' limit 1");
			$ro = mysql_fetch_array($re);
			
			if($ro['actual_balance']!= 0){
				$sql="insert into payment(Cname,prop,cust,date_pay,amount, oldBal,day,month,year)
					value('$name','$prop','$cust','$datepay','$amountp','$oldBalance','$dd','$month','$year')";
					
					
			if(mysql_query($sql)){
			$msg = "<p align=\"center\" style = \"color:blue; font-size:24px; margin:0px; padding:0px\">Successfully Saved <a href = \"paymentDetails.php?id=$cust\">View Report</a> </p>"; 
		}  else {
			$msg = "<p align=\"center\" style = \"color:red; font-size:24px; margin:0px; padding:0px\"> ". mysql_error()." Entry not saved. Please try again or Call admin</p>";
		}
		
		$newBalance=$oldBalance-$amountp;

$sql3="update details set actual_balance='$newBalance' where cust='$cust'";
$sql4="update details set deadline = '$nextdeadline' where cust='$cust'";

if($newBalance!=0){
$sql5="update details set remarks='None' where cust='$cust'";
} else {
$sql5="update details set remarks='Complete' where cust='$cust'";
}

if ( mysql_query($sql3) && mysql_query($sql4) && mysql_query($sql5) ){
$msg .= "<p align=\"center\" style = \"color:blue; font-size:24px; margin:0px; padding:0px\" >your new balance is $newBalance</p>";
}

			} else {
			
			$msg = "<p align=\"center\" style = \"color:blue; font-size:24px; margin:0px; padding:0px\">The Customer's Account Is Fully Paid. Customers with zero balance can not pay on this program</p>";
			}
		} else{
				$msg = "<p align=\"center\" style = \"color:red; font-size:24px; margin:0px; padding:0px\">Amount paid is Less than required. Minimum should be ".$min." Uganda Shs.</p>";
			}
				} else {
	$msg = "<p align=\"center\" style = \"color:red; font-size:24px; margin:0px; padding:0px\">Please Fill In All Details</p>";
	}

 /*
  
 */
} else {
	$msg = "<p align=\"center\" style = \"color:red; font-size:24px; margin:0px; padding:0px\">Please Fill In All Details</p>";
	}

} else {
$msg = "<p align=\"center\" style = \"font-size:24px; margin:0px; padding:0px\">Please Fill in Form</p>";
}

?>


<?php 
$row = array();
if(isset($_GET['id'])){
	$cust = $_GET['id'];
	
	$result = mysql_query("SELECT * FROM details WHERE cust = '$cust'");
	if(mysql_num_rows($result) == 1){
	$row = mysql_fetch_array($result);
	} else {
	echo "Error. Wrong customer number";
	}
}
?>
  <tr height="">
    <td>
    <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Make Payment</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
<div>
  <table width="100%" border="0" cellspacing="0">
    <tr>
      <td height="12">&nbsp;</td>
    </tr>
  </table>
</div>


<?php 
echo $msg;
?>
<form id="form1" name="form1" method="post" action="">
  <table width="80%" align="center" border="0" cellspacing="10">
    <tr bgcolor="#0033FF">
      <td colspan="2"><div align="center" class="style1 style2" style="color:#EEEEEE;">Enter customer payment details </div></td>
    </tr>
    <tr>
      <td>customer name </td>
      <td><label>
        <input type="text" name="name" value="<?php echo $row['name'];?>" style="background-color:#FCF9CD"  />
      </label></td>
    </tr>
    <tr>
      <td>property-reference No.</td>
      <td><label>
        <input type="text" name="prop" value="<?php echo $row['prop'];?>"style="background-color:#FCF9CD" />
      </label></td>
    </tr>
    <tr>
      <td>customer-reference No.</td>
      <td><label>
        <input type="text" name="cust" value="<?php echo $row['cust'];?>"style="background-color:#FCF9CD" onkeypress="return isNumber(event)" class="textfield" id="extra7" />
      </label></td>
    </tr>
    <tr>
      <td>date of payment </td>
      <td><label>
        <input type="text" name="date" value="<?php echo date("Y-m-d");?>"style="background-color:#FCF9CD" />
      </label></td>
    </tr>
    <tr>
      <td>amount paid </td>
      <td><label>
        <input type="text" name="amount"style="background-color:#FCF9CD" onkeypress="return isNumber(event)" class="textfield" id="extra7" />
      </label></td>
    </tr>
    <tr>
      <td><label><a href="cutomerDetails.php?id=<?php echo $cust; ?>">Back</a>
      </label></td>
      <td><label>
        <input type="submit" name="Submit2" value="Submit" />
      </label></td>
    </tr>
  </table>
</form>

</div></td></tr>
	<?php 
	include("includes/footer.php");
	?>