<?php

	session_start();

	//Connection
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "practice_gym_file";

	$connection = new mysqli($host, $username, $password, $database);

	date_default_timezone_set('Asia/Manila');
	$timeNow = date('Y-m-d h:i:s', time());
	$dateNow = date('Y-m-d');
	
	//Time Ago Function
	function diffForHumans($timestamp){     
	  $time_ago        = strtotime($timestamp);
	  $current_time    = time();
	  $time_difference = $current_time - $time_ago;
	  $seconds         = $time_difference;
	  
	  $minutes = round($seconds / 60); // value 60 is seconds  
	  $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
	  $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
	  $weeks   = round($seconds / 604800); // 7*24*60*60;  
	  $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
	  $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
	                
	  if ($seconds <= 60){

	    return "Just Now";

	  } else if ($minutes <= 60){

	    if ($minutes == 1){

	      return "One minute ago";

	    } else {

	      return "$minutes minutes ago";

	    }

	  } else if ($hours <= 24){

	    if ($hours == 1){

	      return "An hour ago";

	    } else {

	      return "$hours hours ago";

	    }

	  } else if ($days <= 7){

	    if ($days == 1){

	      return "Yesterday";

	    } else {

	      return "$days days ago";

	    }

	  } else if ($weeks <= 4.3){

	    if ($weeks == 1){

	      return "A week ago";

	    } else {

	      return "$weeks weeks ago";

	    }

	  } else if ($months <= 12){

	    if ($months == 1){

	      return "A month ago";

	    } else {

	      return "$months months ago";

	    }

	  } else {
	    
	    if ($years == 1){

	      return "One year ago";

	    } else {

	      return "$years years ago";

	    }
	  }
	}

	// Add Log
	// function addLog($connection, $user, $title, $details, $created_at){
	// 	$insert = $connection->query("INSERT INTO logs (user, title, details, created_at) VALUES('$user', '$title', '$details', '$created_at')");
	// }

?>