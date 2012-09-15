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

// free results
$results->free();

// verify validity of username/password
if ($row)
{
?>
<html>
</html>
<?php

// query threads
$query = "SELECT * " .
		 "FROM proj1_thread " .
		 "ORDER BY creation_date";
		 
$results = $db->query($query)
	or die($db->error);

while ($row = $results->fetch_array())
{
	extract($row);
	echo "<a href='thread.php?id=1'>" . $title . "</a>";
	echo "<br/>";
	
	// query number of posts, date of latest post for this thread
	$query = "SELECT COUNT(id) AS count, MAX(creation_date) AS latest " .
			 "FROM proj1_post " .
			 "WHERE thread_id = '" . $id . "'";
			 
	$results2 = $db->query($query)
		or die($db->error);
		
	$num_posts = 0;
	$latest_post = 0;
	if ($row2 = $results2->fetch_array())
	{
		extract($row2);
		$num_posts = $count;
		$latest_post_date = $latest;
	}
	
	echo $num_posts;
	echo "<br/>";
	echo $latest;
	echo "<br/>";
	
	// free results2
	$results2->free();
}

// free results/close db
$results->free();
$db->close();
?>
<?php
}
else // bad username/password
{
	// close DB	
	$db->close();

	echo "Invalid username/password!";
?>
	<br/><br/><a href="login.html">Return to login screen</a>
<?php
}
?>