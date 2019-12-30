<?php
	require("GestioneProgrammazioneDidattica.php");
	$gestione=new GestioneProgrammazioneDidattica();
  	if($_GET['id'] == "all"){
		$rit=$gestione->getProgDidVis($_GET['laurea'],$_GET['accademico'],$_GET['corso'],$_GET['utente']);
  	}
    else if($_GET['id'] == "anni"){
    	$rit=$gestione->getAccademico($_GET['laurea']);
    }
    else
    	$rit=$gestione->getProgDidVis($_GET['laurea'],$_GET['accademico'],$_GET['corso'],$_GET['utente'],$_GET['semestre']);

	echo $rit;
?>