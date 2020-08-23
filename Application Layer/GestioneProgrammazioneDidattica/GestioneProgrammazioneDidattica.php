<?php

if (!isset($_SESSION))
    session_start();


	/**
	 *GestioneProgrammazioneDidattica
	 *
	 *Questa classe gestisce tutte le operazioni relative a Programmazione Didattica
	 *
	 *Author: Alessandro Kevin Barletta, Edoardo Carpentiero, Stefano Cirillo, Gianmarco Mucciariello
	 *Version : 1.0
	 *2015 - Copyright by Pr.D Project - University of Salerno
	 
	 */
require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');
require_once(dirname(__DIR__,2).'\Application Layer\GestioneInsegnamenti\Insegnamento.php');
require_once(dirname(__DIR__,2).'\Application Layer\GestioneDocenti\Docente.php');
include("Associa.php");
include("ProgrammazioneDidattica.php");

class GestioneProgrammazioneDidattica{
	private $database;
	private $matricolaDocenteFittizio;
	public function __construct(){
		$this->database=new Database();
		$this->database->connettiDB();
        $this->matricolaDocenteFittizio="201515200";
	}
    
    //Questa funzione preleva ogni volta un record della tabella e lo inserisce nel DB
    //il parametro $progD è identificativo della programmazione didattica
    //il paramentro $associa contiene l'id dell'insegnamento e l'id del docente
    //non restituisce nessun valore
    public function CreaProgD($progD, $associa)
    {
    		$num=0;
            $vers = 0;
            $ultIDdb = 0;
            $query="SELECT ID FROM Programmazione_Didattica ORDER BY ID";
    		$result = $this->database->eseguiQuery($query);
            while($row = mysqli_fetch_array($result))
                $ultIDdb = $row['ID'];
                //echo $ultIDdb.'>>>>>>>>'.$_SESSION['IDprogD'].'<br>';
            if($ultIDdb == $_SESSION['IDprogD'])
            {}
            else
            {
    			$query="SELECT Versione FROM Programmazione_Didattica WHERE Anno_corso='".$progD->getAnnoCorso()."' AND Anno_Accademico='".$progD->getAnnoAccademico()."'
            	AND Corso='".$progD->getCorso()."' AND Semestre='".$progD->getSemestre()."'  ORDER BY Versione ";
    			$risultatoQuery = $this->database->eseguiQuery($query);
                	while($row = mysqli_fetch_array($risultatoQuery))
                	{
                		$num+=1;
                    	$vers = $row['Versione'];
                	}
                    
            if($num!=0){
    			$query="INSERT INTO Programmazione_Didattica (ID,Anno_corso, Corso, Semestre, Tot_OreLab, Tot_OreTeoria, Anno_Accademico, Versione, Stato, ID_Regolamento) 
        		VALUES (".$_SESSION['IDprogD'].",".$progD->getAnnoCorso().",'".$progD->getCorso()."',".$progD->getSemestre().",".$progD->getTotOreLab().",".$progD->getTotOreTeoria().",'".$progD->getAnnoAccademico()."',($vers+1),'Draft',".$progD->getIDRegolamento().")";
           		
            }
            else {
            	$query="INSERT INTO Programmazione_Didattica (ID,Anno_corso, Corso, Semestre, Tot_OreLab, Tot_OreTeoria, Anno_Accademico, Versione, Stato, ID_Regolamento) 
        		VALUES (".$_SESSION['IDprogD'].",".$progD->getAnnoCorso().",'".$progD->getCorso()."',".$progD->getSemestre().",".$progD->getTotOreLab().",".$progD->getTotOreTeoria().",'".$progD->getAnnoAccademico()."',1,'Draft',".$progD->getIDRegolamento().")";
            }
    		$this->database->eseguiQuery($query);
           }//fine if  
        
        $query="SELECT * FROM Associa WHERE Matricola_Insegnamento='".$associa->getInsegnamento()."' AND Classe='".$associa->getClasse()."' AND ID_ProgDid='".$_SESSION['IDprogD']."' AND Matricola_Professore='".$associa->getDocente()."'
         AND Ore_Teoria=".$associa->getOreTeoria()." AND Ore_Lab=".$associa->getOreLab()." ";
           $result = $this->database->eseguiQuery($query);
           $assEsiste=0;
           while($row = mysqli_fetch_array($result))
                	$assEsiste +=1;
           if($assEsiste == 0)
            { 
				$query="INSERT INTO Associa (Matricola_Insegnamento,Classe, ID_ProgDid, Matricola_Professore, Ore_Teoria, Ore_Lab, status) 
        		VALUES ('".$associa->getInsegnamento()."','".$associa->getClasse()."','".$_SESSION['IDprogD']."','".$associa->getDocente()."','".$associa->getOreTeoria()."','".$associa->getOreLab()."','".$associa->getStatus()."')";
                $this->database->eseguiQuery($query);
		   }
    }
	
