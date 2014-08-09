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
			header('Location: '.'login.php');
			mysqli_close($dbc);
			exit();
		}
    else{
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
		}
	}
	mysqli_close($dbc);
	include('includes/include-min.php');
	include('Signup.html');
?>
<?php
 // require_once('footer.php');
?>