<?php
if (empty($_POST['username']) || empty($_POST['password'])) {
header("Location:login.html");
}
require ('config.php');
include ('debug.php');

//debugDisplay();

//connect to MySQL
$db = new mysqli (SQL_HOST, SQL_USER, SQL_PASS, SQL_DB)
  	or die("error"); 

// query to validate username/password validity
$query = "SELECT * " .
         "FROM proj1_user " .
         "WHERE name = '" . $_POST['username'] . "' " .
		 "AND password = '" . $_POST['password'] . "'";
		 
$results = $db->query($query)
  	or die($db->error);

// get row from results (if no row, username/password is invalid)	
$row = $results->fetch_array();

// free results/close DB
$results->free();
$db->close();

// verify validity of username/password
if ($row)
{
?>
	
<?php
}
else // bad username/password
{
	echo "Invalid username/password!";
?>
	<br/><br/><a href="login.html">Return to login screen</a>
<?php
}
?>