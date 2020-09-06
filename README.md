## Pr.D_IGES
Questa repository contiene il codice sorgente del software PR.D. Il sistema è un portale web dedicato alla gestione  della programmazione didattica nell’ambito universitario denominato Pr. D.   
L’obiettivo del software Pr. D. è quello di mettere a disposizione un sistema che faciliti le normali operazioni svolte dal Presidente del Consiglio Didattico del dipartimento di Informatica relative alla gestione della programmazione didattica.

Su tale sistema è stata effettuata attività di manutenzione, estendendo il sistema con nuovi requisiti riguardanti la gestione del carico didattico dei docenti.

## Documentazione
- Nella cartella <b>_DOCUMENTI DI MANUTENZIONE</b> sono presenti i documenti prodotti <br>
-- Pr.D._MD_Vers.1.3 

## NOTE: 
- I database utilizzati sono presenti nella cartella <b>_DB</b><br>
- Per consentire il corretto funzionamento del sistema, impostare il DB <b>my_prd</b> in <i>StorageLayer/Database</i><br>
- Per consentire la corretta esecuzione dei test di unità, integrazione e di sistema del nuovo sistema, impostare il DB <b>myprd_testing</b> in <i>StorageLayer/Database</i><br>
- Per consentire la corretta esecuzione del test di sistema sul sistema pre-CR, impostare il DB <b>myprd_old</b> in <i>StorageLayer/Database</i><br>
- Le query da inserire dopo l'esecuzione del test di sistema sono presenti nel file <b>query_testing.sql</b>
- I test case di sistema sono inclusi nel file <b>PrD.side</b> da importare su Selenium<br>


## Sviluppatori
Edoardo Carpentiero - Attilio Della Greca - Antonio Prisco


