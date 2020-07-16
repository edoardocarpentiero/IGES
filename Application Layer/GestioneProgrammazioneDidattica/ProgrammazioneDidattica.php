<?php
	/**
	 *Programmazione didattica
	 *
	 *Questa classe rappresenta l'entità insegnamento
	 *
	 *Author: Alessandro Kevin Barletta
	 *Version : 1.0
	 *2015 - Copyright by Pr.D Project - University of Salerno
	 */
	
class ProgrammazioneDidattica{
		private $id, $anno_Corso, $corso, $semestre, $tot_Ore_Teoria, $tot_Ore_Lab, $anno_Accademico, $versione, $stato;
		private $insegnamento, $docente, $id_regolamento;
		public function __construct($id=0,$anno_Corso, $corso, $semestre, $tot_Ore_Teoria, $tot_Ore_Lab,
									$anno_Accademico, $versione, $stato, $id_regolamento)
		{
			$this->id=$id;
            $this->anno_Corso = $anno_Corso;
			$this->corso = $corso;
			$this->semestre = $semestre;
			$this->tot_Ore_Lab = $tot_Ore_Lab;
			$this->tot_Ore_Teoria = $tot_Ore_Teoria;
			$this->anno_Accademico = $anno_Accademico;
			$this->versione = $versione;
			$this->stato = $stato;
			$this->id_regolamento = $id_regolamento;
		}
		
		//Metodi getter, che restituiscono il valore degli attributi
		
		public function getID(){
			return $this->id;
		}
        
		public function getIDRegolamento(){
			return $this->id_regolamento;
		}
		
        public function getAnnoCorso(){
			return $this->anno_Corso;
		}
		
		public function getCorso(){
			return $this->corso;
		}
		
		public function getSemestre(){
			return $this->semestre;
		}
		
		public function getTotOreTeoria(){
			return $this->tot_Ore_Teoria;
		}
		
		public function getTotOreLab(){
			return $this->tot_Ore_Lab;
		}
		
		public function getAnnoAccademico(){
			return $this->anno_Accademico;
		}
		
		public function getStato(){
			return $this->stato;
		}
		
		public function getVersione(){
			return $this->versione;
		}
		
		//Metodi setter, che settano il nuovo valore degli attributi
		
		public function setID($id){
			$this->id = $id;
		}
		
		public function setAnnoCorso($anno_Corso){
			$this->anno_Corso = $anno_Corso;
		}
		
		public function setAnnoAccademico($anno_Accademico){
			$this->anno_Accademico = $anno_Accademico;
		}
		
		public function setCorso($corso){
			$this->corso = $corso;
		}
		public function setTotOreLab($tot_Ore_Lab){
			$this->tot_Ore_Lab = $tot_Ore_Lab;
		}
		
		public function setTotOreTeoria($tot_Ore_Teoria){
			$this->tot_Ore_Teoria = $tot_Ore_Teoria;
		}
		
		public function setIDRegolamento($id_regolamento){
			$this->id_regolamento =$id_regolamento;
		}
		
		public function setSemestre($semestre){
			$this->semestre = $semestre;
		}
		
		public function setVersione($versione){
			$this->versione = $versione;
		}
		
		public function setStato($stato){
			$this->stato = $stato;
		}
		
		

		
}//end class

?>