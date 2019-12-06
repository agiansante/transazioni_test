<?php

//parametri per la lettura della sorgente dati
//per CSV file->[nome del file] , delimiter->[delimitatore csv]
//per db connect host->[db host] , user->[username] , password->[password] , database->[nome db]

class Acces_data
{
    public $data_ret;
	private $_type_of_read;
 
    public function __construct($type_of_read)
    {
        $this->_type_of_read = $type_of_read;
		
    }
	
	//Sorgente dati CSV file->[nome del file] , delimiter->[delimitatore csv]
	public function read_data_csv() 
	{
		try{
			    
					
				$row = 1;
				$data_src= array();
				$data_src_key = array();
			    if (file_exists ($this->_type_of_read["file"])==false)
				{
					$name_file_err=$this->_type_of_read["file"];
					throw new Exception("Il file csv ($name_file_err) non esiste!", 41);  //4-file 1-non esiste	
				}
					if (($handle = fopen($this->_type_of_read["file"], "r")) !== FALSE) 
					{
						while (($data = fgetcsv($handle, 1000, $this->_type_of_read["delimiter"])) !== FALSE) 
						{
							$num = count($data);
								for ($c=0; $c < $num; $c++) 
								{
									//leggo la prima riga e definisco le chiavi dell'array dall'intestazione
									//andrebbe prevista anche la possibilità che il csv non abbia l'intestazione
									if ($row==1)
									{
										array_push($data_src_key, $data[$c]);
									}

									//leggo le altre righe associandole alle chiavi lette precedentemente
									if ($row>1)
									{
										$riga[$data_src_key[$c]]=$data[$c];
										
										//Riconosce se è una data e la trasfoma in timeT per ordinamento dell'array tramite timeT
										//questa crea un campo aggiuntivo nell'array con il valore del timeT e il nome della chiave e il nome del timeT+campo (Es. date->timeTdate)
										$controllo_if_date=$this->chk_date($data[$c]);
										if($controllo_if_date!="")
										{
										 $riga["timeT".$data_src_key[$c]]=$this->data_to_timeT($data[$c],$controllo_if_date);
										}

										
									}

								}

							if ($row>1) //Elimino la prima riga dall'array
							$righe[]=$riga;

							$row++;
						}
					fclose($handle);


					}
		 $this->data_ret=$righe; 
	}catch (Exception $e){
	
		echo "Exception ". $e->getCode(). ": ". $e->getMessage()."".
  " in ". $e->getFile(). " on line ". $e->getLine(). "";	
	}
}
	

	public function connect_db()
	{
			mysql_connect($this->_type_of_read[host],$this->_type_of_read[user],$this->_type_of_read[password])or die("non riesco a connettermi".mysql_error());
   			mysql_select_db($this->_type_of_read[database])or die("non riesco selezionare il database");
   			mysql_query("SET CHARACTER SET 'utf8'");
	}
	
	
	public function disconnessione()
	{
			mysql_close();
	}
	

	
	
	// Funzioni di supporto alla classe**************************************************************
	
	private function chk_date($data)
	{
		
		if($this->validateDate($data, 'd/m/Y')==true)
		{
		  return "it";	
		}
		
		if($this->validateDate($data, 'Y-m-d')==true)
		{
		  return "am";	
		}
		
		return "";
	}
	
	private function validateDate($date, $format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	private function data_to_timeT($data,$type_date)
	{
		if ($type_date=="am")
		$timestamp = strtotime($data);
			
		
		if ($type_date=="it")
		{
			list($gg, $mm, $aaaa) = explode("/", $data);
			$result = $aaaa."-".$mm."-".$gg;
			$timestamp = strtotime($result);
		}
		
		
		return $timestamp;
		
	}
	
	
}
 

