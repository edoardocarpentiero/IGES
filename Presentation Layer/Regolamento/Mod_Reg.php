<?php

if (!isset($_SESSION))
    session_start();
?>
<!--
    Mod_Reg

	Questa classe implementa l'interfaccia grafica per la modifica di un regolamento esistente

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
            <small>Modifica Regolamento</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Modifica Regolamento</a></li>
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
                  <h3 class="box-title">Modifica Regolamento</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
					<p>
						<form action="Pag_Crea_Reg.php" method="POST" name="form1">
						<?php
							$annoIniziale=substr(date("Y"),0,2);
							$annoFinale=intval(substr(date("Y"),2,4));
							$anno=$annoIniziale.$annoFinale."-".$annoIniziale.($annoFinale+1);
							echo '<input type="hidden" value="'.$anno.'" id="annoAccademico">';
						?>
						<table align="center" class="table table-bordered table-striped">
						<tr>
							<td style="text-align: center;">
									<section class="col-lg-12" style="text-align: center;">
									<div>
										<input type="radio" name="corso" value="Laurea" id="laurea" onchange="inserisciCurriculum();controllo()">
										<label>Laurea</label>
										<label>&nbsp&nbsp&nbsp</label>
										<input type="radio" name="corso" value="Magistrale" id="magist" onchange="inserisciCurriculum();controllo()">
										<label>Laurea Magistrale</label>
									</div>
									</section>
									<section class="col-lg-12">&nbsp</section>
									<section class="col-lg-12">
										<section class="col-lg-4">&nbsp</section>
										<section class="col-lg-4">
											<label>Seleziona Curriculum</label>
											<select class="form-control" style="text-align: center;" id="selectCurriculum" name="curr" onchange="controllo()">
							                	
							                </select>
							              </section>
									</section>					            	
			                </td>
		                </tr>
						</table>	
						</form>
					</p>
<!-- CORPO BOX -->
					 <section class="col-lg-12">&nbsp;</section>
				     <section class="col-lg-12">&nbsp;</section>
		        	 <section class="col-lg-12">
			        	<div class="box-footer" style="text-align: center;">
			        		<input type="button" class="btn btn-default btn-lg" value="Modifica Regolamento" name="modifica" id="modificaButton" onclick="modificaRegolamento()" disabled="true">
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
	<script>
	
		function controllo(){
			var corso=document.form1.corso.value;
			var sel=document.getElementById("selectCurriculum").value;
			
			if(corso!="" && sel!="" && sel!="seleziona")
				document.getElementById("modificaButton").disabled=false;
			else
				document.getElementById("modificaButton").disabled=true;
		}
		
		function inserisciCurriculum(){
        		var anno=document.getElementById("annoAccademico").value;
        		var corso=document.form1.corso.value;
				var sel=document.getElementById("selectCurriculum");
                var result="<option value='seleziona'>Seleziona curriculum</option>";
				var req=new XMLHttpRequest();
						req.onreadystatechange=function(){
							if(req.status==200 && req.readyState==4){
								curricula=JSON.parse(req.responseText);
                                if(curricula.length>0){
                                    for(i=0;i<curricula.length;i++){
                                        result+='<option value="'+curricula[i]+'">'+curricula[i]+'</option>';
                                    }
                                    sel.innerHTML=result;
                                    sel.disabled=false;
                                }
                                else{
                                	sel.innerHTML=result;
                                    sel.disabled=true;
                                }
							}
						}
                        	
				var dati=new FormData();
				dati.append("funzione", "cercaCurriculumDaModificare");
				dati.append("corso", corso);
                dati.append("annoAccademico", anno);
				req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneRegolamento/GestioneRegolamento.php", true);
				req.send(dati);
		}
		
		function modificaRegolamento(){
        		var anno=document.getElementById("annoAccademico").value;
        		var corso=document.form1.corso.value;
				var cur=document.getElementById("selectCurriculum").value;
				var req=new XMLHttpRequest();
						req.onreadystatechange=function(){
							if(req.status==200 && req.readyState==4){
								document.form1.submit();
							}
						}
                        	
				var dati=new FormData();
				dati.append("funzione", "modificaRegolamento");
				dati.append("corso", corso);
                dati.append("annoAccademico", anno);
				dati.append("curriculum", cur);
				req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneRegolamento/GestioneRegolamento.php", true);
				req.send(dati);
		}
	</script>
  </body>
</html>
