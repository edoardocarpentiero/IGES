<?php
/**
*GestioneDocente
*
*Questa classe implementa le funzionalità che riguardano la gestione di un docente
*
*Author: Gianmarco Mucciariello
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/

require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');
include("Docente.php");

class GestioneDocente{
	private $database;

	//costruttore che inizializza la variabile con la connessione al database
	public function __construct(){
		$this->database=new Database();
		$this->database->connettiDB();
	}
	
	//restituisce gli SSD
	//la variabile 'SSD' corrisponde al valore di output e contiene l'elenco di tutti gli SSD
	public function getSSD(){
		 $SSD=$this->database->eseguiQuery("SELECT SSD FROM Settore");
		 return $SSD;
    }
	
	//aggiunge le informazioni di un docente all'interno del database
	//Il parametro 'docente' rappresenta le informazioni del docente che devono essere inserite all'interno del database
	//il valore di ritorno è un booleano che assume il valore di 'false' in caso di errore nell'esecuzione della query
	public function aggiungiDocente($docente){
		$query="SELECT * FROM Docente WHERE Email='".$docente->getEmail()."' OR Telefono='".$docente->getNumeroDiTelefono()."' OR Studio='".$docente->getStudio()."'";
		
		if($this->database->eseguiQuery($query)->num_rows==0){
		$query="INSERT INTO Docente (Studio, Nome, Email, Cognome, Ruolo, Info_Ricevimenti, SSD, Stato, Telefono) VALUES ('".$docente->getStudio()."','".$docente->getNome()."','".$docente->getEmail()."','".$docente->getCognome()."','".$docente->getRuolo()."','".$docente->getRicevimento()."','".$docente->getSettoreScientificoDisciplinare()."','".$docente->getStato()."','".$docente->getNumeroDiTelefono()."')";
		return $this->database->eseguiQuery($query);
		}
			return false;
	}

	//restituisce un particolare docente oppure l'elenco di tutti i docenti presenti nel database
	//il parametro 'tutti' è un flag che serve ad indicare se devono essere restutiti tutti i docenti oppure un particolare docente
	//il parametro 'matricola' indica la matricola del docente che si deve cercare all'interno del database
	//il valore di ritorno è 'arrayRisultato' che restituisce un insieme di oggetti di tipo 'Docente'
	public function ricercaDocente($tutti, $matricola){
		if($tutti==0)
			$query="SELECT Matricola, Nome, Cognome, Email, Telefono, Info_Ricevimenti, Ruolo, SSD, Stato, Studio FROM Docente WHERE Matricola='".$matricola."'";
		else
			$query="SELECT Matricola, Nome, Cognome, Email, Telefono, Info_Ricevimenti, Ruolo, SSD, Stato, Studio FROM Docente";
		$risultatoQuery=$this->database->eseguiQuery($query);
		$arrayRisultato=array();
		while($risultato=$risultatoQuery->fetch_row()){
			$prof=new Docente($risultato[0], $risultato[1], $risultato[2], $risultato[3], $risultato[4], $risultato[5], $risultato[6], $risultato[7], $risultato[8], $risultato[9]);
			$arrayRisultato[]=$prof;
		}
		return $arrayRisultato;
	}
	
	//modifica le informazioni relative ad un docente con nuove informazioni passate tramite parametro
	//il parametro 'docente' è un oggetto che contiene le informazioni nuove che devono sostituire quelle vecchie del docente che si vuole modificare
	//il valore di ritorno è un booleano che indica se la query ha avuto successo oppure no
	function aggiornaDocente($docente){
		$query="UPDATE Docente SET Studio='".$docente->getStudio()."', Nome='".$docente->getNome()."', Cognome='".$docente->getCognome()."', Email='".$docente->getEmail()."', Ruolo='".$docente->getRuolo()."', Info_Ricevimenti='".$docente->getRicevimento()."', SSD='".$docente->getSettoreScientificoDisciplinare()."', Stato='".$docente->getStato()."', Telefono='".$docente->getNumeroDiTelefono()."' WHERE Matricola='".$docente->getMatricola()."'";
		return $this->database->eseguiQuery($query);
	}
	
	//modifica lo stato di un docente
	//il parametro 'docente' rappresenta il docente per cui deve essere modificato il parametro
	//il parametro  'nuovoStato' rappresenta il nuovo stato del docente
	//il valore di ritorno è un booleano che indica se la query ha avuto successo oppure no
	public function modificaStatoDocente($docente, $nuovoStato){
		$query="UPDATE Docente SET Stato='".$nuovoStato."' WHERE Matricola='".$docente->getMatricola()."'";
		return $this->database->eseguiQuery($query);
	}
}

if(isset($_POST["funzione"])){
	$gestioneDocente=new GestioneDocente();
	switch($_POST["funzione"]){
		case "aggiungidocente":
			$docente=new Docente(0, $_POST["nome"], $_POST["cognome"], $_POST["email"], $_POST["telefono"], $_POST["ricevimento"], $_POST["ruolo"], $_POST["ssd"], intval($_POST["stato"]), $_POST["studio"]);
			$risultato=$gestioneDocente->aggiungiDocente($docente);
				if($risultato)
					echo "aggiunta avvenuta con successo";
				else
					echo "errore nell'aggiunta del docente";
		break;
		
		case "aggiornadocente":
			$docente=new Docente($_POST["matricola"], $_POST["nome"], $_POST["cognome"], $_POST["email"], $_POST["telefono"], $_POST["ricevimento"], $_POST["ruolo"], $_POST["ssd"], intval($_POST["stato"]), $_POST["studio"]);
			$risultato=$gestioneDocente->aggiornaDocente($docente);
				if($risultato)
					echo "modifica avvenuta con successo";
				else
					echo "errore nella modifica del docente";
			
		break;
		
		case "modificastatodocente":
			$gestioneProf->modificaStatoDocente($_POST["matricola"], $_POST["stato"]);
		break;
	}
}

?>
