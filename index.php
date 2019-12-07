<?php




if ((isset($argc))AND(isset($argv[1]))) 
{
	
	include_once("scripts/report.php");	

} elseif (isset($_GET['filter'])) {
	$filter=$_GET['filter'];
	include_once("scripts/reportweb.php");
	
}else{

	
		include_once("scripts/reportweb.php");

	

	
}







?>