    //questo metodo restituisce i curriculum pubblicati per poter creare la programmazione didattica
    //il parametro $corso contiene il tipo di corso "laurea" "laurea magistrale"
    //il parametro $annoAccademico contiene l'anno accademico del curriculum
    //restituisce una lista di curriculum pubblicati
	public function getCurriculum($corso, $annoAccademico, $annoCorso){
		$query="SELECT Nome_Curriculum,ID FROM Regolamento WHERE Anno_accademico='".$annoAccademico."' AND Corso='".$corso."' AND Stato='Pubblicato' AND Anno_Corso=".$annoCorso."";
        $risultatoQuery=$this->database->eseguiQuery($query);
		if($risultatoQuery->num_rows!=0){
			while($risultato=$risultatoQuery->fetch_row()){
				$arrayRisultato[]="$risultato[0].$risultato[1]";
			}
		return json_encode($arrayRisultato);
		}
	}
    
    //questo metodo restituisce un insieme dei curriculum presenti nel database
    //$annoAcc corrisponde all'anno accademico dei curriculum che si vogliono ottenere
    //$corso indica il corso(Laurea, Laurea Magistrale)
    //$semestre indica il semestre della programmazione didattica che si vuole ottenere
    //restituisce l'insieme dei risultati che sono presenti in $arrayRisultato, codificati in stringa tramite la funzione "json_encode"
    public function getCurriculumProgDid($annoAcc, $corso, $semestre){
		$query='SELECT r.ID,r.Nome_Curriculum FROM Programmazione_Didattica p join Regolamento r on (ID_Regolamento=r.ID) join Associa a on(a.ID_ProgDid=p.ID) join Insegnamento i on (i.Matricola_Insegnamento=a.Matricola_Insegnamento) join Docente d on (a.Matricola_Professore=d.Matricola) 
where p.Semestre="'.$semestre.'" and p.Stato="Draft" and p.Corso = "'.$corso.'" and p.Anno_Accademico = "'.$annoAcc.'" group by r.Nome_Curriculum';
		$risultatoQuery=$this->database->eseguiQuery($query);
		if($risultatoQuery->num_rows!=0){
			while($risultato=$risultatoQuery->fetch_row()){
				$arrayRisultato[]="$risultato[0].$risultato[1]";
			}
		return json_encode($arrayRisultato);
		}
	}
    
    
    //restituisce tutti i docenti presenti nel database
    //$arrayRisultato contiene l'insieme dei docenti presenti nel database
    public function getDocenti(){
    	$query="SELECT Matricola,  Nome, Cognome, SSD, Ruolo FROM Docente";
        $risultatoQuery=$this->database->eseguiQuery($query);
		while($risultato=$risultatoQuery->fetch_row()){
			$arrayRisultato[]=new Docente($risultato[0], $risultato[1], $risultato[2], "", "", "", $risultato[4], $risultato[3], "", "");
		}
		return $arrayRisultato;
    }
	
