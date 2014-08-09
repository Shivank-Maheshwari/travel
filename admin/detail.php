<?php
        include('logincheck.php');		
		require_once('connectvars.php');
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
		$x=$_SESSION['user_id'];
		//$r=$_GET['r'];
		if (isset($_GET['r'])) {
			$r=$_GET['r'];
			$query="delete from travel where tid=$r";		
			mysqli_query($dbc, $query);
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/travel.php';
			header('Location: ' . $home_url);
		}
		include('includes/include-min.php');
		include('navbar.php');
		echo '<h1>Detail</h1><p>';		
		$tid=$_GET['id'];
		$query = "SELECT * FROM travel inner JOIN sharetravel on sharetravel.tid=travel.tid inner JOIN user_display on user_display.id=travel.uid WHERE travel.tid =$tid";
		//$query = "SELECT * FROM travel where tid=$tid";
        $data = mysqli_query($dbc, $query);
		//echo $query;
		
?>
<!-- <a href="addnew.php"><button class="primary">Add New</button></a> -->
<div class="example">
    <table class="table">
        <thead>
            <tr>
				<th class="text-left">Tid</th>
                <th class="text-left">User Id</th>
				<th class="text-left">Display Name</th>
                <th class="text-left">Train No.</th>
                <th class="text-left">Train Name</th>
                <th class="text-left">Date</th>
				<th class="text-left">Seat</th>
				<th class="text-left">Public/Private</th>
				<th class="text-left">Remove</th>
            </tr>
        </thead>
        <tbody>
		<?php
		while( $row = mysqli_fetch_array($data) ) {
            echo '<tr>';
			echo '<td>'.$row['tid'].'</td>';
			echo '<td class="right">'.$row['uid'].'</td>';
			echo '<td class="right">'.$row['displayname'].'</td>';
			echo '<td class="right">'.$row['trainno'].'</td>';
			echo '<td class="right">'.$row['trainname'].'</td>';
			echo '<td class="right">'.$row['date'].'</td>';
			echo '<td class="right">'.$row['seat'].'</td>';
			if($row['sharewith']==1)
				$msg='Public';
			else
				$msg='Private';
			echo '<td class="right">'.$msg.'</td>';
			echo '<td class="right"><a href="?r='.$row['tid'].'">Remove</a></td></tr>';
		}
		?>