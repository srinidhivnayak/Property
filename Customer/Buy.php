<?php require_once('../Connections/PMS.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_PMS, $PMS);
$query_Recordset1 = "SELECT * FROM category_master";
$Recordset1 = mysql_query($query_Recordset1, $PMS) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

if (!isset($_SESSION)) 
{
  session_start();
  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Real Estate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	
$(".country").change(function()
{
var dataString = 'StateName='+ $(this).val();
$.ajax
({
type: "POST",
url: "ajax_state.php",
data: dataString,
cache: false,
success: function(html)
{
$(".state").html(html);
} 
});

});

$('.state').live("change",function(){									   
var dataString = 'CityName='+ $(this).val();
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".city").html(html);
} 
});

});



});
</script>
<style type="text/css">
<!--
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #1B3B00;
}
.style4 {
	font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
}
-->
</style>
</head>
<body>
<div class="main">
  <?php
  include "Headermenu.php"
  ?>
  
  <div class="content">
    <div class="innercontent">
      <?php
	  include "left.php"
	  ?>
      <div class="rightpannel">
        <div class="welcome">
          <div class="style3" style="height:30px; padding-bottom:5px">Welcome <?php echo $_SESSION['CustomerName'];?></div>
          <div style="width:573px; height:auto;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#3f3f3f; line-height:20px; text-align:justify">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="#93A537"><span class="style4">Search Property</span></td>
              </tr>
              <tr>
                <td><form id="form1" name="form1" method="post" action="Inter.php">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="32"><strong>Select Category:</strong></td>
                      <td><select name="cmbCat" id="cmbCat">
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset1['CategoryId']?>"><?php echo $row_Recordset1['CategoryName']?></option>
                        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                      </select></td>
                      <td><label></label></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="32"><strong>State:</strong></td>
                      <td><strong>City:</strong></td>
                      <td><strong>Area:</strong></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="35"><select name="country" class="country">
    <option selected="selected">--Select State--</option>
    <?php
	// Establish Connection with MYSQL
	$con = mysql_connect ("localhost","root");
	// Select Database
	mysql_select_db("pms", $con);
$sql=mysql_query("select * from State_Master order by StateId ASC");
while($row=mysql_fetch_array($sql))
{
echo '<option value="'.$row['StateName'].'">'.$row['StateName'].'</option>';
 } ?>
  </select></td>
                      <td><select name="state" class="state">
    <option selected="selected">--Select City--</option>
  </select></td>
                      <td><select name="city" class="city">
    <option selected="selected">--Select Area--</option>
  </select></td>
                      <td><label>
                        <input type="submit" name="button" id="button" value="Search" />
                      </label></td>
                    </tr>
                    <tr>
                      <td colspan="4" bgcolor="#93A537">&nbsp;</td>
                      </tr>
                    <tr>
                      <td colspan="4">
                         <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>                      </td>
                      </tr>
                  </table>
                                </form>
                </td>
              </tr>
            </table>
          </div>
        </div>
       
      </div>
    </div>
  </div>
  <div>
   <?php
   include "footer.php"
   ?>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
