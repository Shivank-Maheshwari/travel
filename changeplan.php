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
		 $tid=$_GET['id'];
		$query = "SELECT * FROM travel inner join sharetravel on travel.tid=sharetravel.tid WHERE travel.uid = $x and travel.tid=$tid";
		$data= mysqli_query($dbc, $query);
		if (mysqli_num_rows($data) == 0) {
		  echo 'Something went wrong.';
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
			$query = "UPDATE travel set uid=$x,trainno=$num,trainname='$name',seat=$seat,`date`='$date' where tid=$tid";
		
			mysqli_query($dbc, $query);
			
			
			$query = "UPDATE sharetravel set sharewith=$share where tid=$tid";
		
			mysqli_query($dbc, $query);
			
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $home_url);
		}
		//$query = "select * from travel where uid=$x and tid=$tid";
		$row = mysqli_fetch_array($data);
		
		?>
		
<div class="example signup">
<form id="sign" action="<?php echo $_SERVER['REQUEST_URI'] ?>" METHOD="post">
                <fieldset>
                    <legend>Plan your journey.</legend>
						<label>Enter Train No.</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="trainno" value="<?php echo $row['trainno'] ?>"  placeholder="eg. 00000" data-hint="Train Number" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<label>Enter Train Name</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="trainname" value="<?php echo $row['trainname'] ?>" placeholder="eg. abc" data-hint="Name of the Train" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<label>Enter Seat No.</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="seat" value="<?php echo $row['seat'] ?>" placeholder="" data-hint="Your Seat No." data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<label>Enter Journey Date</label>
						<div class="input-control text" data-role="input-control">
							<input type="text" name="date" value="<?php echo $row['date'] ?>" placeholder="YYYY/MM/DD" data-hint="Date of travelling" data-hint-position="right">
							<button class="btn-clear" tabindex="-1" type="button"></button>
						
						</div>
						<div class="input-control switch" data-role="input-control" data-hint="Turn Off to make it private." data-hint-position="right">
                            <label class="inline-block" style="margin-right: 20px">
                                Publically Share
                                <input type="checkbox" name="share" <?php $s=$row['sharewith']; if($s==1){?> checked=""<?php } ?> >
                                <span class="check"></span>
                            </label>
                            
                        </div>
						<input type="submit" value="Submit" name="submit">
						<input type="reset" value="Reset">
				</fieldset>
			</form>
		</div>