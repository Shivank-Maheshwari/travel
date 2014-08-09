<?php
require_once('connectvars.php');
  // Start the session
  session_start();
  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {    
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
          header('Location: ' . $home_url);
        }  
?>
