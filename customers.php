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

if(isset($_POST['name']) && isset ($_POST['balance']) && isset($_POST['cust']) && isset($_POST['actual_bal']) && isset($_POST['prop']) && isset($_POST['dateSign']) && isset($_POST['amountP']) && isset($_POST['number']) && isset($_POST['remarks']) ){
	
	if(($_POST['name'] != "") && ($_POST['balance'] != "") && ($_POST['cust'] != "") && ($_POST['actual_bal'] != "") && ($_POST['prop'] != "") && ($_POST['dateSign'] != "") && ($_POST['amountP'] != "") && ($_POST['number'] != "") && ($_POST['remarks'] != "")){
		if(($_POST['name'] != " ") && ($_POST['balance'] != " ") && ($_POST['cust'] != " ") && ($_POST['actual_bal'] != " ") && ($_POST['prop'] != " ") && ($_POST['dateSign'] != " ") && ($_POST['amountP'] != " ") && ($_POST['number'] != " ") && ($_POST['remarks'] != " ")){
		
		$name  = $_POST['name'];
		$paymonth  = $_POST['balance'];
		$actual  = $_POST['actual_bal'];
		$cust  = $_POST['cust'];
		$prop = $_POST['prop'];
		$datesign  = date("Y-m-d",strtotime($_POST['dateSign']));
		$amountp  = "+".$_POST['amountP']."months";
		$completiondate  = date("Y-m-d", strtotime("$datesign ".$amountp));
		$nextdeadline = date("Y-m-d",strtotime("$datesign + 30 days"));
		$phone  = $_POST['number'];
		$remarks  = $_POST['remarks'];
		
					//get value of month and year
			$day = str_split($datesign);
			$mm = $day[5].$day[6];
			$year = $day[0].$day[1].$day[2].$day[3];
			$month = getmonth($mm);


		$sql="insert into details(name,prop,cust,date_sign,phone,amount,completion_date,remarks,balance_sign,deadline,actual_balance,month,year)
		value('$name','$prop','$cust','$datesign','$phone','$amountp','$completiondate','$remarks','$paymonth','$nextdeadline','$actual','$month','$year')";
		
		if(mysql_query($sql)){
			$msg = "<p style = \"color:blue margin:0px; padding:0px; border:0px; font-size:24px;\" align=\"center\">Successfully Saved</p>";
		} else {
			$msg = "<p style = \"color:red margin:0px; padding:0px; border:0px; font-size:24px;\" align=\"center\">".mysql_error()." Entry not saved. Please try again or Call admin"."</p>";
		}

			} else {
	$msg = "<p style = \"color:red margin:0px; padding:0px; border:0px; font-size:24px;\" align=\"center\">Please Fill In All Details</p>";
	}

 /*
  
 */
} else {
	$msg = "<p style = \"color:red; margin:0px; padding:0px; border:0px; font-size:24px;\" align=\"center\">Please Fill In All Details</p>";
	}
} else {
$msg = "<p align=\"center\" style=\"margin:0px; padding:0px; border:0px; font-size:24px;\">Please fill in the form above</a>";
}

?>
  <tr >
    <td valign="top">
        <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Customers</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
    <div>
  <table width="100%" border="0" cellspacing="0">
    <tr>
      <td height="12">&nbsp;</td>
    </tr>
  </table>
</div>
<div style=" border:none; margin:0px; padding:0px; border:0px">

<?php 
echo $msg;
?>
	
  
</div>
<div style="position:absolute;"></div>
<div style=" border-color:#0099FF;">
<form method="post" action="customers.php">
  <table width="90%" align="center" border="0" cellspacing="7">
    <tr>
      <td colspan="4" bgcolor="#0033FF" ><div align="center" class="style1 style2"  style="color:#EEEEEE;">Insert customer details </div></td>
    </tr>
    <tr>
      <td width="16%">Full Names </td>
      <td width="26%"><label>
        <input type="text" name="name" <?php if(isset($_POST['name'])){$pl = $_POST['name']; if( ($_POST['name'] == "" || $_POST['name'] == " ")){echo "style=\"background-color:#FFA6A6\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?> />
      </label></td>
      <td width="29%">Balance at the signing APA </td>
      <td width="29%"><label>
        <input type="text" name="balance" <?php if(isset($_POST['balance'])){$pl = $_POST['balance']; if( ($_POST['balance'] == "" || $_POST['balance'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?> onkeypress="return isNumber(event)" class="textfield" id="extra7"/>
      </label></td>
    </tr>
    <tr>
      <td>Customer Reference No. </td>
      <td><label>
        <input type="text" name="cust" <?php if(isset($_POST['cust'])){$pl = $_POST['cust']; if( ($_POST['cust'] == "" || $_POST['cust'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?>  onkeypress="return isNumber(event)" class="textfield" id="extra7" />
      </label></td>
      <td> Period of payment (in Months) </td>
      <td><label>
        <input type="text" name="amountP" <?php if(isset($_POST['amountP'])){$pl = $_POST['amountP']; if( ($_POST['amountP'] == "" || $_POST['amountP'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?>  onkeypress="return isNumber(event)" class="textfield" id="extra7" />
      </label></td>
    </tr>
    <tr>
      <td>property-reference No.</td>
      <td><label>
        <input type="text" name="prop" <?php if(isset($_POST['prop'])){$pl = $_POST['prop']; if( ($_POST['prop'] == "" || $_POST['prop'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?> />
      </label></td>
      <td>Actual Balance </td>
      <td><input type="text" name="actual_bal" <?php if(isset($_POST['actual_bal'])){$pl = $_POST['actual_bal']; if( ($_POST['actual_bal'] == "" || $_POST['actual_bal'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?> onkeypress="return isNumber(event)" class="textfield" id="extra7" /></td>
    </tr>
    <tr>
      <td>Phone number </td>
      <td><label>
        <input type="text" name="number" <?php if(isset($_POST['number'])){$pl = $_POST['number']; if( ($_POST['number'] == "" || $_POST['number'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?>  onkeypress="return isNumber(event)" class="textfield" id="extra7"/>
      </label></td>
      <td>Date of signing </td>
      <td><label>
        <input type="text" name="dateSign" value="<?php echo date("Y-m-d");?>" <?php if(isset($_POST['dateSign'])){$pl = $_POST['dateSign']; if( ($_POST['dateSign'] == "" || $_POST['dateSign'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?> />
      </label></td>
    </tr>
    <tr>
      <td>remarks</td>
      <td><label>
        <textarea name="remarks" <?php if(isset($_POST['remarks'])){$pl = $_POST['remarks']; if( ($_POST['remarks'] == "" || $_POST['remarks'] == " ")){echo "style=\"background-color:#FFA6A6;\"";} else {echo "value=\"$pl\" "; echo "style=\"background-color:#FCF9CD\"";}}else {echo "style=\"background-color:#FCF9CD\"";} ?>></textarea>
      </label></td>
      <td><a href="index.php">Cancel</a></td>
      <td><label>
        <input type="submit" name="Submit2" value="Submit" />
      </label></td>
    </tr>
  </table>
  <label></label>
</form>
</div>
</div>
</td></tr>
	<?php 
	include("includes/footer.php");
	?>

