<?php
	require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  // Start the session
  session_start();
  
  $x= $_SESSION['username'];  
		  
	if (isset($_POST['submit'])) {
	$d=$_POST['displayname'];
	//echo 'k';
	$query = "UPDATE user_display set displayname='$d' where username='$x'";
		
        mysqli_query($dbc, $query);
		$ar=array('redirect'=>'index.php');
		echo json_encode($ar);
		die();
		}
	
	
	//include('includes/include-min.php');
	//include('navbar.php');
	//echo 'Please complete your profile.';
	
?>
<div id="wind" class="window" style="width:50%; margin-left:15em;">
    <div class="caption">
        <span class="icon icon-windows"></span> 
        <div class="title">Choose Display Name</div> 
        <button class="btn-min"></button> 
        <button class="btn-max" id="maximize" ></button> 
        <button class="btn-close" onclick="closewin()"></button> 
    </div>
    <div class="content">
        <h2 id="__form__"></h2>
        <div class="example signup" style ="width:inherit">
		
            <form id="sign" action="<?php echo $_SERVER['REQUEST_URI'] ?>" METHOD="post">
                <fieldset>
                    <legend>Choose your Display Name.</legend>
                    
                    <div id="displayname">
					<label>Choose Display Name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" name="displayname" placeholder="Display Name" data-hint="Display Name Will be visible to all people." data-hint-position="right">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
						
                    </div>
					
				    <input type="button" value="Select" name="submit" onclick="complete()">
                    <div style="margin-top: 20px">
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>


	
		<!--<iframe src="//www.facebook.com/plugins/follow?href=https%3A%2F%2Fwww.facebook.com%2FShivankmaheshwari&amp;layout=standard&amp;show_faces=true&amp;colorscheme=light&amp;width=450&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>-->



