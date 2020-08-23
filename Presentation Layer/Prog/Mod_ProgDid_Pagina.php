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
                      <form name="logout" method="post" action="/IGES/Application%20Layer/GestioneAutenticazione/Autenticazione.php">
					  <input type="hidden" name="funzione" value="logout">
					  <input type="hidden" name="nomepagina" value="/IGES/Presentation%20Layer/index.php">
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
                <li><a href="../Account/Mod_Acc.php"><i class="fa fa-circle-o" style="font-size: 13px;"></i> Modifica Account</a></li>
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
                <li><a href="../Account/Mod_AccP.php"><i class="fa fa-circle-o"></i> Modifica Account</a></li>
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
                <input type="hidden" id="corsoSelezionato" value="<?php echo $_POST["corso"];?>">
                <div class="box-body">
<!-- CORPO TABELLA -->

                <form name="confermaProgD" method="post"
				   action="../../Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php" enctype="multipart/form-data" onsubmit="return confirm('Sicuro di voler confermare?');">

				<input type="hidden" name="funzione" value="confermaProgD">
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

                    	$curriculum=explode(".",$_POST["curriculum"]);
                        require_once(dirname(__DIR__,2).'\Application Layer\GestioneProgrammazioneDidattica\GestioneProgrammazioneDidattica.php');
                        require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');

                        $gestProg=new GestioneProgrammazioneDidattica();
						$databaseS=new Database();
						$databaseS->connettiDB();

						$insegnamenti=$gestProg->getInsegnamenti($_POST["anno"],$_POST["corso"],$curriculum[1], $_POST["annoAccademico"]);
						$tipo=$_POST["corso"];


                    	foreach($insegnamenti as $ins){

                            $id=$ins->getID();
							$cfuFrontale=intval($ins->getCfuFrontale());
							$cfuLaboratorio=intval($ins->getCfuLaboratorio());
							$cfu=$cfuFrontale+$cfuLaboratorio;
							$denominazione=$ins->getDenominazione();
							$ssd=$ins->getSSD();
                            $modulo=$ins->getModulo();
							$durataCorso=$ins->getDurataCorso();
							$tipologiaLezione=$ins->getTipologiaLezione();
							$esameInserito= 0;
							$_SESSION["informazioniInsegnamento"]=$ins;
                            $query="select classe from Associa a join Programmazione_Didattica p on (a.ID_ProgDid = p.ID) where p.Anno_Corso = '".$_POST["anno"]."' and p.Corso = '".$_POST["corso"]."' and p.Semestre = '".$_POST["semestre"]."' and p.Anno_accademico = '".$_POST["annoAccademico"]."' group by(classe)";
                            $ris=$databaseS->eseguiQuery($query);

                            echo '<tr onclick="riempiTabelle(\''.$denominazione.'\', \''.$ssd.'\', \''.$cfu.'\', \''.$tipologiaLezione.'\', \''.$durataCorso.'\',\''.$cfuFrontale.'\',\''.$cfuLaboratorio.'\',\''.$id.'\')">';
							if($modulo!=0)
                                 echo '<td rowspan="'.$ris->num_rows.'"><a href="#associa">'.$denominazione.' - '.$modulo.' MODULO</a></td>';
                            else
                                 echo '<td rowspan="'.$ris->num_rows.'"><a href="#associa">'.$denominazione.'</a></td>';

                            $numeroClassi=$ris->num_rows;
                            for($i=1;$i<=$numeroClassi;$i++){
                                    $query="select d.nome, d.cognome , d.Ruolo, d.SSD, a.Ore_Teoria, a.Ore_Lab from Docente d join Associa a on(d.Matricola = a.Matricola_Professore) join Insegnamento i on (a.Matricola_Insegnamento = i.Matricola_Insegnamento) join Programmazione_Didattica p on (a.ID_ProgDid = p.ID) 
                                    where d.Matricola=a.Matricola_Professore and i.Denominazione = '".$denominazione."' and p.Anno_Corso = '".$_POST["anno"]."' and p.Corso = '".$_POST["corso"]."' and p.Semestre = '".$_POST["semestre"]."' and p.Anno_accademico = '".$_POST["annoAccademico"]."' AND Classe=".$i."";
                                    $ris=$databaseS->eseguiQuery($query);
                                    $doc=array();
                                    $ruolo=array();
                                    $ssdDoc=array();
                                    $oreTeoria=array();
                                    $oreLab=array();


                                        while($res=$ris->fetch_row()){
                                                $doc[]="$res[0].$res[1]";
                                                $ruolo[]=$res[2];
                                                $ssdDoc[]=$res[3];
                                                $oreTeoria[]=$res[4];
                                                $oreLab[]=$res[5];
                                        }


                                        echo '<td>'.$i.'</td>';
                                        echo '<td>'.$ssd.'</td>';
                                        echo '<td>'.$cfu.'</td>';
                                        echo '<td id="oreTeoria'.$id.'">';
                                        for($k=0;$k<count($oreTeoria);$k++)
                                           echo "<div>$oreTeoria[$k]</div>";
                                        echo '</td>';
                                        echo '<td id="oreLab'.$id.'">';
                                        for($k=0;$k<count($oreLab);$k++)
                                            echo "<div>$oreLab[$k]</div>";
                                        echo '</td>';
                                        echo '<td>'.$durataCorso.'</td>';
                                        echo '<td>'.$tipologiaLezione.'</td>';
                                        echo '<td id="nominativoDocente'.$id.'">';
                                        foreach($doc as $d){
                                            $nomCong=explode(".",$d);
                                            echo "<div>$nomCong[1] $nomCong[0]</div>";
                                        }
                                        echo '</td>';
                                        echo '<td id="ruoloDocente'.$id.'">';
                                        for($k=0;$k<count($ruolo);$k++)
                                            echo "<div>$ruolo[$k]</div>";

                                        echo '</td>';
                                        echo '<td id="ssdDocente'.$id.'">';
                                        for($k=0;$k<count($ssdDoc);$k++)
                                            echo "<div>$ssdDoc[$k]</div>";

                                        echo '</td>';
                                        echo '<tr onclick="riempiTabelle(\''.$denominazione.'\', \''.$ssd.'\', \''.$cfu.'\', \''.$tipologiaLezione.'\', \''.$durataCorso.'\',\''.$cfuFrontale.'\',\''.$cfuLaboratorio.'\',\''.$id.'\')">';

                            }//end classi
                            echo "</tr>";
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
        				//elimino?

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
				$i=1;

						echo '
    						<h3 style="text-align: center"> Anno '.$_POST["anno"].' - '.$_POST["semestre"].'° semestre</h3>
    						<p>
								<form name="creaProgD" method="post" action="../../Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php">
									
                                    <table align="center" class="table table-bordered table-striped"><tr>
    									<td style="text-align: right;">
											<div class="btn-group">
    											 <button type="button" class="btn btn-default"  onclick="aggiungiProf('.$i.')">+ Aggiungi docente</button>
                                                 <button type="button" class="btn btn-default" id="'.$i.'" onclick="eliminaProf('.$i.');test('.$i.')">- Elimina Docente</button>
    										</div>
    									</td>
									</tr></table>	
								
							</p>
	    					<div class="box-body">
                            
                            ';

                        /*
                        <input type='hidden' name='insegnamento' value='' id='insB".$i."'>
						<input type='hidden' name='annoAccademico' id='annoAccademico' value='".$_GET['annoAccademico']."'>

						<input type='hidden' name='semestre' id='semestre' value='".$_GET['semestre']."'>
						<input type='hidden' name='annoDiCorso' value='".$_GET['annoDiCorso']."'>
						<input type='hidden' name='curriculum' value='".$curriculum[0]."'>
                        <input type='hidden' name='idCurriculum' value='".$curriculum[1]."'>
						<input type='hidden' id='classi' name='classi' value='".$numClassi."'>
                        */
                        echo "
                        <input type='hidden' id='corso' name='corsoLaurea' value='".$_GET['corso']."'>
                        <input type='hidden' name='funzione' value='creaProgD'>
                        <input type='hidden' id='cfuFrontali' value='0'>
                        <input type='hidden' id='cfuLab' value='0'>
                        <input type='hidden' id='oreTotaliProf10' value=''>
                        <input type='hidden' id='ruoloProf10' value=''>";

                        error_reporting(E_ALL);

                        echo '		
                        		<p id="errore'.$i.'" name="errore'.$i.'" style="color: red;"></p>
                                
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
                                                	<input name="oreTeoria'.$i.'0" type="number" readonly id="oreTeoria'.$i.'0" type="text" value="0" size="3">
                                                    <input type="button" onclick="calcoloOre('.$i.',\'teoria\',\'oreTeoria'.$i.'0\',this.value,\''.$idTotOre.'\')" value="+">
                                                </td>';
												echo '
                                                <td>
                                                	<input type="button" onclick="calcoloOre('.$i.',\'lab\',\'oreLab'.$i.'0\',this.value,\''.$idTotOre.'\')" value="-">
                                                	<input name="oreLab'.$i.'0" type="number" readonly id="oreLab'.$i.'0" type="text" value="0" size="3">
                                                    <input type="button" onclick="calcoloOre('.$i.',\'lab\',\'oreLab'.$i.'0\',this.value,\''.$idTotOre.'\')" value="+">
                                                </td>';


                                                echo '<td name="totOre" id="'.$idTotOre.'"></td>';
												echo '<td name="tipologia" id="tipologia'.$i.'">Tipologia</td>';
												echo '<td> <select name="docente'.$i.'0" class="form-control" id="prof'.$i.'0" onchange="setCampiProf(this.value,'.$i.'0)">';
                                                echo '<option value="Nessun Professore">Seleziona docente</option>';
												/*$professori=$gestProg->getProfessori();
													foreach($professori as $prof)
														 echo '<option value="'.$prof->getMatricola().'.'.$prof->getSettoreScientificoDisciplinare().'.'.$prof->getRuolo().'">'.$prof->getCognome().' '.$prof->getNome().'</option>';
												*/echo '</select></td>';
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


				?>
<!-- CORPO BOX -->
					 <section class="col-lg-12">&nbsp;</section>
				     <section class="col-lg-12">&nbsp;</section>
		        	 <section class="col-lg-12">
			        	<div class="box-footer" style="text-align: center;">
<!-- IL TASTO SALVA TI RIPORTA A CREA_PROGDID.PHP, ATTIVA I PULSANTI DI QUELLA PAGINA E AGGIUNGE L'INSEGNAMENTO AL DB E ALLA TABELLA -->
			        		<input type="button" class="btn btn-default btn-lg" value="Annulla" name="annulla" onclick="annulla()">
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

      $('#example1').on( 'error.dt', function ( e, settings, techNote, message ) {
    console.log( 'An error has been reported by DataTables: ', message );
    } ) ;
    </script>
    <script type="text/javascript">
    var oreCorsoTeoria=oreCorsoLab=0;
    var teoria=lab=0;
    		if(document.getElementById("corso").value=="Laurea"){
            	teoria=8;
                lab=10;
            }
            else
            	teoria=lab=8;


		function aggiungiProf(i){
        	var tab=document.getElementById("associazione"+i);
            var n=document.getElementById("associazione"+i).childNodes.length;
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
            dati.append("corso",document.getElementById("corso").value);
            req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneProgrammazioneDidattica/GestioneProgrammazioneDidattica.php", true);
            req.send(dati);
		}

		function riempiTabelle(denominazione, settore, cfu, tipologia, durata,cfuFrontali,cfuLab,id){
            var i=1;

            document.getElementById("denominazione"+i).innerHTML=denominazione;
            document.getElementById("settore"+i).innerHTML=settore;
            document.getElementById("cfu"+i).innerHTML=cfu;
            document.getElementById("tipologia"+i).innerHTML=tipologia;
            document.getElementById("tot"+i+"0").innerHTML=0;
            document.getElementById("oreLab"+i+"0").value=0;
            document.getElementById("oreTeoria"+i+"0").value=0;
            document.getElementById("tot"+i).innerHTML=durata;
            document.getElementById("errore"+i).innerHTML="";
            document.getElementById("cfuFrontali").value=cfuFrontali;
            document.getElementById("cfuLab").value=cfuLab;

           	var tab=document.getElementById("associazione"+i);
            var n=document.getElementById("nominativoDocente"+id).childNodes.length;
            if(tab.childNodes.length>1)
            	removeChild(tab,tab.childNodes.length);
            for(var j=1;j<n;j++){
                var tr=document.createElement("tr");
                add=addProfChild(1,j);
 				tr.innerHTML=add;
           		tab.appendChild(tr);
            }
            oreCorsoTeoria=oreCorsoLab=0;
            calcoloOreCFU();
            /*for(var i=1;i<=classi;i++)
            	test(i);*/
            document.getElementById("assegnazione").style.display="block";
		}

        function removeChild(idTabella,n){
                for(j=0;j<n-1;j++)
                    idTabella.removeChild(idTabella.lastChild);
        }

        function eliminaProf(i){
        	var tab=document.getElementById("associazione"+i);
            if(tab.childNodes.length>1)
            	tab.removeChild(tab.lastChild)
        }

        function addProfChild(nTab,nProf){
        	var professoreAssegnato="";
            var i=nProf;
                var idTot="tot"+nTab+''+i;
                professoreAssegnato+='<input type="hidden" id="oreTotaliProf'+nTab+''+i+'" value="">';
                professoreAssegnato+='<input type="hidden" id="ruoloProf'+nTab+''+i+'" value="">';
                professoreAssegnato+='<tr><td colspan="4"><input type="hidden" id="ruoloProf'+nTab+''+i+'" value=""><input type="hidden" id="oreTotaliProf'+nTab+''+i+'" value=""></td>';

                professoreAssegnato+='<td><input type="button" onclick="calcoloOre('+nTab+',\'teoria\',\'oreTeoria'+nTab+''+i+'\',this.value,\''+idTot+'\')" value="-">';
                professoreAssegnato+='<input name="oreTeoria'+nTab+''+i+'" type="number" readonly id="oreTeoria'+nTab+''+i+'" type="text" value="0" size="3">';
                professoreAssegnato+='<input type="button" onclick="calcoloOre('+nTab+',\'teoria\',\'oreTeoria'+nTab+''+i+'\',this.value,\''+idTot+'\')" value="+"></td>';

                professoreAssegnato+='<td><input type="button" onclick="calcoloOre('+nTab+',\'lab\',\'oreLab'+nTab+''+i+'\',this.value,\''+idTot+'\')" value="-">';
                professoreAssegnato+='<input name="oreLab'+nTab+''+i+'" type="number" readonly id="oreLab'+nTab+''+i+'" type="text" value="0" size="3">';
                professoreAssegnato+='<input type="button" onclick="calcoloOre('+nTab+',\'lab\',\'oreLab'+nTab+''+i+'\',this.value,\''+idTot+'\')" value="+"></td>';

                professoreAssegnato+='<td id="'+idTot+'">0</td>';
                professoreAssegnato+='<td></td>';
                professoreAssegnato+='<td> <select name="docente'+nTab+''+i+'" class="form-control" id="prof'+nTab+''+i+'" onchange="setCampiProf(this.value,'+nTab+''+i+')">';
                professoreAssegnato+='<option value="Nessun Professore">Seleziona docente</option>';


                professoreAssegnato+='</select></td>';
                professoreAssegnato+='<td name="ruolo" id="ruolo'+nTab+''+i+'"></td>';
                professoreAssegnato+='<td name="ssd" id="ssd'+nTab+''+i+'"></td>';
                professoreAssegnato+='</tr>';


          	return professoreAssegnato;
        }



        function setCampiProf(dato,numero){
        	if(dato!="Nessun Professore"){
              inf=dato.split(".");
              document.getElementById("ssd"+numero).innerHTML=inf[1];
              document.getElementById("ruolo"+numero).innerHTML=inf[2];
              confrontaSSD(inf[1]);
            }else{
            	document.getElementById("ssd"+numero).innerHTML="";
              document.getElementById("ruolo"+numero).innerHTML="";
            }
        }

        function confrontaSSD(ssd){
        	if(document.getElementById("settore1").innerHTML!=ssd)
            	alert("Attenzione!\nIl docente assegnato non appartiene al SSD indicato dall'insegnamento!");
        }


        function calcoloOre(nTab,tipologia,idOre,segno,idTotOre){
			//alert(nTab+" Tipologia"+tipologia+" ID:"+idOre+" "+segno+" ID TOT ORE"+idTotOre);

            if(parseInt(document.getElementById(idOre).value)==0 && segno=="-")
            	document.getElementById(idOre).value=0;
            else{
                if(segno=="+" && tipologia=="teoria"){
                    document.getElementById(idOre).stepUp(teoria);
                    var tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)+teoria;
                }
                else if(segno=="-" && tipologia=="teoria"){
                    document.getElementById(idOre).stepDown(teoria);
                    tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)-teoria;
                }
                else if(segno=="+" && tipologia=="lab"){
                    document.getElementById(idOre).stepUp(lab);
                    tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)+lab;
                }
                else if(segno=="-" && tipologia=="lab"){
                    document.getElementById(idOre).stepDown(lab);
                    tot=document.getElementById(idTotOre);
                    tot.innerHTML=parseInt(tot.innerHTML)-lab;
                }
            }
            test(nTab)
        }


     	function test(nTab){
        	val=controllaOre(nTab);
                if(val!=""){
                	risultato=val.split(".")
                    if(risultato.length==4)
                		document.getElementById("errore"+nTab).innerHTML="Ore "+risultato[0]+": "+risultato[1]+"/"+risultato[2];
                    else
                    	document.getElementById("errore"+nTab).innerHTML="Ore "+risultato[0]+": "+risultato[1]+"/"+risultato[2]+"\nErrore ore "+risultato[3]+": "+risultato[4]+"/"+risultato[5];
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
            if(contTeoria>oreCorsoTeoria|| contTeoria<oreCorsoTeoria || contTeoria!=oreCorsoTeoria)
            	errore+="Teoria."+contTeoria+"."+oreCorsoTeoria+"<br>.";
            if(contLab>oreCorsoLab || contLab<oreCorsoLab ||contLab!=oreCorsoLab)
            	errore+="Laboratorio."+contLab+"."+oreCorsoLab+"<br>.";
            alert(errore);
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

        function verificaErrori(){
        	var errore="";
            var docente=controllaDocente();
            var ore=controllaErroreOre();
        	if(docente!="")
            	errore="Nessun docente associato!";
        	if(ore!="")
            	errore+="Verificare numero di ore associate!";

            if(errore!="")
            	alert(errore);
            else
            	document.creaProgD.submit();
        }

    </script>
  </body>
</html>
