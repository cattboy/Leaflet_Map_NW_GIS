<?php 
    session_start();
    //Only access this page if session variable is true
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']) == false) {
	
    header("Location: http://nwmap.pcriot.com/BlackPad_NewMap.html");
    }

 ?>