<!--
    Vis_Regolamento

	Questa classe implementa l'interfaccia grafica per la visualizzazione di un regolamento esistente

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
        <a href="http://prd.altervista.org/Presentation%20Layer/index.php" class="logo">
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
          require('../menu.php');
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
                <li><a href="../Docente/Vis_Doc.php"><i class="fa fa-circle-o"></i>Visualizza Docenti</a></li>';
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
                 <li><a href="../Prog/Vis_ProgDid.php"><i class="fa fa-circle-o"></i> Visualizza Prog. Did.</a></li>
                 '; if($_SESSION['logged']==true){
                 echo '
                 <li><a href="../Prog/Vis_CarD.php"><i class="fa fa-circle-o"></i> Carico Didattico</a></li>
             ';} echo ' </ul>
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
            <small>Visualizza Regolamento</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Visualizza Regolamento</a></li>
          </ol>
        </section>

<!-- CORPO CENTRALE DEL SITO -->
        <!-- Main content -->
       	<section class="content">
       	  <div class="row">
 			<div class="col-xs-12">
              
<!--  TABELLA COMPLETA -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Regolamento</h3>
					<div class="box-tools pull-right">
                  		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
						<form action="" method="post" name="formRegolamento" action="<?php echo $PHP_SELF;?>">
							<table align="center" class="table table-bordered table-striped"><tr>
								<td style="text-align: right;">
									<label>Corso</label>
								</td>
								<td>
								<select class="form-control" name="corso" style="width: 160px;" onChange="cercaCurriculum()">
									<option value="seleziona">Seleziona corso</option>
			                       	<option value="Laurea">Laurea</option>
			                       	<option value="Laurea Magistrale">Laurea Magistrale</option>
			                    </select>
								</td>
			                    <!-- DECIDERE IL FORMATO DI ANNO ACCADEMICO -->
			                    <td style="text-align: right;">
									<label>Anno Accademico</label>
								</td>	
								<td>
								<?php
									require("/membri/prd/Application Layer/GestioneRegolamento/GestioneRegolamento.php");
									$gestioneRegolamento=new GestioneRegolamento();
									$anniAccademici=$gestioneRegolamento->getAnniAccademici();
								echo '<select class="form-control" name="annoAccademico" style="width: 130px;" id="selectAnnoAccademico" onChange="cercaCurriculum()">';
								echo '<option value="seleziona">Seleziona anno accademico</option>';
									for($i=0;$i<count($anniAccademici);$i++)
										echo '<option value="'.$anniAccademici[$i].'">'.$anniAccademici[$i].'</option>';
								echo '</select>';
								?>
								</td>
								<!-- DEVE ESSERE COMPLETATO IN BASE ALLA SCELTA CORSO -->
								<td style="text-align: right;">
								<label>Curriculum</label>
								</td>
								<td>	
								<select class="form-control" name="curriculum" style="width: 200px;" id="selectCurriculum" onChange="mostraRegolamento()">
								<option value="seleziona">Seleziona curriculum</option>
								</select>
							</td></tr></table>	
						</form>
					</p>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php
					if(isset($_POST["corso"]) && isset($_POST["annoAccademico"]) && isset($_POST["curriculum"])){
						//RIPETERE 3 VOLTE SE è TRIENNALE, 2 SE è MAGISTRALE
						//I DATI DELLE TABELLE VENGONO PRESI IN AUTOMATICO ALLA SELEZIONE
						$corso=$_POST["corso"];
						$annoAccademico=$_POST["annoAccademico"];
						$curriculum=$_POST["curriculum"];
						if(strcasecmp($_POST["corso"], "Laurea")==0)
							$anniCorso=3;
						else
							$anniCorso=2;
						
							for($i=1;$i<=$anniCorso;$i++){
								$regolamento=$gestioneRegolamento->getRegolamento($corso, $curriculum, $annoAccademico, $i);
								$cfuRegolamento=array();
								echo '
									<h3 style="text-align: center"> Anno '.$i.'</h3>
									<p>
										<form action="" method="get">
											<table align="center" class="table table-bordered table-striped"><tr>
												<td>
													<label>Insegnamenti Obbligatori</label>
												</td>
											</tr></table>
										</form>
									</p>
									<div class="box-body">
										  <table name="tab'.$i.'" id="example2" class="table table-bordered table-hover datatables">
											<thead>
											  <tr>
												<th>Denominazione</th>
												<th>SSD</th>
												<th>Tipologia Attivit&agrave</th>
												<th>CFU</th>
												<th>Ore</th>
												<th>Modulo</th>
												<th>Tipologia Attivit&agrave Formativa</th>
												<th>Obbligatorio/Opzionale</th>
											  </tr>
											</thead>
											<tbody>';
											foreach($regolamento as $value){
												if($value["Obbligatorio_Opzionale"]==0){
													$ins=$value["insegnamento"];
													//echo '<tr><td>'.$value["Denominazione"].'</td><td>'.$value["SSD"].'</td><td>'.$value["Tipologia_Lezione"].'</td><td>'.$value["CFU"].'</td><td>'.$value["Tot_Ore"].'</td><td>'.$value["Modulo"].'</td><td>'.$value["Tipologia_Attivita"].'</td><td>Obbligatorio</td></tr>';
													echo '<tr><td>'.$ins->getDenominazione().'</td><td>'.$ins->getSSD().'</td><td>'.$ins->getTipologiaLezione().'</td><td>'.($ins->getCfuFrontale()+$ins->getCFULaboratorio()).'</td><td>'.$ins->getDurataCorso().'</td><td>'.$ins->getModulo().'</td><td>'.$ins->getTipologiaAttivitaFormativa().'</td><td>Obbligatorio</td></tr>';
												}
												else{
													$regolamentoOpzionale["cfu".$value["CFU"]][]=$value;
													if(!in_array($value["CFU"], $cfuRegolamento)){
														$cfuRegolamento[]=$value["CFU"];
													}
												}	
											}
											echo '</tbody>
											<tfoot></tfoot>
										  </table>
										</div>
									<section class="col-lg-12">&nbsp</section>
									';
		//BISOGNA SOSTITUIRE IL NUMERO DI CFU NELL'INTESTAZIONE DELLA TABELLA
								sort($cfuRegolamento);
								for($j=0;$j<count($cfuRegolamento);$j++){
										echo '<p>
												<form action="" method="get">
													<table align="center" class="table table-bordered table-striped"><tr>
														<td>
															<label>Insegnamenti Opzionali '.$cfuRegolamento[$j].' CFU a scelta tra:</label>
														</td>
													</tr></table>
												</form>
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
														<th>Obbligatorio/Opzionale</th>
													  </tr>
													</thead>
													<tbody>';
													foreach($regolamentoOpzionale["cfu".$cfuRegolamento[$j]] as $value){
														//echo '<tr><td>'.$value["Denominazione"].'</td><td>'.$value["SSD"].'</td><td>'.$value["Tipologia_Lezione"].'</td><td>'.$value["CFU"].'</td><td>'.$value["Tot_Ore"].'</td><td>'.$value["Modulo"].'</td><td>'.$value["Tipologia_Attivita"].'</td><td>Opzionale</td></tr>';
														$ins=$value["insegnamento"];
														echo '<tr><td>'.$ins->getDenominazione().'</td><td>'.$ins->getSSD().'</td><td>'.$ins->getTipologiaLezione().'</td><td>'.($ins->getCfuFrontale()+$ins->getCFULaboratorio()).'</td><td>'.$ins->getDurataCorso().'</td><td>'.$ins->getModulo().'</td><td>'.$ins->getTipologiaAttivitaFormativa().'</td><td>Opzionale</td></tr>';
													}
													echo '</tbody>
													<tfoot></tfoot>
												  </table>
												</div>
										<section class="col-lg-12">&nbsp</section>
										<section class="col-lg-12">&nbsp</section>';
								}
							}
					}
				?>
		        	 <!--<section class="col-lg-12">
			        	<div class="box-footer" style="text-align: center;">
	<!-- TORNA ALLA HOME 
							<input type="button" class="btn btn-default btn-lg" value="Chiudi Visualizzazione" name="chiudi">
			        	</div>
			        </section> -->              
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<!-- FINE TABELLA -->
            </div><!-- /.col -->
          </div><!-- /.row -->
       	
        </section>
      </div><!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="">Universit&agrave degli studi di Salerno - Dipartimento di Informatica</a>.</strong> All rights reserved.
      </footer>

