<!--
    Pag_Crea_Reg

	Questa classe implementa l'interfaccia grafica per il completamento della creazione di un nuovo regolamento

 	Author: Stefano Cirillo, Alessandro Kevin Barletta, Edoardo Carpentiero, Gianmarco Mucciariello
 	Version : 1.0
 	2015 - Copyright by Pr.D Project - University of Salerno
-->
<?php
session_start();
?>
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
	}

    </style>
    
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
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
          <?php
          require_once('../menu.php');
          creaMenu();
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
                <li><a href="Crea_Reg.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Crea Regolamento</a></li>
                <li><a href="Mod_Reg.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Modifica Regolamento</a></li>
                <li><a href="Pub_Reg.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Pubblica Regolamento</a></li>
                <li><a href="Vis_Regolamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Regolamento</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Programmazione Didattica</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../Prog/Crea_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Crea Prog. Did.</a></li>
                <li><a href="../Prog/Mod_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Modifica Prog. Did.</a></li>
                <li><a href="../Prog/VisMonteOre_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Monte Ore</a></li>
				<li><a href="../Prog/Vis_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Prog. Did.</a></li>
                <li><a href="../Prog/CambiaStato_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Cambia Stato</a></li>
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
                <li><a href="Vis_Regolamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Regolamento</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Programmazione Didattica</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li><a href="../Prog/Vis_ProgD.php"><i class="fa fa-circle-o"></i> Visualizza Prog. Did.</a></li>
                 '; if($_SESSION['logged']==true){
                 echo '
                 <li><a href="../Prog/Vis_CarD.php"><i class="fa fa-circle-o"></i> Carico Didattico</a></li>
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
            Regolamento
            <small>Crea Regolamento</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Crea Regolamento</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->

          <!-- Main row -->
