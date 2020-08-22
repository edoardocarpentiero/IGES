<?php

include_once 'Insegnamento.php';
require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');

/**
 * GestioneInsegnamenti
 *
 * Questa classe implementa le funzionalità per gestire gli insegnamenti
 *
 * Author: Edoardo Carpentiero
 * Version : 1.0
 * 2015 - Copyright by Pr.D Project - University of Salerno
 */
class GestioneInsegnamenti {
	
	private $database;
	
	public function __construct(){
    
		$this->database=new Database();
        $this->database->connettiDB();
	}
    
	// Questo metodo permette l'aggiunta di un insegnamento al sistema e restituisce: -1 se l'insegnamento da inserire già esiste,0 altrimenti
    // 
	public function aggiungiInsegnamento($insegnamento) {
		if (isset($insegnamento)) {	
        	if($this->isExist($insegnamento)==0){																																																				
                $query="INSERT INTO Insegnamento (Denominazione,Tipologia_Attivita,Tipologia_Lezione,Corso,Modulo,SSD,CFU_Laboratorio,CFU_Frontali,Tot_ore) VALUES('".$insegnamento->getDenominazione()."','".$insegnamento->getTipologiaAttivitaFormativa()."','".$insegnamento->getTipologiaLezione()."','".$insegnamento->getCorso()."',".$insegnamento->getModulo().",'".$insegnamento->getSSD()."',".$insegnamento->getCfuLaboratorio().",".$insegnamento->getCfuFrontale().",".$insegnamento->getDurataCorso().")"; 
                $this->database->eseguiQuery($query);
                return 0;
            }
            else
            	return -1;
		}
	}
    
	//Questo metodo restituisce i settori scentifici disciplinari
    public function getSSD(){
         $SSD=$this->database->eseguiQuery("Select SSD from Settore");
         return $SSD;
    }
    
    //Questo metodo permettere di verificare se esiste o meno un insegnamento: restituisce il numero di righe
    private function isExist($insegnamento)
    {
            $risultato=$this->database->eseguiQuery("Select * from Insegnamento where Denominazione='".$insegnamento->getDenominazione()."' AND Tipologia_Attivita='".$insegnamento->getTipologiaAttivitaFormativa()."' AND Tipologia_Lezione='".$insegnamento->getTipologiaLezione()."' AND Corso='".$insegnamento->getCorso()."' AND Modulo=".$insegnamento->getModulo()." AND SSD='".$insegnamento->getSSD()."' AND CFU_Laboratorio=".$insegnamento->getCfuLaboratorio()." AND CFU_Frontali=".$insegnamento->getCfuFrontale()." AND Tot_ore=".$insegnamento->getDurataCorso()."");
            return $risultato->num_rows;
    }
    
    //Questo metodo restituisce gli insegnamenti presenti nel sistema
    public function visualizzaInsegnamenti($campo="",$valore="",$flag){
    		$insegnamentiRicercati=array();
            $query="";
            
            if($flag==0 && $campo=="" && $valore=="")
            	$query="Select * from Insegnamento";
           	else{
            	$valoreRicerca="'$valore'";
            	$query="Select * from Insegnamento Where $campo=$valoreRicerca";
            }
            $result=$this->database->eseguiQuery($query);
            while($row=$result->fetch_row())
               $insegnamentiRicercati[]=new Insegnamento($row[1],$row[6],$row[2],$row[5],$row[8],$row[7],$row[3],$row[4],$row[9],$row[0]);
            return $insegnamentiRicercati;
    }
	
    //Questo metodo permette di salvare le modifiche apportate all'insegnamento: restituisce 0 in caso di successo, -1 altrimenti
    //Il parametro valoriInsegnamento è una stringa contenente i valori dell'insegnamento modificato
    //il parametro Id specifica l'identificativo dell'insegnamento da identificare
  
	public function salvaModifiche($insegnamento) {
			$result=$this->isExist($insegnamento);
            if(!$result){
            	$clausola="Denominazione='".$insegnamento->getDenominazione()."' , Tipologia_Attivita='".$insegnamento->getTipologiaAttivitaFormativa()."' , Tipologia_Lezione='".$insegnamento->getTipologiaLezione()."' , Corso='".$insegnamento->getCorso()."' , Modulo=".$insegnamento->getModulo()." , SSD='".$insegnamento->getSSD()."' , CFU_Laboratorio=".$insegnamento->getCfuLaboratorio()." , CFU_Frontali='".$insegnamento->getCfuFrontale()."' , Tot_ore=".$insegnamento->getDurataCorso()."";
            	$this->database->eseguiQuery("UPDATE Insegnamento SET ".$clausola." WHERE Matricola_Insegnamento=".$insegnamento->getID()."");
            	return 0;
             }
             else
             	return -1;
    }
    
   
}

?>