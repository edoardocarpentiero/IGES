<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	/**
	 *GestioneCaricoDidattico
	 *
	 *Questa classe gestisce tutte le operazioni relative a Gestione carico didattico
	 *
	 *Author: Edoardo Carpentiero, Antonio De Prisco
	 *Version : 1.0
	 *2015 - Copyright by Pr.D Project - University of Salerno
	 
	 */
require_once(dirname(__DIR__,2).'\Application Layer\GestioneProgrammazioneDidattica\GestioneProgrammazioneDidattica.php');
require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');
include("InsegnamentoProgDidattica.php");
include("DocentePrD.php");

class GestioneCaricoDidattico{
	private $database;
	private $matricolaDocenteFittizio;
    private $annoAccademicoCorrente;
	public function __construct(){
		$this->database=new Database();
		$this->database->connettiDB();
        $this->matricolaDocenteFittizio="201515200";
        $a=time();
		$b=date('Y', $a);
		$annoAccademico=$b."-".(intval($b)+1);
        $this->annoAccademicoCorrente=$annoAccademico;
	}
    
    public function getRuoloDocente($matricolaDocente){
    	$query="SELECT Ruolo FROM Docente WHERE Matricola = ".$matricolaDocente;
        $risultatoQuery=$this->database->eseguiQuery($query);
        while($risultato=$risultatoQuery->fetch_row())
        	$arrayRisultato[]=$risultato[0];
        return $arrayRisultato[0];
    }
    
    
    //restituisce il monte ore di un docente ricercato
    //$nome corrisponde al nome del docente da cercare
    //$cognome corrisponde al cognome del docente da cercare
    //restutuisce la variabile $data che contiene il monte ore del docente ricercato
    public function getMonteOre($matricolaDocente){
    	$query="SELECT i.Denominazione, a.Ore_Teoria, a.Ore_Lab from Associa a join Insegnamento i on (i.matricola_insegnamento = a.matricola_insegnamento) join Docente d on (d.matricola = a.matricola_professore) join Programmazione_Didattica p on (a.ID_ProgDid = p.ID)  where d.Matricola = ".$matricolaDocente." AND Versione =(Select max(Versione) from Programmazione_Didattica)";
        echo $query;
    	$risultatoQuery=$this->database->eseguiQuery($query);
        $data="";
        while($risultato=$risultatoQuery->fetch_row()){
            $data .= (intval($risultato[1])+intval($risultato[2])).",".$risultato[0].",";
        }
        return  $data;
    }
    
    
	//restituisce il carico didattico di un docente
    //$username indica l'username del docente
    //restituisce $data che contiene il carico didattico
   public function getCaricoDidattico($matricola){
   		$a=time();
		$b=date('Y', $a);
        $query="SELECT i.denominazione, a.Ore_Teoria, a.Ore_Lab from Associa a join Programmazione_Didattica p on (a.ID_ProgDid = p.ID) join Insegnamento i on (i.matricola_insegnamento = a.matricola_insegnamento) join Docente d on (d.matricola = a.matricola_professore) where d.matricola = ".$matricola." and p.anno_accademico = '".$b."-".(intval($b)+1)."' AND Versione =(Select max(Versione) from Programmazione_Didattica)";
        $risultatoQuery=$this->database->eseguiQuery($query);

		$data='';
        while($risultato=$risultatoQuery->fetch_row()){
            $data .= (intval($risultato[1])+intval($risultato[2])).", ".$risultato[0].", ".$risultato[1].", ".$risultato[2].",";
        }
        return  $data;
    }
    
