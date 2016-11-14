	<?php 
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
<?php
include 'connect.php';
$msg = "";
$c = 0;

?>
  <tr height="">
    <td valign="top" align="center">
     <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Defaulters</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
    <br/><br/>
    
    <table border="1" cellpadding="5px" cellspacing="0px" align="center" border="0" width = "70%" >
  <tr bgcolor="">
	<th style="">NAME</th><th style="">CUSTOMER REFERENCE NUMBER</th><th style="">PROPERTY REFERNCE NUMBER</th><th style="">PHONE NUMBER</th><th style="">MORE</th></tr>

<?php 
$sql = "SELECT * FROM details";
if(isset($_POST["submit"])&& $_POST["submit"] == 'Print'){$_SESSION['sql'] = $sql; header("Location: excel2.php");}
$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {
  $currentdate = strtotime(date("Y-m-d", strtotime("today")));
  $deadline = strtotime($row['deadline']);
  
  $diff = $deadline-$currentdate;  
  $id = $row['cust'];
  
  if(($deadline-$currentdate)<= 0){
echo "<tr>
		<td>".$row['name']."</td>
		<td>".$row['cust']."</td>
		<td>".$row['prop']."</td> 
		<td>".$row['phone']."</td>
		<td><a href =\"cutomerDetails.php?id=$id\">MORE</a></td>
		</tr>";
  $sql3="update details set remarks='Defaulter' where cust='$id'";
  mysql_query($sql3);
		}
		else {
  $c = $c+1;
  			}
}

echo "</table>";
  
  if(mysql_num_rows($result)==$c){
  echo "No defaulters";
  }

?><form action="" method="post"><input name="submit" type="submit" value="Print" /></form>
</td></tr></div>
	<?php 
	include("includes/footer.php");
	?>