<?php
        include('logincheck.php');
		require_once('connectvars.php');
		require_once('vars.php');		
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
		$x=$_SESSION['user_id'];
		$query = "SELECT * FROM user_display WHERE id = $x";
		  
		  $row= mysqli_query($dbc, $query);
		  
		  if (mysqli_num_rows($row) == 0) {
		  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/complete.php';
          header('Location: ' . $home_url);
		  exit();
		  }
		  
		
		//include('includes/include-min.php');
		//include('navbar.php');
		//echo '<div class="times rtime" data-role="times"></div>';
		if (isset($_GET['submit'])) {
		$query="SELECT * FROM travel inner join user_display on travel.uid=user_display.id WHERE ";
		//$query=$query."trainname=ui";
		$flag=0;
		if($_GET['trainname']!='')
		{
			$flag=1;				
			$trainname=$_GET['trainname'];
			$query=$query."trainname='$trainname'";		
		}
		if($_GET['trainno']!='')
		{
			if($flag==1)
				$query=$query." and ";
			$flag=1;
			$trainno=$_GET['trainno'];
			$query=$query."trainno=$trainno";		
		}
		if($_GET['date']!='')
		{
			if($flag==1)
				$query=$query." and ";
			$date=$_GET['date'];
			$query=$query."date='$date'";		
		}
		//$query=$query;
		$data = mysqli_query($dbc, $query);
		?>
		<div class="example">
			<table class="table">
			<thead>
				<tr>
					<th class="text-left">User Name</th>
					<th class="text-left">Train No.</th>
					<th class="text-left">Train Name</th>
					<th class="text-left">Date</th>
					<th class="text-left">Show Details</th>
				</tr>
			</thead>
        <tbody>
		<?php
		while( $row = mysqli_fetch_array($data) ) {
			echo '<tr>';
			echo '<td>'.$row['displayname'].'</td>';
			echo '<td>'.$row['trainno'].'</td>';
			echo '<td>'.$row['trainname'].'</td>';
			echo '<td>'.$row['date'].'</td>';
			//echo '<td></td>';
			$tid=$row['tid'];
			echo '<td><a href="javascript:search('.$tid.')">Detail</a></td>';
			echo '</tr>';
			
		}
		echo '</table>';
		//include('chat/chat.php');
		exit();
		 }
		?>
		
	<!--<h2 id="__form__"><a class="element brand" href="home.php"><span class="icon-home"></span></a></h2>-->


<div class="example signup">
<form id="sign" >
                <fieldset>
                    <legend>Search Co-Travelers.</legend>
						<label>Enter Train No.</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="trainno" id="trainno" placeholder="eg. 00000" data-hint="Train Number" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<label>Enter Train Name</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="trainname" id="trainname" placeholder="eg. abc" data-hint="Name of the Train" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						
						<label>Enter Journey Date</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="date" id="traindate" placeholder="YYYY-MM-DD" data-hint="Date of travelling" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						
						<input type="button" value="Search" onclick="getd()" name="submit">
						<input type="reset" value="Reset">
				</fieldset>
			</form>
		</div>	
		
		
		
		