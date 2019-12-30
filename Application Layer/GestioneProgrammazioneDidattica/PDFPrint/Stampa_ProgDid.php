<?php
/**
	 *Stampa ProgD
	 *
	 *Questa classe serve per effettuare la stampa del documento PDF di una programmazione didattica
	 *Essa viene implementata tramite l'utilizzo del Pattern Adapter
     *
	 *Author: Alessandro Kevin Barletta - Stefano Cirillo
	 *Version : 1.0
	 *2015 - Copyright by Pr.D Project - University of Salerno
	 */
  require('html_table.php');
  require("../GestioneProgrammazioneDidattica.php");
  
  #$pdf=new PDF_HTML_Table();
  #$pdf->AddPage();
  #$pdf->SetFont('Times','',8);
  #$pdf->SetTitle("Prog_Did_".$_GET['annoAcc']);
  #$pdf->WriteHTML("Universita' degli Studi di Salerno - Programmazione Didattica Corso: ".$_GET['corso']." Anno accademico: ".$_GET['annoAcc']."<BR>$htmlTable<BR>");
  #$pdf->Output();
  
  
  class AdapterPrint{
  	private $dati;
    
    function __construct(PDF_HTML_Table $data){
    	$this->dati = $data;
    }
    
    public function creaPagina(){
    	$this->dati->AddPage();
  		$this->dati->SetFont('Times','',8);
    }
    public function setPagina($annoAcc){
    	$this->dati->SetTitle("Prog_Did_".$annoAcc);
    }
    public function scriviPagina($corso, $annoAcc, $table){
    	$this->dati->WriteHTML("Universita' degli Studi di Salerno - Programmazione Didattica Corso: ".$corso." Anno accademico: ".$annoAcc."<BR>$table<BR>");
    	$this->dati->Output();
    }
  }

  $gestione=new GestioneProgrammazioneDidattica();

  $rit=$gestione->getProgDidVis($_GET['corso'],$_GET['annoAcc'],$_GET['anno'],$_GET['userStampa']);

  $htmlTable = "<TABLE><TR><TD><B>Insegnam.</B></TD><TD>Classe</TD><TD>Semestre</TD><TD>Settore</TD><TD>CFU</TD><TD>Ore Teoria</TD><TD>Ore Laboratorio</TD>";
  $htmlTable .= "<TD>Tipologia</TD><TD>Docente</TD><TD>Ruolo</TD><TD>SSD</TD></TR>";
  $htmlTable .= $rit;
  $htmlTable .= "</TABLE>";
  $pdf=new PDF_HTML_Table();
  $stampa=new AdapterPrint($pdf);
  $stampa->creaPagina();
  $stampa->setPagina($_GET['annoAcc']);
  $stampa->scriviPagina($_GET['corso'],$_GET['annoAcc'],$htmlTable);
?>

