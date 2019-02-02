<?php

session_start();
$search_vol_id = $_SESSION['session_volunteer_id'] 
####enters data into database

$Name = $_POST['name'];
$Address = $_POST['address'];
$Voting = $_POST['voting'];
$Registered = $_POST['registered'];
$Affiliation = $_POST['affiliation'];
$Result = $_POST['Result'];
$Support = $_POST['Support'];
$Volunteer = $_POST['Volunteer'];
$Comments = $_POST['Comments'];
$search_id = $_POST['next_id'];
$current_key_id = $_POST['current_key_id'];
$volunteer_id = $_GET['volunteer_id'];

print "Name1: $Name";
####connections
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

if (($Name != "") && ($Name != " "))
{
	print "Name: $Name";
#$sql = "INSERT INTO results_table (name, address,areyouvoting,areyouregisteredtovote,partyaffiliation,results,support,volunteer,comments)
#VALUES ('$Name', '$Address', '$Voting', '$Registered', '$Affiliation', '$Result', '$Support', '$Volunteer', '$Comments')";

$sql = "UPDATE EDay_walk_list_A SET areyouvoting ='$Voting' ,areyouregisteredtovote ='$Registered' ,partyaffiliation ='$Affiliation' ,results ='$Result' ,support = '$Support',volunteer ='$Volunteer',comments = '$Comments', completed = 'Yes' WHERE key_id='$current_key_id'";

print "SQL: $sql";
if ($conn->query($sql) === TRUE) {
   echo "success";
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}

#$conn->close();
}

else { 
print "no data to write";
print "Name: $Name";
}
#####displays name/address

if (($search_id == " ") || ($search_id ==""))
{ 
#print "hello";
# create new logic - get lowest key_id that is not completed
mysql_connect('localhost', 'result', '1Littleme!');
mysql_select_db('result-mysql');
$pre_query = "SELECT key_id FROM EDay_walk_list_A WHERE completed != 'Yes' AND volunteer_id='$search_vol_id' ORDER BY key_id ASC LIMIT 1 ";
print "PRE: $pre_query";
$pre_result = mysql_query($pre_query) or die (mysql_error());
#print "$query";
while ($pre_as_row = mysql_fetch_array ($pre_result))
{
$pre_key_id= $pre_as_row['key_id'];

}
$search_id = "$pre_key_id";
}
else { 
#print "goodbye";
	$search_id = "$search_id";
}	
#print "SEARCH2: $search_id";
mysql_connect('localhost', 'result', '1Littleme!');
mysql_select_db('result-mysql');
$query = "SELECT * FROM EDay_walk_list_A WHERE key_id = '$search_id' AND completed != 'Yes' AND volunteer_id='$search_vol_id' ";
$result = mysql_query($query) or die (mysql_error());
#print "$query";
while ($as_row = mysql_fetch_array ($result))
{
$customer_name = $as_row['name'];
$customer_address = $as_row['address'];
$customer_key_id = $as_row['key_id'];
}
$next_id = ($customer_key_id + 1);
#print "Name: $customer_name <br>";
#print "Address: $customer_address <br>";
#print "Customer ID: $customer_key_id <br>";
#print "Next Customer ID: $next_id<br>";
?>




<html> 
<head> 
	<title>EDay</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 
<body> 