    //restituisce un insieme di insegnamenti presenti nel database
    //$annoCorso corrisponde all'anno di corso interessato
    //$corso corrisponde al tipo di corso (Laurea, Laurea Magistrale)
    //$curriculum corrisponde al curriculum di cui si vogliono sapere gli insegnamenti
    //$annoAccademico corrisponde all'anno accademico di cui si vogliono conoscere gli insegnamenti
    //viene restituito $arrayRisultato che contiene l'insieme degli insegnamenti che sono stati recuperati dal database
	public function getInsegnamenti($annoCorso,$corso, $curriculum, $annoAccademico){
		$query="SELECT i.Denominazione, i.SSD, i.Tipologia_Lezione, i.CFU_Frontali, i.CFU_Laboratorio, i.Tot_Ore, i.Modulo, i.Tipologia_Attivita, f.Obbligatorio_Opzionale, i.Matricola_Insegnamento FROM Regolamento as r join Formato as f on (r.ID=f.ID_Regolamento) join Insegnamento as i on (i.Matricola_Insegnamento=f.Matricola_Insegnamento) WHERE Anno_accademico='".$annoAccademico."' AND i.Corso='".$corso."' AND r.Nome_Curriculum='".$curriculum."' AND Stato='Pubblicato' AND r.Anno_Corso=$annoCorso";
		$risultatoQuery=$this->database->eseguiQuery($query);
		while($risultato=$risultatoQuery->fetch_row()){
			$arrayRisultato[]=new Insegnamento($risultato[0], $risultato[1], $risultato[7], $risultato[6], $risultato[3], $risultato[4], $risultato[2], $corso, $risultato[5], $risultato[9]);
		}
		return $arrayRisultato;
	}
    

    //salva il nuovo stato della programmazione didattica che viene preso da una variabile di sessione
	public function salvaStato(){
		if(isset($_SESSION["iden"])){
			$max=intval($_SESSION["iden"]);
			for($i=0; $i<=$max; $i++){
				$nome="prog".$i;
				$val=$_SESSION[$nome];
				$var=explode("-", $val);
				if($var[0]!="Scegli"){
					$query="UPDATE Programmazione_Didattica SET Stato='".$var[0]."' WHERE ID='".$var[1]."'";
					$risultatoQuery=$this->database->eseguiQuery($query);
				}
				unset($_SESSION[$nome]);
			}
			unset($_SESSION["iden"]);
		}
	}
	
    //memorizza all'interno di una variabile di sessione il nuovo stato da associare ad una programmazione didattica
    //$nuovoStato indica il nuovo stato da associare ad una determinata programmazione didattica
    //$id corrisponde all'id della programmazione didattica per cui si vuole cambiare lo stato
	public function cambiaStato($nuovoStato, $id){
		if(isset($_SESSION["iden"]))
			$_SESSION["iden"]=intval($_SESSION["iden"])+1;
		else
			$_SESSION["iden"]=0;
		
		$nome="prog".$_SESSION["iden"];
		$_SESSION[$nome]=$nuovoStato."-".$id;
	}
	
    //questo metodo restituisce le proggrammazioni didattiche prensenti nel database
    //restituisce una lista di programmazioni didattiche
	public function getProgrammazioniDidattiche(){
		$query="SELECT ID, Anno_corso, Corso, Semestre, Tot_OreTeoria, Tot_OreLab, Anno_Accademico, Versione, Stato FROM Programmazione_Didattica";
        $risultatoQuery=$this->database->eseguiQuery($query);
		while($risultato=$risultatoQuery->fetch_row()){
			$arrayRisultato[]=new ProgrammazioneDidattica($risultato[0], $risultato[1], $risultato[2], $risultato[3], $risultato[4], $risultato[5], $risultato[6], $risultato[7], $risultato[8],0);
		}
		return $arrayRisultato;
	}
    
