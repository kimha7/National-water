<?php 
session_start();
include 'connect.php';
$setCounter = 0;
if(isset($_SESSION['memo'])){
	if(($_SESSION['memo'] == 'name') && ($_SESSION['value'] != "" && $_SESSION['value'] != " ")){
		$name = $_SESSION['value'];
		$sql = "SELECT * from details where name LIKE '%$name%' ";
			} 
			
				if(($_SESSION['memo'] == 'cust') && ($_SESSION['value'] != "" && $_SESSION['value'] != " ")){
		$cust = $_SESSION['value'];
		$sql = "SELECT * from details where cust LIKE '%$cust%' ";
			} 
			
				if(($_SESSION['memo'] == 'prop') && ($_SESSION['value'] != "" && $_SESSION['value'] != " ")){
		$prop = $_SESSION['value'];
		$sql = "SELECT * from details where prop LIKE '%$prop%' ";
			}

$setExcelName = "download_customer";


$setRec = mysql_query($sql);

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
echo ucwords($setMainHeader)."\n".$setData."\n";} 

?>