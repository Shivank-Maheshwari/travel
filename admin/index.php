<?php
        include('logincheck.php');		
		require_once('connectvars.php');
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
		$x=$_SESSION['user_id'];
		if (isset($_GET['r'])) {
			$y=$_GET['r'];
			$query="delete from user_info where id=$y";		
			mysqli_query($dbc, $query);
			$query="delete from user_login where id=$y";
			mysqli_query($dbc, $query);
			$query="delete from user_display where id=$y";
			mysqli_query($dbc, $query);
		}
		include('includes/include-min.php');
		?>
		<script>
function link()
{	
	$("a").click(function(){ if(this.id!='')
	{ getit(this.id+".php");}
	});
}
function summ()
{
	getit("travel.php");
}
function update()
{
	getit("..\/update.php");
}
function profile()
{
	getit("..\/profile.php");
}
function users()
{
	getit("Users.php");
}
function getit(page)
{

var xhr = createXHR();
if (xhr)
{
xhr.open("GET", page, true);
document.getElementById("win").innerHTML="<img src=\"images/bspinner.gif\" width=\"20\" height=\"20\">  Please Wait...</img>";
xhr.onreadystatechange = function(){handlegetit(xhr);};
xhr.send(null);
}
}
function handlegetit(xhr)
{
if (xhr.readyState == 4 && xhr.status == 200)
{
//document.getElementById("image").innerHTML="";
document.getElementById("win").innerHTML=xhr.responseText;
//window.location.href="home.php";

}
}
</script>
<?php
		include('navbar.php');
		//echo '<h1>Users</h1><p>';		
		$query = "SELECT * FROM user_info";
        $data = mysqli_query($dbc, $query);
		
?>

<div id="win">
</div>
