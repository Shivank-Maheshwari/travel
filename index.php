<html>
	<head>
		<meta charset="utf-8">
		<meta name="product" content="Travel Bugs"> 
		<link href="css/metro-bootstrap.css" rel="stylesheet">
		<link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
		<link href="css/docs.css" rel="stylesheet">
		<link href="js/prettify/prettify.css" rel="stylesheet">
		<link href="css/custum.css" rel="stylesheet">
	
		<script src="js/jquery/jquery.min.js"></script>
		<script src="js/jquery/jquery.widget.min.js"></script>
		<script src="js/jquery/metro.min.js"></script>
		<script src="js/metro/metro-notify.js"></script>
		<script src="js/metro/metro-hint.js"></script>
		
		
		<script src="js/custum.js"></script>
		<title>Travel Bugs</title>
	</head>
	<body class="metro" onload="link()">
		<script>
		
/*function plan()
{
	getit("plan.php");
}
function update()
{
	getit("update.php");
}
function profile()
{
	getit("profile.php");
}
function searchtravel()
{
	getit("searchtravel.php");
}
function admin()
{
	getit("admin\/home.php");
}*/
function link()
{	
	$("a").click(function(){ if(this.id!='')
	{ getit(this.id+".php");}
	});
}
function change(i)
{
getit("changeplan.php?id="+i);
//alert("curplan.php?id="+i);
}
function search(i)
{
getit("travel.php?id="+i);

}
/*function signup()
{
	getit("signup.php");
}*/
function getd()
	{
		page="searchtravel.php?trainno="+document.getElementById("trainno").value+"&trainname="+document.getElementById("trainname").value+"&date="+document.getElementById("traindate").value+"&submit=Search";
		//alert(page);
		getit(page);
	}

function getit(page)
{
	$.get(page, function(data,status,xhr){ handlegetit(data,xhr) });
}
	
/*function getit(page)
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
*/
function handlegetit(data,xhr)
{
if (xhr.readyState == 4 && xhr.status == 200)
{
	try{
		var j=jQuery.parseJSON(data);
		if(j.redirect)
		{
			window.location.href=j.redirect;
		}
		else if(j.invalid)
		{

			$("#image").html('');

			$.Notify({
                                    shadow: false,
                                    position: 'top-right',
									background: 'red',
                                    content: j.invalid.one
                    })                   
			setTimeout(function(){
                            $.Notify({style: {background: 'green', color: 'white'}, content: j.invalid.two});}, 2500);
		}		
		return;
	}
	catch(e)
	{
		$("#win").html(data);
		$("#max").click(function() {
			$("#window").css( {"width": "100%", "margin-left": "0em" });});
		$("#min").click(function() {
			$("#win").html('');});
	}

}
}
  
/*if(xhr.responseText=="1")
{
	window.location.href="index.php";
}//document.getElementById("image").innerHTML="";*/
/*if(xhr.responseText=="2")
{
$("#image").html('');

   $.Notify({
                                    shadow: false,
                                    position: 'top-right',
									background: 'red',
                                    content: "Invalid Username Password Combination."
                                })
                            
							
                                
                                
                                setTimeout(function(){
                                    $.Notify({style: {background: 'green', color: 'white'}, content: "Please Try with valid credentials."});
                                }, 2500);
}*/



function log_in()
{
	if(document.getElementById("username").value=="" || document.getElementById("password").value=="")
{
	$.Notify({
                                    shadow: false,
                                    position: 'top-right',
                                    content: "Please fill the values."
                                })
return false;
}
	//document.getElementById("image").innerHTML="<img src=\"images/bspinner.gif\" width=\"20\" height=\"20\">  Please Wait...</img>";
	$("#image").html("<img src=\"images/bspinner.gif\" width=\"20\" height=\"20\">  Please Wait...</img>");
	var requestData = "username=" +	escape(document.getElementById("username").value) + "&password=" + escape(document.getElementById("password").value) + "&submit=submit";
	postXHR('login.php',requestData);
}

function complete()
{
	var requestData = "displayname=" +	escape(document.getElementById("displayname").value) + "&submit=submit";
	postXHR('update.php',requestData);
}

function postXHR(url,requestdata)
{
	$.post(url,requestdata,function(data,status,xhr){ handlegetit(data,xhr) });
}

/*function postXHR(url,requestData)
{
	var xhr=createXHR();
	if(xhr)
	{
	//alert('yes');
	//var requestData = "username=" +	escape(document.getElementById("username").value) + "&password=" + escape(document.getElementById("password").value) + "&submit=submit";
	//alert(requestData);
	xhr.onreadystatechange = function(){handlegetit(xhr);};
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xhr.send(requestData);
	//alert(document.getElementById("username").value);
}
}*/
function closewin()
{
	$("#win").html('');
}


		</script>
<?php
	require_once('connectvars.php');

	// Start the session
	session_start();

	// Clear the error message
	//$error_msg = "";

	// If the user isn't logged in, try to log them in
	if (isset($_SESSION['username'])) {
		include('navbar.php');
	}
	else{
		include('navbar2.php');
	}
	?>
	<div id="win">
	</div>
	<!-- BEGIN TAG - DO NOT MODIFY -->
