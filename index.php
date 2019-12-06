<?php

@require("models/DataAccess.php");
@require("models/DataGest.php");


if ((isset($argc))AND(isset($argv[1]))) 
{
	$filter=$argv[1];
	include_once("scripts/report.php");	

} elseif (isset($_GET['filter'])) {
	$filter=$_GET['filter'];
	include_once("scripts/reportweb.php");
	
}else{

	if (strpos(php_sapi_name(), 'cli') !== false) 
	{
		include_once("scripts/report.php");
	}else{
		include_once("scripts/reportweb.php");
	}	
	

	
}







?>