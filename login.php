	<?php
	session_start(); 
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="90%" align="center" cellspacing="0" cellpadding="0" align="center" style="">
  <tr>
    <td><div>
    <hr style="height:5px; background-color:#00F; margin-top:4px; padding:0px; border:0px" />
  <table width="100%"  cellspacing="0" >
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
    <tr height="30px"><td>&nbsp;</td>

    </tr>
  </table>
  <hr style="height:10px; background-color:#999; margin-top:4px; padding:0px; border:0px" />
  <table width="100%" border="0" cellspacing="0"  border="1">
    <tr><td valign="top">
    <p style="font-size:24px; margin:0px; padding:0px">Login</p>
    </td>
    </tr>
  </table>
   <hr style="height:5px; background-color:#006; margin-top:4px; padding:0px; border:0px" />
</div>
</td>
  </tr>
	<?php
	include("connect.php");
	$msg = "";
	if(isset($_SESSION['user'])){
		header("Location: index.php");
	} else {
	if (isset($_POST['login'])){
		if($_POST['username'] != "" && $_POST['password'] != ""){
		//check whether all fields are field
			if($_POST['username'] != " " && $_POST['password'] != " "){
			//check whether there is a blank space
				$username = $_POST['username'] ;
				$password = sha1($_POST['password']) ;
				$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";	
				$result = mysql_query($sql);
				if(mysql_num_rows($result)==1){
					$row = mysql_fetch_array($result);
					$_SESSION['user'] = $row['userNo'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['fullnames'] = $row['Fname']." ".$row['Lname'];
					$_SESSION['gender'] = $row['gender'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['phone'] = $row['telNo'];
					$_SESSION['post'] = $row['post'];
					$_SESSION['email'] = $row['userEmail'];
					$_SESSION['date'] = $row['regDate'];
					
					if($row['post'] == "Admin"){ $_SESSION['super'] = "super"; }
					header("Location: index.php");					
				} else{
					//not in database
					$msg = "Ooops! Wrong username and/or password";
				}		
			}else{
			//blank space
			$msg = "A field can not caontain a NULL value. Please Try Again";
			}
		} else {
			//field not filled
			$msg = "You can not leave a field empty. Please Try Again";
		}
	} else{
		$msg = "Please Enter All Fields";
	}
	}

	?>
  <tr height="">
    <td align="center">
      <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
	<?php echo $msg; ?>
<form name="form1" method="post" action="login.php">
  <table width="40%" border="1" align="center"  height="auto"cellspacing="0">
    <tr style=" background-color:#CEFFFF;">
	   <td colspan="2">
	   <div align="center" class="style1"><h1 class="style2 style3">login</h1></div>
	   </td>
    </tr>
    <tr>
      <td>username</td>
      <td style="background-color:#CEFFFF; border: none; border-color:#0000FF;"><label>
        <input type="text" name="username">
      </label></td>
    </tr>
    <tr>
      <td>password</td>
      <td style="background-color:#CEFFFF; border: none; border-color:#0000FF;"  ><label>
        <input type="password" name="password">
      </label></td>
    </tr>
    <tr>
      <td height="65" colspan="2"><label>
        <input type="submit" name="login" value="Login">
      </label></td>
    </tr>
  </table>
</form>
</div></td>
  </tr>
 	<?php 
	include("includes/footer.php");
	?>