<div data-role="page">
<header data-role="header" data-theme="b">
<h1>Canvassing Survey</h1> 
<a href="/poll-locations.html" >Poll Locations</a>
<a href="/geocod.html">Map</a>
</header>
	<div >
		
	</div><!-- /header -->




	<div data-role="container">
   <form id="survey_form" data-ajax="false" action="Survey_new.php" method="post"/> 
    <p><input type="text" name="name" id="name" value="<?php echo "$customer_name" ?>" placeholder="Name"  /></p>
    <p><input type="text" name="address" id="address" value="<?php echo "$customer_address" ?>" placeholder="Address" /></p>
  <input type="hidden" name="next_id" value="<?php echo"$next_id"; ?>" />
  <input type="hidden" name="current_key_id" value="<?php echo"$customer_key_id"; ?>" />
	  <div data-role="content">
			<div data-role="collapsible"data-iconpos="right" data-theme="b"data-inset="false">
			<h4>Are you voting</h4>
			 <fieldset>                  
        <label class="radio"><input type="radio" name="voting" id="votingYes" value="Yes">Yes</label>
        <label class="radio"><input type="radio" name="voting" id="votinNo" value="No">No</label>                                    
     </fieldset>
	</div>
	</div>
	        <div data-role="content">
			<div data-role="collapsible"data-iconpos="right" data-theme="b"data-inset="false">
			<h4>Are you registered to vote</h4>  
			
	  <fieldset>                  
        <label class="radio"><input type="radio" name="registered" id="registeredYes" value="Yes">Yes</label>
        <label class="radio"><input type="radio" name="registered" id="registeredNo" value="No">No</label>            
     </fieldset>
     </div>
	</div>   
	<div data-role="content">
			<div data-role="collapsible"data-iconpos="right" data-theme="b"data-inset="false">
			<h4>Party affiliation</h4>
			
	  <fieldset>                  
        <label class="radio"><input type="radio" name="affiliation" id="affiliationDemocrat" value="Democrat">Democrat</label>
        <label class="radio"><input type="radio" name="affiliation" id="affiliationRepublican" value="Republican">Republican</label>            
 		  <label class="radio"><input type="radio" name="affiliation" id="affiliationIndependant" value="Independant">Independant</label>
        <label class="radio"><input type="radio" name="affiliation" id="affiliationOther" value="Other">Other</label>            
       </fieldset> 
        </div>
	</div> 
	<div data-role="content">
			<div data-role="collapsible"data-iconpos="right" data-theme="b"data-inset="false">
			<h4>Result</h4>
			
		 <fieldset>                  
        <label class="radio"><input type="radio" name="Result" id="ResultHome" value="Home">Home</label>
        <label class="radio"><input type="radio" name="Result" id="ResultNotHome" value="Not Home">Not Home</label>            
 		  <label class="radio"><input type="radio" name="Result" id="ResultMoved" value="Moved">Moved</label>
        <label class="radio"><input type="radio" name="Result" id="ResultLanguage" value="Language">Language</label>            
 		  <label class="radio"><input type="radio" name="Result" id="ResultRefused" value="Refused">Refused</label>
        <label class="radio"><input type="radio" name="Result" id="ResultInaccessible" value="Inaccessible">Inaccessible</label>            
     
       </fieldset>
        </div>
	</div>
	<div data-role="content">
			<div data-role="collapsible" data-iconpos="right"data-theme="b"data-inset="false">
			<h4>Support</h4>
			
		 <fieldset>                  
        <label class="radio"><input type="radio" name="Support" id="SupportStrongSupporter" value="Strong Supporter">Strong Supporter</label>
        <label class="radio"><input type="radio" name="Support" id="SupportLeanTowards" value="Lean Towards">Lean Towards</label>            
 		  <label class="radio"><input type="radio" name="Support" id="SupportUndecided" value="Undecided">Undecided</label>
        <label class="radio"><input type="radio" name="Support" id="SupportLeanOpponent" value="Lean Opponent">Lean Opponent</label>            
 		  <label class="radio"><input type="radio" name="Support" id="SupportStrongOpponent" value="Strong Opponent">Strong Opponent</label>
       
  		</fieldset>
				
  		</div>
	</div>
	<div data-role="content">
			<div data-role="collapsible"data-iconpos="right" data-theme="b"data-inset="false">
			<h4>Volunteer</h4>
			  
      <fieldset>                  
        <label class="radio"><input type="radio" name="Volunteer" id="VolunteerYes" value="Yes">Yes</label>
        <label class="radio"><input type="radio" name="Volunteer" id="VolunteerNo" value="No">No</label>                                    
      </fieldset> 
      </div>
	</div>
   
    <p><input type="text" name="Comments" id="comments" value="" placeholder="Comments"  /></p>
   <input type="submit" value="Save" data-theme="b"/>
</div>	
	</form>

</article>

<div data-role="footer"  data-theme="b" data-position="fixed">
<div data-role="navbar">
	<ul>
		<li><a href="/Login.html">Sign out</a></li>
		
	</ul>
</div>
</div>

</body>
</html><!DOCTYPE html>