    /**
    Restituisce gli insegnamenti disponibili che non hanno ancora un docente assegnato (docente fittizio).
    Tale funzionalità è permessa solo se la programmazione didattica è nello stato "da approvare"
    */
    public function getInsegnamentiDisponibili(){
        $query="SELECT i.Matricola_Insegnamento,Denominazione,Tipologia_Lezione,i.Corso,SSD,CFU_Laboratorio,CFU_Frontali,Classe,Semestre,ID_ProgDid,Ore_Teoria,Ore_Lab,Anno_corso,Anno_Accademico,i.Tot_Ore FROM Insegnamento i left join Associa a on (i.Matricola_Insegnamento=a.Matricola_Insegnamento) join Programmazione_Didattica p on (ID=ID_ProgDid) WHERE Matricola_Professore='".$this->matricolaDocenteFittizio."' AND Stato='Da Approvare' AND Anno_Accademico='".$this->annoAccademicoCorrente."' AND Versione =(Select max(Versione) from Programmazione_Didattica)";
        $risultatoQuery=$this->database->eseguiQuery($query);
        $arrayRisultato=array();
        while($risultato=$risultatoQuery->fetch_row()){
            $arrayRisultato[]=new InsegnamentoProgDidattica(new Insegnamento($risultato[1],$risultato[4],"","",$risultato[6],$risultato[5],$risultato[2],$risultato[3],$risultato[14],$risultato[0]),new Associa("",$risultato[7],"","",$risultato[10],$risultato[11],""),new ProgrammazioneDidattica($risultato[9],$risultato[12],"",$risultato[8],"","",$risultato[13],"","",""));
        }
        return $arrayRisultato;
    }
    
    public function getDocentiPrD(){
    	$query="SELECT Matricola_Professore,  Nome,Cognome, Email, Ruolo, SSD , sum(Ore_Teoria+Ore_Lab) FROM Associa join Docente on (Matricola_Professore=Matricola) join Programmazione_Didattica on ID_ProgDid=ID WHERE Anno_Accademico='".$this->annoAccademicoCorrente."' AND Versione =(Select max(Versione) from Programmazione_Didattica) group by(Matricola_Professore)";
        $risultatoQuery=$this->database->eseguiQuery($query);
    	$arrayDocentiPrD=array();
        while($risultato=$risultatoQuery->fetch_row()){
        	$docentePrd=new DocentePrD($risultato[0],$risultato[1],$risultato[2],$risultato[3],$risultato[4],$risultato[5]);
            $arrayInsegnamentiAssociati=$this->getInsegnamentiAssociatiAlDocente($risultato[0]);
            $n=count($arrayInsegnamentiAssociati);
            $insegnamentiInSospeso=0;
            for($i=0;$i<$n;$i++){
            	$status=$arrayInsegnamentiAssociati[$i]->getAssociazione()->getStatus();
            	if(strcmp($status,'IN ATTESA')==0 || strcmp($status,'PROPOSTO')==0 || strcmp($status,'RIFIUTATO')==0){
                	$insegnamentiInSospeso+=1;
                }
            }
            $docentePrd->setNumeroInsegnamentiSospesi($insegnamentiInSospeso);
            if(strcmp($risultato[0],$this->matricolaDocenteFittizio)!=0){
                $ruoloDocente=$docentePrd->getRuolo();
                $oreRaggiunte=$risultato[6];

                if(strcmp($ruoloDocente,"Docente Associato PA")==0 || strcmp($ruoloDocente,"Docente Ordinario PO")==0){
                    if($oreRaggiunte<120)
                        $docentePrd->setStatusCarico(-1);//CARICO NON RAGGIUNTO
                    else if($oreRaggiunte>120 && $oreRaggiunte<180)
                        $docentePrd->setStatusCarico(1);//ORE EXTRA
                    else if($oreRaggiunte>180)
                        $docentePrd->setStatusCarico(2);//CARICO ORE SUPERATO
                   else 
                        $docentePrd->setStatusCarico(0);
                }else if(strcmp($ruoloDocente,"Ricercatore a tempo indeterminato RU")==0){
                    if($oreRaggiunte>0)
                        $docentePrd->setStatusCarico(1);
                    else if($oreRaggiunte>90)
                        $docentePrd->setStatusCarico(2);
                }else if(strcmp($ruoloDocente,'Ricercatori a tempo determinato RTD')==0){
                    if($oreRaggiunte>0)
                        $docentePrd->setStatusCarico(1);
                    else if($oreRaggiunte>66)
                        $docentePrd->setStatusCarico(2);
                }
            }
            $arrayDocentiPrD[]=$docentePrd;
        }
        return $arrayDocentiPrD;
    }
    
