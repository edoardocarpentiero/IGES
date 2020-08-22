<?php

if(!isset($_SESSION))
{
    session_start();
}
/**
*GestioneRegolamento
*
*Questa classe implementa le funzionalit� che riguardano la gestione dei regolamenti
*
*Author: Edoardo Carpentiero, Gianmarco Mucciariello
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/

require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');
include_once("Regolamento.php");
require_once(dirname(__DIR__,2).'\Application Layer\GestioneInsegnamenti\Insegnamento.php');

class GestioneRegolamento{
	private $database;
	
	//costruttore che inizializza il parametro con la connessione al database
	public function __construct(){
		$this->database=new Database();
		$this->database->connettiDB();
	}
	
	//funzione che restituisce un array che rappresenta l'elenco di tutti gli anni accademici presenti nel database
	//il valore di ritorno � 'arrayRisultato' che contiene l'elenco di tutti gli anni accademici presenti nel database
	public function getAnniAccademici(){
		$query="SELECT DISTINCT Anno_accademico FROM Regolamento";
		$risultatoQuery=$this->database->eseguiQuery($query);
		while($risultato=$risultatoQuery->fetch_row()){
			$arrayRisultato[]=$risultato[0];
		}
		return $arrayRisultato;
	}
	

    //funzione che restituisce un array convertito in stringa tramite l'utilizzo della funzione 'json_encode' che rappresenta l'elenco di tutti i curricula presenti nel database
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'annoAccademico' si riferisce all'anno accademico del regolamento che si vuole modificare, nel formato: 'yyyy-yyyy'
	//il parametro 'stato' si riferisce allo stato che deve avere il curriculum per la ricerca nel database
	//il valore di ritorno � 'arrayRisultato' che � un arrai contenente i curricula ricercati nel database. Questo 'arrayRisultato' � codificato in json tramite la funzione 'json_encode'
	
	public function getCurriculum($corso, $annoAccademico, $stato="Pubblicato"){
		$query="SELECT DISTINCT Nome_Curriculum FROM Regolamento WHERE Anno_accademico='".$annoAccademico."' AND Corso='".$corso."' AND Stato='".$stato."'";
		$risultatoQuery=$this->database->eseguiQuery($query);
		$arrayRisultato=array();
		if($risultatoQuery->num_rows!=0){
			while($risultato=$risultatoQuery->fetch_row()){
				$arrayRisultato[]=$risultato[0];
			}
		return json_encode($arrayRisultato);
		}
	}
	
	//funzione che restituisce un array convertito in stringa tramite l'utilizzo della funzione 'json_encode' che rappresenta l'elenco di tutti i curricula presenti nel database per cui pu� essere eseguita una modifica
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'annoAccademico' si riferisce all'anno accademico del regolamento che si vuole modificare, nel formato: 'yyyy-yyyy'
	//il valore di ritorno � 'arrayRisultato' che � un arrai contenente i curricula ricercati nel database. Questo 'arrayRisultato' � codificato in json tramite la funzione 'json_encode'
	public function getCurriculumDaModificare($corso, $annoAccademico){
		$query="SELECT DISTINCT Nome_Curriculum FROM Regolamento WHERE Anno_accademico='".$annoAccademico."' AND Corso='".$corso."' AND Stato='Draft' OR Stato='Completo'";
		$risultatoQuery=$this->database->eseguiQuery($query);
		$arrayRisultato=array();
		if($risultatoQuery->num_rows!=0){
			while($risultato=$risultatoQuery->fetch_row()){
				$arrayRisultato[]=$risultato[0];
			}
		return json_encode($arrayRisultato);
		}
	}
    
	//funzione che memorizza tutti gli insegnamenti di un regolamento che si vuole modificare all'interno di variabili di sessione, in modo da poter successivamente modificare il regolamento desiderato
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'annoAccademico' si riferisce all'anno accademico del regolamento che si vuole modificare, nel formato: 'yyyy-yyyy'
	//il parametro 'curriculum' si riferisce al nome del curriculum che si vuole modificare
	public function modificaRegolamento($corso, $annoAccademico, $curriculum){
		$curr=strtoupper($curriculum);
		$query="SELECT i.Matricola_Insegnamento, i.Denominazione, i.Tipologia_Attivita, i.Tipologia_Lezione, i.Corso, i.Modulo, i.SSD, i.CFU_Laboratorio, i.CFU_Frontali, i.Tot_Ore, r.Anno_Corso, r.CFUOpzionali FROM Insegnamento AS i, Regolamento AS r, Formato AS f WHERE r.ID=f.ID_Regolamento AND i.Matricola_Insegnamento=f.Matricola_Insegnamento AND r.Corso='".$corso."' AND r.Anno_accademico='".$annoAccademico."' AND r.Nome_Curriculum='".$curr."' AND f.Obbligatorio_Opzionale='0'";
		$risultatoQuery=$this->database->eseguiQuery($query);
		if(isset($_SESSION["idInsegnamenti".$curr]))
			$idInsegnamenti[]=json_decode($_SESSION["idInsegnamenti".$curr], true);
		
		

		while($ins=$risultatoQuery->fetch_row()){
			$somma=intval($ins[7])+intval($ins[8]);
			$nomeAnnoObbligatorio=$curr."obbligatorioAnno".$ins[10];
			if(!isset($_SESSION['CFUOpzionale'.$curr.'Anno'.$ins[10]]))
				$_SESSION['CFUOpzionale'.$curr.'Anno'.$ins[10]]=$ins[11];
			$annoObbligatorio[$nomeAnnoObbligatorio][]=array("annoCorso"=>$ins[10],
									   "ID"=>$ins[0],
									   "Denominazione"=>$ins[1],
									   "SSD"=>$ins[6],
									   "TipologiaLezione"=>$ins[3],
									   "CFUFrontale"=>$somma,
									   "DurataCorso"=>$ins[9],
									   "Modulo"=>$ins[5],
									   "TipologiaAttivitaFormativa"=>$ins[2]);
			$idInsegnamenti[]=$ins[0];
		}
	
		$query="SELECT i.Matricola_Insegnamento, i.Denominazione, i.Tipologia_Attivita, i.Tipologia_Lezione, i.Corso, i.Modulo, i.SSD, i.CFU_Laboratorio, i.CFU_Frontali, i.Tot_Ore, r.Anno_Corso, r.CFUOpzionali FROM Insegnamento AS i, Regolamento AS r, Formato AS f WHERE r.ID=f.ID_Regolamento AND i.Matricola_Insegnamento=f.Matricola_Insegnamento AND r.Corso='".$corso."' AND r.Anno_accademico='".$annoAccademico."' AND r.Nome_Curriculum='".$curr."' AND f.Obbligatorio_Opzionale='1'";
		$risultatoQuery=$this->database->eseguiQuery($query);

		while($ins=$risultatoQuery->fetch_row()){
			if(!isset($_SESSION['CFUOpzionale'.$curr.'Anno'.$ins[10]]))
				$_SESSION['CFUOpzionale'.$curr.'Anno'.$ins[10]]=$ins[11];
			$somma=intval($ins[7])+intval($ins[8]);
			$nomeAnnoOpzionale=$curr."opzionaleAnno".$ins[10];
			$annoOpzionale[$nomeAnnoOpzionale][]=array("annoCorso"=>$ins[10],
									   "ID"=>$ins[0],
									   "Denominazione"=>$ins[1],
									   "SSD"=>$ins[6],
									   "TipologiaLezione"=>$ins[3],
									   "CFUFrontale"=>$somma,
									   "DurataCorso"=>$ins[9],
									   "Modulo"=>$ins[5],
									   "TipologiaAttivitaFormativa"=>$ins[2]);
			$idInsegnamenti[]=$ins[0];
		}
		
		$_SESSION["idInsegnamenti".$curr]=json_encode($idInsegnamenti);
		
		if($corso=="Laurea")
			$n=3;
		else
			$n=2;
		
		for($i=1;$i<=$n;$i++){
			$nomeAnnoObbligatorio=$curr."obbligatorioAnno".$i;
			$nomeAnnoOpzionale=$curr."opzionaleAnno".$i;
			if(isset($annoObbligatorio[$nomeAnnoObbligatorio]))
				$_SESSION[$nomeAnnoObbligatorio]=json_encode($annoObbligatorio[$nomeAnnoObbligatorio]);
			if(isset($annoOpzionale[$nomeAnnoOpzionale]))
				$_SESSION[$nomeAnnoOpzionale]=json_encode($annoOpzionale[$nomeAnnoOpzionale]);
		}
	}
	
	//questa funzione restituisce il range di cfu corrispondenti alle attivit� formative presenti all'interno del database
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'annoAccademico' si riferisce all'anno accademico del regolamento che si vuole modificare, nel formato: 'yyyy-yyyy'
	//il parametro 'attivita_formativa' si riferisce all'attivit� formativa per cui si vuole conoscere il range di cfu(minimo e massimo)
	//il valore di ritorno � 'cfu' che � un array contenente il range dei cfu (minimo-massimo) presenti nel database, rappresentati come stringa
    public function getRangeCfuAttivita($annoAccademico,$attivita_formativa,$corso='Laurea'){
    	$cfu=array();
        $query="SELECT CFU_min, CFU_max FROM Ordinamento join Possiede on Ordinamento.ID=ID_Ordinamento Join Suddivisione on ID_Suddivisione=Suddivisione.ID WHERE Anno_accademico='$annoAccademico' AND Corso='$corso' AND Attivita_formativa='$attivita_formativa'";
		$risultatoQuery=$this->database->eseguiQuery($query);
        if($corso=="Laurea"){
        	$cfuTotMin=0;
        	$cfuTotMax=0;
        	while($risultato=$risultatoQuery->fetch_row()){
        			$cfuTotMin+=intval($risultato[0]);
        			$cfuTotMax+=intval($risultato[1]);
            		$cfu[]="$risultato[0].$risultato[1]";
        	}
        	$cfu["cfuTotMin"]=$cfuTotMin;	
        	$cfu["cfuTotMax"]=$cfuTotMax;
        }
        else{
              while($risultato=$risultatoQuery->fetch_row())
                  $cfu[]="$risultato[0].$risultato[1]";
        }
        return $cfu;
    }
    
	//questa funzione restituisce gli ssd (settore sceintifico disciplinare) presenti all'interno del database
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'annoAccademico' si riferisce all'anno accademico del regolamento che si vuole modificare, nel formato: 'yyyy-yyyy'
	//il parametro 'tipologia' si riferisce 
    public function getSSD($annoAccademico,$tipologia,$ambito,$corso='Laurea'){
        $ssd=array();
        $query="";
        if($tipologia=="di base")
        	$query="SELECT Composto.SSD FROM Ordinamento join Possiede on Ordinamento.ID=ID_Ordinamento Join Suddivisione on ID_Suddivisione=Suddivisione.ID Join Composto on Suddivisione.ID=Composto.ID_Suddivisione Join Settore on Composto.SSD=Settore.SSD WHERE Anno_accademico='$annoAccademico' AND Corso='$corso' AND Attivita_formativa='di base' AND Ambiti_disciplinari='Matematico-Fisico' OR Ambiti_disciplinari='Informatica'";
		elseif($tipologia=="Affini e integrative")
        	$query="SELECT Composto.SSD FROM Ordinamento join Possiede on Ordinamento.ID=ID_Ordinamento Join Suddivisione on ID_Suddivisione=Suddivisione.ID Join Composto on Suddivisione.ID=Composto.ID_Suddivisione Join Settore on Composto.SSD=Settore.SSD WHERE Anno_accademico='$annoAccademico' AND Corso='$corso' AND Attivita_formativa='$tipologia'";
        else
        	$query="SELECT Composto.SSD FROM Ordinamento join Possiede on Ordinamento.ID=ID_Ordinamento Join Suddivisione on ID_Suddivisione=Suddivisione.ID Join Composto on Suddivisione.ID=Composto.ID_Suddivisione Join Settore on Composto.SSD=Settore.SSD WHERE Anno_accademico='$annoAccademico' AND Corso='$corso' AND Attivita_formativa='$tipologia' AND Ambiti_disciplinari='$ambito'";

        $risultatoQuery=$this->database->eseguiQuery($query);
        while($risultato=$risultatoQuery->fetch_row())
            $ssd[]="$risultato[0]";
        return $ssd;
    }
    
	//questa funzione rende lo stato di un regolamento "Pubblicato", un regolamento per poter essere pubblicato deve aver passato una serie di controlli che sono presenti all'interno di un'altra funzione
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'curr' si riferisce al nome del curriculum che si vuole pubblicare
	//il valore di ritorno � '0' che indica che l'operazione � andata a buon fine
    public function pubblicaRegolamento($curr,$corso){
    	$query='UPDATE Regolamento SET Stato="Pubblicato" WHERE Nome_Curriculum="'.$curr.'" AND Stato="Completo" AND Corso="'.$corso.'"';
        $this->database->eseguiQuery($query);
        return 0;
    }
    
    
    
    
    //questa funzione verifica l'esistenza di un curriculum all'interno del database e restituisce 0 se il curriculum cercato non esiste, altrimenti restituisce il valore -1
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'annoAccademico' si riferisce all'anno accademico del regolamento che si vuole cercare
	//il parametro 'curriculum' si riferisce al nome del curriculum che si vuole cercare 
	//il valore di ritorno � '-1' se non esiste il curriculum cercato all'interno del database oppure '0' se il curriculum esiste
    public function isExist($annoAccademico,$curriculum,$corso){
    	$query="Select * FROM Regolamento WHERE Anno_accademico='".$annoAccademico."' AND Corso='".$corso."' AND Nome_Curriculum='".$curriculum."'";
        $risultatoQuery=$this->database->eseguiQuery($query);
        if($risultatoQuery->num_rows!=0)
    		return -1;
        return 0;
    
    }
    
	//questa funzione restituisce un regolamento presente all'interno del database
	//il parametro 'corso' si rifersce al tipo di corso: Laurea o laurea magistrale.
	//il parametro 'annoAccademico' si riferisce all'anno accademico del regolamento che si vuole cercare
	//il parametro 'curriculum' si riferisce al nome del curriculum che si vuole cercare 
	//il valore di ritorno � 'arrayRisultato' che � un arrai contenente gli insegnamenti che formano il regolamento ricercato nel database.
	public function getRegolamento($corso, $curriculum, $annoAccademico, $annoCorso,$stato="Pubblicato"){
		$query="SELECT i.Denominazione, i.SSD, i.Tipologia_Lezione, i.CFU_Frontali, i.CFU_Laboratorio, i.Tot_Ore, i.Modulo, i.Tipologia_Attivita, f.Obbligatorio_Opzionale FROM Regolamento AS r, Formato AS f, Insegnamento AS i WHERE r.ID=f.ID_Regolamento AND i.Matricola_Insegnamento=f.Matricola_Insegnamento AND Anno_accademico='".$annoAccademico."' AND i.Corso='".$corso."' AND r.Nome_Curriculum='".$curriculum."' AND r.Anno_Corso='".$annoCorso."' AND Stato='".$stato."'";
		$risultatoQuery=$this->database->eseguiQuery($query);
			while($risultato=$risultatoQuery->fetch_row()){
				$arrayRisultato[]=array("insegnamento"=>new Insegnamento($risultato[0], $risultato[1], $risultato[7], $risultato[6], $risultato[3], $risultato[4], $risultato[2], "", 0, 0), "Obbligatorio_Opzionale"=>$risultato[8]);
			}
			return $arrayRisultato;
	}
	
	//elimina un insegnamento dall'array degli insegnamenti che devono essere associato ad un dato curriculum
	//il parametro 'id' si riferisce all'id dell'insegnamneto da eliminare
	//il parametro 'nomeSessione" si riferisce al nome della sessione in cui � memorizzato l'array contenente gli insegnamenti
	//il parametro 'curr' si riferisce al nome del curriculum da cui si vuole eliminare un insegnamento
	public function eliminaInsegnamento($id, $nomeSessione, $curr){
		$idInsegnamenti=json_decode($_SESSION["idInsegnamenti".$curr], true);
		$arrayInsegnamenti=json_decode($_SESSION[$nomeSessione], true);
		
		for($i=0; $i<count($idInsegnamenti); $i++){
			if($idInsegnamenti[$i]!=$id){
				$idInsegnamentiTemp[]=$idInsegnamenti[$i];
			}
		}
		
		for($i=0; $i<count($arrayInsegnamenti); $i++){
			if($arrayInsegnamenti[$i]["ID"]!=$id)
				$arrayInsegnamentiTemp[]=$arrayInsegnamenti[$i];
		}
		
		$_SESSION["idInsegnamenti".$curr]=json_encode($idInsegnamentiTemp);
		$_SESSION[$nomeSessione]=json_encode($arrayInsegnamentiTemp);
	}
	
	//questa funzione controlla che tutti i vincoli del regolamento che si vuole memorizzare siano rispettate e restituisce una serie di errori qualora quei vincoli non siano stati rispettati
	//il parametro 'curr' si riferisce al nome del curriculum che si vuole controllare
	//il parametro 'corso' si riferisce al tipo di corso (laurea o laurea magistrale)
	//il parametro 'tipologiaAttivita'
	//il parametro 'anno' si riferisce 
	public function controllaRegolamento($curr, $corso,$tipologiaAttivita, $anno, $ambito, $tipologiaAttivitaInsegnamento){

		if ($corso=="Laurea")
			$n=3;
		else
			$n=2;
		
		$contaCFU=0;
        $range=$this->getRangeCfuAttivita($anno, $tipologiaAttivita, $corso);
		$ssdTrovati=$this->getSSD($anno, $tipologiaAttivita, $ambito, $corso);
        $rangeCFU=explode(".", $range[0]);

        if($tipologiaAttivitaInsegnamento=="Base Mat" || $tipologiaAttivitaInsegnamento=="Caratterizzante Inf" || $tipologiaAttivitaInsegnamento=="Affine")
        	$rangeCFU=explode(".", $range[0]);
        elseif($tipologiaAttivitaInsegnamento=="Base Inf")
        	$rangeCFU=explode(".", $range[1]);


        for($i=1;$i<=$n;$i++){
			$annoObbligatorio=strtoupper($curr)."obbligatorioAnno".$i;
			$arrayInsegnamenti=json_decode($_SESSION[$annoObbligatorio], true);
           
			foreach($arrayInsegnamenti as $insegnamento){
					if(in_array($insegnamento["SSD"],$ssdTrovati) && strcmp($insegnamento["TipologiaAttivitaFormativa"],$tipologiaAttivitaInsegnamento)==0)
						$contaCFU+=intval($insegnamento["CFUFrontale"]);
			}
       }
       if($contaCFU>=intval($rangeCFU[0]) && $contaCFU<=intval($rangeCFU[1]))
			return "1.$contaCFU";
        else
        	return "0.$contaCFU.$rangeCFU[0].$rangeCFU[1]";
	}
	
    //Questo metodo restituisce i messaggi inerenti agli errori che si verificano nella compilazione del regolamento
    //Il parametro curr indica il curriculum
    //Il parametro anno indica l'anno accademico del regolamento
    //Il parametro corso indica il corso selezionato
	public function controllaRegolamentoPerAmbito($curr, $anno, $corso){
		$controllo="";
        $annoAcc="";
        $risultatoQuery=$this->database->eseguiQuery("SELECT MAX(Anno_accademico) FROM Ordinamento")->fetch_row();
		$anno=$risultatoQuery[0];
		$cfuTot=0;
        
        if($corso=="Laurea"){
			$num=3;
        	$baseMat=explode(".",$this->controllaRegolamento($curr, $corso,"di base", $anno, "Matematico-Fisico","Base Mat"));
            $baseInf=explode(".",$this->controllaRegolamento($curr, $corso,"di base", $anno, "Informatica","Base Inf"));
            $carInf=explode(".",$this->controllaRegolamento($curr, $corso,"Caratterizzanti", $anno, "Informatica","Caratterizzante Inf"));
            $affine=explode(".",$this->controllaRegolamento($curr, $corso,"Affini e integrative", $anno, "Informatica","Affine"));
            
            if(intval($baseMat[0])==0)
				$controllo.="Vincoli non rispettati nell'ambito di base matematico-fisico:\nTOTALE CFU $baseMat[1] -- MIN:$baseMat[2] - MAX:$baseMat[3]\n";
            else
            	$cfuTot+=$baseMat[1];
            if(intval($baseInf[0])==0)
				$controllo.="Vincoli non rispettati nell'ambito di base informatica:\nTOTALE CFU $baseInf[1] -- MIN:$baseInf[2] - MAX:$baseInf[3]\n";
            else
            	$cfuTot+=$baseInf[1];
            if(intval($carInf[0])==0)
				$controllo.="Vincoli non rispettati nell'ambito caratterizzante informatico:\nTOTALE CFU $carInf[1] -- MIN:$carInf[2] - MAX:$carInf[3]\n";
            else
            	$cfuTot+=$carInf[1];
            if(intval($affine[0])==0)
				$controllo.="Vincoli non rispettati nell'ambito affine e integrativo informatico:\nTOTALE CFU $affine[1] -- MIN:$affine[2] - MAX:$affine[3]\n";
            else{
            	$cfuTot+=$affine[1];  
                
                $cfuTot+=$this->getCFUOpzionali(3,$curr);
                $s=$this->getRangeCfuAttivita($anno,"A scelta dello studente");
                $scelta=explode(".",$s[0]);
                $t=$this->getRangeCfuAttivita($anno,"Tirocinio");
                $tirocinio=explode(".",$t[0]);
                $p=$this->getRangeCfuAttivita($anno,"Prova Finale");
                $provaFinale=explode(".",$p[0]);
                $i=$this->getRangeCfuAttivita($anno,"Lingua Inglese");
                $inglese=explode(".",$i[0]);

                $cfuTot+=intval($scelta[0])+intval($tirocinio[1])+intval($provaFinale[0])+intval($inglese[0]);
				
                if($cfuTot<180)
                    $controllo.="Il totale dei CFU non risulta maggiore o uguale di 180!\nTOTALE CFU REGOLAMENTO $cfuTot";}
       }else{
		   $num=2;
      		$carInf=explode(".",$this->controllaRegolamento($curr, $corso,"Caratterizzanti", $anno, "Discipline Informatiche","Caratterizzante Inf"));
       		$affine=explode(".",$this->controllaRegolamento($curr, $corso,"Affini", $anno, "Attivita formative affini o integrative","Affine"));

       		if(intval($carInf[0])==0)
				$controllo.="Vincoli non rispettati nell'ambito caratterizzante informatico:\nTOTALE CFU $carInf[1] -- MIN:$carInf[2] - MAX:$carInf[3]\n";
            else
            	$cfuTot+=$carInf[1];
      	 	if(intval($affine[0])==0)
				$controllo.="Vincoli non rispettati nell'ambito affine e integrativo informatico:\nTOTALE CFU $affine[1] -- MIN:$affine[2] - MAX:$affine[3]\n";
            else{
            	$cfuTot+=$affine[1];
                $cfuTot+=$this->getCFUOpzionali(2,$curr);
                $s=$this->getRangeCfuAttivita($anno,"A scelta dello studente","Magistrale");
                $scelta=explode(".",$s[0]);
                $p=$this->getRangeCfuAttivita($anno,"Prova Finale","Magistrale");
                $provaFinale=explode(".",$p[0]);
                $a=$this->getRangeCfuAttivita($anno,"Ulteriori attivit&agrave formative (art. 10, comm 5, lettera","Magistrale");
                $attivita=explode(".",$a[0]);

                $cfuTot+=intval($scelta[0])+intval($provaFinale[0])+intval($attivita[0]);

                if($cfuTot<120)
                    $controllo="Il totale dei CFU non risulta maggiore o uguale di 120!\nTOTALE CFU REGOLAMENTO $cfuTot";}
       }
	   
	   for($i=1;$i<=$num;$i++){
		   $res=$this->getCFUOpzionaliPerAnno($curr, $i);
		   if($res["totCFU"]<$res["maxCFU"])
			   $controllo.="La somma dei cfu degli insegnamenti facoltativi per l'anno ".$i." e' inferiore al numero massimo di cfu facoltativi(".$res["maxCFU"]." CFU)";
	   }
	   
       return $controllo;
	}
	
	//questa funzione restituisce un array associativo che contiene il numero di cfu facoltativi per un dato anno di corso e il totale di cfu che si pu� ottenere sommando i cfu degli insegnamenti facoltativi assegnati a quell'anno
	//il parametro 'curr' si riferisce al nome del curriculum per cui devono essere calcolati i cfu
	//il parametro 'anno' si riferisce all'anno di corso per cui devono essere calcolati i cfu
	//il valore di ritorno � 'result' che corrisponde ad un array che contiene il numero di cfu facoltativi per un dato anno di corso e il totale di cfu che si pu� ottenere sommando i cfu degli insegnamenti facoltativi assegnati a quell'anno
	public function getCFUOpzionaliPerAnno($curr, $anno){
		if(isset($_SESSION['CFUOpzionale'.strtoupper($curr).'Anno'.$anno]))
			$maxCFU=intval($_SESSION['CFUOpzionale'.strtoupper($curr).'Anno'.$anno]);
		else
			$maxCFU=0;
		
		if(isset($_SESSION[strtoupper($curr)."opzionaleAnno".$anno])){
			$elencoInsegnamenti=json_decode($_SESSION[strtoupper($curr)."opzionaleAnno".$anno], true);
		
			$totCFU=0;
			foreach($elencoInsegnamenti as $ins){
				$totCFU+=intval($ins["CFUFrontale"]);
			}
		}
		else
			$totCFU=0;
		
		$result["totCFU"]=$totCFU;
		$result["maxCFU"]=$maxCFU;
		
		return $result;
	}
	
	//questa funzione restituisce la sommatoria del numero di cfu opzionali per un dato curriculum
	//il parametro 'n' indica gli anni di corso (3 per la laurea e 2 per la laurea magistrale)
	//il parametro 'curr' indica il curriculum per cui si vuole calcolare la sommatoria dei cfu facoltativi
	//il valore di ritorno � 'cfuTot' che restituisce la sommatoria del numero di cfu opzionali per un dato curriculum
    public function getCFUOpzionali($n,$curr){
        $i=0;
        $cfuTot=0;
        for($i=1;$i<=$n;$i++){
			$cfuTot+=intval($_SESSION['CFUOpzionale'.strtoupper($curr).'Anno'.$i]);
        }
        return $cfuTot;
    }
    
	//questa funzione salva all'interno del database gli insegnamenti che sono stati assegnati ad un regolamento ed elimina dalla memoria l'elenco degli insegnamenti una volta che essi sono stati salvati
	//il parametro 'curr' indica il nome del curriculum per cui devono essere memorizzati gli insegnamenti
	//il parametro 'anno' indica l'anno accademico a cui corrisponde il regolamento
	//il parametro 'corso' rappresenta il tipo di corso per cui si vuole memorizzare il regolamento
	//il parametro 'stato' indica lo stato con cui si deve memorizzare un regolamento
	
	public function salvaRegolamento($curr, $anno, $corso, $stato){
		if ($corso=="Laurea")
			$n=3;
		else
			$n=2;
		
		$annoAccademico=$anno."-".($anno+1);
		
		for($i=1;$i<=$n;$i++){
			$cfuOpzionali=$_SESSION['CFUOpzionale'.$curr."Anno".$i];
            if(intval($cfuOpzionali)>0)
				$query="INSERT INTO Regolamento (Corso, Anno_accademico, Nome_Curriculum, CFUOpzionali, Anno_Corso, Stato) VALUES ('$corso', '$annoAccademico', '$curr', $cfuOpzionali, $i, '$stato')";
			else
            	$query="INSERT INTO Regolamento (Corso, Anno_accademico, Nome_Curriculum, CFUOpzionali, Anno_Corso, Stato) VALUES ('$corso', '$annoAccademico', '$curr', 0, $i, '$stato')";
            
            $risultatoQuery=$this->database->eseguiQuery($query);

			$query="SELECT ID FROM Regolamento WHERE Corso='$corso' AND Anno_accademico='$annoAccademico' AND Nome_Curriculum='$curr' AND Anno_Corso=$i";
			$risultato=$this->database->eseguiQuery($query);
            while($result=$risultato->fetch_row())
				$idRegolamento=$result[0];
                
			$annoObbligatorio=$curr."obbligatorioAnno".$i;
            
			if(isset($_SESSION[$annoObbligatorio])){
				$arrayInsegnamenti=json_decode($_SESSION[$annoObbligatorio], true);
				foreach($arrayInsegnamenti as $insegnamento){
					$query="INSERT INTO Formato (Matricola_Insegnamento, ID_Regolamento, Obbligatorio_Opzionale) VALUES (".$insegnamento["ID"].", $idRegolamento, '0')";
					$risultatoQuery=$this->database->eseguiQuery($query);
				}
				unset($_SESSION[$annoObbligatorio]);
			}
            
			$annoOpzionale=$curr."opzionaleAnno".$i;
			if(isset($_SESSION[$annoOpzionale])){
				$arrayInsegnamenti=json_decode($_SESSION[$annoOpzionale], true);
				foreach($arrayInsegnamenti as $insegnamento){
					$query="INSERT INTO Formato (Matricola_Insegnamento, ID_Regolamento, Obbligatorio_Opzionale) VALUES (".$insegnamento["ID"].", $idRegolamento, '1')";
					$risultatoQuery=$this->database->eseguiQuery($query);
				}
				unset($_SESSION[$annoOpzionale]);
			}
			unset($_SESSION['CFUOpzionale'.strtoupper($curr).'Anno'.$i]);
       }
	}
}

if(isset($_POST["funzione"])){
	$gestioneRegolamento=new GestioneRegolamento();
    $annoIniziale=substr(date("Y"),0,2);
   	$annoFinale=intval(substr(date("Y"),2,4));
    $anno=$annoIniziale.$annoFinale."-".$annoIniziale.($annoFinale+1);

	switch($_POST["funzione"]){
		case "cercacurriculum":
			echo $gestioneRegolamento->getCurriculum($_POST["corso"], $_POST["annoAccademico"]);
		break;
        
		case "cercaCurriculumDaModificare":
			echo $gestioneRegolamento->getCurriculumDaModificare($_POST["corso"], $_POST["annoAccademico"]);
		break;
		
        case "regolamentoEsistente":
        	echo $gestioneRegolamento->isExist($anno,$_POST["curr"],$_POST["corso"]);
        break;
        
        case "controllaRegolamento":
			echo $gestioneRegolamento->controllaRegolamentoPerAmbito($_POST["curr"], $_POST["annoBase"], $_POST["corso"]);
        break;
		
		case "salvaRegolamento":
            $gestioneRegolamento->salvaRegolamento(strtoupper($_POST["curr"]), $_POST["annoBase"], $_POST["corso"], $_POST["stato"]);
        break;
        
        case "cercaCurriculum":
            echo $gestioneRegolamento->getCurriculum($_POST["corso"],$anno,"Completo");
        break;
        
        case "cercaRegolamentoCompletato":
            if($_POST["corso"]=="Laurea")
            	carica(3,"Laurea",$_POST["curriculum"],$anno,$gestioneRegolamento);
            elseif($_POST["corso"]=="Magistrale")
            	carica(2,"Laurea Magistrale",$_POST["curriculum"],$anno,$gestioneRegolamento);
        break;
        
        case "pubblicaRegolamento":
        	$curr=$_POST["curr"];
            $corso=$_POST["corso"];
            echo $gestioneRegolamento->pubblicaRegolamento($curr,$corso);
        break;
		
		case "modificaRegolamento":
            $gestioneRegolamento->modificaRegolamento($_POST["corso"], $_POST["annoAccademico"], $_POST["curriculum"]);
        break;
		
		case "eliminainsegnamento":
			$gestioneRegolamento->eliminaInsegnamento($_POST["id"], $_POST["nomeSessione"], $_POST["curr"]);
		break;
	}
    
    
}

	function carica($anno,$corso,$curriculum,$annoAccademico,$gestioneRegolamento)
    {
		for($i=1;$i<=$anno;$i++){
								$regolamento=$gestioneRegolamento->getRegolamento($corso, $curriculum, $annoAccademico, $i, "Completo");
								$cfuRegolamento=array();
								echo '
									<h3 style="text-align: center"> Anno '.$i.'</h3>
									<p>
										<form action="" method="get">
											<table align="center" class="table table-bordered table-striped"><tr>
												<td>
													<label>Insegnamenti Obbligatori</label>
												</td>
											</tr></table>
										</form>
									</p>
									<div class="box-body">
										  <table name="tab'.$i.'" id="example2" class="table table-bordered table-hover datatables">
											<thead>
											  <tr>
												<th>Denominazione</th>
												<th>SSD</th>
												<th>Tipologia Attivit&agrave</th>
												<th>CFU</th>
												<th>Ore</th>
												<th>Modulo</th>
												<th>Tipologia Attivit&agrave Formativa</th>
												<th>Obbligatorio/Opzionale</th>
											  </tr>
											</thead>
											<tbody>';
											foreach($regolamento as $value){
												if($value["Obbligatorio_Opzionale"]==0){
													$ins=$value["insegnamento"];
													echo '<tr><td>'.$ins->getDenominazione().'</td><td>'.$ins->getSSD().'</td><td>'.$ins->getTipologiaLezione().'</td><td>'.($ins->getCfuFrontale()+$ins->getCFULaboratorio()).'</td><td>'.$ins->getDurataCorso().'</td><td>'.$ins->getModulo().'</td><td>'.$ins->getTipologiaAttivitaFormativa().'</td><td>Obbligatorio</td></tr>';
												}
												else{
													$regolamentoOpzionale["cfu".$value["CFU"]][]=$value;
													if(!in_array($value["CFU"], $cfuRegolamento)){
														$cfuRegolamento[]=$value["CFU"];
													}
												}	
											}
											echo '</tbody>
											<tfoot></tfoot>
										  </table>
										</div>
									<section class="col-lg-12">&nbsp</section>
									';
		//BISOGNA SOSTITUIRE IL NUMERO DI CFU NELL'INTESTAZIONE DELLA TABELLA
								sort($cfuRegolamento);
								for($j=0;$j<count($cfuRegolamento);$j++){
										echo '<p>
												<form action="" method="get">
													<table align="center" class="table table-bordered table-striped"><tr>
														<td>
															<label>Insegnamenti Opzionali '.$cfuRegolamento[$j].' CFU a scelta tra:</label>
														</td>
													</tr></table>
												</form>
											</p>
											<div class="box-body">
												  <table name="tabOpz'.$i.'" id="example2" class="table table-bordered table-hover datatables">
													<thead>
													  <tr>
														<th>Denominazione</th>
														<th>SSD</th>
														<th>Tipologia Attivit&agrave</th>
														<th>CFU</th>
														<th>Ore</th>
														<th>Modulo</th>
														<th>Tipologia Attivit&agrave Formativa</th>
														<th>Obbligatorio/Opzionale</th>
													  </tr>
													</thead>
													<tbody>';
													foreach($regolamentoOpzionale["cfu".$cfuRegolamento[$j]] as $value){
														$ins=$value["insegnamento"];
														echo '<tr><td>'.$ins->getDenominazione().'</td><td>'.$ins->getSSD().'</td><td>'.$ins->getTipologiaLezione().'</td><td>'.($ins->getCfuFrontale()+$ins->getCFULaboratorio()).'</td><td>'.$ins->getDurataCorso().'</td><td>'.$ins->getModulo().'</td><td>'.$ins->getTipologiaAttivitaFormativa().'</td><td>Opzionale</td></tr>';
													}
													echo '</tbody>
													<tfoot></tfoot>
												  </table>
												</div>
										<section class="col-lg-12">&nbsp</section>
										<section class="col-lg-12">&nbsp</section>';
								}
							}
					}

?>