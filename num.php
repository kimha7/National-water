<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <label for="textfield"></label>
  <input type="text" name="textfield" value="" id="extra7" name="extra7" onkeypress="return isNumber(event)" />  
  enter number
</form>
<?php
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
?>

<?php


?>
<div style="position:absolute; border:inset; background-color: #EFEFEF;" align="center" ><table width="100%" border="1" cellspacing="0" cellpadding="0" >
  <tr>
    <td><input name="" type="text" /></td>
  </tr>
</table>

</div>
</body>
</html>
