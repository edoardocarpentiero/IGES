<?php

if (!isset($_SESSION))
    session_start();
?>
<!--
    Add_Ins

	Questa classe implementa l'interfaccia grafica per l'aggiunta di un nuovo insegnamento

 	Author: Stefano Cirillo, Alessandro Kevin Barletta, Edoardo Carpentiero, Gianmarco Mucciariello
 	Version : 1.0
 	2015 - Copyright by Pr.D Project - University of Salerno
-->
<!DOCTYPE html>
<html>
  <head>
  <?php
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
                <li><a href="Add_Ins.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Nuovo Insegnamento</a></li>
                <li><a href="Mod_Ins.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Modifica Insegnamento</a></li>
                <li><a href="Vis_Insegnamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Insegnamenti</a></li>
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
                <li><a href="../Prog/Crea_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Crea Prog. Did.</a></li>
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
                <li><a href="Vis_Insegnamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Insegnamenti</a></li>
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
            Insegnamento
            <small>Aggiungi Insegnamento</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Aggiungi Insegnamento</a></li>
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
                  <h3 class="box-title">Aggiungi Insegnamento</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <form name="form" id="formAggiungi"class="" method="POST">
					<input type="hidden" value="0" id="tipo" name="tipo">
		            <section class="col-lg-12">
			 			<div style="float: none;">
                        	<div><em>* Campo Obbligatorio<br>
                            	** Obbligatorio se &egrave stato selezionato Laboratorio
                            	</em></div><br><br>
							<section class="col-lg-3">
								<input  type="radio" id="corso1" value="Laurea" name="corso" onclick="resettaCFUInsegnamento()">
								<label>*Laurea</label>
							</section>
							<section class="col-lg-3">
								<input type="radio" id="corso2" value="Laurea Magistrale" name="corso" onclick="resettaCFUInsegnamento()">
								<label>*Laurea Magistrale</label>
							</section>
	                    </div>
	                </section>
	                <section class="col-lg-12">&nbsp;</section>
	                <section class="col-lg-12">    
			 			<div style="float: none;">
							<section class="col-lg-3">
								<label for="nome">*Denominazione</label>
		                    	<input type="text" class="form-control" placeholder="Es. Analisi matematica" id="denominazione" name="denominazione" size="30" onkeyup="controllaCampo()">
		                    </section>
	                    </div>
	                    <div class="form-group">
	                    	<section class="col-lg-3">

<!-- AGGGIUNGERE I VARI SSD -->
		                      <label>*SSD</label>
                              <div style="float: none;">
		                      <select id="SSD" name="SSD" class="form-control">
                              <option selected value=0>Seleziona SSD</option>
                                  <?php
                                        require_once(dirname(__DIR__,2).'\Application Layer\GestioneInsegnamenti\GestioneInsegnamento.php');
                                      $gestione=new GestioneInsegnamenti();
                                      $ssd=$gestione->getSSD();
                                      while($row=$ssd->fetch_row())
                                          echo "<option value='$row[0]'>$row[0]</option>";
                                  ?>
                              </select>
                              </div>
		                     </section>
                             
		                    <div style="float: none;">
		                    	<section class="col-lg-3">
		                    		<label for="CFU">*CFU Frontali/Es</label>
                                    <div style="float: none;">
		                    		<select class="form-control" id="cfuInsegnamento" name="cfuInsegnamento" onchange="cambioCfu(this.value,0)" disabled>
                                        <option selected value=0>Seleziona CFU</option>
                                        <script> 
                                            cfuIns=document.getElementById("cfuInsegnamento");
                                            for(var i=1;i<=12;i++)
                                                cfuIns.add(new Option(i+" CFU", i, false, false));
                                        </script> 
									</select>
                                    </div>
		                    	</section>
							</div>
							<div style="float: none;">
								<section class="col-lg-3">
									<label for="ore">Ore</label>
                                    <div style="float: none;">
		                    			<input style="border: none;" id="oreCorso" name="oreCorso" readonly size="6" placeholder="0 ore">               
		                    		</div>
                                </section>
		                    </div>
	                    </div>
	                  </section>
		 			<section class="col-lg-12">&nbsp;</section>
                    	<section class="col-lg-2">&nbsp;</section>
				        <section class="col-lg-2">
							<div style="float: none;">
		                    	<input type="checkbox" name="tipologia" id="tipologia" value="Laboratorio" onclick="abilita()">
                                	<label for="lab">Laboratorio</label> 
		                    </div>
                       	</section>
                     	<section class="col-lg-4">
			                <div style="float: none;">
								<label for="CFUlab">**CFU Lab</label>
                            </div>
                            <div style="float: none;">
                                <select class="form-control" id="cfuLaboratorio" name="cfuLaboratorio" onchange="cambioCfu(this.value,1)" disabled>
                                     <option selected value=0>Seleziona CFU</option>
                                     <script> 
                                        cfuLab=document.getElementById("cfuLaboratorio");
                                           for(var i=1;i<=12;i++)
                                               cfuLab.add(new Option(i+" CFU", i, false, false));
                                     </script> 
                                </select>
                            </div>
                        </section>
                        <section class="col-lg-4">
                            <div style="float: none;">
                                <label for="orelab">Ore</label>
                            </div>
                            <div style="float: none;">
                              	<input style="border: none;" id="oreAttivitaLaboratorio" name="oreAttivitaLaboratorio" readonly size="6" placeholder="0 ore">
                         	</div>
		                </section> 			
				     <section class="col-lg-12">&nbsp;</section>
				     <section class="col-lg-12">&nbsp;</section>
				     <section class="col-lg-12">
				     	<div class="form-group">

