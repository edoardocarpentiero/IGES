<?php

class InsegnamentoProgDidattica
{
		 private $insegnamento,$associazione,$programmazioneDidattica;
		 
		 function __construct($insegnamento,$associazione,$programmazioneDidattica)
		 {
			 $this->insegnamento = $insegnamento;
			 $this->associazione = $associazione;
             $this->programmazioneDidattica = $programmazioneDidattica;
		 }//end construct
		 
		 public function getInsegnamento(){
			 return $this->insegnamento;
		 }
         
         public function getAssociazione(){
			 return $this->associazione;
		 }
         
         public function getProgrammazioneDidattica(){
			 return $this->programmazioneDidattica;
		 }
         
         public function setInsegnamento($insegnamento){
			 $this->insegnamento=$insegnamento;
		 }
         
         public function setAssociazione($associazione){
			 $this->associazione=$associazione;
		 }
         
         public function setProgrammazioneDidattica($programmazioneDidattica){
			 $this->programmazioneDidattica=$programmazioneDidattica;
		 }
		 
         
		}
?>