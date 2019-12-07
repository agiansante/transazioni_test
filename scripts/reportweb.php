<?php 

@require("models/DataAccess.php");
@require("models/DataGest.php");

$src_dat = array('file'=>'data.csv','delimiter'=>';');  
$obj_access = new Acces_data($src_dat);
$obj_access->read_data_csv();






$obj_gest = new Gest_data();

if ($filter==""){

	
	$costumers=$obj_gest->group_by_arr($obj_access->data_ret,'customer');

	foreach ($costumers as $costumer)
	{
		
		echo "<h3>Customer: $costumer<br>Elenco transazioni:</h3>";
		$dati_ret=$obj_gest->order_by_key_arr($obj_gest->filter_by_value_arr($obj_access->data_ret,'customer',$costumer),'date');

		foreach ($dati_ret as $dato)
		{
			echo "<i>-->Data transazione: $dato[date] - Importo ". $obj_gest->convert_currency_to_eu($dato['value'])."<i><br>";
		}
		
	
	}
	
	
}else{



	echo "<h3>Customer: $filter<br>Elenco transazioni:</h3>";
	$dati_ret=$obj_gest->order_by_key_arr($obj_gest->filter_by_value_arr($obj_access->data_ret,'customer',$filter),'date');

	foreach ($dati_ret as $dato)
	{
		echo "<i>-->Data transazione: $dato[date] - Importo ". $obj_gest->convert_currency_to_eu($dato['value'])."<i><br>";
	}

}



?>
