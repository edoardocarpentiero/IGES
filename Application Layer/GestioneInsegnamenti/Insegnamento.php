<?php
	/**
	 *Insegnamento
	 *
	 *Questa classe rappresenta l'entità insegnamento
	 *
	 *Author: Edoardo Carpentiero
	 *Version : 1.0
	 *2015 - Copyright by Pr.D Project - University of Salerno
	 */
class Insegnamento{
		private $denominazioneInsegnamento, $ssd, $id, $durataCorso, $tipologiaAttivitaFormativa, $modulo;
		private $cfuLaboratorio,$cfuFrontale, $corsoAppartenenza, $tipologiaLezione;
		
		public function __construct($denominazione, $ssd, $tipologiaAttivitaFormativa, $modulo, $cfuTeoria, $cfuLaboratorio, $tipologiaLezione,$corso,$durataCorso,$id=0){
			$this->id=$id;
            $this->denominazioneInsegnamento=$denominazione;
			$this->ssd=$ssd;
			$this->tipologiaAttivitaFormativa=$tipologiaAttivitaFormativa;
			$this->modulo=intval($modulo);
			$this->cfuFrontale=intval($cfuTeoria);
			$this->cfuLaboratorio=intval($cfuLaboratorio);
			$this->corsoAppartenenza=$corso;
			$this->tipologiaLezione=$tipologiaLezione;
			$this->durataCorso=intval($durataCorso);
		}
		
		
		public function getDenominazione(){
			return $this->denominazioneInsegnamento;
		}
        
        public function getID(){
			return $this->id;
		}
		
		public function getSSD(){
			return $this->ssd;
		}
		
		
		public function getDurataCorso(){
			return intval($this->durataCorso);
		}
		
		public function getTipologiaAttivitaFormativa(){
			return $this->tipologiaAttivitaFormativa;
		}
		
		public function getModulo(){
			return $this->modulo;
		}
		
		public function getCorso(){
			return $this->corsoAppartenenza;
		}
		
		public function getCfuLaboratorio(){
			return intval($this->cfuLaboratorio);
		}
		
		public function getCfuFrontale(){
			return intval($this->cfuFrontale);
		}
		
		public function getTipologiaLezione(){
			return $this->tipologiaLezione;
		}
		
		public function setDenominazione($denominazione){
			return $this->denominazioneInsegnamento=$denominazione;
		}
		
		public function setSSD($ssd){
			return $this->ssd=$ssd;
		}
		
		public function setDurataCorso($durataCorso){
			return $this->durataCorso=$durataCorso;
		}
		
		public function setTipologiaAttivitaFormativa($tipologia){
			return $this->tipologiaAttivitaFormativa=$tipologia;
		}
		
		public function setModulo($modulo){
			return $this->modulo=$modulo;
		}
		
		public function setCFULaboratorio($cfuLab){
			return $this->cfuLaboratorio=$cfuLab;
		}
		
		public function setCfuFrontale($cfuTeoria){
			$this->cfuFrontale=$cfuTeoria;
		}
		
		public function setTipologiaLezione($newTipologia){
			return $this->tipologiaLezione=$newTipologia;
		}
		public function setCorso($corso){
			return $this->corsoAppartenenza=$corso;
		}

		public function __toString(){
			return "$this->denominazioneInsegnamento.$this->tipologiaAttivitaFormativa.$this->tipologiaLezione.$this->corsoAppartenenza.$this->modulo.$this->ssd.$this->cfuLaboratorio.$this->cfuFrontale.$this->durataCorso";
		}
}

?>