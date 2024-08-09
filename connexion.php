<?php
	//Se connecter au serveur
	$con = mysqli_connect("localhost","root", "");
	//Sélectionner la base de donnée
	mysqli_select_db($con,'shopage');
	mysqli_query($con,"SET NAMES UTF8");
?>