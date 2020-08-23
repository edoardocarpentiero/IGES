<?php

if (!isset($_SESSION))
    session_start();
?>
<!--
    Crea_ProgDid_pagina

	Questa classe implementa l'interfaccia grafica per il completamento della creazione 
    di una nuova programmazione didattica

 	Author: Stefano Cirillo, Alessandro Kevin Barletta, Edoardo Carpentiero, Gianmarco Mucciariello
 	Version : 1.0
 	2015 - Copyright by Pr.D Project - University of Salerno
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pr.D. - UNISA Informatica </title>    
    <!--Input con sfondo trasparente (user e pass) -->
    <style type="text/css"> #inputLogin{background: transparent; border-style: none;
	     /* Stili comuni agli elementi del form */
	    color: #dedede; /* Colore del testo */
	    float: left; /* Float a sinistra */
	    font-family: Verdana, sans-serif; /* Tipo di carattere per il testo */
	    margin: 10px 0; /* Margini */
	}</style>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="http://localhost/IGES/Presentation%20Layer/index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>r.<b>D.</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="text-align: left;"><img src="../dist/img/logoRidotto2.png" alt="logo"><b>&nbsp&nbsp&nbspP</b>r.<b>D.</b></span>
        </a>

<!-- BARRA DI NAVIGAZIONE SUPERIORE -->
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a> 
          <div class="navbar-custom-menu">
<?php

