<?php
	/**
	 *Associa
	 *
	 *Questa classe rappresenta l'entità Associa, che associa ad ogni Programmazione didattica i professori e gli insegnamenti
	 *
	 *Author: Alessandro Kevin Barletta
	 *Version : 1.0
	 *2015 - Copyright by Pr.D Project - University of Salerno
	 
	 */
	
	 class Associa
	 {
		 private $progD,$classe, $professore, $insegnamento, $ore_Teoria, $ore_Lab, $status;
		 
		 function __construct($insegnamento,$classe, $progD, $professore, $ore_Teoria, $ore_Lab, $status)
		 {
			 $this->progD = $progD;
			 $this->professore = $professore;
             $this->insegnamento = $insegnamento;
			 $this->ore_Teoria = $ore_Teoria;
			 $this->ore_Lab = $ore_Lab;
             $this->classe = $classe;
             $this->status = $status;
		 }//end construct
		 
		 public function getProgD(){
			 return $this->progD;
		 }
		 
		 public function getDocente(){
			 return $this->professore;
		 }
		 
		 public function getInsegnamento(){
			 return $this->insegnamento;
		 }
		 
		 public function getOreTeoria(){
			 return $this->ore_Teoria;
		 }
		 
		 public function getOreLab(){
			 return $this->ore_Lab;
		 }
		 
         public function getClasse(){
			 return $this->classe;
		 }
         
         public function getStatus(){
			 return $this->status;
		 }
         
		 public function setProgD($progD){
			 $this->progD = $progD;
		 }
         
         public function setClasse($classe){
			$this->classe = $classe;
		 }
		 
		 public function setProfessore($professore){
			 $this->professore = $professore;
		 }
		 
		 public function setInsegnamento($insegnamento){
			 $this->insegnamento = $insegnamento;
		 }
		 
		 public function setOreTeoria($ore_Teoria){
			 $this->ore_Teoria = $ore_Teoria;
		 }
		 
		 public function setOreLab($ore_Lab){
			 $this->ore_Lab = $ore_Lab;
		 }
         
         public function setStatus($status){
			 $this->status = $status;
		 }
         
         public function __toString(){
			 return "$this->professore.$this->insegnamento.$this->ore_Teoria.$this->ore_Lab.$this->classe.$this->status";
		}
	 }//end class
	 
?>