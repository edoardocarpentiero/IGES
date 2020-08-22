<?php
/**
*Docente
*
*Questa classe rappresenta l'entità docente
*
*Author: Gianmarco Mucciariello
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/

	class Docente{
		private $matricola, $nome, $cognome, $email, $telefono, $ricevimento, $ruolo, $settoreScientificoDisciplinare, $stato, $studio;
		
        //costruttore che imposta tutte le variabili con i valori passati tramite parametro
		public function __construct($matricola, $nome, $cognome, $email, $telefono, $ricevimento, $ruolo, $settoreScientificoDisciplinare, $stato, $studio){
			
			$this->matricola=$matricola;
			$this->nome=$nome;
			$this->cognome=$cognome;
			$this->email=$email;
			$this->telefono=$telefono;
			$this->ricevimento=$ricevimento;
			$this->ruolo=$ruolo;
			$this->settoreScientificoDisciplinare=$settoreScientificoDisciplinare;
			$this->stato=$stato;
			$this->studio=$studio;
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
		
		public function getNumeroDiTelefono(){
			return $this->telefono;
		}
		
		public function getRicevimento(){
			return $this->ricevimento;
		}
		
		public function getRuolo(){
			return $this->ruolo;
		}
		
		public function getStato(){
			return $this->stato;
		}
		
		public function getStudio(){
			return $this->studio;
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
		
		public function setNumeroDiTelefono($telefono){
			return $this->telefono=$telefono;
		}
		
		public function setRicevimento($ricevimento){
			return $this->ricevimento=$ricevimento;
		}
		
		public function setRuolo($ruolo){
			return $this->ruolo=$ruolo;
		}
		
		public function setStato($stato){
			return $this->stato=$stato;
		}
		
		public function setStudio($studio){
			return $this->studio=$studio;
		}
        
        
		public function setSettoreScientificoDisciplinare($settoreScientificoDisciplinare){
			return $this->settoreScientificoDisciplinare=$settoreScientificoDisciplinare;
		}
	}
?>