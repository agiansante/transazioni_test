<?php


//Questa funzione recupera i dati da linea di comando e elabora i dati restituendo un array dati come risultato della Query

// -s [select] passare i campi della select divisi da virgola ES: -s valore1,valore2  se non impostato eseguira la select su tutti i campi Select *
// -w [where]  filtra i campi in base una condizione  chiave valore ES: -w key=valore se non impostato non applica la condizione 
// -o [order by] ordina i risultati dato un campo può assumere valori ASC | DESC ES: -o key=DESC valore di default se non impostato DESC
// -g [group by] ragruppa i dati in base ad un campo ES: -o key

class ElabDataCmd extends Gest_data
{
   
	private $_base_data;
 
    public function __construct($base_data)
    {
        $this->_base_data = $base_data;
		
    }
	
    
	//Elaborazione dei parametri da riga di comando ed esecuzione dell'elaborazione dei dati
	//in sequenza esegue Select -> Where -> Order
	//input argc,argv
	//return arry
	
    public function get_data ($argc,$argv)
    {
       if ((isset($argc))AND(isset($argv[1])))
	   {
		   $data_get = getopt("s:w:o:g:");
		   
		   if (isset($data_get["s"]))
		   {
			 $ret_array_select=$this->select_arr($this->_base_data,$data_get["s"]);
			 
		   }else{
			 $ret_array_select=$this->_base_data;   
		   }
		   
		   /*echo "<pre>";
		   print_r($ret_array_select);
		   echo "</pre>";*/
		   
		   if (isset($data_get["w"]))
		   {
			 $parametri_where=explode("=", $data_get["w"]);  
			 $ret_array_where=$this->filter_by_value_arr($ret_array_select,$parametri_where[0],$parametri_where[1]);
			  
		   }else{
			$ret_array_where=$ret_array_select;    
		   }
		   
		  if (isset($data_get["o"]))
		   {
			 $parametri_order=explode("=", $data_get["o"]);
			 
			 if (count($parametri_order)===1)
				{ $tipo_ordinamento="DESC"; }
			 	 else
			 	{$tipo_ordinamento=$parametri_order[1]; }
				
			   
			 $ret_array_order=$this->order_by_key_arr($ret_array_where,$parametri_order[0],$tipo_ordinamento);
			 
			 
		   }else{
			$ret_array_order=$ret_array_where;    
		   } 
		   
		   $ret_array_result=$ret_array_order;
		   
		   
		   if (count($ret_array_result)===0)
			   echo "--> I Criteri inseriti non hanno prodotto alcun risultato! <--";
		   
		   return $ret_array_result;
		   
		   
	   }
    }
}  