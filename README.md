## Pr.D_IGES
Questa repository contiene il codice sorgente del software PR.D. Il sistema è un portale web dedicato alla gestione  della programmazione didattica nell’ambito universitario denominato Pr. D.   
L’obiettivo del software Pr. D. è quello di mettere a disposizione un sistema che faciliti le normali operazioni svolte dal Presidente del Consiglio Didattico del dipartimento di Informatica relative alla gestione della programmazione didattica.

SitoWeb: http://prd.altervista.org/Presentation%20Layer/index.php

Su tale sistema è stata effettuata attività di manutenzione, estendendo il sistema con nuovi requisiti riguardanti la gestione del carico didattico dei docenti.

## Documentazione
Nella cartella <b> _DOCUMENTI DI MANUTENZIONE</b> sono presenti i documenti prodotti tra cui <b>Pr.D._MD_Vers.1.3</b> che contiene la descrizione della change request, l'impact analysis effettuata e i modelli di sistema aggiunti

## NOTE: 
- I database utilizzati sono presenti nella cartella <b>_DB</b><br>

- Per utilizzare il sistema con dati già presenti, impostare il DB <b>myprd_release</b> in <i>StorageLayer/Database</i><br>
- Per consentire la corretta esecuzione dei test di unità e integrazione del nuovo sistema, impostare il DB <b>myprd_unitTesting</b> in <i>StorageLayer/Database</i><br>
- Per consentire la corretta esecuzione del test di sistema sul sistema pre-CR, impostare il DB <b>myprd_old</b> in <i>StorageLayer/Database</i><br>
- Per consentire la corretta esecuzione del test di sistema sul sistema post-CR, impostare il DB <b>myprd_systemTesting</b> in <i>StorageLayer/Database</i><br>
- Le query da inserire dopo l'esecuzione del test di sistema post-CR sono presenti nel file <b>query_testing.sql</b>
- I test case di sistema sulla gestione del carico didattico sono inclusi nel file <b>PrD_GCD</b> da importare su Selenium<br>
- I test case di sistema sulla gestione della programmazione didattica sono inclusi nel file <b>PrD_GestioneProgDid</b> da importare su Selenium<br>


## Sviluppatori
Edoardo Carpentiero - Attilio Della Greca - Antonio Prisco


