	<?php 
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
<?php
include 'connect.php';

$msg = "";
$fff = "";

if(isset($_POST["search"])){
$flag=0;
$sql=""; 
if($_POST['name'] != "" && $_POST['name'] != " "){
$name = $_POST['name'];
$_SESSION['memo'] = 'name';
$_SESSION['value'] = $name;
$sql = "SELECT * from details where name LIKE '%$name%' ";
} 

if($_POST['cust'] != "" && $_POST['cust'] != " "){
$cust = $_POST['cust'];
$_SESSION['memo'] = 'cust';
$_SESSION['value'] = $cust;
$sql = "SELECT * from details where cust LIKE '%$cust%' ";
} if($_POST['prop'] != "" && $_POST['prop'] != " "){
$prop = $_POST['prop'];
$_SESSION['memo'] = 'prop';
$_SESSION['value'] = $prop;
$sql = "SELECT * from details where prop LIKE '%$prop%' ";
}

if($_POST['search'] == "Print"){header("Location:excel3.php");} else {$_SESSION['memo'] = '';
$_SESSION['value'] = '';}

if($sql != ""){
	
$result=mysql_query($sql);
$fff = mysql_fetch_array($result) ;

if(mysql_num_rows($result)>=1){
$msg = "<tr>
		<td colspan = \"3\"><table border = \"1\" width = \"100%\" cellspacing=\"0\">
		<tr>
		<th>NAME</th><th>CUSTOMER NUMBER</th><th>PROP NUMBER</th><th>PHONE NUMBER</th><th>MORE</th></tr>";
while ($row = mysql_fetch_array($result)) {
$id = $row['cust'];
$msg .= "<tr >
		<td>".$row['name']."</td>
		<td>".$row['cust']."</td>
		<td>".$row['prop']."</td> 
		<td>".$row['phone']."</td>
		<td><a href =\"cutomerDetails.php?id=$id\">MORE</a></td>
		</tr>";
}
$msg .= "</table> </td></tr>";

}
else {
$msg = "<tr><td colspan='3' align='center' style='color:red'>Record not
found</td></tr>";

}

	} else {
		$msg = "<tr><td colspan='3' align='center' style='color:red'>Please Enter A query</td></tr>";
		}

} else {
$msg = "<tr><td colspan = \"3\"></td></tr>";
}
?>

  <tr>
    <td valign="top">
        <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Search Customer</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
	<div>
    	<p style = " margin:0px; padding:0px; border:0px; font-size:24px; margin:0px; padding:0px;" align="center">Enter Your Query</p><br />
      <form name="search" method="post" action="">
	<table width="70%" align="center">
  <tr align="center" valign="top">
    <td>Search By Name</td>
    <td>Search By Customer Number</td>
    <td>Search By Property Number</td>
  </tr>  
    <tr>
    <td>
<table align="center"  cellspacing="4" cellpadding="0">
<tr>
<td colspan="3"><input type="text" name="name" size="20" style="background-color:#FCF9CD" <?php if(isset($_POST['name'])){$tt =$_POST['name'];echo "value = \"$tt\" ";} ?>/></td>
</tr>
</table>

</td>
    <td>
<table align="center"  cellspacing="4" cellpadding="0">
<tr>
<td colspan="3"><input type="text" name="cust" size="20" onkeypress="return isNumber(event)" class="textfield" id="extra7" style="background-color:#FCF9CD" <?php if(isset($_POST['cust'])){$cc =$_POST['cust'];echo "value = \"$cc\" ";} ?>/></td>
</tr>
</table>

</td>
    <td>
<table align="center"  cellspacing="4" cellpadding="0">
<tr>
<td colspan="3"><input type="text" name="prop" size="20" style="background-color:#FCF9CD" <?php if(isset($_POST['prop'])){$pp =$_POST['prop'];echo "value = \"$pp\" ";} ?>/></td>
</tr>
</table>
</td>
  </tr>
  <?php echo $msg; ?>
</table>
<table align="center"><tr><td style=""><input type="submit" value="Search" name="search"  /></td><?php if(isset($fff) && $fff!=0){ echo "<td><input type=\"submit\" value=\"Print\" name=\"search\"  /></td>";} ?></tr></table>
</form>
</div></div>
</td></tr>


	<?php 
	include("includes/footer.php");
	?>
