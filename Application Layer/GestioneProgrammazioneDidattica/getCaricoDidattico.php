<?php
	include_once("GestioneProgrammazioneDidattica.php");
	$gestione=new GestioneProgrammazioneDidattica();
    if($_POST['id'] == "caricoDidattico"){
    	if($gestione->existProg_DidCorrente())
    		$rit=$gestione->getCaricoDidattico($_POST['user']);
        else
        	$rit=-1;
    }
    else if($_POST['id'] == "monteOre"){
    	$rit=$gestione->getMonteOre($_POST['matricolaDocente']);
    }
	echo $rit;
?>