<?php
$Vol_id = $_POST['v_id'];
$link = mysql_connect("localhost", "result", "1Littleme!");
mysql_select_db("result-mysql", $link);

$result = mysql_query("SELECT * FROM EDay_walk_list_A WHERE completed = 'YES'", $link);
$num_rows = mysql_num_rows($result);

$result2 = mysql_query("SELECT * FROM EDay_walk_list_A ", $link);
$num_rows2 = mysql_num_rows($result2);

$res = mysql_query("SELECT * FROM EDay_walk_list_A WHERE volunteer_id = $Vol_id ", $link);
$rows = mysql_num_rows($res);

$res2 = mysql_query("SELECT * FROM EDay_walk_list_A WHERE volunteer_id = $Vol_id AND completed = 'YES' ", $link);
$rows2 = mysql_num_rows($res2);
?>

<html> 
  <head> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
   
  </head> 
<div data-role="page">
<header data-role="header" data-theme="b">
<h1>Group Statistics</h1>
<a href="/Login.html">Sign out</a>
</header>
  <body> 
  <div>
  <br>

	<center><img src="https://s3-us-west-2.amazonaws.com/pollardmauricetest/edayButtonLogo.png" height="100" width="100" /><center>
     <br>
      
   <form id="count_form" data-ajax="false" action="count.php" method="post"/> 
     <table width="0%" border="0" cellspacing="10" cellpadding="0" >

<tr>
<td>
<center><strong>Group ID:</strong></center>
</td>
<td>
<center><strong>Group stats:</strong></center>
</td>
</tr>

<tr>
<td>
<form>
 <br> <input type="text"  name="v_id" id="v_id"  value=""> 
</td>
<td>
  <br>  <input type="text"   name="walklistcompleted" id="walklistcompleted"  value="<?php echo"$rows2"; ?>/<?php echo"$rows"; ?>">

</td>
</tr>
<tr>
<td>
<input type="submit" value="Enter"/ data-theme="b">
</td>

</tr>
</table>
</form>
      
     <br>
      <center><strong>Completion of all walk list:</strong></center><br>
      <input type="text" name="completionofallwalklists" id="completionofallwalklists" value="<?php echo"$num_rows"; ?> / <?php echo"$num_rows2"; ?>">
  </div>
 
  <div data-role="footer"  data-theme="b" data-position="fixed"> 
	<h6>Strategize To Win</h6> 
</div> 
  </body> 
</html>