    //questo metodo restituisce l'anno accademico di una programmazione didattica in base al corso selezionato
    //$corso contiene il tipo di corso "laurea" "laurea magistrale"
    //restituisce l'anno accademico della programmazione didattica in base a quel corso
    public function getAccademico($corso){
      $query="SELECT distinct Anno_Accademico from Programmazione_Didattica where Corso = '".$corso."'";
      $risultatoQuery=$this->database->eseguiQuery($query);
      $d = '';

      while($risultato=$risultatoQuery->fetch_row()){
          $d .= $risultato[0].",";
      }

      return $d;
	}
    
    //questa funzione restituisce il totale ore fatte di un dato docente per effettuare il controllo durante la creazione della programmazione didattica
    //$matricola indica la matricola del docente di cui si vuole sapere il totale delle ore
    //$ruolo indica il ruolo del docente che si vuole cercare
    //restituisce $ore che corrisponde al totale ore del docente che è stato ricercato
     public function getTotOreProf($matricola,$ruolo){
      $query="SELECT SUM(Ore_Teoria+Ore_Lab) as OreFatte
      FROM Docente d join Associa a on (d.Matricola = a.Matricola_Professore) join Insegnamento i on (i.Matricola_Insegnamento = a.Matricola_Insegnamento)
      where (d.Ruolo = '".$ruolo."') and d.Matricola='".$matricola."'
      group by a.Matricola_professore";
      //return $query;
      $risultatoQuery=$this->database->eseguiQuery($query);
      $ore=0;
      while($risultato=$risultatoQuery->fetch_row())
            $ore=$risultato[0];
      return $ore.$risultato[1];
    }
    
   
    /**
    	Restituisce true se esiste una programmazione didattica dell'anno corrente da approvare, false altrimenti
    */ 
    public function existProg_DidCorrente(){
    	$a=time();
        $b=date('Y', $a);
        $annoAccademico=$b."-".(intval($b)+1);
        $query="SELECT * FROM Programmazione_Didattica WHERE Anno_Accademico='".$annoAccademico."' AND Stato='Da Approvare'";
        $risultatoQuery=$this->database->eseguiQuery($query);
        if($risultatoQuery->num_rows>0)
        	return true;
        return false;
    }
    
    public function getStatusPrd(){
    	$a=time();
        $b=date('Y', $a);
        $arrayRisultato=array();
        $annoAccademico=$b."-".(intval($b)+1);
        $query="SELECT * FROM Programmazione_Didattica WHERE Anno_Accademico='".$annoAccademico."' AND (Stato='Approvato' OR Stato='Draft')";
        $risultatoQuery=$this->database->eseguiQuery($query);
        while($risultato=$risultatoQuery->fetch_row())
        	$arrayRisultato[]=$risultato[2]."&".$risultato[1]."&".$risultato[6]."&".$risultato[3]."&".$risultato[8];
        return $arrayRisultato;
    }
    
    
    
