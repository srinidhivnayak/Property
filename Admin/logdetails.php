<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Real Estate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {
	color: #1CBCFA;
	font-weight: bold;
}
.style2 {
	color: #FD821B;
	font-weight: bold;
}
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
      <div class="contentainer">
      <?php>
        CALL "get_log"();
      <?>
      </div>


      <div class="rightpannel">
        <div class="welcome">
          <div style="width:200px; height:30px; padding-bottom:5px"><img src="images/welcome.jpg" width="202" height="24" />
          </div>
        </div>
      </div>
      <?php
   include "footer.php"
   ?>
  
  </div>
  <div>
</body>
</html>
