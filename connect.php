<?php

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
		$con=mysqli_connect("148.63.151.90","UserName","YourPassword","spoofbit");
		
        session_start();


?>