    //questa funzione retituisce una programmazione didattica che viene ricercata
    //$corso contiene il tipo di corso "laurea" "laurea magistrale"
    //$anno_corso corrisponde all'anno di corso interessato
    //$corso corrisponde al tipo di corso (Laurea, Laurea Magistrale)
    //$anno_accademico corrisponde all'anno accademico di cui si vogliono conoscere gli insegnamenti
    //$utente indica il tipo di utente per cui si sta eseguendo la ricerca
    //$semestre indica il semestre di cui si vuole sapere la programmazione didattica
    //restituisce la variabile $d che contiene le informazioni riguardanti la programmazione didattica cercata
    public function getProgDidVis($corso, $anno_accademico, $anno_corso, $utente,$semestre=0){
    	$riga = "<tr>";
        $d="";
        if($utente == 'Presidente' && $semestre!=0)
        	$query="SELECT i.Denominazione, a.Classe, p.Semestre, i.SSD, i.CFU_Frontali, i.CFU_Laboratorio, a.Ore_Teoria, a.Ore_Lab, p.Tot_OreTeoria, p.Tot_OreLab, i.Tipologia_attivita, d.Nome, d.Cognome,d.Ruolo, d.SSD, i.Tot_ore, d.Matricola from Programmazione_Didattica p join Associa a on (p.id = a.ID_ProgDid) join Insegnamento i on (i.Matricola_Insegnamento = a.Matricola_Insegnamento) join Docente d on (d.Matricola = a.Matricola_Professore) where p.Corso ='".$corso."' and p.Anno_Accademico = '".$anno_accademico."' and p.Anno_corso = '".$anno_corso."' and p.Stato='draft' AND p.Semestre='".$semestre."' order by i.Denominazione";
        elseif($utente == 'Presidente')
			$query="SELECT i.Denominazione, a.Classe, p.Semestre, i.SSD, i.CFU_Frontali, i.CFU_Laboratorio, a.Ore_Teoria, a.Ore_Lab, p.Tot_OreTeoria, p.Tot_OreLab, i.Tipologia_attivita, d.Nome, d.Cognome,d.Ruolo, d.SSD from Programmazione_Didattica p join Associa a on (p.id = a.ID_ProgDid) join Insegnamento i on (i.Matricola_Insegnamento = a.Matricola_Insegnamento) join Docente d on (d.Matricola = a.Matricola_Professore) where p.Corso ='".$corso."' and p.Anno_Accademico = '".$anno_accademico."' and p.Anno_corso = '".$anno_corso."' order by i.Denominazione";
    	else if($utente != '')
			$query="SELECT i.Denominazione, a.Classe, p.Semestre, i.SSD, i.CFU_Frontali, i.CFU_Laboratorio, a.Ore_Teoria, a.Ore_Lab, p.Tot_OreTeoria, p.Tot_OreLab, i.Tipologia_attivita, d.Nome, d.Cognome,d.Ruolo, d.SSD from Programmazione_Didattica p join Associa a on (p.id = a.ID_ProgDid) join Insegnamento i on (i.Matricola_Insegnamento = a.Matricola_Insegnamento) join Docente d on (d.Matricola = a.Matricola_Professore) where p.Corso ='".$corso."' and p.Anno_Accademico = '".$anno_accademico."' and p.Anno_corso = '".$anno_corso."' and p.Stato <> 'draft' and p.Stato <> 'archiviato' order by i.Denominazione";
     	else
	        $query="SELECT i.Denominazione, a.Classe, p.Semestre, i.SSD, i.CFU_Frontali, i.CFU_Laboratorio, a.Ore_Teoria, a.Ore_Lab, p.Tot_OreTeoria, p.Tot_OreLab, i.Tipologia_attivita, d.Nome, d.Cognome,d.Ruolo, d.SSD from Programmazione_Didattica p join Associa a on (p.id = a.ID_ProgDid) join Insegnamento i on (i.Matricola_Insegnamento = a.Matricola_Insegnamento) join Docente d on (d.Matricola = a.Matricola_Professore) where p.Corso ='".$corso."' and p.Anno_Accademico = '".$anno_accademico."' and p.Anno_corso = '".$anno_corso."' and p.Stato = 'approvata' order by i.Denominazione";

     $risultatoQuery=$this->database->eseguiQuery($query);
      
      while($risultato=$risultatoQuery->fetch_row()){
      		if($semestre!=0)
            	$riga="<tr onclick=\"riempiTabelle('".ucfirst(strtolower($risultato[0]))."','".$risultato[1]."','".$risultato[2]."','".$risultato[3]."','".$risultato[4]."','".$risultato[5]."','".$risultato[6]."','".$risultato[7]."','".$risultato[8]."','".$risultato[9]."','".$risultato[10]."','".$risultato[11]."','".$risultato[12]."','".$risultato[13]."','".$risultato[14]."','".$risultato[15]."','".$risultato[16]."') \">";
          	$d .= "$riga<td>".ucfirst(strtolower($risultato[0]))."</td><td>".$risultato[1]."</td><td>".$risultato[2]."</td><td>".$risultato[3]."</td><td>".(intval($risultato[4])+intval($risultato[5]))."</td>";
          	$d .= "<td>".$risultato[6]."</td><td>".$risultato[7]."</td>";
          	$d .= "<td>".$risultato[10]."</td><td>".$risultato[11]." ".$risultato[12]."</td><td>".$risultato[13]."</td><td>".$risultato[14]."</td></tr>";
      }
      return $d;
   }
}


