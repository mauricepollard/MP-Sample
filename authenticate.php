<?php
session_start();

$User = $_POST['username'];
$Pass = $_POST['password'];

$servername = "localhost";
$username = "result";
$password = "1Littleme!";
$dbname = "result-mysql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

else { 




mysql_connect('localhost', 'result', '1Littleme!');
mysql_select_db('result-mysql');
$query = "SELECT * FROM user_table WHERE username ='$User' AND password = '$Pass'";
$result = mysql_query($query) or die (mysql_error());
while ($auth_as_row = mysql_fetch_array ($result))
{
$volunteer_id= $auth_as_row['key_id'];
$priviledges_status= $auth_as_row['priviledges'];
}
$num_rows = mysql_num_rows($result);
#print "$query";
if ($priviledges_status == 'admin')
	{	
		header ('Location:count.php?priviledges='.$priviledges_status);
	}
else 
	{ 
		if ($num_rows == 1)
			{
				$_SESSION["session_volunteer_id"] =$volunteer_id;
				header ('Location:Survey_new.php?volunteer_id='.$volunteer_id);
			}
		else 
			{ 
				header ('Location:Login.html');
			}	
	
	}


#print "Num rows: $num_rows";


}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
	<style type="text/css">

</style>
</head>
<body > 

</body>


</html>