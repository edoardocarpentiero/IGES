<?php
/**
*DocentePrD
*
*Questa classe rappresenta l'entitא docente nella programmazione Didattica
*
*Author: Edoardo Carpentiero
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/

	class DocentePrD{
		private $matricola, $nome, $cognome, $email, $ruolo, $settoreScientificoDisciplinare,$numeroInsegnamentiSospesi,$statusCarico;
		
        public function __construct($matricola, $nome, $cognome, $email, $ruolo, $settoreScientificoDisciplinare){
        	
            $this->matricola=$matricola;
			$this->nome=$nome;
			$this->cognome=$cognome;
			$this->email=$email;
			$this->ruolo=$ruolo;
			$this->settoreScientificoDisciplinare=$settoreScientificoDisciplinare;
        }
		
		//metodi getter che restituiscono il contenuto delle variabili
		public function getMatricola(){
			return $this->matricola;
		}
		
		public function getNome(){
			return $this->nome;
		}
		
		public function getCognome(){
			return $this->cognome;
		}
		
		public function getEmail(){
			return $this->email;
		}
		public function getNumeroInsegnamentiSospesi(){
			return $this->numeroInsegnamentiSospesi;
		}
		
		public function getStatusCarico(){
			return $this->statusCarico;
		}	
		public function getRuolo(){
			return $this->ruolo;
		}
		
		public function getSettoreScientificoDisciplinare(){
			return $this->settoreScientificoDisciplinare;
		}
        
		//metodi setter che modificano il contenuto delle variabili con il valore passato tramite parametro
		public function setMatricola($matricola){
			return $this->matricola=$matricola;
		}
		
		public function setNome($nome){
			return $this->nome=$nome;
		}
		
		public function setCognome($cognome){
			return $this->cognome=$cognome;
		}
		
		public function setEmail($email){
			return $this->email=$email;
		}
		
				
		public function setRuolo($ruolo){
			return $this->ruolo=$ruolo;
		}
		
		public function setSettoreScientificoDisciplinare($settoreScientificoDisciplinare){
			return $this->settoreScientificoDisciplinare=$settoreScientificoDisciplinare;
		}
        
        public function setNumeroInsegnamentiSospesi($numeroInsegnamentiSospesi){
			return $this->numeroInsegnamentiSospesi=$numeroInsegnamentiSospesi;
		}
		
		public function setStatusCarico($statusCarico){
			return $this->statusCarico=$statusCarico;
		}
	}
?>