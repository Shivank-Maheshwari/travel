<?php
        //include('logincheck.php');
		session_start();
		require_once('connectvars.php');
		require_once('vars.php');		
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
		$x=$_SESSION['username'];
		$x1=$_SESSION['user_id'];
		$query = "SELECT * FROM user_display WHERE id = $x1";
		 //echo $query; 
		  $row= mysqli_query($dbc, $query);
		  
		  if (mysqli_num_rows($row) == 0) {
			$ar=array('redirect'=>'complete.php');
			echo json_encode($ar);
		  //$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/complete.php';
          //header('Location: ' . $home_url);
		  exit();
		  }
		
			$query = "select * from travel where uid=$x1";
			//echo $query;
			
			$data = mysqli_query($dbc, $query);
			//echo mysqli_num_rows($data);
			//$row = mysqli_fetch_array($data);
			
		
		
			?>
			<div class="example">
			<table class="table">
			<thead>
				<tr>
					<th class="text-left">Train No.</th>
					<th class="text-left">Train Name</th>
					<th class="text-left">Date</th>
					<th class="text-left">Seat</th>
					<th class="text-left">Change</th>
				</tr>
			</thead>
        <tbody>
			<?php
			while( $row = mysqli_fetch_array($data) ) {
			echo '<tr>';
			
			echo '<td>'.$row['trainno'].'</td>';
			echo '<td>'.$row['trainname'].'</td>';
			echo '<td>'.$row['date'].'</td>';
			echo '<td>'.$row['seat'].'</td>';
			$tid=$row['tid'];
			echo '<td><a href="javascript:change('.$tid.')">Change</a></td>';
			echo '</tr>';
			
		}
			
		?>
		</tbody>
		<script>
			$(document).ready(function() {
				$("#hideshow").click( function() {
				$(".example").toggle("slow");
				});
			$(".example").hover(
function () {
// this is the mouseenter event handler
$(this).addClass("myhover");
$(".example").animate({width:"80%",borderWidth:"5px"});
},
function () {
// this is the mouseleave event handler
$(this).removeClass("myhover");
$(".example").animate({width:"65%",borderWidth:"1px"});

});
			
		});
		
		</script>
