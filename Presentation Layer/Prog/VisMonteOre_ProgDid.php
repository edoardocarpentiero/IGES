<!DOCTYPE html>
<html>
  <head>
     <?php
     if(!isset($_SESSION))
     {
         session_start();
     }
     ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
	if($_SESSION['presidente'] == false OR $_SESSION['logged']==false)
		header("location:http://localhost/IGES/Presentation%20Layer/index.php") 
	?>
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
    
     <!-- GRAFICI Chart.js -->
   	<script src="../pages/chart/Chart.js"></script>
    
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
                      <form name="logout" method="post" action="http://localhost/IGES/Application%20Layer/GestioneAutenticazione/Autenticazione.php">
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
<form name="login" method="post" action="http://localhost/IGES/Application%20Layer/GestioneAutenticazione/Autenticazione.php">
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
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <h1>
            Programmazione Didattica
            <small>Visualizza Monte Ore Docenti</small>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Visualizza Monte Ore</a></li>
          </ol>
        </section>
 <!-- IINIZO  -->
    <!-- corpo  -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body ">
              <!-- tabella  -->
              <div id="example1_wrapper" class=" table-responsive dataTables_wrapper form-inline dt-bootstrap">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Matricola</th>
                  <th>Cognome</th>
                  <th>Nome</th>
                  <th>Ruolo</th>
                  <th>SSD</th>
                  <th>Stato</th>
                </tr>
                </thead>
                <tbody style="cursor: pointer;">
                <?php
                	require_once(dirname(__DIR__,2).'\Application Layer\GestioneCaricoDidattico\GestioneCaricoDidattico.php');
                    $ges=new GestioneCaricoDidattico();
					$docentiPrD=$ges->getDocentiPrD();
                    $n=count($docentiPrD);
                    for($i=0;$i<$n;$i++){
									
                                    $docentePrD=$docentiPrD[$i];
									$matricolaDocente=$docentePrD->getMatricola();
                                    $nome=$docentePrD->getNome();
                                    $cognome=$docentePrD->getCognome();
                                    $email=$docentePrD->getEmail();
                                    $ruolo=$docentePrD->getRuolo();
                                    $SSD=$docentePrD->getSettoreScientificoDisciplinare();
                                    $numInsegnamentiSospesi=$docentePrD->getNumeroInsegnamentiSospesi();
                                    $statusCarico=$docentePrD->getStatusCarico();
									
                                    $dati=$matricolaDocente."&".$cognome."&".$nome."&".$email."&".$ruolo."&".$statusCarico;
								?>
                                
								<tr class="dati" title="Clicca per info" onClick='infoDocenteSelezionato("<?php echo $dati;?>")' data-toggle="modal" data-target="#modal-insegnamentiAssociati">
                                <?php
                                
										echo "<td  style='cursor:pointer; font-weight: 600;'>$matricolaDocente</td>";
                                        echo "<td>$cognome</td>";
                                        echo "<td>$nome</td>";
                                        echo "<td>$ruolo</td>";
                                        echo "<td>$SSD</td>";
                                ?> 
                                        <td>
                                        	<?php 
                                            if(strcmp($matricolaDocente,"201515200")!=0){
                                            	if($statusCarico==0 && $numInsegnamentiSospesi==0){?>
                                            	<button type="button" class="btn btn-success" disabled>Carico didattico raggiunto <span class="badge"><?php echo $numInsegnamentiSospesi;?></span></button>
                                           	<?php }else if($numInsegnamentiSospesi>0){ //$statusCarico==0?>                                            	
                                            	<button type="button" class="btn btn-warning" disabled>Carico didattico in sospeso <span class="badge"><?php echo $numInsegnamentiSospesi;?></span></button>
                                            <?php }else if($statusCarico==-1 && $numInsegnamentiSospesi==0){?>
                                            	<button type="button" class="btn btn-danger" disabled>Carico didattico non raggiunto <span class="badge"><?php echo $numInsegnamentiSospesi;?></span></button>
                                            <?php }else if($statusCarico==1 && $numInsegnamentiSospesi==0){?>
                                            	<button type="button" class="btn btn-success" disabled>Carico didattico raggiunto* <span class="badge"><?php echo $numInsegnamentiSospesi;?></span></button>
                                            <?php }else if($statusCarico==2 && $numInsegnamentiSospesi==0){?>
                                            	<button type="button" class="btn btn-danger" disabled>Monte ore annuale superato <span class="badge"><?php echo $numInsegnamentiSospesi;?></span></button>
                                                <?php } 
                                            }else if(strcmp($matricolaDocente,"201515200")==0 && $numInsegnamentiSospesi>0){?>
                                            	<button type="button" class="btn btn-warning" disabled>Insegnamenti Liberi <span class="badge"><?php echo $numInsegnamentiSospesi;?></span></button>
                                            <?php }else{ ?>
                                            	<button type="button" class="btn btn-success" disabled>Insegnamenti Assegnati</button>
                                            <?php }?>
                                        </td>	
                                 </tr>
                   <?php } ?>  
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Matricola</th>
                  <th>Cognome</th>
                  <th>Nome</th>
                  <th>Ruolo</th>
                  <th>SSD</th>
                  <th>Stato</th>
                </tr>
                </tfoot>
              </table>
              </div>
              <!-- fine tabella  -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <!-- fine corpo -->
 <!-- DIALOG BOX INSEGNAMENTI ASSOCIATI -->
  <div class="modal fade bd-example-modal-lg" id="modal-insegnamentiAssociati" style="display: none;" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" onclick="refresh()">×</span></button>
                <h4 class="modal-title">Insegnamenti associati a: <br><b><span id="nominativioDoc"></span></b></h4>
              </div>
				
              <div class="box-body table-responsive no-padding">
              <div class="modal-body">
              <input type="hidden" value="" id="matricolaDoc">
              <input type="hidden" value="" id="email">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Denominazione</th>
                    <th>CFU</th>
                    <th>Tipologia Attività</th>
                    <th>Ore Teoria</th>
                    <th>Ore Lab.</th>
                    <th>Corso</th>
                    <th>Anno</th>
                    <th>Semestre</th>
                    <th>Classe</th>
                    <th>SSD</th>
                    <th>Disponibilità</th>
                  </tr>
               </thead>
               <tbody id="tableInsegnamentiAssociati">

               </tbody>
              </table>
              </div>
            </div>
              <div class="modal-footer">
                <p class="pull-left">Monte ore docente min: <span id="minDaCoprire" style="font-weight: 900; font-size:15px;"></span> - max: <span id="maxDaCoprire" style="font-weight: 900; font-size:15px;"></span></p>
                <p >Monte ore raggiunto: <span id="monteOreRaggiunto" style="font-weight: 900; font-size:15px;"></span> ore </p>
                <center><h4 id="messaggioDocente">Al docente sono state assegnate ore extra.</h4></center>
              </div>
              
              <div class="box" id="visualizza">
				<div class="box-body">
                  <div class="row">
                    <div class="col-md-8" id="graficoDonut">
						<div id="canvas-holder">
						</div>
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <ul class="chart-legend clearfix" id="legend">
                      </ul>
                    </div><!-- /.col -->
                    
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.col -->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </div>
  
  <!-- DIALOG BOX EMAIL RIUFIUTO -->
  <div class="modal fade" id="modal-emailRifiuto" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Email presa visione</h4>
              </div>
              <div class="box-body table-responsive no-padding">
              <div class="modal-body">
              <input type="hidden" value="" id="datiAssociazione"/>
                    <div class="form-group"> <!-- Email field -->
                        <label class="control-label requiredField" for="email">Email docente<span class="asteriskField">*</span></label>
                        <input class="form-control" id="emailDestinatario" name="emailDestinatario" type="text" disabled/>
                    </div>

                    <div class="form-group"> <!-- Subject field -->
                        <label class="control-label " for="subject">Oggetto</label>
                        <input class="form-control" id="oggetto" name="oggetto" type="text"/>
                    </div>

                    <div class="form-group"> <!-- Message field -->
                        <label class="control-label " for="message">Messaggio</label>
                        <textarea class="form-control" cols="40" id="messaggio" name="messaggio" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" data-dismiss="modal" onclick="inviaEmail()">Invia</button>
                    </div>
              </div>
            </div>
              <div class="modal-footer">
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </div>
  
        <!-- FINEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE -->

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
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        
      });
      
      
      
    </script>
    <script>
    
    	var tela=0;
        function infoDocenteSelezionato(dati){
			datiDocente=dati.split("&");
            document.getElementById("nominativioDoc").innerHTML=datiDocente[1]+" "+datiDocente[2];
            document.getElementById("matricolaDoc").value=datiDocente[0];
            if(datiDocente[0]!="201515200"){
              document.getElementById("email").value=datiDocente[3];
              rangeOreDocente(datiDocente[4]);
            }
            document.getElementById("messaggioDocente").style.display = "none";
            /*if(datiDocente[5]==1)
            	document.getElementById("messaggioDocente").style.display = "inline";
            else
            	document.getElementById("messaggioDocente").style.display = "none";*/
            oreRicoperte(datiDocente[0]);
            
        }
        
        function rangeOreDocente(ruolo){
              minOre=document.getElementById("minDaCoprire");
              maxOre=document.getElementById("maxDaCoprire");
              if(ruolo=="Docente Associato PA" || ruolo=="Docente Ordinario PO"){
                            	minOre.innerHTML="120";
                                maxOre.innerHTML="180";
              }
              else if(ruolo=="Ricercatore a tempo indeterminato RU"){
                            	minOre.innerHTML="0";
                                maxOre.innerHTML="90";
              }
              else if(ruolo=="Ricercatore a tempo determinato RTDA"){
                            	minOre.innerHTML="0";
                                maxOre.innerHTML="66";
              }
              else if(ruolo=="Ricercatore a tempo determinato RTDB"){
                           	 	minOre.innerHTML="0";
                                maxOre.innerHTML="78";
              }
       }
       
       function oreRicoperte(matricolaDocente){
             dati=new FormData();                                      
             dati.append("matricolaDocente",matricolaDocente);
             dati.append("funzione","oreRicoperte");
             httpRequest = new XMLHttpRequest();
             httpRequest.onreadystatechange = function(){
             	if(httpRequest.readyState == 4 && httpRequest.status == 200){
                         var ore=httpRequest.responseText;//-1 se la prog nn esiste
                         if(ore>=0){
                              document.getElementById("monteOreRaggiunto").innerHTML=ore; 
                              insegnamentiAssociati(matricolaDocente);
                         }
             	}
            };
            httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
            httpRequest.send(dati);
        }
        
        function insegnamentiAssociati(matricolaDocente){
        	dati=new FormData();
            dati.append("matricolaDocente",matricolaDocente);
            dati.append("funzione","insegnamentiAssociati");
            document.getElementById("tableInsegnamentiAssociati").innerHTML="";
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function(){
             	if(httpRequest.readyState == 4 && httpRequest.status == 200){
                         var table=httpRequest.responseText;
                         alert(table);
                         document.getElementById("tableInsegnamentiAssociati").innerHTML=table;
                         if(matricolaDocente!="201515200"){
                         	tela=0;
                         	setTimeout(function(){ mostraCaricoDid(matricolaDocente)}, 400);
                         	
                       	}
             	}
           };
           httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
           httpRequest.send(dati); 
        }
        
        function presaVisione(datiAssociazione){
        	datiAss=datiAssociazione.split("&");
            risp=confirm("Vuoi rendere disponibile l'insegnamento "+datiAss[4]+" ?");
            if(risp){
                dati=new FormData();
                dati.append("matricolaDoc",datiAss[0]);
                dati.append("matricolaIns",datiAss[1]);
                dati.append("classe",datiAss[2]);
                dati.append("progId",datiAss[3]);
                
                dati.append("oreT",datiAss[5]);
                dati.append("oreL",datiAss[6]);

                dati.append("funzione","liberaInsegnamento");
                httpRequest = new XMLHttpRequest();
                httpRequest.onreadystatechange = function(){
                    if(httpRequest.readyState == 4 && httpRequest.status == 200){
                            ris=httpRequest.responseText;
                            if(ris==0){
                                alert("Insegnamento "+datiAss[4]+" è di nuovo disponibile!");
                                oreRicoperte(datiAss[0]);
                                
                            }
                    }
               };
               httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
               httpRequest.send(dati); 
           }
        }
        
        function accettaProposta(datiAssociazione){
        	datiAss=datiAssociazione.split("&");
        	risp=confirm("Sei sicuro di voler ACCETTARE la proposta relativa all'insegnamento "+datiAss[4]+" ?");
            if(risp){
              dati=new FormData();
              dati.append("matricolaDoc",datiAss[0]);
              dati.append("matricolaIns",datiAss[1]);
              dati.append("classe",datiAss[2]);
              dati.append("progId",datiAss[3]);
              
              dati.append("oreT",datiAss[5]);
              dati.append("oreL",datiAss[6]);

              dati.append("funzione","accettaProposta");
              httpRequest = new XMLHttpRequest();
              httpRequest.onreadystatechange = function(){
                  if(httpRequest.readyState == 4 && httpRequest.status == 200){
                          ris=httpRequest.responseText;
                          if(ris==0){
                              alert("Insegnamento "+datiAss[4]+" assegnato con successo!");
                              oreRicoperte(datiAss[0]);
                          }
                  }
             };
             httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
             httpRequest.send(dati); 
           }
        }
        
        function rifiutaProposta(datiAssociazione){
        	datiAss=datiAssociazione.split("&");
        	document.getElementById("datiAssociazione").value=datiAssociazione;
            document.getElementById("emailDestinatario").value="edoardo93av@gmail.com";
            //document.getElementById("emailDestinatario").value=document.getElementById("email").value;
            document.getElementById("oggetto").value="RIFIUTO PROPOSTA INSEGNAMENTO PROG.DIDATTICA";
            document.getElementById("messaggio").value="Gentile Docente, il seguente insegnamento:\n\n----------------------------\nDenominazione: "+datiAss[4]+"\nCFU: "+datiAss[7]+"\nAnno: "+datiAss[8]+"\nSemestre: "+datiAss[10]+"\nClasse:"+datiAss[2]+"\nOre Teoria: "+datiAss[5]+" - Ore Lab: "+datiAss[6]+"\n----------------------------\n\nproposto per la programmazione didattica dell'anno "+datiAss[9]+" è stato RIFIUTATO!\n\nBuona Giornata.\nPresidente della didattica.";
        }

        
        function inviaEmail(){ 
        	datiAss=document.getElementById("datiAssociazione").value.split("&");
        	risp=confirm("Sei sicuro di voler RIFIUTARE la proposta relativa all'insegnamento "+datiAss[4]+" ?");
            if(risp){
                dati=new FormData();
                dati.append("matricolaDoc",datiAss[0]);
                dati.append("matricolaIns",datiAss[1]);
                dati.append("classe",datiAss[2]);
                dati.append("progId",datiAss[3]);
                
                dati.append("oreT",datiAss[5]);
                dati.append("oreL",datiAss[6]);
                
                dati.append("emailDestinatario",document.getElementById("emailDestinatario").value);
                dati.append("oggettoEmail",document.getElementById("oggetto").value);
                dati.append("messaggioEmail",document.getElementById("messaggio").value);
                dati.append("funzione","rifiutaProposta");
                httpRequest = new XMLHttpRequest();
                httpRequest.onreadystatechange = function(){
                    if(httpRequest.readyState == 4 && httpRequest.status == 200){
                            ris=httpRequest.responseText;
                            if(ris==0){
                                alert("Email inviata con successo!");
                                oreRicoperte(datiAss[0]);
                            }
                            else
                                alert("Errore invio email!");
                    }
               };
               httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
               httpRequest.send(dati); 
            }
        }
        
        function refresh(){
        	if(document.getElementById("matricolaDoc").value!="201515200")
        		location.reload();
        }
        
        function aggiornaStatus(status,datiAssociazione){
                        	var res=datiAssociazione.split("&");
                        	var dati=new FormData();
                            var msg;
                            
                            if(status==1){
                            	msg="Sei sicuro di voler ACCETTARE l'insegnamento proposto dal Presidente?";
                                dati.append("stato","ACCETTATO");
                            }
                            else if(status==2){
                           		msg="Sei sicuro di voler RIFIUTARE l'insegnamento proposto dal Presidente?";
                                dati.append("stato","RIFIUTATO");
                            }
                            esitoOp = confirm(msg);
                            if(esitoOp){    
                            	dati.append("matricolaIns",res[1]);
                                dati.append("classe",res[2]);
                                dati.append("progID",res[3]);
                                dati.append("oreT",res[4]);
                                dati.append("oreL",res[5]);
                                dati.append("funzione","cambiaStatus");
                                httpRequest = new XMLHttpRequest();
                                httpRequest.onreadystatechange = function(){
                                if(httpRequest.readyState == 4 && httpRequest.status == 200){
                                             var esito = httpRequest.responseText;
                                             if(esito==0)
                                             	oreRicoperte(res[0]);
                                      }
                                };
                                httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
                                httpRequest.send(dati);
                            }
                        }

        
        var colori=["#FFBF00","#F400A1","#08E8DE","#00FF00","#FF4D00","#1560BD","#FF0000","#960018","#007BA7","#00A86B"];
              
                        
                        function mostraCaricoDid(matricola){
                            dati=new FormData();
                            dati.append("matricolaDocente",matricola);
                            dati.append("funzione","monteOre");
                            httpRequest = new XMLHttpRequest();
                           	httpRequest.onreadystatechange=creaGrafo
                            httpRequest.open("POST","http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php",true);
                            httpRequest.send(dati);
                        }
						
                        function creaGrafo(){
                            if(httpRequest.readyState == 4 && httpRequest.status == 200){
                                //restituisce gia la stringa formattata
                                var doughnut = httpRequest.responseText;

                                disegna(doughnut);
                                ;
                            }
                        }
                
                
                function disegna(dati){
                 	var foglio = document.getElementById("visualizza");
					//se non ci sono dati non disegna
					if(dati.length>0){
                      foglio.style.display = "block";
                      var doughnutData = [];
                      var spl = [];
                      spl=dati.split(",");
                      var r=180;
                      var g=0;
                      var b=60;
                      var sfum=40;
                      var rgb=0;
						document.getElementById("legend").innerHTML="";
                      for(var i=0; i<spl.length; i+=2){
                          doughnutData.push({value: spl[i], color: colori[rgb], highlight: colori[rgb], label: spl[i+1]+" | Totale Ore"});
                          r+=10;
                          g+=70;
                          b+=50;
                          
                          if(spl[i+1] != null && tela==0){
                            var ul = document.getElementById("legend");
                            var lis = document.createElement("li");
                            var span = document.createElement("span");
                            

                            var ico = document.createElement("i");
                            var att = document.createAttribute("class");       // Create a "class" attribute
                            att.value = "fa fa-circle-o";
                            ico.setAttributeNode(att);
			
                            span.innerHTML = " "+spl[i+1];
                            lis.appendChild(ico);
                            lis.appendChild(span);
                            ul.appendChild(lis);
                          }
                          rgb++;
                      }
					document.getElementById("canvas-holder").innerHTML="";
                     if(tela==0){
                          var div = document.getElementById("canvas-holder");
                          var canvas = document.createElement("canvas");
                          var idel = document.createAttribute("id");
                          idel.value = "chart-area";
                          canvas.setAttributeNode(idel);
                          div.appendChild(canvas);
                          tela++;
                      }
                      var ctx = document.getElementById("chart-area").getContext("2d");
                      window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
                    }
                    else
                    	foglio.style.display = "none";
                }
    </script>
  </body>
</html>
