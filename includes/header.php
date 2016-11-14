<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script> function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<link rel="stylesheet" href="css/proj.css" type="text/css" />
</head>

<body style="margin:0px; padding:0px; border:0px">
<table width="90%" align="center" cellspacing="0" cellpadding="0" align="center" style="">
  <tr>
    <td><div>
    <hr style="height:5px; background-color:#00F; margin-top:4px; padding:0px; border:0px" />
  <table width="100%"  cellspacing="0">
    <tr>
      <td valign="top" align="left"><table width="50%" align="left" style="border:none">
  <tr>
    <td width="120"><a href="index.php"><img src="images/logo.jpg" width="120" height="100" /></a></td>
    <td valign="middle"><h1 align="left" style="font-size:30px; margin:0px; padding:0px; border:0px">          NWSC APA Monitoring System</h1> </td>
  </tr>
</table>
 </td>
    </tr>
  </table>
</div></td>
  </tr>
  <tr>
    <td>
	<div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  border="1" style="background-color:#CCC">
    <tr height="30px">
          <td width="15%" style="text-align:center"><form action="change_word.php" method="get"><input name="" type="submit" value="CHANGE PASSWORD" style="background-color:#FFF; border:none; color:#00C;" /></form></td>
          <td width="8%" style="text-align:center"><form action="logout.php" method="get"><input name="" type="submit" value="LOGOUT" style="background-color:#FFF; border:none; color:red;" /></form></td>
          <?php if (isset($_SESSION['super'])){ ?>
          <td width="8%" style="text-align:center"><form action="register.php" method="get"><input name="" type="submit" value="REGISTER" style="background-color:#FFF; border:none; color:#00C;" /></form></td>
		  
		  <?php }?>
    	  <td width="55%"></td>
    </tr>
  </table>
  <hr style="height:10px; background-color:#999; margin-top:4px; padding:0px; border:0px" />
  <table width="100%" border="0" cellspacing="0"  border="1">
    <tr><td valign="top">
    <ul style="width:100%; list-style:none;  margin:0px; padding:0px; border:0px ">
    <li style="float:left; display:block; margin-right:50px"><a href="search.php" style="text-decoration:none; color:#00C;">VIEW CUSTOMERS</a></li>
    <li style="float:left; display:block; margin-right:50px"><a href="customers.php" style="text-decoration:none; color:#00C;">ADD CUSTOMER</a></li>
    <li style="float:left; display:block; margin-right:50px"><a href="defaulters.php" style="text-decoration:none; color:#00C;">DEFAULTERS</a></li>
    <li style="float:left; display:block; margin-right:3px"><a href="test.php" style="text-decoration:none; color:#00C;">REPORT</a></li>
    </ul>
    </td>
    </tr>
  </table>
   <hr style="height:5px; background-color:#006; margin-top:4px; padding:0px; border:0px" />
</div>
   <div align="right" style="margin-top:10px" > 
    Your Welcome <?php if (isset($_SESSION['fullnames'])){	
	echo $_SESSION['fullnames'];
	}
	?></div>
</td>
  </tr>