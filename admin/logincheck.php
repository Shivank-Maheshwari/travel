<?php
	require_once('connectvars.php');
	session_start();
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!isset($_SESSION['username'])) {
	//echo 'ho';
		header('Location: ' . '../index.php');
        exit();  
    }
	else{
	$x=(int)$_SESSION['user_id'];
	$query="select * from user_info where id=$x";
	$data = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($data);
	if($row['group']==1){ 
	//echo "ll";
		header('Location: ' . '../index.php');
	}
  }
?>
