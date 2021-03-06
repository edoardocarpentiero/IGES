<?php
/**
*Database
*
*Questa classe implementa le funzionalit� che riguardano il database, utilizzando il Proxy Pattern
*
*Author: Gianmarco Mucciariello
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/

//Database RELEASE
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE", "my_prd");

/*
//databaseTesting TESTING INTEGRAZIONE GestioneCaricoDidattico
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE", "myprd_testing");

//databaseTesting TESTING SISTEMA GestioneCaricoDidattico
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE", "myprd");*/


class Database{
	private $connessione, $risultato;

	public function connettiDB(){
		// Crea la connessione
		$this->connessione = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
		// Controlla che la connessione sia stata creata con successo
		if ($this->connessione->connect_error) {
			die("Connection failed: " . $this->connessione->connect_error);
	}
  }
  
	public function chiudiDB(){
		//chiude la connessione con il db
		$this->connessione->close();
  }

	public function eseguiQuery($query){
		$this->risultato = $this->connessione->query($query) or die ($this->connessione->error);
		return $this->risultato;
  }
    
    public function returnRisultato(){
		return $this->risultato;   
  }
  
}//end class

?>