//Questo controllo verifica quale funzione è stata richiesta dall'utente e la esegue(richiamando il metodo corretto)

if(isset($_POST["funzione"])){
	$gestionePrD=new GestioneProgrammazioneDidattica();
   	$anno=date("Y")."-".(intval(date("Y"))+1);
	switch($_POST["funzione"]){
		case "selezionaCurriculum":
			echo $gestionePrD->getCurriculum($_POST["corso"], $anno,$_POST["annoCorso"]);
			break;
            
        
        case "confermaProgD": //Gestisce la conferma o l'annullamento dell'operazione Crea Prog.Did

	$databaseE=new Database();
	$databaseE->connettiDB();
	if(isset($_POST['submitAnnulla']))
	{
		$query = "DELETE FROM Associa WHERE ID_ProgDid='".$_SESSION['IDprogD']."'";
                $risultatoQuery = $databaseE->eseguiQuery($query);
                $query = "DELETE FROM Programmazione_Didattica WHERE ID='".$_SESSION['IDprogD']."'";
                 $risultatoQuery = $databaseE->eseguiQuery($query);
		$_SESSION['progDinseritagia'] =0;
		$_SESSION['IDprogD'] = 0;
		$_SESSION['rigaPrD'] = 0;
		
		header("Location: http://localhost/IGES/Presentation%20Layer/Prog/Crea_ProgDid.php");
	}
	
	if(isset($_POST['submitConferma']))
	{
    	$_SESSION['progDinseritagia'] = 0;
        $_SESSION['IDprogD'] = 0;
		$_SESSION['rigaPrD'] = 0;
		header("Location: http://localhost/IGES/Presentation%20Layer/Prog/Crea_ProgDid.php");
	}
	break;
        
        case "creaProgD":
        	//Verifica quanti, e quali, record(righe nel Database) mandare al metodo CreaProgd(), che li inserirà nel DB

                $_SESSION['rigaPrD'] +=1;
                $i=0;
                $databaseE=new Database();
                $databaseE->connettiDB();
                $IDinsegnamento = 0;
                $nomeInsegnamento = "";
                $esame= $_POST['insegnamento'];


                //Prendo l'ID dell'esame da associare
                $query = "SELECT Matricola_Insegnamento FROM Insegnamento WHERE Denominazione='".$esame."'";
                    $risultatoQuery = $databaseE->eseguiQuery($query);
                    while($row = mysqli_fetch_array($risultatoQuery))
                        $IDinsegnamento = $row['Matricola_Insegnamento'];

                    //Oggetto ProgD
                    //$oreT,$oreL
                     $progD = new ProgrammazioneDidattica('',$_POST['annoDiCorso'],$_POST['laurea'], $_POST['semestre'],0,0, $_POST['annoAccademico'], "1","Draft", $_SESSION['curriculumProgDid']);
                     $docenti = $_POST['docente10'];
                     $oreTeoria = $_POST['oreTeoria10'];
                     $oreLab = $_POST['oreLab10'];

                     $numRiga = $_SESSION['rigaPrD'];

                    $count=0;
                for($i=1; $i<=$_POST['classi']; $i++)
                {
                    foreach($docenti as $key => $d)
                     {
                        $mat = explode(".", $d);
                     }//end foreach
                    $mat = explode(".", $docenti);
                    $_SESSION['docente'.$numRiga.'0']= $mat[0];
                    $_SESSION['oreTeoria'.$numRiga.'0']=$oreTeoria;
                    $_SESSION['oreLab'.$numRiga.'0']=$oreLab;
                    $_SESSION['insegnamento'.$numRiga.'0'] = $esame;
                    $_SESSION['classe'.$numRiga] = $i;
                    $associa = new Associa($IDinsegnamento,$i, $IDprogD, $mat[0], $oreTeoria, $oreLab,"IN ATTESA");
                    //CREA PROG. DIDATTICA 
                    $gestionePrD->CreaProgD($progD, $associa);
                    $_SESSION['progDinseritagia']=1;
                    //inserito il primo docente, controllo, e nel caso inserisco, se all'insegnamento sono stati assegnati piu docenti
                    for($k=1; $k<=5; $k++)
                    {
                        if($_POST['docente'.$i.''.$k] != 0)
                        {
                            $docenti = $_POST['docente'.$i.''.$k];

                            foreach($docenti as $key => $d)
                             {
                                $mat = explode(".", $d);
                             }//end foreach
                             $mat = explode(".", $docenti);
                            $oreTeoria = $_POST['oreTeoria1'.$k];
                            $oreLab = $_POST['oreLab1'.$k];
                            $_SESSION['docente'.$numRiga.''.$k] = $mat[0];
                            $_SESSION['oreTeoria'.$numRiga.''.$k]=$oreTeoria;
                            $_SESSION['oreLab'.$numRiga.''.$k]=$oreLab;
                            $associa = new Associa($IDinsegnamento, $i, $IDprogD, $mat[0], $oreTeoria, $oreLab,"IN ATTESA");
                            $gestionePrD->CreaProgD($progD, $associa);
                        }
                     }//end for 

                        $docenti = $_POST['docente'.($i+1).'0'];
                        $oreTeoria = intval($_POST['oreTeoria'.($i+1).'0']);
                        $oreLab = intval($_POST['oreLab'.($i+1).'0']);
                        $_SESSION['rigaPrD'] +=1;
                        $numRiga +=1;
                 }//end for Numclassi
                        $_SESSION['rigaPrD'] -= 1;
                        $_SESSION['progDinCorso']=1;
                        header("Location: http://localhost/IGES/Presentation%20Layer/Prog/Crea_ProgDid_pagina.php?laurea=".$_POST['laurea']."&annoAccademico=".$_POST['annoAccademico']."&annoDiCorso=".$_POST['annoDiCorso']."&classi=".$_POST['classi']."&semestre=".$_POST['semestre']."&curriculum=".$_POST['curriculum'].".".$_SESSION['curriculumProgDid']."");
            break;
            
       	/*#MODIFICARE
        case "caricoDidattico":
			//echo $gestionePrD->getCaricoDidattico($_POST["nm"], $_POST["cn"]);
            break;*/
        case "associa":
            echo getProfAssociato($_POST["corso"],$_POST["nClasse"],$_POST["numeroProf"],$gestionePrD);
        break;
		
		case "cambiaStato":
            $gestionePrD->cambiaStato($_POST["nuovoStato"], $_POST["id"]);
        break;
		
		case "salvaStato":
            $gestionePrD->salvaStato();
        break;
        case "riempiSelect":
            $arrayRis=$gestionePrD->getDocenti();
            $array=array();
            for($i=0;$i<count($arrayRis);$i++)
            	 $array[]=$arrayRis[$i]->getMatricola().".".$arrayRis[$i]->getSettoreScientificoDisciplinare().".".$arrayRis[$i]->getRuolo().".".$arrayRis[$i]->getNome().".".$arrayRis[$i]->getCognome();
            echo json_encode($array);
        break;
        //USATO NELLA CREAZIONE DELLA PRD DA PARTE DEL PRESIDENTE
        case "getOreTot"://Le ore restituire sono quelle assegnate provvisoriamente al docente nella programmazione didattica da approvare
            $matr=$_POST['matricola'];
            $ruolo=$_POST['ruolo'];
            $ore=$gestionePrD->getTotOreProf($matr,$ruolo);
            echo $ore;
        break;
        case "selezionaCurriculumProgDid":
        	echo $gestionePrD->getCurriculumProgDid($_POST['annoAccademico'], $_POST['corso'], $_POST['semestre']);
        break;
	}
}

