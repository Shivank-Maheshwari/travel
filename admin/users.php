
<?php
        include('logincheck.php');		
		require_once('connectvars.php');
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
		$x=$_SESSION['user_id'];
		if (isset($_GET['r'])) {
			$y=$_GET['r'];
			$query="delete from user_info where id=$y";		
			mysqli_query($dbc, $query);
			$query="delete from user_login where id=$y";
			mysqli_query($dbc, $query);
			$query="delete from user_display where id=$y";
			mysqli_query($dbc, $query);
		}
		//include('includes/include-min.php');
		//include('navbar.php');
		echo '<h1>Users</h1><p>';		
		$query = "SELECT * FROM user_info";
        $data = mysqli_query($dbc, $query);
		
?>
<a href="addnew.php"><button class="primary">Add New</button></a>
<div class="example">
    <table class="table">
        <thead>
            <tr>
                <th class="text-left">Username</th>
                <th class="text-left">E-Mail</th>
                <th class="text-left">First Name</th>
                <th class="text-left">Last Name</th>
                <th class="text-left">Remove</th>
            </tr>
        </thead>
        <tbody>
		<?php
		while( $row = mysqli_fetch_array($data) ) {
            echo '<tr>';
			echo '<td>'.$row['username'].'</td>';
			echo '<td class="right">'.$row['email'].'</td>';
			echo '<td class="right">'.$row['fname'].'</td>';
			echo '<td class="right">'.$row['lname'].'</td>';
			echo '<td class="right"><a href="?r='.$row['id'].'">Remove</a></td></tr>';
		}
		?>