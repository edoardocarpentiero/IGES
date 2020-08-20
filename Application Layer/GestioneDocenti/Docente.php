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
		private $numeroInsegnamentiSospesi,$statusCarico;
		
        //costruttore che imposta tutte le variabili con i valori passati tramite parametro
		//Metodo per effettuare l'overload del costruttore
        function __construct()
        {
            $a = func_get_args();
            $i = func_num_args();
            if (method_exists($this,$f='__construct'.$i)) {
                call_user_func_array(array($this,$f),$a);
            }
        }

        function __construct1($matricola, $nome, $cognome, $email, $telefono, $ricevimento, $ruolo, $settoreScientificoDisciplinare, $stato, $studio){
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

        function __construct2($matricola, $nome, $cognome, $email, $ruolo, $settoreScientificoDisciplinare){
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

        public function getNumeroInsegnamentiSospesi(){
            return $this->numeroInsegnamentiSospesi;
        }

        public function getStatusCarico(){
            return $this->statusCarico;
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

        public function setNumeroInsegnamentiSospesi($numeroInsegnamentiSospesi){
            return $this->numeroInsegnamentiSospesi=$numeroInsegnamentiSospesi;
        }

        public function setStatusCarico($statusCarico){
            return $this->statusCarico=$statusCarico;
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