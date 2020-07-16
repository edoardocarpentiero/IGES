<?php 
	/**
	 *VisualizzaOrdinamento
	 *
	 *Questa classe crea e manda alla GUI l'ordinamento selezionato dall'Utente
	 *
	 *Author: Alessandro Kevin Barletta
	 *Version : 1.0
	 *2015 - Copyright by Pr.D Project - University of Salerno
	 
	 */
                        require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');
                        
                        $anno = $_POST['anno'];
                        $corso = $_POST['corso'];
                        if($corso=="Magistrale")
                        	$anno = "2015-2016";
                        $tabella="";

                        $database = new Database();
                        $database->connettiDB();
                 $query= " use myprd;
                        SELECT Ordinamento.Attivita_formativa, Suddivisione.Ambiti_disciplinari,
                        Settore.SSD, Settore.Descrizione, Suddivisione.CFU_min, Suddivisione.CFU_max FROM Ordinamento, Suddivisione,
                        Settore, Composto, Possiede WHERE Ordinamento.Anno_accademico = '".$anno."' AND Ordinamento.Corso ='".$corso."'
                        AND Possiede.ID_Ordinamento = Ordinamento.ID AND Possiede.ID_Suddivisione = Suddivisione.ID AND
                        Composto.ID_Suddivisione = Suddivisione.ID AND Composto.SSD = Settore.SSD ORDER BY Settore.SSD";
						$risultatoQuery=$database->eseguiQuery($query);
                        if($_POST['corso']!="Magistrale")
                        	$tabella .= "<th>TotCFU</th>";
                        $tabella .= "</tr></thead><tbody>";
                        //conto i vari campi
                        $countDiBase = 0; 
                        $countCaratt=0; 
                        $countAffine=0;
                        $countAffMag=0;
                        $countMate=0; 
                        $countInfo=0;
						$caratAffine = 0;
                        $caratAffMag=0;
						$caratBase =0;
						$caratCaratt=0;
						$caratInfo=0;
						$caratMate=0;
                        $minMat=0;
                        $minInfo=0;
                        $maxMat=0;
                        $maxInfo=0;
                        
                        
                        while ($rowD = mysqli_fetch_array($risultatoQuery))
                        {
                        	
                        	if($rowD['Attivita_formativa'] == "di base")
                            	$countDiBase +=1;
                            if($rowD['Attivita_formativa'] == "Caratterizzanti")
                            	$countCaratt +=1;
                            if($rowD['Attivita_formativa'] == "Affini e integrative")
                            	$countAffine +=1;
                            if($rowD['Attivita_formativa'] == "Affini")
                            	$countAffMag +=1;
                            if($rowD['Ambiti_disciplinari'] == "Matematico-Fisico")
                            {
                            	$countMate +=1;
                                $minMat = $rowD['CFU_min'];
                                $maxMat = $rowD['CFU_max'];
                            }
                            if($rowD['Ambiti_disciplinari'] == "Informatica" && $rowD['Attivita_formativa'] == "di base")
                            {
                            	$countInfo +=1;
                                $minInfo = $rowD['CFU_min'];
                                $maxInfo = $rowD['CFU_max'];
                            }
                            
                        }   //Questi calcoli servono per scrivere DI BASE solo al centro
                        	if($countDiBase <= 2)
                            	$caratBase = 1;
                            else if(($countDiBase%2)==0)
                            	$caratBase = $countDiBase/2;
                            else
                            	$caratBase = ($countDiBase -1) /2;
							
							if($countCaratt <= 2)
                            	$caratCaratt = 1;
                            else if(($countCaratt%2)==0)
                            	$caratCaratt = $countCaratt/2;
                            else
                            	$caratCaratt = ($countCaratt -1) /2;
                        
                        	if($countAffine <= 2)
                            	$caratAffine = 1;
                            else if(($countAffine%2)==0)
                            	$caratAffine = $countAffine/2;
                            else
                            	$caratAffine = ($countAffine -1) /2;
                                
                            if($countAffMag <= 2)
                            	$caratAffMag = 1;
                            else if(($countAffMag%2)==0)
                            	$caratAffMag = $countAffMag/2;
                            else
                            	$caratAffMag = ($countAffMag -1) /2;
                                
                            if($countMate <= 2)
                            	$caratMate = 1;
                            else if(($countMate%2)==0)
                            	$caratMate = $countMate/2;
                            else
                            	$caratMate = ($countMate -1) /2;
                                
                            if($countInfo <= 2)
                            	$caratInfo = 1;
                            else if(($countInfo%2)==0)
                            	$caratInfo = $countInfo/2;
                            else
                            	$caratInfo = ($countInfo -1) /2;
                                
                        $risultatoQuery=$database->eseguiQuery($query);
                        $count=0;
                        while ($row = mysqli_fetch_array($risultatoQuery))
                        {
                        if($row['Attivita_formativa'] == "di base" && $row['Ambiti_disciplinari'] == "Matematico-Fisico"){
                        	$count +=1;
                            if($count == $caratBase)
                            {
                        		$tabella .= "<tr><td class='bianco'>".$row['Attivita_formativa']."</td>";
                                $tabella .= "<td class='bianco'>".$row['Ambiti_disciplinari']."</td>";
                            }
                            else{
                            	$tabella .= "<tr class='bianco'><td>  </td>";
                                $tabella .= "<td>  </td>";
                                }
                            if($count == $countMate)
                            {
                            $tabella .= "<td>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($count == $caratBase)
                            {
                            $tabella .= "<td>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td>".($minMat + $minInfo)."-".($maxMat+$maxInfo)."</td></tr>";
                            }
                            else{
                            		$tabella .= "<td>  </td>";
                                    $tabella .= "<td>  </td>";
                                }
                            }
                            else {
                            $tabella .= "<td class='bianco'>".$row['SSD']." ".$row['Descrizione']."</td>";
                           if($count == $caratBase)
                            {
                            $tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td class='bianco'>".($minMat + $minInfo)."-".($maxMat+$maxInfo)."</td></tr>";
                            }
                            else{
                            		$tabella .= "<td class='bianco'>  </td>";
                                    if($_POST['corso']!="Magistrale")
                                    $tabella .= "<td class='bianco'>  </td>";
                                }
                            }
                        }//chiudi if                       
                        }//chiudi while
							
						$risultatoQuery=$database->eseguiQuery($query);
                        $count=0;
                        while ($row = mysqli_fetch_array($risultatoQuery)){
                        if($row['Attivita_formativa'] == "di base" && $row['Ambiti_disciplinari'] == "Informatica"){
                        	$count +=1;
                            if($count==1)
                            	$tabella .= "<tr class='primo'>";
                            else
                            	$tabella .= "<tr>";
                            if($count == $caratBase)
                            {
                            	if($count==$countInfo)
                        			$tabella .= "<td class='bianco'>".$row['Attivita_formativa']."</td>";
                                else
                                	$tabella .= "<td>".$row['Attivita_formativa']."</td>";
                            }
                            
                            
                            if($count==$caratInfo)
                            {
                            	if($count == $countInfo)
                                {
                            		$tabella .= "<td >  </td>";
                                	$tabella .= "<td >".$row['Ambiti_disciplinari']."</td>";
                                 }
                                 else 
                                 {
                                 	$tabella .= "<td class='bianco'>  </td>";
                                	$tabella .= "<td class='bianco'>".$row['Ambiti_disciplinari']."</td>";
                                 }
                            }
                            else{
                            	if($count == $countInfo)
                                {
                            		$tabella .= "<td >  </td>";
                                	$tabella .= "<td></td>";
                                 }
                                 else 
                                 {
                                 	$tabella .= "<td class='bianco'>  </td>";
                                	$tabella .= "<td class='bianco'></td>";
                                 }
                                }
                            
                            
                            if($count == $countInfo)
                            {
                            
                            $tabella .= "<td >".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($count==$caratInfo)
                            {
                            	$tabella .= "<td >".$row['CFU_min']."-".$row['CFU_max']."</td>";
                                if($_POST['corso']!="Magistrale")
                           	    $tabella .= "<td >".$row['CFU_max']."</td></tr>";
                            }
                            else{
                            	$tabella .= "<td></td>";
                                if($_POST['corso']!="Magistrale")
                                $tabella .= "<td></td></tr>";
                                }
                            }
                            else{
                            $tabella .= "<td class='bianco'>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($count==$caratInfo)
                            {
                            	$tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                                if($_POST['corso']!="Magistrale")
                           	    $tabella .= "<td class='bianco'></td></tr>";
                                }
                            else{
                            	$tabella .= "<td class='bianco'></td>";
                                if($_POST['corso']!="Magistrale")
                                $tabella .= "<td class='bianco'></td>";
                                }
                            }//chiudi else
                            }}//chiudi if e while
							
							$risultatoQuery=$database->eseguiQuery($query);
							$count=0;
                        while ($row = mysqli_fetch_array($risultatoQuery))
                        {
                        if($row['Attivita_formativa'] == "Caratterizzanti")
                          {
                          	$count +=1;
					if($count == $countCaratt)
					{
                            if($count == $caratCaratt)
                        	{	 $tabella .= "<tr><td>".$row['Attivita_formativa']."</td>";
                            	 $tabella .= "<td>".$row['Ambiti_disciplinari']."</td>";
                                 $tabella .= "<td>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($count == $caratCaratt)
                           		 $tabella .= "<td>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            else
                            	 $tabella .= "<td></td>";
                            if($_POST['corso']!="Magistrale")
                           		 $tabella .= "<td>".$row['CFU_min']."-".$row['CFU_max']."</td></tr>";
                           } 
                            else{
                            	$tabella .= "<tr><td>  </td>";
                                $tabella .= "<td>  </td>";
                                
                            $tabella .= "<td >".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($count == $caratCaratt)
                           		 $tabella .= "<td >".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            else
                            	 $tabella .= "<td ></td>";
                            if($_POST['corso']!="Magistrale")
								 {
									 if($count == $caratCaratt)
										$tabella .= "<td >".$row['CFU_min']."-".$row['CFU_max']."</td></tr>";
									else
										$tabella .= "<td ></td></tr>";
								 }
                             }
					}
					else
					{
						if($count == $caratCaratt)
                        	{	 $tabella .= "<tr class='bianco'><td class='bianco'>".$row['Attivita_formativa']."</td>";
                            	 $tabella .= "<td class='bianco'>".$row['Ambiti_disciplinari']."</td>";
                                 $tabella .= "<td class='bianco'>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($count == $caratCaratt)
                           		 $tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            else
                            	 $tabella .= "<td class='bianco'></td>";
                            if($_POST['corso']!="Magistrale")
                           		 $tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td></tr>";
                           } 
                            else{
                            	$tabella .= "<tr class='bianco'><td class='bianco'>  </td>";
                                $tabella .= "<td class='bianco'>  </td>";
                                
                            $tabella .= "<td class='bianco'>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($count == $caratCaratt)
                           		 $tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            else
                            	 $tabella .= "<td class='bianco'></td>";
                            if($_POST['corso']!="Magistrale")
								 {
									 if($count == $caratCaratt)
										$tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td></tr>";
									else
										$tabella .= "<td class='bianco'></td></tr>";
								 }
                                 }
					}
                          }
                        }
							
						$risultatoQuery=$database->eseguiQuery($query);
						$count = 0;
                        while ($row = mysqli_fetch_array($risultatoQuery)){
                        if($row['Attivita_formativa'] == "Affini e integrative"){
                        	$count +=1;
                             if($count == $caratAffine)
                        		$tabella .= "<tr class='bianco'><td>".$row['Attivita_formativa']."</td>";
                            else
                            {
                            if($count==$countAffine)
                            	$tabella .= "<tr><td>  </td>";
                            else
                            	$tabella .= "<tr class='bianco'><td>  </td>";
                            }
                            
                            if($count == $countAffine)
                            {
                            $tabella .= "<td>".$row['Ambiti_disciplinari']."</td>";
                            $tabella .= "<td>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($caratAffine == $count)
                            	{
                            $tabella .= "<td>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td>".$row['CFU_min'].".".$row['CFU_max']."</td></tr>";
                           	    }
                            else
                           	 {
                            $tabella .= "<td></td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td></td></tr>";
                             }
                            }
                            else
                          {
                            $tabella .= "<td class='bianco'>".$row['Ambiti_disciplinari']."</td>";
                            $tabella .= "<td class='bianco'>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($caratAffine == $count)
                           	 {
                          		  $tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                                  if($_POST['corso']!="Magistrale")
                          		  $tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td></tr>";
                          	 }
                           	 else
                             {
                            $tabella .= "<td class='bianco'></td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td class='bianco'></td></tr>";
                             }//else
                            }//else sopra
                            }//chiudi if
                          }//chiudi while
                            
                        $risultatoQuery=$database->eseguiQuery($query);
						$count = 0;
                        while ($row = mysqli_fetch_array($risultatoQuery)){
                        if($row['Attivita_formativa'] == "Affini"){
                        	$count +=1;
                             if($count == $caratAffMag)
                             {
                        		$tabella .= "<tr class='bianco'><td>".$row['Attivita_formativa']."</td>";
                                $tabella .= "<td>".$row['Ambiti_disciplinari']."</td>";
                             }
                            else
                            {
                            if($count==$countAffMag)
                            {
                            	$tabella .= "<tr><td>  </td>";
                                $tabella .= "<td></td>";
							}
                            else
                            {
                            	$tabella .= "<tr class='bianco'><td>  </td>";
                                $tabella .= "<td class='bianco'></td>";
                            }
                            }
                            
                            if($count == $countAffMag)
                            {
                            $tabella .= "<td>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($caratAffMag == $count)
                            	{
                            $tabella .= "<td>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td>12</td></tr>";
                           	    }
                            else
                           	 {
                            $tabella .= "<td></td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td></td></tr>";
                             }
                            }
                            else
                          {
                            $tabella .= "<td class='bianco'>".$row['SSD']." ".$row['Descrizione']."</td>";
                            if($caratAffMag == $count)
                           	 {
                          		  $tabella .= "<td class='bianco'>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                                  if($_POST['corso']!="Magistrale")
                          		  $tabella .= "<td class='bianco'>12</td></tr>";
                          	 }
                           	 else
                             {
                            $tabella .= "<td class='bianco'></td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td class='bianco'></td></tr>";
                             }//else
                            }//else sopra
                            }//chiudi if
                          }//chiudi while
            	        						
						$risultatoQuery=$database->eseguiQuery($query);
                        while ($row = mysqli_fetch_array($risultatoQuery)){
                        if($row['Attivita_formativa'] != "Affini e integrative" && $row['Attivita_formativa'] != "Affini" && $row['Attivita_formativa'] != "di base" && $row['Attivita_formativa'] != "Caratterizzanti"){
                            
                        	$tabella .= "<tr><td>".$row['Attivita_formativa']."</td>";
                            $tabella .= "<td>".$row['Ambiti_disciplinari']."</td>";
                            if($row['SSD']=="a")
                            	$tabella .="<td> </td>";
                            else
                            	$tabella .= "<td>".$row['SSD']." ".$row['Descrizione']."</td>";
                            $tabella .= "<td>".$row['CFU_min']."-".$row['CFU_max']."</td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td>".$row['CFU_min']."-".$row['CFU_max']."</td></tr>";}
                            }
                            if($_POST['corso']!="Magistrale")
                            	$tabella .= "<tr><td>TOTALE(Per conseguimento titolo)</td>";
                            else
                            	$tabella .= "<tr><td>TOTALE</td>";
                            $tabella .= "<td> </td>";
                            $tabella .= "<td> </td>";
                            if($_POST['corso']!="Magistrale")
                            	$tabella .= "<td> </td>";
                            else
                            	$tabella .= "<td>120</td>";
                            if($_POST['corso']!="Magistrale")
                            $tabella .= "<td>180</td></tr>";
					$tabella .="</tbody><tfoot><tr>
                        <th>Attivit&agrave formativa</th>
                        <th>Ambito disciplinare</th>
                        <th>Settore</th>
                        <th>CFU</th>";
                        if($_POST['corso']!="Magistrale")
                      		$tabella .=" <th>TotCFU</th>";
					$tabella .= "</tr></tfoot>";
						session_start();
						$_SESSION['ordinamento'] = "".$tabella;
						header("location:http://prd.altervista.org/Presentation%20Layer/Ordinamento/Vis_OrdinamentoScelto.php");
?>