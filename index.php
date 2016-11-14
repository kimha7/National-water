	<?php 
	include("includes/header.php");
	if(!isset($_SESSION['user'])){
		header("Location: login.php");
		}
	?>
  <tr height="" ><td>
  <h1 align="left" style="margin:0px; padding:0px; border:0px; font-weight:100">Home</h1>
   <div style="border:1px solid blue; height:auto; min-height:330px; margin-top:10px">
  
  </div>
  
    </td>
  </tr>
 	<?php 
	include("includes/footer.php");
	?>