<?php
  // Define database connection constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'NO');
  define('DB_NAME', 'exc');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(isset($_GET['class']))
	$class=$_GET['class'];
else
		$class='12';
$query = "SELECT * FROM `".$class."` where 1";
$data= mysqli_query($dbc, $query);
?>
<html>
<head>
	<script>
		function change()
		{
			var index=document.getElementById("sel").selectedIndex;
			var a=["13","12","11","10","9","8","7b","7a","6b","6a","5b","5a","4b","4a","3b","3a","2b","2a"];
			//alert("wait");
			window.location.href="i.php?class="+a[index];
			
		}
		function ini()
		{
			alert(window.location.href);
			
			document.getElementById("sel").selectedIndex=3;
		}
	</script>
</head>

<body>
<select id="sel" name="sel" onchange="change()">
	<option>Select Class</option>
	<option id="12">12</option>
	<option id="11">11</option>
	<option id="10">10</option>
	<option id="9">9</option>
	<option id="8">8</option>
	<option id="7b">7B</option>
	<option id="7a">7A</option>
	<option id="6b">6B</option>
	<option id="6a">6A</option>
	<option id="5b">5B</option>
	<option id="5a">5A</option>
	<option id="4b">4B</option>
	<option id="4a">4A</option>
	<option id="3b">3B</option>
	<option id="3a">3A</option>
	<option id="2b">2B</option>
	<option id="2a">2A</option>
</select>
<form id="frm" name="frm">

	<table border="1" cellspacing="0">
	<tr>
		<th>S.N.</th>
		<th>Student Name</th>
		<th>Admission No.</th>
		<th>Parent Name</th>
		<th>Address</th>
		<th>Phone No.</th>
		<th>Change</th>
	</tr>
	<?php
	while( $row = mysqli_fetch_array($data) ) {
			echo '<tr>';			
			echo '<td>'.$row['S.N.'].'</td>';
			echo '<td>'.$row['STUDENTS_NAME'].'</td>';
			echo '<td>'.$row['ADM.NO.'].'</td>';
			echo '<td>'.$row['_PARENTS_NAME'].'</td>';
			echo '<td>'.$row['ADDRESS'].'</td>';
			echo '<td>'.$row['Phone_No'].'</td>';
			//$tid=$row['tid'];
			echo '<td><a href="javascript:change('.$tid.')">Change</a></td>';
			echo '</tr>';
			
		}
	?>
	</table>
</body>
</html>