    public function getInsegnamentiAssociatiAlDocente($matricolaDocente){
        if($this->verificaFormatoMatricolaDocente($matricolaDocente)==-1)
            return -1;
        if (!$_SESSION['presidente'])
            $query = "SELECT i.Matricola_Insegnamento,Denominazione,Tipologia_Lezione,i.Corso,SSD,CFU_Laboratorio,CFU_Frontali,Classe,Semestre,ID_ProgDid,Ore_Teoria,Ore_Lab,Anno_corso,Anno_Accademico,status,i.Tot_Ore FROM Insegnamento i left join Associa a on (i.Matricola_Insegnamento=a.Matricola_Insegnamento) join Programmazione_Didattica p on (ID=ID_ProgDid) WHERE Matricola_Professore='" . $matricolaDocente . "' AND Stato='Da Approvare' AND Anno_Accademico='" . $this->annoAccademicoCorrente . "' AND Versione =(Select max(Versione) from Programmazione_Didattica)";
        else
            $query = "SELECT i.Matricola_Insegnamento,Denominazione,Tipologia_Lezione,i.Corso,SSD,CFU_Laboratorio,CFU_Frontali,Classe,Semestre,ID_ProgDid,Ore_Teoria,Ore_Lab,Anno_corso,Anno_Accademico,status,i.Tot_Ore FROM Insegnamento i left join Associa a on (i.Matricola_Insegnamento=a.Matricola_Insegnamento) join Programmazione_Didattica p on (ID=ID_ProgDid) WHERE Matricola_Professore='" . $matricolaDocente . "' AND (Stato='Da Approvare' OR Stato='Approvato' OR Stato='Draft') AND Anno_Accademico='" . $this->annoAccademicoCorrente . "' AND Versione =(Select max(Versione) from Programmazione_Didattica)";
        //echo $query;
        $risultatoQuery = $this->database->eseguiQuery($query);
        $arrayRisultato = array();
        while ($risultato = $risultatoQuery->fetch_row()) {
            $arrayRisultato[] = new InsegnamentoProgDidattica(new Insegnamento($risultato[1], $risultato[4], "", "", $risultato[6], $risultato[5], $risultato[2], $risultato[3], $risultato[15], $risultato[0]), new Associa("", $risultato[7], "", "", $risultato[10], $risultato[11], $risultato[14]), new ProgrammazioneDidattica($risultato[9], $risultato[12], "", $risultato[8], "", "", $risultato[13], "", "", ""));
        }
        return $arrayRisultato;
    }


    /**
    	Restituisce true se la proposta è stata memorizzata con successo, altrimenti false se l'insegnamento gia è stato proposto
    */
    public function proponiInsegnamento($associa){
        if(!$this->verificaPropostaInsegnamento($associa)) {
            return false;
        }
        else{

            $query="UPDATE Associa SET status='".$associa->getStatus()."', Matricola_Professore=".$associa->getDocente()." WHERE Matricola_Insegnamento='".$associa->getInsegnamento()."' AND Classe=".$associa->getClasse()." AND ID_ProgDid=".$associa->getProgD()." AND Matricola_Professore=".$this->matricolaDocenteFittizio." AND Ore_Teoria=".$associa->getOreTeoria()." AND Ore_Lab=".$associa->getOreLab();
              $this->database->eseguiQuery($query);
              return true;
        }
    }

    
    /**
    	Restituisce le informazioni relative ai docente associati a quell'insegnamento e le relative ore assegnate
    */
    public function getInfoDocentiInsegnamento($matricolaInsegnamento,$classe,$IDprogDid){//AND Matricola_Professore<>'".$matricolaDocente."'
    	if(!$this->verificaVisualizzaInsegnamentiDisponibili(new Associa($matricolaInsegnamento,$classe,$IDprogDid,"","","","")))
    	    return false;
    	else {
            $query = "SELECT Matricola,Cognome,Nome, Ore_Teoria,Ore_Lab FROM Insegnamento i left join Associa a on (i.Matricola_Insegnamento=a.Matricola_Insegnamento) join Docente d on (a.Matricola_Professore=d.Matricola) WHERE a.Matricola_Insegnamento='" . $matricolaInsegnamento . "' AND Classe=" . $classe . " AND ID_ProgDid=" . $IDprogDid;
            $risultatoQuery = $this->database->eseguiQuery($query);
            $arrayRisultato = array();
            while ($risultato = $risultatoQuery->fetch_row())
                $arrayRisultato[] = $risultato[0] . "." . $risultato[1] . "." . $risultato[2] . "." . $risultato[3] . "." . $risultato[4];
            return $arrayRisultato;
        }
    }
    
