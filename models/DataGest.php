<?php


class Gest_data
{
    				//Select dato l'array di base restituisce solo l'array con i campi scelti nella select
					//parametri in ingresso:
					//data -> sorgente dati (tipo array)
					//key -> elementi della select (tipo array)
					//Output: (tipo array)
	
	
					public function select_arr($data,$key_select) 
					{


										$data_src= $data;
										$arr_group = array();


							foreach ($data_src as $dato) 
							{

										foreach ($dato as $key => $value) 
										{
											if ( in_array($key, explode(",", $key_select)) )
											{
											$riga[$key]=$value;	
												
												//Se l'arrey ha settato un campo timeT lo riport nell'array filtrato per ordinare i campi di tipo data
												//i campi timeT vnegono creati durante la lettura dei dati se si incontra una data classe DataAccess
												// ---------------------------------------
												if (array_key_exists("timeT".$key, $dato))
												{
												$keyT="timeT".$key;
												$riga[$keyT]=$dato["timeT".$key];	
												}
												// ---------------------------------------
												
											}		
										}
									
							$righe[]=$riga;			

							}	
						
						

						return $righe;
					}
	
	
					//Group by sui valori dell'array
					//parametri in ingresso:
					//data -> sorgente dati (tipo array)
					//key -> key per cui si vuole raggruppare (tipo string)

					public function group_by_arr($data,$key) 
					{


								$data_src= $data;
								$key_group = $key;
								$arr_group = array();


								foreach ($data_src as $dato) {

									$value_app=$dato[$key_group];

									if (array_search($value_app,$arr_group)===false)
									{
										array_push($arr_group, $value_app);
									}

								}

						return $arr_group;

				}


					//Filter sui valori dell'array
					//parametri in ingresso:
					//data -> sorgente dati (tipo array)
					//key -> key per cui si vuole filtrare (tipo string)
					//value -> value per cui si vuole filtrare (tipo string)

				public function filter_by_value_arr($data,$key,$value) 
					{


								$data_src= $data;
								$key_filter = $key;
								$value_filter = $value;
								$arr_filter = array();
								
								if (array_key_exists($key, $data_src[0])!==true)
									{
										echo "\n\n\n--> Attenzione chiave per la condizione where (-w) inesistente!!! <--\n\n\n";
										return $arr_filter=array();	
									}
								

								$arr_filter = array_filter($data_src, function ($item) use ($value_filter,$key_filter) 
								{
									if ($item[$key_filter] == $value_filter) 
										{
											return true;
										}
										return false;
								});



						return  $arr_filter;

				}	


				//Filter sui valori dell'array
					//parametri in ingresso:
					//data -> sorgente dati (tipo array)
					//key -> key per cui si vuole filtrare (tipo string)
					//oredr -> [ASC | DESC] tipo di ordinamento default DESC
					// per ora ordinamento solo numerico va fatta una condizione se il dato è isnumeric per ordinare anche le stringhe
					//se il campo è una data andrebbe anche fatto la switch automatico al dato timeT per far questo mettere davanti alla key la stringa timeT+$key e verificare che sia un elemto esistente dell'array se cosi è si utilizza il dato timeT + nomekey

				public function order_by_key_arr($data,$key,$order="DESC") 
					{
								
						
								if (count($data)>=1)
								{
								
									
								if (array_key_exists($key, $data[0])!==true)
									{
										
										echo "\n\n\n--> Attenzione chiave per la condizione Order by (-o) inesistente!!! <--\n\n\n";
										return $data_src=array();	
										
									}	
								}
						
								$data_src= $data;

								if (count($data_src)>0)
								{
									if (array_key_exists("timeT".$key, $data_src[0])===true)
									{

										$key="timeT".$key;

									}
								}



								$arr_filter = array();


								usort($data_src, function ($a,$b) use ($key,$order) 
								{

									
									if ($a[$key] == $b[$key]) return 0;

									if ($order=="DESC")
									return ($a[$key] < $b[$key] ) ? 1 : -1;

									if ($order=="ASC")
									return ($a[$key] > $b[$key] ) ? 1 : -1;
								});	



						return  $data_src;
			
}		

	
			
		public function convert_currency_to_eu($currency) 
					{
						
						$a=rand(8,60);
						
						$b=rand(1,90);
						
						if (strlen($b)<2)
						{
							$b="0".$b;
						}
						
						

						return  "€".$a.".".$b;

				}
	
	
	
}
 
