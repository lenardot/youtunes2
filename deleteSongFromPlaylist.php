<?php
  session_start();

  $uID = $_SESSION['uid'];
  // User must have a valid session to proceed
	if(!isset($_SESSION['uid'])){
		echo "Not ogged in!";
		exit();
	}

  $db = mysql_connect("localhost","root", "root");

	//check to see if the database was connected to successfully
    if (!$db){
    	echo "Could not connect to database" . mysql_error();
    	exit();
    }//end if

	//try to connect to the specific database, kill the thread if not
	$db_name = "youtunes";
  if (!mysql_select_db($db_name, $db)){
    die ("Could not select database") . mysql_error();
  }

  if (!isset($_GET['sID']) ||
      !isset($_GET['pID'])) {
		echo "Invalid call to this function";
		exit();
	}

  $sID = $_GET['sID'];
  $pID = $_GET['pID'];

  $query =
    "DELETE
      FROM `youtunes`.`PlaylistHasSong`
    WHERE
      `PlaylistHasSong`.`pID` = " .mysql_real_escape_string($pID). " AND
      `PlaylistHasSong`.`sID` = " .mysql_real_escape_string($sID). "
    LIMIT 1";

  mysql_query($query);
?>