    /**
    	Restituisce true se all'insegnamento risulta essere associato un docente non fittizio.
    */
    public function isProposed($associa){
    	$query="SELECT * FROM Associa WHERE Matricola_Insegnamento='".$associa->getInsegnamento()."' AND Classe=".$associa->getClasse()." AND ID_ProgDid=".$associa->getProgD()." AND Matricola_Professore=".$this->matricolaDocenteFittizio." AND Ore_Teoria=".$associa->getOreTeoria()." AND Ore_Lab=".$associa->getOreLab();
    	$risultatoQuery=$this->database->eseguiQuery($query);
        if($risultatoQuery->num_rows>0)
        	return false;
        return true;
    }
    
    /**
    	Questo metodo permette di cambiare lo status dell'associazione
    */
    public function cambiaStatoAssociazione($associa){
        if(!$this->verificaCambiaStatoInsegnamentoProposto($associa))
            return -1;
        else {
            $query = "UPDATE Associa SET status='" . $associa->getStatus() . "' WHERE Matricola_Insegnamento='" . $associa->getInsegnamento() . "' AND Classe=" . $associa->getClasse() . " AND ID_ProgDid=" . $associa->getProgD() . " AND Matricola_Professore='" . $associa->getDocente() . "' AND Ore_Teoria=" . $associa->getOreTeoria() . " AND Ore_Lab=" . $associa->getOreLab() . "";
            $this->database->eseguiQuery($query);
            return 0;
        }
    }
    
