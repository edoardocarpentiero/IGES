<?php
        include_once "Insegnamento.php";
        include_once "GestioneInsegnamento.php";
        
        $gestione=new GestioneInsegnamenti();
        if($_POST["tipo"]==0 || $_POST["tipo"]==1){
        		$oreLab=0;
                $denominazione=$_POST["denominazione"];
                $tipologiaAttivitaFormativa=$_POST["tipologiaAttivitaFormativa"];
                $ssd=$_POST["SSD"];
                $cfuFrontali=intval($_POST["cfuInsegnamento"]);
                $corso=$_POST["corso"];
                $oreTot=intval($_POST["oreCorso"]);
                $tipologia="Frontale/Esercitazione";
                $cfuLab=0;
                $denominazione=strtoupper($denominazione);
        }

        if($_POST["tipo"]==0){
              	$insegnamenti=array();
              	$modulo=0;
				$esito=0;
                
                if(isset($_POST["tipologia"]) && isset($_POST["cfuLaboratorio"]) && intval($_POST["cfuLaboratorio"])>0){
                    $tipologia=$tipologia." + Laboratorio";
                    $cfuLab=intval($_POST["cfuLaboratorio"]);
                    $oreLab=intval($_POST["oreAttivitaLaboratorio"]);
                    $oreTot+=$oreLab;
                }


                if(isset($_POST["modulo"]) && (intval($_POST["modulo"])>1)){	
                    $modulo=intval($_POST["modulo"]);
                    for($i=0;$i<$modulo;$i++)
                        $insegnamenti[]=new Insegnamento($denominazione, $ssd, $tipologiaAttivitaFormativa,intval($i+1),$cfuFrontali,$cfuLab,$tipologia,$corso,$oreTot);
                }
                else{
                    $insegnamenti[]=new Insegnamento($denominazione,$ssd,$tipologiaAttivitaFormativa,0,$cfuFrontali,$cfuLab,$tipologia,$corso,$oreTot);}

                if($modulo>1)
                {
                   for($i=0;$i<$modulo;$i++){
                       $esito=$gestione->aggiungiInsegnamento($insegnamenti[$i]);}
                }
                else
                   $esito=$gestione->aggiungiInsegnamento($insegnamenti[0]);
              echo $esito;
        }elseif($_POST["tipo"]==1){
                $esito="";
                $id=intval($_POST["id"]);
                $modulo=intval($_POST["modulo"]);

                if($_POST["tipologia"]==0 && $_POST["cfuLaboratorio"]>0){
                  $tipologia=$tipologia." + Laboratorio";
                  $cfuLab=intval($_POST["cfuLaboratorio"]);
                  $oreLab=intval($_POST["oreAttivitaLaboratorio"]);
                  $oreTot+=$oreLab;
                }
                $esito=$gestione->salvaModifiche(new Insegnamento($denominazione,$ssd,$tipologiaAttivitaFormativa,0,$cfuFrontali,$cfuLab,$tipologia,$corso,$oreTot),$id);
                
                echo $esito;
        }

        elseif($_POST["tipo"]==2){
            $tipoCorso=$_POST["corso"];
            $tabella="";
            $result=$gestione->visualizzaInsegnamenti("Corso",$tipoCorso,1);
            $n=count($result);
            $i=0;
            $tabella.="<table id='example1' class='table table-bordered table-striped'>";
            $tabella.='<thead>
                      <tr>
                      	<th>Denominazione</th>
                        <th>Tipologia Attivit&agrave Formativa</th>
                        <th>Tipologia Attivit&agrave</th>
                        <th>Modulo</th>
                        <th>Corso</th>
                      	<th>SSD</th>
                      	<th>CFU</th>
                        <th>Ore Corso</th>
                      </tr>
                    </thead>
                    <tbody>';

            for($i=0;$i<$n;$i++){
                    $tabella.="<tr>";
                    $tabella.="<td>".$result[$i]->getDenominazione()."</td>";
                    $tabella.="<td>".$result[$i]->getTipologiaAttivitaFormativa()."</td>";
                    $tabella.="<td>".$result[$i]->getTipologiaLezione()."</td>";
                    if(intval($result[$i]->getModulo())==0)
                    	$tabella.="<td></td>";
                    else
                    	$tabella.="<td>".$result[$i]->getModulo()."</td>";
                    $tabella.="<td>".$result[$i]->getCorso()."</td>";
                    $tabella.="<td>".$result[$i]->getSSD()."</td>";
                    $somma=$result[$i]->getCfuFrontale()+$result[$i]->getCfuLaboratorio();
                    $tabella.="<td>$somma</td>";
                    $tabella.="<td>".$result[$i]->getDurataCorso()."</td>";
                    $tabella.="</tr>";
            }
            $tabella.= '</tbody>
                    <tfoot>
                      <tr>
                       	<th>Denominazione</th>
                        <th>Tipologia Attivit&agrave Formativa</th>
                        <th>Tipologia Attivit&agrave</th>
                        <th>Modulo</th>
                        <th>Corso</th>
                      	<th>SSD</th>
                      	<th>CFU</th>
                        <th>Ore Corso</th>
                      </tr>
                    </tfoot>
                  </table>';
            echo $tabella;
    }
?>