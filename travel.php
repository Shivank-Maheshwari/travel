<?php
        //include('logincheck.php');
		session_start();
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
		
		$tid=$_GET['id'];
		$query = "SELECT * FROM travel inner JOIN sharetravel on sharetravel.tid=travel.tid inner JOIN user_display on user_display.id=travel.uid WHERE travel.tid =$tid and sharetravel.sharewith=1";
		
	
		
		//echo $query;
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
					<th class="text-left">Seat</th>
					<th class="text-left">Chat</th>
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
			echo '<td>'.$row['seat'].'</td>';
			$uid=$row['uid'];
			echo '<td><a href="pm/new_pm.php?id='.$uid.'">Chat</a></td>';
			echo '</tr>';
			
		}
		exit();
		 
		?>
		<script>
			$(document).ready(function() {
				$("#hideshow").click( function() {
				$(".example").toggle("slow");
				});
			$(".example").hover(
function () {
// this is the mouseenter event handler
$(this).addClass("myhover");
$(".example").animate({right:"50px", width:"80%",borderWidth:"10px"});
},
function () {
// this is the mouseleave event handler
$(this).removeClass("myhover");
$(".example").animate({right:"0px", width:"65%",borderWidth:"1px"});

});
			
		});
		
		</script>
	<h2 id="__form__"><a class="element brand" href="home.php"><span class="icon-home"></span></a></h2>
<div class="example signup">
<form id="sign" action="<?php echo $_SERVER['REQUEST_URI'] ?>" METHOD="post">
                <fieldset>
                    <legend>Search Co-Travelers.</legend>
						<label>Enter Train No.</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="trainno" placeholder="eg. 00000" data-hint="Train Number" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<label>Enter Train Name</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="trainname" placeholder="eg. abc" data-hint="Name of the Train" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						
						<label>Enter Journey Date</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="date" placeholder="DD/MM/YYYY" data-hint="Date of travelling" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						
						<input type="submit" value="Search" name="submit">
						<input type="reset" value="Reset">
				</fieldset>
			</form>
		</div>	
		