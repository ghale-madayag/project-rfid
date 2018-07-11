<?php
	// error_reporting(E_ALL ^ E_DEPRECATED);
	// error_reporting(0);
	try {
		$handler = new PDO('mysql:host=localhost;dbname=rfid_db','root','');
		$handler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
		die();	
	}
?>