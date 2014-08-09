<?php
	//include('logincheck.php');
	session_start();
	require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
	$x=$_SESSION['username'];
	//echo $x;
	$query1="select * from user_info where username='$x'";
	$user_info=mysqli_query($dbc, $query1);
	$row = mysqli_fetch_array($user_info);
	
	if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	$gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password_repeat']));	
	$subscribe = mysqli_real_escape_string($dbc, trim($_POST['subscribe']));
    if (!empty($fname) && !empty($lname) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
	if($gender=='on')
	$gender='male';
	else{
	$gender='female';
	}
	if($subscribe=='on')
			$subscribe=1;
			else{
			$subscribe=0;
			}
    $query = "update user_info set fname='$fname',lname='$lname',gender='$gender' where id=$x";
	mysqli_query($dbc, $query);
	$query = "update user_login set password=SHA('$password1') where id=$x";
	mysqli_query($dbc, $query);
	$query = "update user_login set subscribe='$subscribe' where id=$x";
	mysqli_query($dbc, $query);
	mysqli_close($dbc);
	header('Location: '.'success.php');
    }
    else if(!empty($fname) && !empty($lname)){
		$query = "update suser set fname='$fname',lname='$lname',gender='$gender',subscribe='$subscribe' where id=$x";
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($dbc, $query);
		mysqli_close($dbc);
		header('Location: '.'success.php');
	}    
    else {
		echo '<p class="error">You must enter all of the data, including the desired password twice.</p>';
    }
  }
	$email=$row['email'];
	$username=$row['username'];
	$fname = $row['fname'];
	$lname = $row['lname'];
	$gender = $row['gender'];
	$subscribe = $row['subscribe'];	
	mysqli_close($dbc);
	//include('includes/include-min.php');
	//include('navbar.php');
?>
	<!--<h2 id="__form__"><a class="element brand" href="home.php"><span class="icon-home"></span></a></h2>-->
        <div id="window" class="window" style="width:60%; margin-left:13em;">
    <div class="caption">
        <span class="icon icon-windows"></span> 
        <div class="title">Profile</div> 
        <button id="min" class="btn-min"></button> 
        <button id="max" class="btn-max"></button> 
        <button class="btn-close" onclick="closewin()"></button> 
    </div>
    <div class="content">
		
		<div class="example signup" style="width: inherit;">
			
            <form id="sign" action="<?php echo $_SERVER['REQUEST_URI'] ?>" METHOD="post">
                <fieldset>
                    <legend>Update Info</legend>
                    <label>Enter E-Mail Id</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" placeholder="E-Mail Id" disabled data-hint="Enter E-Mail Id" data-hint-position="right" value="<?php echo $email;?>">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
					<label>Choose User Name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" placeholder="Username" disabled data-hint="Username Will be used for Login" data-hint-position="right" value="<?php echo $username;?>">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
					<label>First Name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" name="fname" placeholder="chars" data-hint="Your First Name" data-hint-position="right" value="<?php echo $fname;?>">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
					<label>Last Name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" name="lname" placeholder="chars" data-hint="Your Last Name" data-hint-position="right" value="<?php echo $lname;?>">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
                    <label>Password</label>
                    <div class="input-control password" data-role="input-control">
                        <input type="password" name="password" placeholder="Your Password" autofocus="" data-hint="Enter Strong Password" data-hint-position="right">
                        <button class="btn-reveal" tabindex="-1" type="button"></button>
                    </div>
					<label>Enter Password Again</label>
					<div class="input-control password" data-role="input-control">
                        <input type="password" name="password_repeat" placeholder="Retype Password" autofocus="" data-hint="Enter Password Again" data-hint-position="right">
                        <button class="btn-reveal" tabindex="-1" type="button"></button>
                    </div>     
                    <div>
                        <div class="clearfix">
                        <div class="input-control radio inline-block" data-role="input-control" data-hint="Choose Gender" data-hint-position="right">
                            <label class="inline-block">
                                <input type="radio" name="gender" <?php if($gender=="on")echo 'checked=""';?>>
                                <span class="check"></span>
                                Male
                            </label>
                            <label class="inline-block">
                                <input type="radio" name="gender" <?php if($gender!="on")echo 'checked=""';?>>
                                <span class="check"></span>
                                Female
                            </label>
                        </div>
                        
                        </div>
                        <div class="input-control switch" data-role="input-control" data-hint="Default On" data-hint-position="left">
                            <label class="inline-block" style="margin-right: 20px">
                                Subscribe to our News Letter 
                                <input type="checkbox" name="subscribe" checked="" >
                                <span class="check"></span>
                            </label>                            
                        </div>
                    </div>
                    <input type="submit" value="Update" name="submit">
                    <input type="reset" value="Reset">            
                    <div style="margin-top: 20px">
                    </div>
                </fieldset>
            </form>
        </div>
		</div>
		
<?php
  require_once('footer.php');
?>