<!-- BOX CENTRALE -->
		<div class="">
            <!-- Left col -->
			 <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Crea Regolamento - CURRICULUM <?php echo strtoupper($_POST["curr"]);?></h3>
                  <input type="hidden" id="curriculum" value="<?php echo strtoupper($_POST["curr"]);?>">
                  <input type="hidden" id="corso" value="<?php echo strtoupper($_POST["corso"]);?>">
                  <input type="hidden" value="salvaRegolamento" name="funzione">
                  <?php
                  		$annoIniziale=substr(date("Y"),0,2);
                    	$annoFinale=intval(substr(date("Y"),2,4));
						
                  		require_once(dirname(__DIR__,2).'\Application Layer\GestioneRegolamento\GestioneRegolamento.php');
                  ?>
                  
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
				<?php
					if(isset($_POST["insegnamenti"]) && (!isset($_SESSION["vecchioPost"]) || ($_POST["insegnamenti"]!=$_SESSION["vecchioPost"]))){
						$insegnamenti=$_POST["insegnamenti"];
						$annoCorso=$_POST["annoCorso"];
						$curr=strtoupper($_POST["curr"]);
						$nomeSessione=$curr.$annoCorso;
						
						if(isset($_SESSION[$nomeSessione]))
							$arrayInsegnamenti=json_decode($_SESSION[$nomeSessione], true);
						
						if(isset($_SESSION["idInsegnamenti".$curr]))
							$idInsegnamenti=json_decode($_SESSION["idInsegnamenti".$curr], true);
						
						for($i=0; $i<count($insegnamenti); $i++){
							$ins=explode(".", $insegnamenti[$i]);
                            $somma=intval($ins[5])+intval($ins[9]);
							$arrayInsegnamenti[]=array("annoCorso"=>$ins[0],
													   "ID"=>$ins[1],
													   "Denominazione"=>$ins[2],
													   "SSD"=>$ins[3],
													   "TipologiaLezione"=>$ins[4],
													   "CFUFrontale"=>$somma,
													   "DurataCorso"=>$ins[6],
													   "Modulo"=>$ins[7],
													   "TipologiaAttivitaFormativa"=>$ins[8]);
							$idInsegnamenti[]=$ins[1];
						}
						$_SESSION[$nomeSessione]=json_encode($arrayInsegnamenti);
						$_SESSION["idInsegnamenti".$curr]=json_encode($idInsegnamenti);
						$_SESSION["vecchioPost"]=$_POST["insegnamenti"];
					}
					
       				$anno1=$annoFinale;
                    if($_POST["corso"]=="Laurea")
                    	$n=3;
                    else if($_POST["corso"]=="Magistrale")
                    	$n=2;
					echo '<form action="" method="get" name="form1">
							<input type="hidden" name="curr" value="'.$_POST["curr"].'">
							<input type="hidden" name="corso" value="'.$_POST["corso"].'">
						</form>';
									
					for($i=1;$i<=$n;$i++){
						echo '
    						<h3 style="text-align: center"> Anno '.$i.' ('.$annoIniziale.$anno1.'/'.$annoIniziale.($annoFinale+$i).')</h3>
    						<p>
								<form action="" method="get">
									<table align="center" class="table table-bordered table-striped"><tr>
										<td>
											<label>Insegnamenti Obbligatori</label>
    									</td>
    									<td style="text-align: right;">
											<div class="btn-group">
    											 <button type="button" class="btn btn-default" id="obbligatorioAnno'.$i.'" onclick="add(this.id, 0)">+</button>
    										</div>
    									</td>
									</tr></table>	
								</form>
							</p>
	    					<div class="box-body">
				                  <table name="tabAnno'.$i.'" id="example2" class="table table-bordered table-hover datatables">
				                    <thead>
				                      <tr>
				                      	<th>Denominazione</th>
				                      	<th>SSD</th>
				                      	<th>Tipologia Attivit&agrave</th>
				                      	<th>CFU</th>
				                        <th>Ore</th>
				                        <th>Modulo</th>
				                        <th>Tipologia Attivit&agrave Formativa</th>
										<th>Elimina</th>
				                      </tr>
				                    </thead>
				                    <tbody id="insegnamentiObbligatori'.$i.'">';
									if (isset($_SESSION[strtoupper($_POST["curr"])."obbligatorioAnno".$i])){
										$annoObbligatorio=strtoupper($_POST["curr"])."obbligatorioAnno".$i;
										$arrayInsegnamenti=json_decode($_SESSION[$annoObbligatorio], true);
										foreach($arrayInsegnamenti as $insegnamento){
													echo '<tr id='.$insegnamento["ID"].'>';
													echo '<td>'.$insegnamento["Denominazione"].'</td>';
													echo '<td>'.$insegnamento["SSD"].'</td>';
													echo '<td>'.$insegnamento["TipologiaLezione"].'</td>';
													echo '<td>'.$insegnamento["CFUFrontale"].'</td>';
													echo '<td>'.$insegnamento["DurataCorso"].'</td>';
													echo '<td>'.$insegnamento["Modulo"].'</td>';
													echo '<td>'.$insegnamento["TipologiaAttivitaFormativa"].'</td>';
													echo '<td><input type="button" value="elimina" onclick="elimina('.$insegnamento["ID"].', \''.$annoObbligatorio.'\', \''.strtoupper($_POST["curr"]).'\')"></td>';
												echo '</tr>';
										}
									}
                                   echo' </tbody>
				                    <tfoot></tfoot>
				                  </table>
				                </div>
    						<section class="col-lg-12">&nbsp</section>';
						echo '<p>
								<form action="" method="get">
									<table align="center" class="table table-bordered table-striped"><tr>
										<td>
											<label>Insegnamenti Opzionali&nbsp&nbsp&nbsp</label>
    										<input type="number"'.$i.' id="CFUOpzionaleAnno'.$i.'" placeholder="Numero CFU" onchange="controllaCFU(\''.$i.'\')"';
												echo 'value="'.$_SESSION['CFUOpzionale'.strtoupper($_POST["curr"]).'Anno'.$i];
											echo '" step="3" min="0">
          									<label>&nbsp&nbsp&nbspCFU a scelta tra:</label>
          								</td>
          								<td  style="text-align: right;">
    										<div class="btn-group">
    											 <button type="button" class="btn btn-default" id="opzionaleAnno'.$i.'" onclick="add(this.id, 1)">+</button>
    										</div>
										</td>
									</tr></table>
							</p>
	    					<div class="box-body">
				                  <table name="tabOpz'.$i.'" id="example2" class="table table-bordered table-hover datatables">
				                    <thead>
				                      <tr>
				                      	<th>Denominazione</th>
				                      	<th>SSD</th>
				                      	<th>Tipologia Attivit&agrave</th>
				                      	<th>CFU</th>
				                        <th>Ore</th>
				                        <th>Modulo</th>
				                        <th>Tipologia Attivit&agrave Formativa</th>
										<th>Elimina</th>
				                      </tr>
				                    </thead>
				                    <tbody>';
										if (isset($_SESSION[strtoupper($_POST["curr"])."opzionaleAnno".$i])){
											$annoOpzionale=strtoupper($_POST["curr"])."opzionaleAnno".$i;
											$arrayInsegnamenti=json_decode($_SESSION[$annoOpzionale], true);
											foreach($arrayInsegnamenti as $insegnamento){
													echo '<tr id='.$insegnamento["ID"].'>';
														echo '<td>'.$insegnamento["Denominazione"].'</td>';
														echo '<td>'.$insegnamento["SSD"].'</td>';
														echo '<td>'.$insegnamento["TipologiaLezione"].'</td>';
														echo '<td>'.$insegnamento["CFUFrontale"].'</td>';
														echo '<td>'.$insegnamento["DurataCorso"].'</td>';
														echo '<td>'.$insegnamento["Modulo"].'</td>';
														echo '<td>'.$insegnamento["TipologiaAttivitaFormativa"].'</td>';
														echo '<td><input type="button" value="elimina" onclick="elimina('.$insegnamento["ID"].', \''.$annoOpzionale.'\', \''.strtoupper($_POST["curr"]).'\')"></td>';
													echo '</tr>';
											}
										}
									echo '</tbody>
				                    <tfoot></tfoot>
				                  </table>
				                </div>
          				<section class="col-lg-12">&nbsp</section>
          				<section class="col-lg-12">&nbsp</section>
          				<section class="col-lg-12">&nbsp</section>
          				<section class="col-lg-12">&nbsp</section>';
                        $anno1=($annoFinale+$i);
					}
				?>                
