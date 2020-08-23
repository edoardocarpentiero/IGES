<?php

if (!isset($_SESSION))
    session_start();
?>
<!--
    Vis_Doc

	Questa classe implementa l'interfaccia grafica per la visualizzazione della lista docenti della facoltà
    di Informatica presenti nel database

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
                      <form name="logout" method="post" action="http://localhost/IGES/Application%20Layer/GestioneAutenticazione/Autenticazione.php">
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
                <li><a href=""><i class="fa fa-circle-o"></i>Visualizza Docenti</a></li>';
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
            Docenti
            <small>Visualizza Docenti</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>

<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Visualizza Docenti</a></li>
          </ol>
        </section>

<!-- CORPO CENTRALE DEL SITO -->
        <!-- Main content -->
       	<section class="content">
       	  <div class="row">
 			<div class="col-lg-12">
              
<!--  TABELLA COMPLETA -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Visualizza Docenti</h3>
                   <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div id="tabella1" class="box-body">

<!-- CORPO TABELLA -->
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Cognome</th>
                        <th>Nome</th>
                        <th>Ruolo</th>
                        <th>Settore Scientifico Disciplinare</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
						require_once(dirname(__DIR__,2).'\Application Layer\GestioneDocenti\GestioneDocente.php');
							$ges=new GestioneDocente();
							$docs=$ges->ricercaDocente(1, "");
							for($i=0;$i<count($docs);$i++){
								$telefono=$docs[$i]->getNumeroDiTelefono();
								$email=$docs[$i]->getEmail();
								$studio=$docs[$i]->getStudio();
								$ricevimento=$docs[$i]->getRicevimento();
								$nome=$docs[$i]->getNome();
								$cognome=$docs[$i]->getCognome();
							
								$dati=$telefono."&".$email."&".$studio."&".$ricevimento."&".$nome."&".$cognome;
								
								?>
							<tr class="dati" onClick='mostraDettagli("<?php echo $dati;?>")' style="cursor:pointer;">
							<?php
									echo "<td>$cognome</td>";
									echo "<td>$nome</td>";
									echo "<td>".$docs[$i]->getRuolo()."</td>";
									echo "<td>".$docs[$i]->getSettoreScientificoDisciplinare()."</td>";
							}
					?>
                    </tr>
					</tbody>
                    <tfoot>
                      <tr>
                        <th>Cognome</th>
                        <th>Nome</th>
                        <th>Ruolo</th>
                        <th>Settore Scientifico Disciplinare</th>
                      </tr>
                    </tfoot>
                  </table>
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
     </div><!-- wrapper -->
		
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
    <script type="text/javascript">
					function mostraDettagli(dati){
						var tab=document.getElementById("tabella1");
						var res=dati.split("&");
						
						var tel=res[0];
						var email=res[1];
						var studio=res[2];
						var ric=res[3];
						var nome=res[4];
						var cog=res[5];
						
						tab.innerHTML='<table id="example2" class="table table-bordered table-hover">\
							<thead>\
							  <tr>\
								<th>Cognome</th>\
								<th>Nome</th>\
								<th>Telefono</th>\
								<th>Email</th>\
								<th>Studio</th>\
								<th>Ricevimento</th>\
							  </tr>\
							</thead>\
							<tbody>\
							<tr class="dati">\
								<td>'+cog+'</td>\
								<td>'+nome+'</td>\
								<td>'+tel+'</td>\
								<td>'+email+'</td>\
								<td>'+studio+'</td>\
								<td>'+ric+'</td>\
							</tr>\
							</tbody>\
							<tfoot>\
							</tfoot>\
						  </table>';
					}
		</script>
  </body>
</html>