<!-- AGGGIUNGERE LE VARIE TIPOLOGIE E I VARI MODULI-->
	                    	<section class="col-lg-6">
			                    <label>*Tipologia Attivit&agrave Formativa</label>
                                <div style="float: none;">
                                    <select class="form-control" id="tipologiaAttivitaFormativa" name="tipologiaAttivitaFormativa">
                                        <option value=0 selected>Seleziona tipologia attivit&agrave</option>
                                        <option value="Base Inf">Base Inf.</option>
                                        <option value="Base Mat">Base Mat.</option>
                                        <option value="Caratterizzante Inf">Caratterizzante Inf.</option>
                                        <option value="Affine">Affine</option>
                                        <option value="Scelta dello studente">Scelta dello studente</option>
                                    </select>
                                </div>
			                 </section>
			                 <section class="col-lg-6">
			                    <label>*Modulo</label>
                                <div style="float: none;">
                                    <select class="form-control" id="modulo" name="modulo">
                                          <option selected value=-1>Seleziona divisione insegnamento</option>
                                          <option value="0">Nessuna divisione</option>
                                          <option value="2">2 moduli</option>
                                    </select>
                                </div>
			                 </section>
		                 </div>
				     </section>
				     <section class="col-lg-12">&nbsp;</section>
				     <section class="col-lg-12">&nbsp;</section>
		        	 <section class="col-lg-12">
			        	<div class="box-footer" style="text-align: center;">
			        		<input type="button" class="btn btn-default btn-lg" value="Salva insegnamento" onclick="salva()">
			        	</div>
			        </section>
                    
                </form>
                
<!-- CORPO BOX -->
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
<script src="controlliInsegnamento.js" ></script>
<script>

var lab=0;
function salva(){

		

          corso=1;
          tipologia=0;

          if(document.getElementById("tipologia").checked){
              tipologia=1;
              if(document.getElementById("cfuLaboratorio").value!=0)
                  tipologia=0;
              else 
                  tipologia=1;
          }
          else
              tipologia=0;

          if(document.getElementById("corso1").checked)
              corso=0;
          else if(document.getElementById("corso2").checked)
              corso=0;

          if(document.getElementById("SSD").value!=0 && document.getElementById("cfuInsegnamento").value!=0 && document.getElementById("tipologiaAttivitaFormativa").value!=0 && document.getElementById("modulo").value>=0 && corso!=1 && controllaDenominazione() && tipologia==0)
          {
			var form=document.form;
              var httpRequest = new XMLHttpRequest();
              dati=new FormData();
              dati.append("tipo",0);
              dati.append("denominazione",form.denominazione.value);
              dati.append("corso",form.corso.value);
              dati.append("SSD",form.SSD.value);
              dati.append("cfuInsegnamento",form.cfuInsegnamento.value);
              dati.append("oreCorso",form.oreCorso.value);
              if(document.getElementById("tipologia").checked){
                  dati.append("tipologia",0);
                  dati.append("cfuLaboratorio",form.cfuLaboratorio.value);
                  dati.append("oreAttivitaLaboratorio",form.oreAttivitaLaboratorio.value);
              }
              dati.append("tipologiaAttivitaFormativa",form.tipologiaAttivitaFormativa.value);
              dati.append("modulo",form.modulo.value);
              
              httpRequest.open("POST","http://localhost/IGES/Application%20Layer/GestioneInsegnamenti/getDati.php", true);
              httpRequest.send(dati);
              httpRequest.onreadystatechange=function(){
                  if (httpRequest.readyState==4 && httpRequest.status==200){
                          result=httpRequest.responseText;
                          if(parseInt(result)==0){
                              alert("Insegnamento salvato con successo!");
                            	document.getElementById("formAggiungi").reset();  
                          }
                          else
                              alert("Esiste gia' l'insegnamento!");
                  }
              };
          }
          else
              alert("Compilare i campi!");
      
 }
      
      
</script>