    /**
    	In questo metodo, lo status dell'associazione insegnamento-docente passo nello stato IN ATTESA e fa l'update della matricola del docente associato con quella del docente fittizio
    */
    public function liberaAssociazioneInsegnamento($associa){
         if(!$this->verificaCambiaStatoInsegnamentoProposto($associa))
            return -1;
        else {
            $query = "UPDATE Associa SET status='" . $associa->getStatus() . "', Matricola_Professore='" . $this->matricolaDocenteFittizio . "' WHERE Matricola_Insegnamento='" . $associa->getInsegnamento() . "' AND Classe=" . $associa->getClasse() . " AND ID_ProgDid=" . $associa->getProgD() . " AND Matricola_Professore='" . $associa->getDocente() . "'  AND Ore_Teoria=" . $associa->getOreTeoria() . " AND Ore_Lab=" . $associa->getOreLab();
            $this->database->eseguiQuery($query);
            return 0;
        }
    }


    
    /**
    Permette di spedire l'email al docente.
    */
    public function inviaEmail($matricolaPresidente,$matricolaDocente,$emailMittente,$emailDestinatario, $oggetto,$messaggio){
        if(!$this->verificaCampiEmail($matricolaPresidente,$matricolaDocente,$emailMittente,$emailDestinatario, $oggetto,$messaggio))
            return -1;
    	$nome_mittente = "Presidente Del Consiglio Didattico";
        $mail_mittente = $emailMittente;
        $mail_destinatario = $emailDestinatario;

        // definisco il subject ed il body della mail
        $mail_oggetto = $oggetto;
        $mail_corpo = $messaggio;

        // aggiusto un po' le intestazioni della mail
        // E' in questa sezione che deve essere definito il mittente (From)
        // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
        $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
        $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
        //$mail_headers .= "X-Mailer: PHP/" . phpversion();

        mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers);
        return 0;
    }

    //METODI DI VERIFICA
    private function isExistDocente($matricolaDocente){
        $query="SELECT * FROM Docente WHERE Matricola=".$matricolaDocente;
        $risultatoQuery=$this->database->eseguiQuery($query);
        if($risultatoQuery->num_rows>0)
            return true;
        return false;

    }

    private function isExistInsegnamentoProgD($associa){
        $query="SELECT * FROM Associa WHERE Matricola_Insegnamento='".$associa->getInsegnamento()."' AND Classe=".$associa->getClasse()." AND ID_ProgDid=".$associa->getProgD();
        $risultatoQuery=$this->database->eseguiQuery($query);
        if($risultatoQuery->num_rows>0)
            return true;
        return false;

    }

    private function verificaFormatoMatricolaDocente($matricolaDocente){
        if(preg_match('/^[0-9]{1,11}$/', $matricolaDocente))
            return 0;
        else
            return -1;
    }

    private function verificaFormatoClasse($classe){
        if(preg_match('/^[0-9]{1,11}$/', $classe)){
            if($classe>=1 && $classe<=3)
                return 0;
        } else
            return -1;
    }

    private function verificaFormatoMatricolaInsegnamento($matricolaInsegnamento){
        if(preg_match('/^[0-9]{1,11}$/', $matricolaInsegnamento))
            return 0;
        else
            return -1;

    }

    private function verificaFormatoOre($ore){
        if(preg_match('/^[0-9]{1,2}$/', $ore))
            return 0;
        else
            return -1;
    }

    private function verificaStatusProposta($stato){
        if(strcmp($stato,"PROPOSTO")==0)
            return 0;
        return -1;

    }

    private function isExistDocenteInPrD($associa){
        $query="SELECT * FROM Associa WHERE Matricola_Professore=".$associa->getDocente()." AND ID_ProgDid=".$associa->getProgD();
        $risultatoQuery=$this->database->eseguiQuery($query);
        if($risultatoQuery->num_rows>0)
            return true;
        return false;
    }


    private function isAssociateInsegnamentoDocente($associa){
        $query="SELECT * FROM Associa WHERE Matricola_Insegnamento='".$associa->getInsegnamento()."' AND Classe=".$associa->getClasse()." AND ID_ProgDid=".$associa->getProgD()." AND Matricola_Professore=".$associa->getDocente()." AND Ore_Teoria=".$associa->getOreTeoria()." AND Ore_Lab=".$associa->getOreLab();
        $risultatoQuery=$this->database->eseguiQuery($query);
        if($risultatoQuery->num_rows>0)
            return true;
        return false;
    }

    private function verificaStatusInsegnamentoProposto($stato){
        if(strcmp($stato,"ACCETTATO")==0 || strcmp($stato,"ASSEGNATO")==0 || strcmp($stato,"RIFIUTATO")==0 || strcmp($stato,"IN ATTESA")==0)
            return true;
        return false;
    }

    private function verificaPropostaInsegnamento($associa){

        if($this->verificaFormatoClasse($associa->getClasse())==0){
            if($this->verificaFormatoMatricolaDocente($associa->getDocente())==0 && $this->isExistDocente($associa->getDocente()) && $this->isExistInsegnamentoProgD($associa) && $this->verificaFormatoMatricolaInsegnamento($associa->getInsegnamento())==0 && $this->verificaFormatoClasse($associa->getClasse())==0 && $this->verificaFormatoOre($associa->getOreTeoria())==0 && $this->verificaFormatoOre($associa->getOreLab())==0 && $this->verificaStatusProposta($associa->getStatus())==0){
                if($this->isProposed($associa))
                    return false;
                else
                    return true;
            }
        }
        else
            return false;
    }

    private function verificaCambiaStatoInsegnamentoProposto($associa){
        if($this->verificaFormatoClasse($associa->getClasse())==0){
            if($this->verificaFormatoMatricolaDocente($associa->getDocente())==0 && $this->isExistDocenteInPrD($associa) && $this->isExistInsegnamentoProgD($associa) && $this->verificaFormatoMatricolaInsegnamento($associa->getInsegnamento())==0 && $this->verificaFormatoClasse($associa->getClasse())==0 && $this->verificaFormatoOre($associa->getOreTeoria())==0 && $this->verificaFormatoOre($associa->getOreLab())==0 && $this->verificaStatusInsegnamentoProposto($associa->getStatus())){
                if($this->isAssociateInsegnamentoDocente($associa))
                    return true;
                else
                    return false;
            }
        }
        else
            return false;
    }

    private function verificaVisualizzaInsegnamentiDisponibili($associa){
        if($this->verificaFormatoClasse($associa->getClasse())==0){
            if($this->verificaFormatoClasse($associa->getClasse())==0 && $this->verificaFormatoMatricolaInsegnamento($associa->getInsegnamento())==0 && $this->isExistInsegnamentoProgD($associa))
                return true;
            else
                return false;
        }else
            return false;

    }

    private function verificaCampiEmail($matricolaPresidente,$matricolaDocente,$emailMittente,$emailDestinatario, $oggetto,$messaggio){
        $query="SELECT Matricola FROM Docente WHERE Email='".$emailDestinatario."'";
        $risultatoQuery=$this->database->eseguiQuery($query);
        while ($risultato = $risultatoQuery->fetch_row())
            $matricola=$risultato[0];
        if($matricolaDocente!=$matricola)
            return false;
        if(strcmp($emailMittente,"-")==0 || strcmp($emailDestinatario,"-")==0 || strcmp($oggetto,"-")==0 || strcmp($messaggio,"-")==0  || strlen($oggetto)<8 || strlen($messaggio)<16)
            return false;
        $query="SELECT Matricola FROM Docente WHERE Email='".$emailMittente."'";
        $risultatoQuery=$this->database->eseguiQuery($query);
        while ($risultato = $risultatoQuery->fetch_row())
            $matricola=$risultato[0];
        if($matricolaPresidente!=$matricola)
            return false;
        return true;

    }

}


