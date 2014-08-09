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
		if (isset($_POST['submit'])) {
			$num=$_POST['trainno'];
			$name=$_POST['trainname'];
			$seat=$_POST['seat'];
			$share=$_POST['share'];
			$date=$_POST['date'];
			if($share=='on')
			{
				$share=1;
			}
			else{
			$share=2;
			}
			$date=date('Y/m/d',strtotime($date));
			//echo $date;
			$query = "INSERT INTO travel (uid,trainno,trainname,seat,`date`) VALUES ($x,$num,'$name',$seat,'$date')";
		
			mysqli_query($dbc, $query);
			$query = "SELECT * FROM travel WHERE uid = $x and trainno=$num and trainname='$name' and seat=$seat";
			$data = mysqli_query($dbc, $query);
			$row = mysqli_fetch_array($data);
			$tid=$row['tid'];
			
			$query = "INSERT INTO sharetravel (tid,sharewith) VALUES ($tid,$share)";
		
			mysqli_query($dbc, $query);
			
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';
          header('Location: ' . $home_url);
		}		
		?>

<!--<h2 id="__form__"><a class="element brand" href="home.php"><span class="icon-home"></span></a></h2>-->
<div class="example signup">
<form id="sign" action="<?php echo $_SERVER['REQUEST_URI'] ?>" METHOD="post">
                <fieldset>
                    <legend>Plan your journey.</legend>
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
						<label>Enter Seat No.</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="seat" placeholder="" data-hint="Your Seat No." data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<label>Enter Journey Date</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="date" placeholder="YYYY/MM/DD" data-hint="Date of travelling" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<div class="input-control switch" data-role="input-control" data-hint="Turn Off to make it private." data-hint-position="right">
                            <label class="inline-block" style="margin-right: 20px">
                                Publically Share
                                <input type="checkbox" name="share" checked="" >
                                <span class="check"></span>
                            </label>
                            
                        </div>
						<input type="submit" value="Submit" name="submit">
						<input type="reset" value="Reset">
				</fieldset>
			</form>
		</div>