function getProfAssociato($corso,$nClasse,$nProf,$gestionePrD){
		if($corso=="Laurea"){
       	 	$stepTeoria=8;
            $stepLaboratorio=10;
        }
        else{
        	$stepTeoria=8;
            $stepLaboratorio=8;
        }
        $idTotOre="tot".$nClasse.$nProf;
        
        	$professoreAssegnato='<input type="hidden" id="oreTotaliProf'.$nClasse.$nProf.'" value="">';
            $professoreAssegnato.='<input type="hidden" id="ruoloProf'.$nClasse.$nProf.'" value="">';
			$professoreAssegnato.='<td colspan="4"></td>';
            
            $professoreAssegnato.='<td><input type="button" onclick="calcoloOre('.$nClasse.',\'teoria\',\'oreTeoria'.$nClasse.$nProf.'\',this.value,\''.$idTotOre.'\')" value="-">';
            $professoreAssegnato.='<input name="oreTeoria'.$nClasse.$nProf.'" type="number" readonly id="oreTeoria'.$nClasse.$nProf.'" type="text" value="0" size="3">';
            $professoreAssegnato.='<input type="button" onclick="calcoloOre('.$nClasse.',\'teoria\',\'oreTeoria'.$nClasse.$nProf.'\',this.value,\''.$idTotOre.'\')" value="+"></td>';
            
            $professoreAssegnato.='<td><input type="button" onclick="calcoloOre('.$nClasse.',\'lab\',\'oreLab'.$nClasse.$nProf.'\',this.value,\''.$idTotOre.'\')" value="-">';
			$professoreAssegnato.='<input name="oreLab'.$nClasse.$nProf.'" type="number" readonly id="oreLab'.$nClasse.$nProf.'" type="text" value="0" size="3">';
			$professoreAssegnato.='<input type="button" onclick="calcoloOre('.$nClasse.',\'lab\',\'oreLab'.$nClasse.$nProf.'\',this.value,\''.$idTotOre.'\')" value="+"></td>';
            
            $professoreAssegnato.='<td id="'.$idTotOre.'" name="totOre[]">0</td>';
			$professoreAssegnato.='<td></td>';
			$professoreAssegnato.='<td> <select name="docente'.$nClasse.$nProf.'" class="form-control" id="prof'.$nClasse.$nProf.'" onchange="setCampiProf(this.value,'.$nClasse.$nProf.')">';
			$professoreAssegnato.='<option value="Nessun Professore">Seleziona docente</option>';
            $arrayRis=$gestionePrD->getDocenti();
            foreach($arrayRis as $d){
           				 $value=$d->getMatricola().'.'.$d->getSettoreScientificoDisciplinare().'.'.$d->getRuolo();
                         $val=$d->getNome()." ".$d->getCognome();
                         $professoreAssegnato.="<option value='".$value."'>$val</option>";
            }
			$professoreAssegnato.='</select></td>';
			$professoreAssegnato.='<td name="ruolo[]" id="ruolo'.$nClasse.$nProf.'"></td>';
			$professoreAssegnato.='<td name="ssd[]" id="ssd'.$nClasse.$nProf.'"></td>';
      	$professoreAssegnato.='</tr>';
        
        return $professoreAssegnato;
}
?>