<!-- CORPO BOX -->
					 <section class="col-lg-12">&nbsp;</section>
				     <section class="col-lg-12">&nbsp;</section>
		        	 <section class="col-lg-12">
			        	<div class="box-footer" style="text-align: center;">
			        		<input type="button" onclick="controllaRegolamento(<?php echo ' \''.strtoupper($_POST["curr"]).'\', \''.date("Y").'\', \''.$_POST["corso"].'\'';?>)" class="btn btn-default btn-lg" value="Salva Regolamento" name="salva">
						</div>
			        </section>

                </div><!-- /.box-body -->
			</div>
 		</div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
<!-- PIE DI PAGINA -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.di.unisa.it/">Universit&agrave degli studi di Salerno - Dipartimento di Informatica</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    
    
  </body>
</html>
<script>
function add(id, opz){
	curr=document.form1.curr.value;
	corso=document.form1.corso.value;
	nomeOpz='CFUOpzionale'+id.substr(id.length-5);
	cfuOpzionali=document.getElementById(nomeOpz).value;
	window.open("http://localhost/IGES/Presentation%20Layer/Regolamento/Pag_Sel_EsOpz.php?id="+id+"&curr="+curr+"&corso="+corso+"&cfuOpz="+cfuOpzionali+"&Opz="+opz, "_self");
}

function controllaCFU(num){
	nomeInput="CFUOpzionaleAnno"+num;
	valoreInput=document.getElementById(nomeInput).value;
	if(parseInt(valoreInput)>0){
		nomeBottone="opzionaleAnno"+num;
		bottone=document.getElementById(nomeBottone);
		bottone.disabled=false;
	}
	else{
		nomeBottone="opzionaleAnno"+num;
		bottone=document.getElementById(nomeBottone);
		bottone.disabled=true;
	}
}

function elimina(id, nomeSessione, curr){
	if(confirm("Sei sicuro di voler eliminare questo insegnamento dal regolamento?"))
		document.getElementById(id).style.display="none";
	var req=new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.status==200 && req.readyState==4){}	
	}
	var dati=new FormData();
	dati.append("funzione", "eliminainsegnamento");
	dati.append("id", id);
	dati.append("nomeSessione", nomeSessione);
	dati.append("curr", curr);
	req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneRegolamento/GestioneRegolamento.php", true);
	req.send(dati);
}

function controllaRegolamento(curr, annoBase, corso){
	var req=new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.status==200 && req.readyState==4){
            if(req.responseText.length>1){
                if(confirm("Attenzione!\nIl regolamento non rispetta alcuni vincoli!\n"+req.responseText+"\nSalvare comunque?"))
					salvaRegolamento(curr, annoBase, corso, "Draft");
			}
			else
				salvaRegolamento(curr, annoBase, corso, "Completo");
                
		}
    }
	
	var dati=new FormData();
	dati.append("funzione", "controllaRegolamento");
	dati.append("curr", curr);
	dati.append("annoBase", annoBase);
	dati.append("corso", corso);
	req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneRegolamento/GestioneRegolamento.php", true);
	req.send(dati);
}

function salvaRegolamento(curr, annoBase, corso, stato){
	var req=new XMLHttpRequest();
	req.onreadystatechange=function(){
		if(req.status==200 && req.readyState==4){
           	alert("Salvataggio regolamento "+curr+" avvenuto con successo!");
			window.open("http://localhost/IGES/Presentation%20Layer/Regolamento/Crea_Reg.php","_self");
        }
    }
	
	var dati=new FormData();
	dati.append("funzione", "salvaRegolamento");
	dati.append("curr", curr);
	dati.append("annoBase", annoBase);
	dati.append("corso", corso);
	dati.append("stato", stato);
	req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneRegolamento/GestioneRegolamento.php", true);
	req.send(dati);
}
controllaCFU(1);
controllaCFU(2);
controllaCFU(3);
</script>