if(isset($_POST["funzione"])){
	$gestioneCaricoDid=new GestioneCaricoDidattico();
    $gestionePrD=new GestioneProgrammazioneDidattica();
	switch($_POST["funzione"]){
    
    	case "monteOre":
    		echo $gestioneCaricoDid->getMonteOre($_POST['matricolaDocente']);
        break;
        
        case "caricoDidattico":
            $rit=$gestioneCaricoDid->getCaricoDidattico($_POST['matricolaDocente']);
        	echo $rit;
        break;
        case "cambiaStatus":
        	$stato=$_POST['stato'];
            $matricolaIns=$_POST['matricolaIns'];
            $classe=$_POST['classe'];
            $idProgDid=$_POST['progID'];
            $matricolaDoc=$_SESSION['matricola'];
            $oreT=$_POST['oreT'];
            $oreL=$_POST['oreL'];
            $esito=$gestioneCaricoDid->cambiaStatoAssociazione(new Associa($matricolaIns,$classe,$idProgDid,$matricolaDoc,$oreT,$oreL,$stato));
            echo $esito;
        break;
        /*case "ruoloDocente":
        	echo $gestioneCaricoDid->getRuoloDocente($_POST['matricolaDocente']);
        break;*/
        
        case "oreRicoperte":
                $res=$gestioneCaricoDid->getMonteOre($_POST['matricolaDocente']);
                if(strcmp($res,'')==0)
                    echo 0;
                else{
                    $carico=explode(",", $res);
                    $somma=0;
                    for($i=0;$i<count($carico);$i++){
                        if(($carico[$i] % 2) == 0)
                            $somma+=intval($carico[$i]);
                    }
                    echo $somma;
                }
        break;
        
        case "proponiInsegnamento":
       		$stato='PROPOSTO';
            $matricolaIns=$_POST['matricolaIns'];
            $classe=$_POST['classe'];
            $idProgDid=$_POST['progID'];
            $matricolaDoc=$_SESSION['matricola'];
            $oreTeoria=$_POST['oreTeoria'];
            $oreLab=$_POST['oreLab'];
        	$esito=$gestioneCaricoDid->proponiInsegnamento(new Associa($matricolaIns,$classe,$idProgDid,$matricolaDoc,$oreTeoria,$oreLab,$stato));
            if($esito)
            	echo 0;
            else
            	echo -1;
        break;
        
        case "verificaCondivisione":
        	$matricolaIns=$_POST['matricolaIns'];
            $classe=$_POST['classe'];
            $idProgDid=$_POST['progId'];
        	$res=$gestioneCaricoDid->getInfoDocentiInsegnamento("201515200",$matricolaIns,$classe,$idProgDid);
            echo count($res);
        break;
        
        case "insegnamentiAssociati":
        	$insegnamentiAssociati=$gestioneCaricoDid->getInsegnamentiAssociatiAlDocente($_POST['matricolaDocente']);
        	echo insegnamentiAssociati($insegnamentiAssociati,$_POST['matricolaDocente']);
        break;
        
        case "liberaInsegnamento":
            $matricolaIns=$_POST['matricolaIns'];
            $matricolaDoc=$_POST['matricolaDoc'];
            $classe=$_POST['classe'];
            $idProgDid=$_POST['progId'];
            $oreT=$_POST['oreT'];
            $oreL=$_POST['oreL'];
            $associa= new Associa($matricolaIns,$classe,$idProgDid,$matricolaDoc,$oreT,$oreL,"IN ATTESA");
            $ris=$gestioneCaricoDid->liberaAssociazioneInsegnamento($associa);
            echo $ris;
        break;
        
        case "rifiutaProposta":
        	 $matricolaIns=$_POST['matricolaIns'];
              $matricolaDoc=$_POST['matricolaDoc'];
              $classe=$_POST['classe'];
              $idProgDid=$_POST['progId'];
              $emailDestinatario=$_POST['emailDestinatario'];
              $oggettoEmail=$_POST['oggettoEmail'];
              $messaggioEmail=$_POST['messaggioEmail'];
              $oreT=$_POST['oreT'];
              $oreL=$_POST['oreL'];
              $associa= new Associa($matricolaIns,$classe,$idProgDid,$matricolaDoc,$oreT,$oreL,"IN ATTESA");
              $gestioneCaricoDid->liberaAssociazioneInsegnamento($associa);
              $ris=$gestioneCaricoDid->inviaEmail("prdSoftware@mail.it",$emailDestinatario, $oggettoEmail,$messaggioEmail);
              echo $ris;
        break;
        
        case "accettaProposta":
        	 $matricolaIns=$_POST['matricolaIns'];
             $matricolaDoc=$_POST['matricolaDoc'];
             $classe=$_POST['classe'];
             $idProgDid=$_POST['progId'];
             $oreT=$_POST['oreT'];
             $oreL=$_POST['oreL'];
             $associa= new Associa($matricolaIns,$classe,$idProgDid,$matricolaDoc,$oreT,$oreL,"ASSEGNATO");
           	 $esito=$gestioneCaricoDid->cambiaStatoAssociazione($associa);
             echo $esito;
        break;
	}
}

