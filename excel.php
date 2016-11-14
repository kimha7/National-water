<?php 
session_start();
include 'connect.php';
$setCounter = 0;

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

if(isset($_SESSION['tempo'])){
	
			//get value of month and year
			$query = str_split($_SESSION['tempo']);
			$mm = $query[3].$query[4];
			$year = $query[6].$query[7].$query[8].$query[9];
			$day = $query[0].$query[1];
			$month = getmonth($mm);
		
		$flag=0;
		$sql="SELECT * from payment where ";
		
		if($_POST["day"]!= "" && $_POST["day"] != " "){ 
			$sql .="day = '%$day%' AND";
			}
$sql .= " month LIKE '%$month%' AND year LIKE '%$year%'";


$setExcelName = "payment_";


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