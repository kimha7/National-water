	<?php
	include("includes/header.php");
	include ('connect.php');
	$msg = "";
	if(isset($_SESSION['user'])){
	//check if logged in
		if($_SESSION['post'] == "Admin"){
		//check if user is admin
				if(isset($_POST['submit'])){
					//check if clicked register button
					if(($_POST['Fname'] != "") && ($_POST['Lname'] != "") && ($_POST['username'] != "") && ($_POST['password1'] != "") && ($_POST['password2'] != "") && ($_POST['sex'] != "") && ($_POST['telNo'] != "") && ($_POST['email'] != "") && ($_POST['post'] != "")){
					//check if all fields have been filled
						if(($_POST['Fname'] != " ") && ($_POST['Lname'] != " ") && ($_POST['username'] != " ") && ($_POST['password1'] != " ") && ($_POST['password2'] != " ") && ($_POST['sex'] != " ") && ($_POST['telNo'] != " ") && ($_POST['email'] != " ") && ($_POST['post'] != " ")){
						//check if there is a null value
							if($_POST['password1'] == $_POST['password2']){
							//check if passwords match
								$fname=$_POST["Fname"];
								$lname=$_POST["Lname"];
								$username=$_POST["username"];
								$sex=$_POST["sex"];
								$telno=$_POST["telNo"];
								$email=$_POST["email"];
								$post=$_POST["post"];
								$password=$_POST["password1"];

								$mypassword = sha1($password);
								$date = date("Y-m-d", strtotime("today"));
								
								$sql="insert into users(Fname,Lname,username,password,gender,telNo,userEmail,post,regDate)
										value('$fname','$lname','$username','$mypassword','$sex','$telno','$email','$post','$date')";
								
								if(mysql_query($sql)){
									$msg = "Registration Successfull";
								} else{
									$msg = "Registration Failed Because ".mysql_error();
								}
								
															
							} else{
							//passwords dont match
							$msg = "OOoops! Your passwords dont match.";
							}
						} else {
						//there is  null value
							$msg = "Form can not contain a null value";
						}
					} else{
					//missing fields
						$msg = "There is a missing field";
					}
				} else {
					//just opened the page
					$msg = "Please Fill in the Form To Register A new User";
				}
			
		} else {
			//user not admin
			header("Location: index.php?stat=denied");			
		}
	} else {
		//user not logged in
		header("Location: login.php?stat=illegal");	
	}
	?>
  <tr height="">
    <td align="center">
     <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Add new user</h1>
    <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
	<?php echo $msg;?>
	<form method="post" action="register.php">
    <table width="100%" style="border: inset; left:211px; top:185px; height:490px; width:604px;" >
      <tr>
        <td colspan="2"><b>Name</b></td>
      </tr>
      <tr>
        <td height="31"><label>First Name 
            <input type="text" name="Fname" value="<?php if (isset ($_POST['Fname'])){echo $_POST['Fname'];} ?>" <?php if (isset ($_POST['Fname'])){if($_POST['Fname']=="" || $_POST['Fname']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?>/>
        </label></td>
        <td>&nbsp;</td>
      </tr>
	   <tr>
        <td height="48" colspan="2">Last Name         
          <input type="text" name="Lname" value="<?php if (isset ($_POST['Lname'])){echo $_POST['Lname'];} ?>" <?php if (isset ($_POST['Lname'])){if($_POST['Lname']=="" || $_POST['Lname']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?> /></td>
      </tr>
      <tr>
        <td colspan="2"><b> Username</b>
          <input type="text" name="username" value="<?php if (isset ($_POST['username'])){echo $_POST['username'];} ?>" <?php if (isset ($_POST['username'])){if($_POST['username']=="" || $_POST['username']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?>  /></td>
      </tr>
     <tr>
        <td height="48" colspan="2"><b>Create a password</b>
          <input type="password" name="password1" <?php if (isset ($_POST['password1'])){if($_POST['password1']=="" || $_POST['password1']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?>  /></td>
      </tr>
      <tr>
        <td colspan="2"><b>Confirm Password
            <input type="password" name="password2" <?php if (isset ($_POST['password2'])){if($_POST['password2']=="" || $_POST['password2']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?>  />
        </b></td>
      </tr>
      <tr>
        <td height="39" colspan="2"><b>Gender 
          <select name="sex" onChange="MM_jumpMenu('parent',this,0)">
            <option>Male</option>
            <option>Female</option>
          </select>
        </b></td>
      </tr>
      <tr>
        <td colspan="2"><b>Mobile Phone</b>
          <input type="text" name="telNo" value="<?php if (isset ($_POST['telNo'])){echo $_POST['telNo'];} ?>" <?php if (isset ($_POST['telNo'])){if($_POST['telNo']=="" || $_POST['telNo']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?> onkeypress="return isNumber(event)" class="textfield" id="extra7" /></td>
      </tr>
      <tr>
        <td height="48" colspan="2"><b>E-mail Address</b>
          <input type="text" name="email" value="<?php if (isset ($_POST['email'])){echo $_POST['email'];} ?>" <?php if (isset ($_POST['email'])){if($_POST['email']=="" || $_POST['email']==" "){ echo "style=\"background:red; opacity:0.5; color:white;\"";}} ?> /></td>
      </tr>
      <tr>
        <td height="48" colspan="2"><b>Register As</b><select name="post">
		<option>User</option>
        <option>Admin</option>
		</select></td>
      </tr>
      <tr>
        <td height="41" colspan="2"><input type="submit" name="submit" value="Submit" />
        <input type="reset" name="Submit22" value="Reset" /></td>
      </tr>
    </table>
  </form>
  </div></td>
  </tr>
 	<?php 
	include("includes/footer.php");
	?>