function insegnamentiAssociati($insegnamentiAssociati,$matricolaDocente){
		$n=count($insegnamentiAssociati);
        
		for($i=0;$i<$n;$i++){
                    $insegnamento=$insegnamentiAssociati[$i]->getInsegnamento();
                    $associazione=$insegnamentiAssociati[$i]->getAssociazione();
                    $progDidattica=$insegnamentiAssociati[$i]->getProgrammazioneDidattica();
            
					$matricolaInsegnamento=$insegnamento->getID();
                    $denominazione=$insegnamento->getDenominazione();
                    $cfu=$insegnamento->getCfuLaboratorio()+$insegnamento->getCfuFrontale();
                    $tipologiaAttivita=$insegnamento->getTipologiaLezione();
                    $oreTeoria=$associazione->getOreTeoria();
                    $oreLab=$associazione->getOreLab();
                    $corso=$insegnamento->getCorso();
                    $anno=$progDidattica->getAnnoCorso();
                    $semestre=$progDidattica->getSemestre();
                    $SSD=$insegnamento->getSSD();
                    $status=$associazione->getStatus();
                                	                               		
                    $cfuLab=$insegnamento->getCfuLaboratorio();
                    $cfuTeoria=$insegnamento->getCfuFrontale();
                    $annoAccademico=$progDidattica->getAnnoAccademico();
                    $classe=$associazione->getClasse();
                    $oreTot=$insegnamento->getDurataCorso();   
                    
                    $datiAssociazione=$matricolaDocente."&".$matricolaInsegnamento."&".$classe."&".$progDidattica->getID()."&".str_replace(" ","_",$denominazione)."&".$oreTeoria."&".$oreLab."&".$cfu."&".$anno."&".$annoAccademico."&".$semestre;
                    $risultato ="";
                    $risultato.="<tr id=".$i."><td title='Clicca per info' style='font-weight: 600;'>".$denominazione."</td>";
					$risultato.="<td>$cfu</td>";
                    $risultato.="<td>$tipologiaAttivita</td>";
                    if($oreTeoria==0)
                          $risultato.="<td>-</td>";
                    else
                          $risultato.="<td>$oreTeoria</td>";
                    if($oreLab==0)
                          $risultato.="<td>-</td>";
                    else
                          $risultato.="<td>$oreLab</td>";
                    $risultato.="<td>$corso</td>";
                    $risultato.="<td>$anno</td>";
                    $risultato.="<td>$semestre</td>";
                    $risultato.="<td>$classe</td>";
                    $risultato.="<td>$SSD</td>";
                    $risultato.="<td>";
                    
                    if(strcmp($matricolaDocente,"201515200")!=0){
                      if(strcmp($status,"PROPOSTO")==0){
                           $risultato.="<span >
                                        		<div class=btn-group>
                                                  <button type=button title=Insegnamento proposto class='btn btn-warning btn-flat'>PROPOSTO</button>
                                                  <button type=button class='btn btn-warning btn-flat dropdown-toggle' data-toggle=dropdown>
                                                    <span class=caret></span>
                                                    <span class=sr-only>Toggle Dropdown</span>
                                                  </button>
                                                  <ul class=dropdown-menu role=menu>
                                                    <li><a onclick=accettaProposta('".$datiAssociazione."')>Assegna</a></li>
                                                    <li><a data-toggle=modal data-target=#modal-emailRifiuto onclick=rifiutaProposta('".$datiAssociazione."')>Rifiuta</a></li>
                                                  </ul>
                                                </div>
                                               </span>";
                          
                      }else if(strcmp($status,"ACCETTATO")==0){
                          $risultato.="<button title='Insegnamento proposto accettato.' type='button' class='btn btn-success' disabled >ACCETTATO</button>";
                      }else if(strcmp($status,"RIFIUTATO")==0){
                          $risultato.='<button title="Insegnamento proposto rifiutato." type="button" onclick=presaVisione("'.$datiAssociazione.'") class="btn btn-danger">RIFIUTATO</button>';
                      }else if(strcmp($status,"ASSEGNATO")==0){
                          $risultato.="<button title='Insegnamento proposto dal docente è stato accettato.' type='button' class='btn btn-dark' disabled >ASSEGNATO</button>";
                      }else if(strcmp($status,"IN ATTESA")==0){
                      		if(strcmp($matricolaDocente,$_SESSION['matricola'])==0){
                                $datiAssociazione=$matricolaDocente."&".$matricolaInsegnamento."&".$classe."&".$progDidattica->getID()."&".$oreTeoria."&".$oreLab;
                            	$risultato.='<span >
                                        		<div class=btn-group>
                                                  <button type=button title=Insegnamento proposto in attesa class="btn btn-warning btn-flat">IN ATTESA</button>
                                                  <button type=button class="btn btn-warning btn-flat dropdown-toggle" data-toggle=dropdown>
                                                    <span class=caret></span>
                                                    <span class=sr-only>Toggle Dropdown</span>
                                                  </button>
                                                  <ul class=dropdown-menu role=menu>
                                                    <li><a onclick=aggiornaStatus(1,"'.$datiAssociazione.'")>Accetta</a></li>
                                                    <li><a onclick=aggiornaStatus(2,"'.$datiAssociazione.'")>Rifiuta</a></li>
                                                  </ul>
                                                </div>
                                               </span>';
                      		}else
                            	$risultato.="<button title='Insegnamento proposto in attesa.' type='button' class='btn btn-warning' disabled >IN ATTESA</button>";
                      }
                    }
                    else
                    	$risultato.='-';
                    $risultato.="</td>";
                    $risultato.="</tr>";
            }
            return $risultato;
}
?> 
                                
                                        