<!-- MENU PERSONALIZZAZIONE LATERALE
      <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        </ul>
        
        <div class="tab-content">
          <div class="tab-pane" id="control-sidebar-home-tab">
          </div>
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        </div>
      </aside>
      <div class="control-sidebar-bg"></div>
    </div> -->
	<script>
		function cercaCurriculum(){
				corso=document.formRegolamento.corso.value;
				annoAccademico=document.formRegolamento.annoAccademico.value;
				var sel=document.getElementById("selectCurriculum");
				sel.innerHTML='<option value="seleziona">Seleziona curriculum</option>';
			if(corso!="seleziona" && annoAccademico!="seleziona"){
				var req=new XMLHttpRequest();
						req.onreadystatechange=function(){
							if(req.status==200 && req.readyState==4){
								curricula=JSON.parse(req.responseText);
								for(i=0;i<curricula.length;i++){
									sel.innerHTML+='<option value="'+curricula[i]+'">'+curricula[i]+'</option>';
								}
							}	
						}
							var dati=new FormData();
							dati.append("funzione", "cercacurriculum");
							dati.append("corso", corso);
							dati.append("annoAccademico", annoAccademico);
							req.open("POST", "http://prd.altervista.org/Application%20Layer/GestioneRegolamento/GestioneRegolamento.php", true);
							req.send(dati);
			}
		}
		
		function mostraRegolamento(){
			corso=document.formRegolamento.corso.value;
			annoAccademico=document.formRegolamento.annoAccademico.value;
			curriculum=document.formRegolamento.curriculum.value;
			if(corso!="seleziona" && annoAccademico!="seleziona" && curriculum!="seleziona"){
				document.formRegolamento.submit();
			}
		}
	</script>
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
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
      });
    </script>    
  </body>
</html>