if($_SESSION['logged']==true)
{
echo '
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <img src="'.$_SESSION['fotoProfilo'].'" class="user-image" alt="User Image">
                  <span class="hidden-xs">'.$_SESSION['username'].'</span>
                </a>
                <ul class="dropdown-menu">
                 
                 <!-- User image -->
                  <li class="user-header">
                     <img src="'.$_SESSION['fotoProfilo'].'" class="img-circle" alt="User Image">
                    <p>
                      '.$_SESSION['username'].'
                    </p>
                  </li>
                  
<!-- Menu BODY PROFILO -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <form name="logout" method="post" action="/Application%20Layer/GestioneAutenticazione/Autenticazione.php">
					  <input type="hidden" name="funzione" value="logout">
					  <input type="hidden" name="nomepagina" value="/Presentation%20Layer/index.php">
					  <input type="submit" name="Logout" value="Logout"  style="background-color: #FF8800 !important;
                      border: 2px solid #FCA800 !important; color: #fff !important; font-weight: bold !important;
                      padding: 0 !important; margin: 10px 0 !important; height: 25px !important; width: 80px !important;" />
					  </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
';}else{
echo ' 
<ul class="nav nav-bar"><ul>
<form name="login" method="post" action="/Application%20Layer/GestioneAutenticazione/Autenticazione.php">
<input type="hidden" name="funzione" value="login" >
<input type="hidden" name="nomepagina" value="/Presentation%20Layer/index.php">
<input type="text" id="inputLogin" name="username" placeholder="username">
<input type="password" name="password" id="inputLogin" placeholder="password">
<input type="submit"  name="Accedi" id="bottoneLogin" value="Accedi"  style="background-color: #FF8800 !important; border: 2px solid #FCA800 !important; 
color: #fff !important; font-weight: bold !important; padding: 0 !important; margin: 10px 0 !important; height: 25px !important; width: 80px !important;" />
<br><a href="/Autenticazione/RecuperaPassword.php" style="color: white !important;">Hai dimenticato la Password?</a>
</form>';}
?>

          </div>
        </nav>
      </header>
<!-- FINE BARRA NAVIGAZIONE -->

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

<?php

if($_SESSION['logged']==true)
{
echo '
<!-- LOGIN -->      
          <div class="user-panel">
           <div class="pull-left image">
              <img src="'.$_SESSION['fotoProfilo'].'" class="img-circle" alt="User Image"><br><br>
            </div> 

<!-- DATI LOGIN-->
            <div class="pull-left info">
              <p>'.$_SESSION['username'].'</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>';}
 ?>        

<!-- MENU LATERALE SX -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          
          <li class="header"><!--MAIN NAVIGATION -->

<?php
if($_SESSION['logged']==true AND $_SESSION['presidente'] == true)
{
echo '
<!-- DOCENTI Menu -->
            <li class="treeview">
              <a href="#">
                <i class="ion ion-person-stalker"></i> <span>Docenti</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="../Docente/Add_Doc.php"  style="font-size: 13px;"><i class="fa fa-circle-o"></i>Aggiungi Docente</a></li>
                <li><a href="../Docente/Mod_Dett_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Modifica Docente</a></li>
                <li><a href="../Docente/Mod_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Modifica stato Docente</a></li>
                <li><a href="../Docente/Vis_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Visualizza Docenti</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i>
                <span>Insegnamento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Insegnamento/Add_Ins.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Nuovo Insegnamento</a></li>
                <li><a href="../Insegnamento/Mod_Ins.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Modifica Insegnamento</a></li>
                <li><a href="../Insegnamento/Vis_Insegnamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Insegnamenti</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>Ordinamento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Ordinamento/Vis_Ordinamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Ordinamento</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Regolamento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Regolamento/Crea_Reg.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Crea Regolamento</a></li>
                <li><a href="../Regolamento/Mod_Reg.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Modifica Regolamento</a></li>
                <li><a href="../Regolamento/Pub_Reg.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Pubblica Regolamento</a></li>
                <li><a href="../Regolamento/Vis_Regolamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Regolamento</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Programmazione Didattica</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Crea_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Crea Prog. Did.</a></li>
                <li><a href="Mod_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Modifica Prog. Did.</a></li>
                <li><a href="VisMonteOre_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Monte Ore</a></li>
				<li><a href="Vis_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Prog. Did.</a></li>
                <li><a href="CambiaStato_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Cambia Stato</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Account/Add_Acc.php"><i class="fa fa-circle-o" style="font-size: 13px;"></i> Aggiungi Account</a></li>
                <li><a href="../Account/Del_Acc.php"><i class="fa fa-circle-o" style="font-size: 13px;"></i> Elimina Account</a></li>
                <li><a href="../Account/Vis_Account.php"><i class="fa fa-circle-o" style="font-size: 13px;"></i> Visualizza Account</a></li>
                <li><a href="../Account/Vis_El_Acc.php"><i class="fa fa-circle-o" style="font-size: 13px;"></i> Elenco Account</a></li>
            </li>
    	</ul>
                ';//chiudi echo
}// chiudi IF
else {
echo '
<!-- PROFESSORI Menu -->
            <li class="treeview">
              <a href="#">
                <i class="ion ion-person-stalker"></i> <span>Docenti</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Docenti/Vis_Doc.php"><i class="fa fa-circle-o"></i>Visualizza Docenti</a></li>';
                echo '
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i>
                <span>Insegnamento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Insegnamento/Vis_Insegnamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Insegnamenti</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>Ordinamento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Ordinamento/Vis_Ordinamento.php"><i class="fa fa-circle-o"></i> Visualizza Ordinamento</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Regolamento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Regolamento/Vis_Regolamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Regolamento</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Programmazione Didattica</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li><a href="Vis_ProgD.php"><i class="fa fa-circle-o"></i> Visualizza Prog. Did.</a></li>
                 '; if($_SESSION['logged']==true){
                 echo '
                 <li><a href="Vis_CarD.php"><i class="fa fa-circle-o"></i> Carico Didattico</a></li>
             ';} echo ' </ul>
            </li>
          		<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Account/Vis_Account.php"><i class="fa fa-circle-o"></i> Visualizza Account</a></li>
              </ul>
            </li>
';}
?>

            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <h1>
            Programmazione Didattica
            <small>Crea Programmazione Didattica</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Crea Programmazione Didattica</a></li>
          </ol>
        </section>

<!-- CORPO CENTRALE DEL SITO -->
        <!-- Main content -->
       	<section class="content">
 <!-- BOX CENTRALE -->
		<div class="">
		
		<!--  TABELLA COMPLETA -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Programmazione Didattica</h3>
                   <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <input type="hidden" id="corsoSelezionato" value="<?php echo $_GET["laurea"];?>">
                <div class="box-body">
<!-- CORPO TABELLA -->
				<input type="hidden" id="oreTotaliProf10" value="">
                <input type="hidden" id="ruoloProf10" value="">
                
                <form name="confermaProgD" method="post" action="../../Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php" enctype="multipart/form-data" onsubmit="return confirm('Sicuro di voler confermare?');">
				
				<input type="hidden" name="funzione" value="confermaProgD"> </input> 
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                      	<th>Insegnamento</th>
                      	<th>Classe</th>
                      	<th>Settore</th>
                      	<th>CFU</th>
                      	<th>Ore Teoria</th>
                      	<th>Ore Laboratorio</th>
                      	<th>Totale Ore</th>
                      	<th>Tipologia</th>
                        <th>Docente</th>
                        <th>Ruolo</th>
                        <th>SSD</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                    <?php
                    
                    	$curriculum=explode(".",$_GET["curriculum"]);
                        $_SESSION['curriculumProgDid']=$curriculum[1];
                        require_once(dirname(__DIR__,2).'\Application Layer\GestioneProgrammazioneDidattica\GestioneProgrammazioneDidattica.php');
                        require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');
						

                        $gestProg=new GestioneProgrammazioneDidattica();
						$databaseS=new Database();
						$databaseS->connettiDB();
						$insegnamenti=$gestProg->getInsegnamenti($_GET["annoDiCorso"],$_GET["laurea"],$curriculum[0], $_GET["annoAccademico"]);
						$tipo=$_GET["laurea"];
                        $_SESSION['esamiPresenti']=0;
                        
                        
			//ALERT SE LA PROG DIDATTICA ESISTE GIA
			if($_SESSION['primaCreazionePrD'] ==1)
        	{   		
                        
                        
                        $esiste=0;
                        $query = "SELECT ID FROM Programmazione_Didattica WHERE Anno_corso='".$_GET['annoDiCorso']."' AND Corso='".$_GET['laurea']."' AND Semestre='".$_GET['semestre']."'";
											$risultatoxQuery=$databaseS->eseguiQuery($query);
                                            $numRows = mysqli_num_rows($risultatoxQuery);
                                            if($numRows>0)
                                            	$esiste = 1;
                                           
                 if($esiste == 1)                           	
            	{   
					$msg="Questa Programmazione Didattica esiste, sarai reindirizzato alla pagina di Modifica!";
					
                	$_SESSION['primaCreazionePrD']=0;
                }
                	$_SESSION['primaCreazionePrD'] = 0;
        	} //FINE ALERT
            ?>
            <script  type="text/javascript" language="javascript">
    		  var errorMsg = '<? echo addslashes($msg); ?>';
      			if (errorMsg != '') {
         			alert(errorMsg);
                    window.location.href='Mod_ProgDid.php';
      }
      </script>
            <?php
                        
                    	foreach($insegnamenti as $ins){
                        	$_SESSION['esamiPresenti']+=1;
                            $id=$ins->getID();
							$cfuFrontale=intval($ins->getCfuFrontale());
							$cfuLaboratorio=intval($ins->getCfuLaboratorio());
							$cfu=$cfuFrontale+$cfuLaboratorio;
							$denominazione=$ins->getDenominazione();
							$ssd=$ins->getSSD();
							$durataCorso=$ins->getDurataCorso();
                            //ELIMINARE
                            //echo "<input type='text' value='".$durataCorso."'>";
							$tipologiaLezione=$ins->getTipologiaLezione();
							$classi=intval($_GET["classi"]);
							$esameInserito= 0;
							
							for($i=1;$i<=$_SESSION['rigaPrD']; $i++)
							{	
								if($_SESSION['insegnamento'.$i.'0'] == $denominazione)
								{
									$esameInserito = $i;
                                    $_SESSION['esamiInseriti'] +=1;
									break;
								} //Se trova l'esame corrispondente esce dal ciclo
							}//endFor rigaPrD
							
							if($esameInserito != 0)
							{	
								for($j=$esameInserito; $j<($esameInserito+ $classi); $j++)
								{	
									echo '<tr id=\''.$id.'\' onclick="riempiTabelle(\''.$denominazione.'\', \''.$ssd.'\', \''.$cfu.'\', \''.$tipologiaLezione.'\', \''.$classi.'\',\''.$durataCorso.'\',\''.$cfuFrontale.'\',\''.$cfuLaboratorio.'\',\''.$id.'\')">';
									echo '<td><a href="#associa">'.$denominazione.'</a></td>';
									echo '<td>'.($j - $esameInserito + 1).'</td>';
									echo '<td>'.$ssd.'</td>';
									echo '<td>'.$cfu.'</td>';
									echo '<td>'.$_SESSION['oreTeoria'.$j.'0'].'</td>';
									echo '<td>'.$_SESSION['oreLab'.$j.'0'].'</td>';
									echo '<td>'.$durataCorso.'</td>';
									echo '<td>'.$tipologiaLezione.'</td>';
									echo '<td>';
									
									//I 3 for successivi servono a stampare, nel caso fossero presenti, i nomi di piu docenti assegnati allo stesso corso
									for($k=0; $k<5; $k++)
									{
										if($_SESSION['docente'.$j.''.$k] != 0)
										{
											$query = "SELECT Nome, Cognome FROM Docente WHERE Matricola='".$_SESSION['docente'.$j.''.$k]."'";
											$risultatosQuery=$databaseS->eseguiQuery($query);
											while($row = mysqli_fetch_array($risultatosQuery))
												echo ''.$row['Nome'].' '.$row['Cognome'].'<br>';
										}	
									}	
									echo '</td>';
									
									echo '<td>';
									for($k=0; $k<5; $k++)
									{
										if($_SESSION['docente'.$j.''.$k] != 0)
										{
											$query = "SELECT Ruolo FROM Docente WHERE Matricola='".$_SESSION['docente'.$j.''.$k]."'";
											$risultatosQuery=$databaseS->eseguiQuery($query);
											while($row = mysqli_fetch_array($risultatosQuery))
												echo ''.$row['Ruolo'].'<br>';
											
										}	
									}	
									echo '</td>';
									
									echo '<td>';
									for($k=0; $k<5; $k++)
									{
										if($_SESSION['docente'.$j.''.$k] != 0)
										{
											$query = "SELECT SSD FROM Docente WHERE Matricola='".$_SESSION['docente'.$j.''.$k]."'";
											$risultatosQuery=$databaseS->eseguiQuery($query);
											while($row = mysqli_fetch_array($risultatosQuery))
												echo ''.$row['SSD'].'<br>';
										}	
									}	
									echo '</td>';
									
									echo '</tr>';
								}//end for
							}//endif
							else
							{//Se non è stato ancorai nserito il docente verranno lasciati vuoi i relativi campi
								echo '
                             <tr id=\''.$id.'\'  onclick="riempiTabelle(\''.$denominazione.'\', \''.$ssd.'\', \''.$cfu.'\', \''.$tipologiaLezione.'\', \''.$classi.'\',\''.$durataCorso.'\',\''.$cfuFrontale.'\',\''.$cfuLaboratorio.'\',\''.$cfuLaboratorio.'\')">';
									echo '<td><a href="#associa">'.$denominazione.'</a></td>';
									echo '<td></td>';
									echo '<td>'.$ssd.'</td>';
									echo '<td>'.$cfu.'</td>';
									echo '<td></td>';
									echo '<td></td>';
									echo '<td>'.$durataCorso.'</td>';
									echo '<td>'.$tipologiaLezione.'</td>';
									echo '<td></td>';
									echo '<td></td>';
									echo '<td></td>';
							}
                    	}//end foreach insegnamenti
                    echo '
					</tbody>
                    <tfoot>
                      <tr>
                       	<th>Insegnamento</th>
                      	<th>Classe</th>
                      	<th>Settore</th>
                      	<th>CFU</th>
                      	<th>Ore Teoria</th>
                      	<th>Ore Laboratorio</th>
                      	<th>Totale Ore</th>
                      	<th>Tipologia</th>
                        <th>Docente</th>
                        <th>Ruolo</th>
                        <th>SSD</th>
                      </tr>
                    </tfoot>
                  </table>
                  <section class="col-lg-12">
			        <div class="box-footer" style="text-align: center;">
		<!-- I TASTI SI DEVONO ATTIVARE SOLO QUANDO SONO STATE FATTE LE ASSEGNAZIONI -->';
        				
			        	
			        	echo '<input type="submit" name="submitAnnulla" value="Annulla"  class="btn btn-default btn-lg" value="Annulla">';
						if($_SESSION['rigaPrD'] != 0)
						{
							if(($_SESSION['esamiPresenti'] - $_SESSION['esamiInseriti']) != 0){
								echo "<input type='submit' name='submitConferma' value='Conferma' class='btn btn-default btn-lg'>";
                                }
							else
								echo '<input type="submit" name="submitConferma" class="btn btn-default btn-lg" value="Conferma">';
						}
						else
							echo '<input type="button" class="btn btn-default btn-lg" value="Conferma" disabled= "disabled">';
                            
						echo '
                        </form>
			      	</div>
			      </section>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<!-- FINE TABELLA -->';

			
            
          echo '  <!-- Left col -->
			 <div class="box box-default" id="assegnazione" style="display:none;">
                <div class="box-header with-border">
                  <a name="associa"></a><h3 class="box-title">Crea Programmazione Didattica - Assegnazioni</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
				<h2 style="text-align: center"> Esame selezionato <span id="nome"></span></h2>';
				
					//RIPETERE TANTE VOLTE QUANTE SONO LE CLASSI SELEZIONATI NELLA PAGINA Crea_ProgDid.php
					//SONO STATE IPOTIZZATE 3 CLASSI
					$numClassi = intval($_GET["classi"]);
                    $semestre=$_POST['semestre'];
                    
					for($i=1;$i<=$numClassi;$i++){
                    
						echo '<input type="hidden" id="oreTotaliProf'.$i.'0" value="">
                				<input type="hidden" id="ruoloProf'.$i.'0" value="">
    						<h3 style="text-align: center"> Classe '.$i.' - '.$_GET['semestre'].'° semestre</h3>
    						<p>
								<form name="creaProgD" method="post" action="../../Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php">
									
                                    <table align="center" class="table table-bordered table-striped"><tr>
    									<td style="text-align: right;">
											<div class="btn-group">
    											 <button type="button" class="btn btn-default"  onclick="aggiungiProf('.$i.')">+ Aggiungi docente</button>
                                                 <button type="button" class="btn btn-default" id="'.$i.'" onclick="eliminaProf('.$i.',this.value);test('.$i.')">- Elimina Docente</button>
    										</div>
    									</td>
									</tr></table>	
								
							</p>
	    					<div class="box-body">
                            
                            ';
                        
                        echo "
                        <input type='hidden' name='funzione' value='creaProgD'>
                        <input type='hidden' name='insegnamento' value='' id='insB".$i."'>
						<input type='hidden' name='annoAccademico' id='annoAccademico' value='".$_GET['annoAccademico']."'>
						<input type='hidden' id='corso' name='laurea' value='".$_GET['laurea']."'>
						<input type='hidden' name='semestre' id='semestre' value='".$_GET['semestre']."'>
						<input type='hidden' name='annoDiCorso' value='".$_GET['annoDiCorso']."'>
						<input type='hidden' id='denominazioneCurriculum' name='curriculum' value='".$curriculum[0]."'>
                        <input type='hidden' name='idCurriculum' value='".$curriculum[1]."'>
						<input type='hidden' id='classi' name='classi' value='".$numClassi."'>
                        <input type='hidden' id='cfuFrontali' value='0'>
                        <input type='hidden' id='cfuLab' value='0'>
                        <!--<input type='text' id='query'> -->
                        ";
                        
                        error_reporting(E_ALL);
						echo '		
                        		<p id="errore'.$i.'" name="errore'.$i.'" style="color: red;"></p>
                                <p id="erroreDocente'.$i.'" style="color: red;"></p>
				                  <table id="tab'.$i.'" class="table table-bordered table-striped">
				                    <thead>
				                      <tr>
				                      	<th>Insegnamento</th>
				                      	<th>Classe</th>
				                      	<th>Settore</th>
				                      	<th>CFU</th>
				                      	<th>Ore Teoria</th>
				                      	<th>Ore Laboratorio</th>
				                      	<th>Totale Ore/<span id="tot'.$i.'"></span></th>
				                      	<th>Tipologia</th>
				                        <th>Docente</th>
				                        <th>Ruolo</th>
				                        <th>SSD</th>
				                      </tr>
				                    </thead>
				                    <tbody id="associazione'.$i.'">';
                                    		$idTotOre="tot".$i."0";
                                            echo '<tr>';
												echo '<td  id="denominazione'.$i.'">Insegnamento</td>';
												echo '<td name="classe" id="classe'.$i.'">'.$i.'</td>';
												echo '<td name="settore" id="settore'.$i.'">Settore</td>';
												echo '<td name="CFU" id="cfu'.$i.'">CFU</td>';
												
                                                
                                                echo '<td>
                                                	<input type="button" onclick="calcoloOre('.$i.',\'teoria\',\'oreTeoria'.$i.'0\',this.value,\''.$idTotOre.'\')" value="-">
                                                	<input name="oreTeoria'.$i.'0" type="number" readonly id="oreTeoria'.$i.'0" type="text" value="0" style="width: 30%;">
                                                    <input type="button" onclick="calcoloOre('.$i.',\'teoria\',\'oreTeoria'.$i.'0\',this.value,\''.$idTotOre.'\')" value="+">
                                                </td>';
												echo '
                                                <td>
                                                	<input type="button" onclick="calcoloOre('.$i.',\'lab\',\'oreLab'.$i.'0\',this.value,\''.$idTotOre.'\')" value="-">
                                                	<input name="oreLab'.$i.'0" type="number" readonly id="oreLab'.$i.'0" type="text" value="0" style="width: 30%;">
                                                    <input type="button" onclick="calcoloOre('.$i.',\'lab\',\'oreLab'.$i.'0\',this.value,\''.$idTotOre.'\')" value="+">
                                                </td>';
												
                                                
                                                echo '<td name="totOre[]" id="'.$idTotOre.'"></td>';
												echo '<td name="tipologia" id="tipologia'.$i.'">Tipologia</td>';
												echo '<td> <select name="docente'.$i.'0" class="form-control" id="prof'.$i.'0" onchange="setCampiProf(this.value,'.$i.'0)">';
                                                
                                                echo '</select></td>';
												echo '<td name="ruolo" id="ruolo'.$i.'0"></td>';
												echo '<td name="ssd" id="ssd'.$i.'0"></td>';
                                            echo '</tr>';
                                    echo '</tbody>
				                    <tfoot>
    								</tfoot>
				                  </table>
								  
				                </div>
    						<section class="col-lg-12">&nbsp</section>
          				<section class="col-lg-12">&nbsp</section>
          				<section class="col-lg-12">&nbsp</section>';
					}
					
				?>                
<!-- CORPO BOX -->
					 <section class="col-lg-12">&nbsp;</section>
				     <section class="col-lg-12">&nbsp;</section>
		        	 <section class="col-lg-12">
			        	<div class="box-footer" style="text-align: center;">
<!-- IL TASTO SALVA TI RIPORTA A CREA_PROGDID.PHP, ATTIVA I PULSANTI DI QUELLA PAGINA E AGGIUNGE L'INSEGNAMENTO AL DB E ALLA TABELLA -->
			        		<input type="button" class="btn btn-default btn-lg" value="Salva Modifiche" onclick="verificaErrori()" name="salva">
			        		<!--<input type="button" class="btn btn-default btn-lg" value="Annulla" name="annulla" onclick="annulla()">-->
                         
							
			        	</div>
			        </section>
				 </form>
                </div><!-- /.box-body -->
			</div>
			
 		</div><!-- /.row (main row) -->
       	
        </section>
      </div><!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="">Universit&agrave degli studi di Salerno - Dipartimento di Informatica</a>.</strong> All rights reserved.
      </footer>
    </div> 

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- page script -->
	 <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
    <script type="text/javascript">
    	var oreTotProf=0;
        var oreCorsoTeoria=oreCorsoLab=0;
        var teoria=lab=0;
    	if(document.getElementById("corso").value=="Laurea"){
            	teoria=8;
                lab=10;
            }
            else
            	teoria=lab=8;
    	
        function riempiSelect(i){
        	var sel=document.getElementById("prof"+i+"0");
        	var req=new XMLHttpRequest();
            var professore="<option value='Nessun Professore'>Seleziona docente</option>";
            req.onreadystatechange=function(){
                if(req.status==200 && req.readyState==4){
                	docenti=JSON.parse(req.responseText);
                    if(docenti.length>0){
                       for(j=0;j<docenti.length;j++){
                            var doc=docenti[j].split(".");
                       		value=doc[0]+'.'+doc[1]+'.'+doc[2];
                         	val=doc[3]+" "+doc[4];
                         	professore+="<option value='"+value+"'>"+val+"</option>";
                        }
            		}
                    sel.innerHTML=professore;
                }
            }
            var dati=new FormData();
            dati.append("funzione", "riempiSelect");
            req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php", true);
            req.send(dati);
        }
        
		function aggiungiProf(i){ 
        	var tab=document.getElementById("associazione"+i);
        	var n=tab.childNodes.length;
        	var req=new XMLHttpRequest();
            req.onreadystatechange=function(){
                if(req.status==200 && req.readyState==4){
                    var tr=document.createElement("tr");
                    tr.innerHTML=req.responseText;
                    tab.appendChild(tr);
				}
            }
            var dati=new FormData();
            dati.append("funzione", "associa");
            dati.append("nClasse",i);
            dati.append("numeroProf",n);
            dati.append("corso",document.getElementById("corsoSelezionato").value);
            req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php", true);
            req.send(dati);
		}
        
		function riempiTabelle(denominazione, settore, cfu, tipologia, classi, durata,cfuFrontali,cfuLab){
        	document.getElementById("nome").innerHTML=denominazione;
            for(var i=1;i<=classi;i++){
            	riempiSelect(i);
            	document.getElementById("insB"+i).value= denominazione;
            	document.getElementById("denominazione"+i).innerHTML=denominazione;
                document.getElementById("settore"+i).innerHTML=settore;
                document.getElementById("cfu"+i).innerHTML=cfu;
                document.getElementById("tipologia"+i).innerHTML=tipologia;
                document.getElementById("tot"+i+"0").innerHTML=0;
                document.getElementById("oreLab"+i+"0").value=0;
                document.getElementById("oreTeoria"+i+"0").value=0;
                document.getElementById("tot"+i).innerHTML=durata;
                document.getElementById("errore"+i).innerHTML="";
                document.getElementById("erroreDocente"+i).innerHTML="";
            }
            document.getElementById("cfuFrontali").value=cfuFrontali;
            document.getElementById("cfuLab").value=cfuLab;
            oreCorsoTeoria=oreCorsoLab=0;
            calcoloOreCFU();
            for(var i=1;i<=classi;i++)
            	testOre(i);
            document.getElementById("assegnazione").style.display="block";
		}
        
        function setCampiProf(dato,numero){
        	if(dato!="Nessun Professore"){
                document.getElementById("prof"+numero).value=dato;
                inf=dato.split(".");
                document.getElementById("ssd"+numero).innerHTML=inf[1];
                document.getElementById("ruolo"+numero).innerHTML=inf[2];
                document.getElementById("tot"+numero).innerHTML=0;
                document.getElementById("oreLab"+numero).value=0;
                document.getElementById("oreTeoria"+numero).value=0;
                confrontaSSD(inf[1]);
                oreTotaliProf(inf[0],inf[2],numero);
                
            }else{
            	document.getElementById("ssd"+numero).innerHTML="";
              	document.getElementById("ruolo"+numero).innerHTML="";
                document.getElementById("tot"+numero).innerHTML=0;
                document.getElementById("oreLab"+numero).value=0;
                document.getElementById("oreTeoria"+numero).value=0;
                document.getElementById("erroreDocente"+String(numero).substring(0, 1)).removeChild(document.getElementById("d"+numero));
            }
        }
        
        function oreTotaliProf(matricolaProf,ruolo,numero){
        	var req=new XMLHttpRequest();
            req.onreadystatechange=function(){
        	    if(req.status==200 && req.readyState==4){
                    document.getElementById("oreTotaliProf"+numero).value=req.responseText;
                    document.getElementById("ruoloProf"+numero).value=ruolo;
                    oreTotProf=document.getElementById("oreTotaliProf"+numero).value;
               }
            }
            var dati=new FormData();
            dati.append("funzione", "getOreTot");
            dati.append("matricola",matricolaProf);
            dati.append("ruolo",ruolo);
            req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php", true);
            req.send(dati);
        }
        
        
        function calcoloOre(nTab,tipologia,idOre,segno,idTotOre){
            oreAggiunte=0;
            if(parseInt(document.getElementById(idOre).value)==0 && segno=="-")
            	document.getElementById(idOre).value=0;
            else if(document.getElementById("prof"+idTotOre.substring(idTotOre.length-2, idTotOre.length)).value=="Nessun Professore"){
            	alert("Selezionare un Docente!");
            }
            else{
                if(segno=="+" && tipologia=="teoria"){
                    document.getElementById(idOre).stepUp(teoria);
                    var tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)+teoria;
                    oreAggiunte=teoria;
                }
                else if(segno=="-" && tipologia=="teoria"){
                    document.getElementById(idOre).stepDown(teoria);
                    tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)-teoria;
                    oreAggiunte=teoria;
                }
                else if(segno=="+" && tipologia=="lab"){
                    document.getElementById(idOre).stepUp(lab);
                    tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)+lab;
                    oreAggiunte=lab;
                }
                else if(segno=="-" && tipologia=="lab"){
                    document.getElementById(idOre).stepDown(lab);
                    tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)-lab;
                    oreAggiunte=lab;
                }
                testOre(nTab);
                
                if(segno=="+"){
                    n=parseInt(document.getElementById("oreTotaliProf"+idTotOre.substring(idTotOre.length-2, idTotOre.length)).value);
                    n+=oreAggiunte;
                    document.getElementById("oreTotaliProf"+idTotOre.substring(idTotOre.length-2, idTotOre.length)).value =n;
                }
                else{
                    n=parseInt(document.getElementById("oreTotaliProf"+idTotOre.substring(idTotOre.length-2, idTotOre.length)).value);
                    n-=oreAggiunte;
                    document.getElementById("oreTotaliProf"+idTotOre.substring(idTotOre.length-2, idTotOre.length)).value=n;
                }
            controllaOreDocente(idTotOre.substring(idTotOre.length-2, idTotOre.length),nTab);
            }
        }
        
        function controllaOreDocente(idRiga,nTab){
            somma=parseInt(document.getElementById("oreTotaliProf"+idRiga).value);
            ruolo=document.getElementById("ruoloProf"+idRiga).value;
            if(ruolo=="Docente Associato PA")
            	testRuoloOre(ruolo,"Docente Associato PA",120,180,nTab,idRiga,somma);
            else if(ruolo=="Docente Ordinario PO")
            	testRuoloOre(ruolo,"Docente Ordinario PO",120,180,nTab,idRiga,somma);
            else if(ruolo=="Ricercatore a tempo indeterminato RU")
            	testRuoloOre(ruolo,"Ricercatore a tempo indeterminato RU",0,90,nTab,idRiga,somma);
            else if(ruolo=="Ricercatore a tempo determinato RTDA")
            	testRuoloOre(ruolo,"Ricercatore a tempo determinato RTDA",0,66,nTab,idRiga,somma);
            else if(ruolo=="Ricercatore a tempo determinato RTDB")
           		testRuoloOre(ruolo,"Ricercatore a tempo determinato RTDB",0,78,nTab,idRiga,somma);
        }
        
        function testRuoloOre(ruoloProf,ruolo,oreMin,oreMax,nTab,idRiga,somma){   
            if(ruoloProf==ruolo && (somma>oreMin && somma<=oreMax))
            	alert("Stai aggiungendo ore extra al professore");
        	if(somma>oreMax){
                span=document.createElement("span");
                numeroProf=parseInt(idRiga.substring(1, 2))+1;
                span.innerHTML="Errore Professore "+numeroProf+": Ore assegnate al docente: "+somma+"/"+oreMax+"<br>";
                span.setAttribute("id","d"+idRiga);
                if(document.getElementById("d"+idRiga)==undefined)
                    document.getElementById("erroreDocente"+nTab).appendChild(span);
                else
                	document.getElementById("d"+idRiga).innerHTML="Errore Professore "+numeroProf+": Ore assegnate al docente: "+somma+"/"+oreMax+"<br>";
            }
			else{ 
            		if(document.getElementById("d"+idRiga)!=undefined)
                    	document.getElementById("erroreDocente"+nTab).removeChild(document.getElementById("d"+idRiga));
                }
        }
        
        function confrontaSSD(ssd){
        	if(document.getElementById("settore1").innerHTML!=ssd)
            	alert("Attenzione!\nIl docente assegnato non appartiene al SSD indicato dall'insegnamento!");
        }
        
        
        
     	function testOre(nTab){
        	val=controllaOre(nTab);
                if(val!=""){
                	risultato=val.split(".")
                    //alert(risultato);
                    if(risultato.length==4)
                		document.getElementById("errore"+nTab).innerHTML="Ore "+risultato[0]+": "+risultato[1]+"/"+risultato[2];
                    else
                    	document.getElementById("errore"+nTab).innerHTML="Ore "+risultato[0]+": "+risultato[1]+"/"+risultato[2]+"\nOre "+risultato[3]+": "+risultato[4]+"/"+risultato[5];
                }
                else
                	document.getElementById("errore"+nTab).innerHTML="";
        }
     
     	function controllaOre(nTab){
        	var tab=document.getElementById("associazione"+nTab);
        	var nChild=tab.childNodes.length;
            var contTeoria=0;
            var contLab=0;
           for(var i=0;i<nChild;i++){
            	t=parseInt(document.getElementById("oreTeoria"+nTab+""+i).value);
                contTeoria+=t;
            }
            for(var i=0;i<nChild;i++){
            	l=parseInt(document.getElementById("oreLab"+nTab+""+i).value);
                contLab+=l;
            }
            errore="";
            if(contTeoria>oreCorsoTeoria || contTeoria<oreCorsoTeoria || contTeoria!=oreCorsoTeoria)
            	errore+="Teoria."+contTeoria+"."+oreCorsoTeoria+"<br>.";
            if(contLab>oreCorsoLab || contLab<oreCorsoLab ||contLab!=oreCorsoLab)
            	errore+="Laboratorio."+contLab+"."+oreCorsoLab+"<br>.";
            return errore;
            
        }
        
        function calcoloOreCFU(){
        	var cfuF=document.getElementById("cfuFrontali").value;
            var cfuL=document.getElementById("cfuLab").value;
        	if(document.getElementById("corso").value=="Laurea"){
            	for(var i=1;i<=cfuF;i++)
                	oreCorsoTeoria+=8;
               	for(var i=1;i<=cfuL;i++)
                	oreCorsoLab+=10;
            }
            else{
            	for(var i=1;i<=cfuF;i++)
                	oreCorsoTeoria+=8;
               	for(var i=1;i<=cfuL;i++)
                	oreCorsoLab+=8;
            }
        }
        
        function eliminaProf(i,value){
        	var tab=document.getElementById("associazione"+i);
            
            if(tab.childNodes.length>1){
            	n=tab.childNodes.length-1;
                //if(document.getElementById("d"+i+""+n)!=undefined);
            	//	document.getElementById("erroreDocente"+i).removeChild(document.getElementById("d"+i+""+n));
                tab.removeChild(tab.lastChild);
            }
            
        }
        
        function annulla(){
        	location.href="http://localhost/IGES/Presentation%20Layer/Prog/Crea_ProgDid.php";
        }
        
        function controllaDocente(){
        	errori="";
            for(var i=1;i<=document.getElementById("classi").value;i++){
            	var tab=document.getElementById("associazione"+i);
        		var n=tab.childNodes.length;
            	for(var j=0;j<n;j++){
                	var value=document.getElementById("prof"+i+""+j).value;
                	if(value=="Nessun Professore")
                    	errori+=value;
                }
            }
            return errori;
        }
        
        function controllaErroreOre(){
        	errori="";
        	for(i=1;i<=document.getElementById("classi").value;i++)
            	errori+=document.getElementById("errore"+i).innerHTML;
            return errori;
        }
        
        function controllaOreAssociate(){
        	errori="";
        	for(i=1;i<=document.getElementById("classi").value;i++)
            	errori+=document.getElementById("erroreDocente"+i).innerHTML;
            return errori;
        }
        
        function verificaErrori(){
        	var errore="";
            var docente=controllaDocente();
            var ore=controllaErroreOre();
            var oreDocente=controllaOreAssociate();
        	if(docente!="")
            	errore="Nessun docente associato!";
        	if(ore!="")
            	errore+="Verificare numero di ore associate!";
            if(oreDocente!="")
            	errore+="Verificare numero di ore associate al Docente!";
            if(errore!="")
            	alert(errore);
            else
            	document.creaProgD.submit();
        }
        
    </script>    
  </body>
</html>
