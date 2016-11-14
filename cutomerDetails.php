	<?php 
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
<?php
include 'connect.php';
$row = array();
$msg = "";
$color = "";
if(isset($_GET['id'])){
	$cust = $_GET['id'];
	
	$result = mysql_query("SELECT * FROM details WHERE cust = '$cust'");
	if(mysql_num_rows($result) == 1){
	$row = mysql_fetch_array($result);
	
	if($row['remarks'] == "Complete"){
	$msg .= "Customer is fully cleared. <a href=\"re_entry.php?user=$cust\">Make New Entry</a>";
	$color .= "black";
	} else if($row['remarks'] == "Defaulter"){
	$msg .= $row['remarks'];
	$color .= "red";}
	else{
	$msg .= $row['remarks'];
	$color .= "blue";
	}
	
	} else {
	echo "error. wrong customer number";
	}
}


?>
  <tr height="">
    <td>
    <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Customer's Details</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
<div>
<form method="post" action="customers.php">
<table border="1" style=" border:1px solid silver;" width="80%" cellpadding="5px" cellspacing="0px" align="center" >
 <tr>
     <br /> <div ><p style = " margin:0px; padding:0px; border:0px; font-size:24px; margin:0px; padding:0px;" align="center"><?php echo $row['name'];?></p></div><br />

    <tr>
      <td width="16%" style="background-color:#DDDDDD;">Full Names </td>
      <td width="26%"><label>
        <?php echo $row['name'];?>
      </label></td>
      <td width="29%" style="background-color:#DDDDDD;">Property Reference No. </td>
      <td width="29%"><label><?php echo $row['prop'];?></label></td>
    </tr>
    <tr>
      <td style="background-color:#DDDDDD;">Customer Reference No. </td>
      <td><label><?php echo $row['cust'];?></label></td>
      <td style="background-color:#DDDDDD;"> Period of payment (in Months) </td>
      <td><label><?php echo $row['amount'];?></label></td>
    </tr><tr>
      <td style="background-color:#DDDDDD;">Date of Signing </td>
      <td><label><?php echo $row['date_sign'];?></label></td>
      <td style="background-color:#DDDDDD;">Deadline Of Completion </td>
      <td><label><?php echo $row['completion_date'];?></label></td>
    </tr>
    <tr>
      <td style="background-color:#DDDDDD;">Actual Balance </td>
      <td><label><?php echo $row['actual_balance'];?></label></td>
      <td style="background-color:#DDDDDD;">Balance on Signing APA </td>
      <td><label><?php echo $row['balance_sign'];?></label></td>
    </tr>
    <tr>
      <td style="background-color:#DDDDDD;">Minimum To Pay Each Month </td>
      <td><label><?php
	  $min = ($row['balance_sign']/ $row['amount']);
	  echo $min; ?></label></td>
      <td style="background-color:#DDDDDD;">Remarks</td>
      <td style="background-color:<?php echo $color; ?>; opacity:0.7; color:white"><label><?php	echo $msg;   ?></label></td>
    </tr>
    <tr>
      <td style="background-color:#DDDDDD;">Next Deadline of payment </td>
      <td><label><?php echo $row['prop'];?></label></td>
      <td style="background-color:#DDDDDD;">Phone number </td>
      <td><label><?php echo $row['phone']?></label></td>
    </tr>
    <tr>
      <td colspan="2"><label></label>
        <div align="right"><a href="pay.php?id=<?php echo $cust;?>">Make Payment</a></div></td><td><div align="right"><a href="paymentDetails.php?id=<?php echo $cust;?>">View Payment History</a></div></td><td><div align="right"><a href="index.php">Back To Index </a></div></td>
      </tr>
  </table><br />
  <label></label>
</form>

</div></div>
</td></tr>
	<?php 
	include("includes/footer.php");
	?>
