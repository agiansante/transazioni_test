# Transazioni test

# Elenco transazioni v 2.0

Import dati da file csv e possibilità di eseguire delle query sui dati tramite linea di comando, se il dato viene riconosciuto come valuta in base al segno e non è € allora esegue la conversione ad € (conversione finta in questa versione).

E' possibile richiamare lo scricp anche da Browser (in questa versione la chiamata da Browser a un set ridotto di funzioni, chiamando lo script senza parametri restituisce un l'elenco delle transazioni ragruppate per customer, se si passa il parametro filter restituisce elenco transazioni di di qullo specifico customer).

E' possibile anche modificare il CSV aggiungendo colonne con altre tipologie di dati ed effettuari query anche su questi ultimi.

# Possibili comandi da CMD

 -s [select] passare i campi della select divisi da virgola ES: -s valore1,valore2  se non impostato eseguira la select su tutti i campi Select *
 
 -w [where]  filtra i campi in base una condizione  chiave valore ES: -w key=valore se non impostato non applica la condizione 
 
 -o [order by] ordina i risultati dato un campo può assumere valori ASC | DESC ES: -o key=DESC valore di default se non impostato DESC

# Esempi comandi da CMD
Elencare tutte le transazioni di un singolo customer ordinate per data

php index.php -w customer=1 -o date=DESC

--------------------------------------------------------------------------------------------------------------

Elencare tutte le transazioni di un singolo customer ordinate per data visualizzando solo alcuni campi

php index.php -s customer,date,value  -w customer=1 -o date=DESC

--------------------------------------------------------------------------------------------------------------
Elencare tutte le transazioni ordinate per data

php index.php -s customer,date,value  -o customer=DESC

--------------------------------------------------------------------------------------------------------------
Elencare tutte le transazione per nome utente ordinate per data

php index.php   -w "nome utente"=Luca -o date=ASC


Nota: sia i nome delle chiavi sia i nomi dei valori in questa versione sono case sensitive

# Esempi WEB


* [Esempio con filtro](https://www.alessandrogiansante.com/test/transazioni/?filter=2) - tutte le transazioni del Customer 2
* [Esempio senza filtro](https://www.alessandrogiansante.com/test/transazioni/) - tutte le transazioni ragruppate per Customer 


# Installazione

Copiare tutto il progetto in una cartella del webServer con supporto per linguaggio PHP

Testato con PHP 7.3.10
