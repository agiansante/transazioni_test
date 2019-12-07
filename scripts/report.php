<?php
mb_internal_encoding("UTF-8");

@require("models/DataAccess.php");
@require("models/DataGest.php");
@require("models/ElabDataCmd.php");


$src_dat = array('file'=>'data.csv','delimiter'=>';');  
$obj_access = new Acces_data($src_dat);
$obj_access->read_data_csv();




$data_base=$obj_access->data_ret;
$obj_elab_cmd = new ElabDataCmd($data_base);

$arry_result=$obj_elab_cmd->get_data($argc,$argv);

foreach ($arry_result as $dato)
	{
		
		echo "-->";
		
			foreach ($dato as $key => $value) 
			{
				   preg_match("/([^0-9.,]*)([0-9.,]*)([^0-9.,]*)/", $value, $simbolo);

				   if ( in_array($simbolo[1], array('£','$')))  
					{
						$orig_value=$value;
						$value=$obj_elab_cmd->convert_currency_to_eu($value) . " (orig: $orig_value)";
					}

					if (substr($key,0,5)!="timeT")
					echo " $key: $value ";
			}
		
		echo "\n";
	}






?>