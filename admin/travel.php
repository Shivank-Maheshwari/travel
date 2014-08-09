<?php
        include('logincheck.php');		
		require_once('connectvars.php');
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
		$x=$_SESSION['user_id'];
		//include('includes/include-min.php');
		//include('navbar.php');
		echo '<h1>Summary</h1><p>';		
		$query = "SELECT * FROM travel";
        $data = mysqli_query($dbc, $query);
		
?>
<!-- <a href="addnew.php"><button class="primary">Add New</button></a> -->
<div class="example">
    <table class="table">
        <thead>
            <tr>
				<th class="text-left">Tid</th>
                <th class="text-left">User Id</th>
                <th class="text-left">Train No.</th>
                <th class="text-left">Train Name</th>
                <th class="text-left">Detail</th>
            </tr>
        </thead>
        <tbody>
		<?php
		while( $row = mysqli_fetch_array($data) ) {
            echo '<tr>';
			echo '<td>'.$row['tid'].'</td>';
			echo '<td class="right">'.$row['uid'].'</td>';
			echo '<td class="right">'.$row['trainno'].'</td>';
			echo '<td class="right">'.$row['trainname'].'</td>';
			echo '<td class="right"><a href="detail.php?id='.$row['tid'].'">Detail</a></td></tr>';
		}
		?>