function closeit()
{
	window.open('','_self').close();
}
function createXHR()
{
try { return new XMLHttpRequest(); } catch(e) {}
try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); } catch (e) {}
try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); } catch (e) {}
try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {}
return null;
}
function sendRequest()
{
if(document.getElementById("user_id").value=="" || document.getElementById("pass").value=="")
{
	$.Notify({
                                    shadow: false,
                                    position: 'top-right',
                                    content: "Please fill the values."
                                })
return false;
}
var xhr = createXHR();
if (xhr)
{
xhr.open("GET", "login2.php?user_id="+document.getElementById("user_id").value+"&password="+document.getElementById("pass").value, true);
document.getElementById("image").innerHTML="<img src=\"images/bspinner.gif\" width=\"20\" height=\"20\">  Please Wait...</img>";
xhr.onreadystatechange = function(){handleResponse(xhr);};
xhr.send(null);
}
}
function handleResponse(xhr)
{
if (xhr.readyState == 4 && xhr.status == 200)
{
document.getElementById("image").innerHTML="";
if(xhr.responseText=="1")
window.location.href="home.php";
else{

                            
                                $.Notify({
                                    shadow: false,
                                    position: 'top-right',
									background: 'red',
                                    content: "Invalid Username Password Combination."
                                })
                            
							
                                
                                
                                setTimeout(function(){
                                    $.Notify({style: {background: 'green', color: 'white'}, content: "Please Try with valid credentials."});
                                }, 2500);
                                
                            
							
							
							}
}
}



function check()
{
sendRequest();
return false;
}
function checkEmail() {
	document.getElementById("error_email").innerHTML="";
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
    document.getElementById("error_email").innerHTML="Please Enter a valid E-Mail Address";
    document.frm.submit.disabled=true;
    return false;
 }
 else{
	var xhr = createXHR();
if (xhr)
{
xhr.open("GET", "checkuser.php?email="+document.frm.email.value, true);
document.getElementById("image1").innerHTML="<img src=\"images/bspinner.gif\" width=\"20\" height=\"20\">  Validating...</img>";
xhr.onreadystatechange = function(){handlecheckEmail(xhr);};
xhr.send(null);
}
}
}

function handlecheckEmail(xhr)
{
if (xhr.readyState == 4 && xhr.status == 200)
{
document.getElementById("error_email").innerHTML="";
document.getElementById("image1").innerHTML="";
if(xhr.responseText=="1")
{
document.getElementById("error_email").innerHTML="Email-id is already registered";
document.frm.submit.disabled=true;
}
else{
document.getElementById("error_email").innerHTML="";
document.frm.submit.disabled=false;
}
}
}
 
function checkAvail()
{
if(document.frm.username.value=="")
{
document.getElementById("responseOutput").innerHTML="";
return false;
}
var xhr = createXHR();
if (xhr)
{
document.getElementById("responseOutput").innerHTML="";
xhr.open("GET", "checkuser.php?user="+document.frm.username.value, true);
document.getElementById("image").innerHTML="<img src=\"images/bspinner.gif\" width=\"20\" height=\"20\">  Checking...</img>";
xhr.onreadystatechange = function(){handlecheckAvail(xhr);};
xhr.send(null);
}
}


function handlecheckAvail(xhr)
{
if (xhr.readyState == 4 && xhr.status == 200)
{
document.getElementById("responseOutput").innerHTML="";
document.getElementById("image").innerHTML="";
if(xhr.responseText=="1")
{
document.getElementById("responseOutput").innerHTML="User already exist";
document.frm.submit.disabled=true;
}
else{
document.getElementById("responseOutput").innerHTML="Available";
document.frm.submit.disabled=false;
}
}
}

function notify(content)
{
$.Notify({
                                    shadow: false,
                                    position: 'top-right',
									background: 'red',
                                    content: content
                                })
}

function valform()
{

if(document.getElementById("error_email").innerHTML=="Email-id is already registered"){
notify("Choose another E-mail id.");
return false;
}

if(document.frm.username.value=="")
{
notify("Please select a Username.");
return false;
}

if(document.getElementById("responseOutput").innerHTML=="User already exist"){
notify("Choose another Username.");
return false;
}

if(document.frm.fname.value==""){
notify("First Name field empty.");                             
return false;
}
if(document.frm.lname.value==""){
notify("Last Name field is empty.");
return false;
}

if(document.frm.password.value==""){
notify("Password can't be empty.");
return false;
}
if(document.frm.password_repeat.value==""){
notify("Password can't be empty.");
return false;
}
if(document.frm.password.value!=document.frm.password_repeat.value){
notify("Password doesn't match.");
return false;
}
}
