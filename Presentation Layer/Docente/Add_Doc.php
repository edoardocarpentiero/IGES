<!--
    Add_Doc

	Questa classe implementa l'interfaccia grafica che riguarda l'aggiunta di un docente

 	Author: Stefano Cirillo, Alessandro Kevin Barletta, Edoardo Carpentiero, Gianmarco Mucciariello
 	Version : 1.0
 	2015 - Copyright by Pr.D Project - University of Salerno
-->
<!DOCTYPE html>
<html>
  <head>
  <?php
  if(!isset($_SESSION))
  {
      session_start();
  }
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
              <li><a href="Add_Doc.php"  style="font-size: 13px;"><i class="fa fa-circle-o"></i>Aggiungi Docente</a></li>
                <li><a href="Mod_Dett_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Modifica Docente</a></li>
                <li><a href="Mod_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Modifica stato Docente</a></li>
                <li><a href="Vis_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Visualizza Docenti</a></li>
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
                if($_SESSION['logged'] == true){
                  }
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
            Docente
            <small>Aggiungi Docente</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Aggiungi Docente</a></li>
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
                  <h3 class="box-title">Aggiungi Docente</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <form name="aggiungidocenteform">
		            <section class="col-lg-6">
			 			<div style="float: none;">
							<label for="nome">Nome</label>
	                    	<input type="text" class="form-control" name="nome" onkeypress="return event.keyCode!=13">
	                    </div>
	                    <div style="float: none;">
	                    	<label for="cognome">Cognome</label>
	                    	<input type="text" class="form-control" name="cognome" onkeypress="return event.keyCode!=13">
	                    </div>
	                    <div style="float: none;">
							<label for="ricevimento">Ricevimento</label>
	                    	<input type="text" class="form-control" name="ricevimento" onkeypress="return event.keyCode!=13">                    
	                    </div>
						
	                    <div class="form-group" style="float: none;">
		                    <label>Telefono:</label>
							<div class="input-group">
			                	<div class="input-group-addon">
			                        <i class="fa fa-phone"></i>
			                    </div>
			                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask name="telefono" onkeypress="return event.keyCode!=13">
			                </div><!-- /.input group -->
		                </div><!-- /.form group -->
		 			</section>
		 				
		 			<section class="col-lg-6">
						<div style="float: none;">
							<label for="studio">Studio</label>
	                    	<input type="text" class="form-control" name="studio" onkeypress="return event.keyCode!=13"> 
	                    </div>
				
		                <div style="float: none;">
							<label for="ssd">SSD</label>
							<select id="SSD" name="ssd" class="form-control">
                              <option selected value=0>Seleziona SSD</option>
								<?php
									require_once(dirname(__DIR__,2).'\Application Layer\GestioneDocenti\GestioneDocente.php');
									$gestione=new GestioneDocente();
									$ssd=$gestione->getSSD();
									while($row=$ssd->fetch_row())
										echo "<option value='$row[0]'>$row[0]</option>";
								?>
                            </select>
	                    </div>                  
		                <div style="float: none;">
	                    	<label for="ruolo">Ruolo</label>
	                    	<select name="ruolo" class="form-control">
								<option value="Docente Associato PA">Docente Associato 'PA'</option>
								<option value="Docente Ordinario PO">Docente Ordinario 'PO'</option>
								<option value="Ricercatore a tempo indeterminato RU">Ricercatore a tempo indeterminato 'RU'</option>
								<option value="Ricercatore a tempo determinato RTDA">Ricercatore a tempo determinato 'RTD' Tip. A</option>
                                <option value="Ricercatore a tempo determinato RTDB">Ricercatore a tempo determinato 'RTD' Tip. B</option>
							</select>
	                    </div>
	                     <div class="form-group" style="float: none;">
		                    <label>Email:</label>
							<div class="input-group">
			                	<div class="input-group-addon">
			                        <i class="fa fa-envelope"></i>
			                    </div>
			                    <input type="text" class="form-control"  name="email" onkeypress="return event.keyCode!=13">
			                </div><!-- /.input group -->
		                </div><!-- /.form group -->
			        </section> <!-- right col -->
                    <section class="col-lg-12">
                        <label for="stato">Stato</label>
			 			<div style="float: none;">
							<section class="col-lg-3">
								<input type="radio" name="stato" value="1" onkeypress="return event.keyCode!=13">
								<label>Attivo</label>
                                <label>&nbsp&nbsp&nbsp&nbsp</label>
								<input type="radio" name="stato" value="0" onkeypress="return event.keyCode!=13">
								<label>Inattivo</label>
							</section>
	                    </div>
	                </section>
                    <section class="col-lg-12">
                      <div class="box-footer" style="text-align: center;">
                          <input type="button" class="btn btn-default btn-lg" value="Aggiungi" onClick="aggiungiDocente()">
                      </div>
                     </section>
					<div class="box-footer" style="text-align: center;" id="conferma"></div>
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
    </div><!-- ./wrapper -->
    <script src="Funzioni_Controllo.js"></script>
	<script>
			function aggiungiDocente(){
				nome=document.aggiungidocenteform.nome.value;
				cognome=document.aggiungidocenteform.cognome.value;
				telefono=document.aggiungidocenteform.telefono.value;
				ricevimento=document.aggiungidocenteform.ricevimento.value;
				studio=document.aggiungidocenteform.studio.value;
				ssd=document.aggiungidocenteform.ssd.value;
				ruolo=document.aggiungidocenteform.ruolo.value;
				email=document.aggiungidocenteform.email.value;
				stato=document.aggiungidocenteform.stato.value;

				if(controllaTesto(nome) && controllaTesto(cognome) && controllaTelefono(telefono) && controllaRicevimento(ricevimento) && controllaStudio(studio) && controllaEmail(email) && controllaStato(stato)){
					var req=new XMLHttpRequest();
					req.onreadystatechange=function(){
						if(req.status==200 && req.readyState==4){
							document.getElementById("conferma").innerHTML=req.responseText;
							document.aggiungidocenteform.reset();
							setTimeout(
								function() {
								  document.getElementById("conferma").innerHTML="";
								}, 2000);
						}	
					}
					
					var dati=new FormData();
					dati.append("funzione", "aggiungidocente");
					dati.append("nome", nome);
					dati.append("cognome", cognome);
					dati.append("email", email);
					dati.append("telefono", telefono);
					dati.append("ricevimento", ricevimento);
					dati.append("ruolo", ruolo);
					dati.append("ssd", ssd);
					dati.append("stato", stato);
					dati.append("studio", studio);
					req.open("POST", "http://localhost/IGES/Application%20Layer/GestioneDocenti/GestioneDocente.php", true);
					req.send(dati);
				}
				else
					document.getElementById("conferma").innerHTML="controlla i dati inseriti e riprova";
			}
	</script>
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
