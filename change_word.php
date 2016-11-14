	<?php
	include("includes/header.php");
	include ('connect.php');
	$msg = "";
	if(isset($_SESSION['user'])){
	//check if logged in
				if(isset($_POST['submit'])){
					//check if clicked register button
					if(($_POST['password'] != "") && ($_POST['password1'] != "") && ($_POST['password2'] != "")){
					//check if all fields have been filled
						if(($_POST['password'] != " ") && ($_POST['password1'] != " ") && ($_POST['password2'] != " ")){
						//check if there is a null value
							$user = $_SESSION['user'];
							$query = "SELECT * FROM users WHERE userNo = '$user'";
							$res = mysql_query($query);
							$row = mysql_fetch_array($res);
							
							if($row['password'] == sha1($_POST['password'])){
								if($_POST['password1'] == $_POST['password2']){
								//check if passwords match
								
								$password=$_POST["password1"];

								$mypassword = sha1($password);
								$date = date("Y-m-d", strtotime("today"));
								
								$msg = "ready to save";
								$sql="UPDATE users SET password = '$mypassword' WHERE userNo = '$user'";
								
								if(mysql_query($sql)){
									$msg = "<p align=\"center\" style=\"font-size:24px; margin:0px; padding:0px; color:blue;\">Password Sucessfully Changed</p>";
								} else{
									$msg = "<p align=\"center\" style=\"font-size:24px; margin:0px; padding:0px; color:red;\">Registration Failed Because ".mysql_error()."</p>";
								}
								
															
							} else{
							//passwords dont match
							$msg = "<p align=\"center\" style=\"font-size:24px; margin:0px; padding:0px; color:red;\">OOoops! Your passwords dont match.</p>";
							}
								
								} else {
									$msg = "<p align=\"center\" style=\"font-size:24px; margin:0px; padding:0px; color:red;\">Error, Wrong Password. Try Again.</p> ";
									}

						} else {
						//there is  null value
							$msg = "<p align=\"center\" style=\"font-size:24px; margin:0px; padding:0px; color:red;\">Form can not contain a null value</p>";
						}
					} else{
					//missing fields
						$msg = "<p align=\"center\" style=\"font-size:24px; margin:0px; padding:0px; color:red;\">There is a missing field</p>";
					}
				} else {
					//just opened the page
					$msg = "<p align=\"center\" style=\"font-size:24px; margin:0px; padding:0px;\">Please Fill in the Form To Change your password</p>";
				}
			
	} else {
		//user not logged in
		header("Location: login.php?stat=illegal");	
	}
	?>
  <tr height="">
    <td valign="top">
    <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Change Password</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
    <br />
	<?php echo $msg;?>
    <br />    <br />
	<form method="post" action="change_word.php">
    <table align="center" cellpadding="0" cellspacing="0" width="40%" >
      <tr>
        <td height="31"><b><label>Full Name    
          </label></b><span></span></td>
        <td><?php if(isset($_SESSION['fullnames'])){echo $_SESSION['fullnames']; } ?></td>
      </tr>
	   <tr>
	     <td colspan=""><b> Username</b></td><td>
          <span><?php if(isset($_SESSION['username'])){echo $_SESSION['username']; } ?></span></td>
        </tr>
     <tr>
        <td height="48" colspan=""><b>Enter Existing Password</b></td><td>
          <input type="password" name="password" <?php if (isset ($_POST['password'])){if($_POST['password']=="" || $_POST['password']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?>  /></td>
      </tr>
      <tr>
        <td colspan=""><b>Enter New Password </b></td> <td>       <input type="password" name="password1" <?php if (isset ($_POST['password1'])){if($_POST['password1']=="" || $_POST['password1']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?>  />
          </b></td>
      </tr>
       <tr>
        <td colspan=""><b>Repeat New Password</b></td><td>         <input type="password" name="password2" <?php if (isset ($_POST['password2'])){if($_POST['password2']=="" || $_POST['password2']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?>  />
          </b></td>
      </tr>
      <tr>
        <td height="41" colspan="2"><input type="submit" name="submit" value="Submit" />
          <input type="reset" name="Submit22" value="Reset" /></td>
      </tr>
    </table>
  </form>
 </div></td> </tr>
 	<?php 
	include("includes/footer.php");
	?>