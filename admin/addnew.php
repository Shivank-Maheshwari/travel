<?php
	require_once('connectvars.php');
	session_start();
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	$fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	$gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password_repeat']));
	$subscribe = mysqli_real_escape_string($dbc, trim($_POST['subscribe']));
    if (!empty($username) && !empty($fname) && !empty($lname) && !empty($email) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
		$query = "SELECT * FROM user_info WHERE username = '$username'";
		$data = mysqli_query($dbc, $query);
		if (mysqli_num_rows($data) == 0) {
			if($gender=='on')
			$gender='male';
			else
			$gender='female';
			$query = "INSERT INTO user_info (username,email,fname,lname,gender, join_date) VALUES ('$username','$email','$fname','$lname','$gender', NOW())";
			mysqli_query($dbc, $query);
			$query = "SELECT * FROM user_info WHERE username = '$username'";
			$data = mysqli_query($dbc, $query);
			$row = mysqli_fetch_array($data);
			$uid=$row['id'];
			//echo $uid;
			if($subscribe=='on')
			$subscribe=1;
			else{
			$subscribe=0;
			}
			$query = "INSERT INTO subscribe (id, subscribe) VALUES ($uid, $subscribe)";
			mysqli_query($dbc, $query);
			$query = "INSERT INTO user_login (id, password,username) VALUES ($uid,SHA('$password1'),'$username' )";
			mysqli_query($dbc, $query);
			header('Location: '.'home.php');
			mysqli_close($dbc);
			exit();
		}
    else{
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
	 }
    else{
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
		}
	}
	mysqli_close($dbc);
	include('includes/include-min.php');
?>
	    <div class="example signup" style="margin-left: 200px;">
            <form id="sign" action="<?php echo $_SERVER['REQUEST_URI'] ?>" METHOD="post">
                <fieldset>
                    <legend>Create Account</legend>
                    <label>Enter E-Mail Id</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" name="email" placeholder="E-Mail Id" data-hint="Enter E-Mail Id" data-hint-position="right">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
					<label>Choose User Name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" name="username" placeholder="Username" data-hint="Username Will be used for Login" data-hint-position="right">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
					<label>First Name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" name="fname" placeholder="chars" data-hint="Your First Name" data-hint-position="right">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
					<label>Last Name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" name="lname" placeholder="chars" data-hint="Your Last Name" data-hint-position="right">
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
                                <input type="radio" name="gender" checked="">
                                <span class="check"></span>
                                Male
                            </label>
                            <label class="inline-block">
                                <input type="radio" name="gender">
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
                    <input type="submit" value="Create" name="submit">
                    <input type="reset" value="Reset">
                    <div style="margin-top: 20px">
                    </div>
                </fieldset>
            </form>
        </div>
		<!--<iframe src="//www.facebook.com/plugins/follow?href=https%3A%2F%2Fwww.facebook.com%2FShivankmaheshwari&amp;layout=standard&amp;show_faces=true&amp;colorscheme=light&amp;width=450&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>-->
<?php
  //require_once('footer.php');
?>