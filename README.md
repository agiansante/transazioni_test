# Transazioni test

# Elenco transazioni v 1.0

Restituisce un elenco di transazioni ragruppate per Customer è anche possibile filtrare le transazioni di un singolo customer.

Può essere utilizzato sia da command line sia da web

Da Riga Di comando:

Leggere tutte le transazioni ragruppate per Customer  ---> index.php

Leggere le transazioni di un determinato Customer  ---> index.php <filtro>

Da Browser:

Leggere tutte le transazioni ragruppate per Customer  ---> http://<host>/<folder>/

Leggere le transazioni di un determinato Customer  ---> http://<host>/<folder>/?filter=<filtro>

* [Esempio con filtro](https://www.alessandrogiansante.com/test/transazioni/?filter=2) - tutte le transazioni del Customer 2
* [Esempio senza filtro](https://www.alessandrogiansante.com/test/transazioni/) - tutte le transazioni ragruppate per Customer 