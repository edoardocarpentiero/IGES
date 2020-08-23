<?php

if (!isset($_SESSION))
    session_start();
?>
<!--
    Add_Acc

	Questa classe implementa l'interfaccia grafica che riguarda l'aggiunta di un account

 	Author: Stefano Cirillo, Alessandro Kevin Barletta, Edoardo Carpentiero, Gianmarco Mucciariello
 	Version : 1.0
 	2015 - Copyright by Pr.D Project - University of Salerno
-->
<!DOCTYPE html>
<html>
  <head>
  <?php

  if($_SESSION['presidente'] == false OR $_SESSION['logged']==false)
        header("location: http://localhost/IGES/Presentation%20Layer/index.php")
    ?>
     
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pr.D. - UNISA Informatica </title>    
    <!--Input con sfondo trasparente (user e pass) -->
    <style type="text/css"> #inputLogin{
    background: transparent; border-style: none;
     /* Stili comuni agli elementi del form */
    color: #dedede; /* Colore del testo */
    float: left; /* Float a sinistra */
    font-family: Verdana, sans-serif; /* Tipo di carattere per il testo */
    margin: 10px 0; /* Margini */
	}</style>
    
      <script>
      function controlloUtente()
      {
      			user = document.aggiungiaccount.username.value;
                var myregexp = /^[a-z0-9]+$/i;
                if (myregexp.test(user)==false)
  				  {
       				document.getElementById('conferma').innerHTML = "Il nome utente deve contenere soltanto lettere e/o numeri!";
                    document.aggiungiaccount.invioForm.disabled = true;
   				  }
                else
                  {
                	document.getElementById('conferma').innerHTML = "";
                    document.aggiungiaccount.invioForm.disabled = false;
                  }
      
                if(user.length>=20)
                {
                	document.getElementById('conferma').innerHTML = "Il nome utente deve essere di massimo 20 caratteri!";
                    document.aggiungiaccount.invioForm.disabled = true;
                }
                else
                {
                	document.getElementById('conferma').innerHTML = "";
                    document.aggiungiaccount.invioForm.disabled = false;
                }      
      } //fine controlloUtente     
      
      function controlloPassword()
      {
            	pw = document.aggiungiaccount.password.value;
                pwV = document.aggiungiaccount.passwordV.value;
				
                if(pw.length<6)
                {
                	document.getElementById('conferma').innerHTML = "La Password deve essere almeno di 6 caratteri!";
                    document.aggiungiaccount.invioForm.disabled = true;
                }
                else {
                	if (pw != pwV || pw=="")
               			 {
                	
                    	document.aggiungiaccount.invioForm.disabled = true;
                   		document.getElementById('conferma').innerHTML = "Le Password non coincidono!";
                		 }
               		else {
                		document.aggiungiaccount.invioForm.disabled = false;
                    	document.getElementById('conferma').innerHTML = "";
                    	 }
                    }
	  }
      </script>
     
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
              <li><a href="../Docente/Add_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Aggiungi Docente</a></li>
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
                <li><a href="../Insegnamento/Add_Ins.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Nuovo Insegnamento</a></li>
                <li><a href="../Insegnamento/Mod_Ins.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Modifica Insegnamento</a></li>
                <li><a href="../Insegnamento/Vis_Insegnamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Visualizza Insegnamenti</a></li>
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
              <ul class="treeview-menu" >
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
                <li><a href="../Prog/CambiaStato_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Cambia Stato</a></li>
			</ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Add_Acc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Aggiungi Account</a></li>
                <li><a href="Del_Acc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Elimina Account</a></li>
                <li><a href="Vis_Account.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Account</a></li>
                <li><a href="Vis_El_Acc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Elenco Account</a></li>
            	
                
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
                <li><a href="../Docente/Vis_Doc.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Visualizza Docenti</a></li>';
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
                <li><a href="../Ordinamento/Vis_Ordinamento.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Ordinamento</a></li>
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
                 <li><a href="../Prog/Vis_ProgDid.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Prog. Did.</a></li>
                 '; if($_SESSION['logged']==true){
                 echo '
                 <li><a href="../Prog/Vis_CarD.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Carico Didattico</a></li>
                 <li class="treeview">
                </ul>
                 </li>
               
               <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Vis_Account.php" style="font-size: 13px;"><i class="fa fa-circle-o"></i> Visualizza Account</a></li>
              </ul>
            </li>
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
            Account
            <small>Aggiungi Account</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>
 
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Aggiungi Account</a></li>
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
                  <h3 class="box-title">Aggiungi Account</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                 
                <div class="box-body">
                <form name="aggiungiaccount" method="POST" action="../../Application%20Layer/GestioneAccount/GestioneAccount.php">
                    <input type="hidden" name="funzione" value="aggiungiaccount" >
                    <section class="col-lg-12">&nbsp;</section>
                    <section class="col-lg-12">
                        <section class="col-lg-4"></section>    
    <!-- AGGGIUNGERE DOCENTI -->
                            <section class="col-lg-4">
                                 <label>Docenti</label>
                                 <select name="matricola" class="form-control">
                                   <?php
                                    require_once(dirname(__DIR__,2).'\Application Layer\GestioneAccount\GestioneAccount.php');
						$gestione=new GestioneAccount();
                        
                        $ris=$gestione->getAccount(1,$_SESSION['username']);
                        #gli account che non corrispondono a un docente non verranno visualizzati
                        while($row = mysqli_fetch_array($ris))
                             echo '<option  value="'.$row['Matricola'].'">'.$row['Nome'].' '.str_replace("%", "&nbsp;",$row['Cognome']).'</option>';
                                   ?>
                                 </select>
                                </section>
                         <section class="col-lg-4"></section>
                     </section>
                     <section class="col-lg-12">&nbsp;</section>
                     <section class="col-lg-12">
                        <section class="col-lg-4"></section>
                            <section class="col-lg-4">
                                <label>Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <?php
                                    if ($_SESSION['aggiuntaAccount'] == "3")
                                    echo '<input name="username" type="text" value="'.$_SESSION['accountEsistente'].'"  pattern="[A-Za-z0-9]{5,40}"
       								autofocus required style="color: red;" class="form-control" placeholder="Username" pattern="[A-Za-z0-9]{5,40}"
       								title ="L Username deve contenere solo lettere o numeri e deve essere di 5-20 caratteri!" onkeypress="return event.keyCode!=13">';
                                    else
                                    echo '<input name="username" type="text" pattern="[A-Za-z0-9]{5,40}"
         							autofocus required class="form-control" placeholder="Username"  pattern="[A-Za-z0-9]{5,40}"
       								title ="L Username deve contenere solo lettere o numeri e deve essere di 5-20 caratteri!" autofocus required onkeypress="return event.keyCode!=13">';
                               		?>
                               </div>
                            </section>
                        <section class="col-lg-4"></section>
                     </section>
                     
                    <section class="col-lg-12">&nbsp;</section>
                     
                    <section class="col-lg-12">
                        <section class="col-lg-4"></section>
                        <section class="col-lg-4">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required pattern="[A-Za-z0-9]{6,40}"
       								title ="La password deve contenere solo lettere o numeri e deve essere di 6-20 caratteri!" onkeyup="controlloPassword()" onkeypress="return event.keyCode!=13">
                        </section>
                    </section>
                     
                    <section class="col-lg-12">
                        <section class="col-lg-4"></section>
                        <section class="col-lg-4">
                            <label>Conferma Password</label>
                            <input type="password"  class="form-control" name="passwordV" required pattern="[A-Za-z0-9]{6,20}"
       								title ="La password deve contenere solo lettere o numeri e deve essere di 6-20 caratteri!" onkeyup="controlloPassword()" onkeypress="return event.keyCode!=13">
                        </section>
                    </section>
                     
                    <section class="col-lg-12">&nbsp;</section>
                     
                    <section class="col-lg-12">
                        <section class="col-lg-4"></section>
                        <section class="col-lg-4">
                        
                        </section>
                    </section>
                     
                    <section class="col-lg-12">&nbsp;</section>
                    <section class="col-lg-12">&nbsp;</section>
                    <section class="col-lg-12">
                        <div class="box-footer" style="text-align: center;">
                            <input type="submit" name="invioForm" class="btn btn-default btn-lg" value="Aggiungi"  />
                        </div>
                    </section>
                    <div class="box-footer" style="text-align: center; color: red;" id="conferma">
                    <?php
                        if($_SESSION['aggiuntaAccount'] == 3){
                        	echo 'Username già esistente!';
                            $_SESSION['aggiuntaAccount']=0; }
                            
                        if($_SESSION['aggiuntaAccount'] == 2){
                        	echo 'Il docente è già associato ad un altro account!';
                            $_SESSION['aggiuntaAccount']=0; }
                            
                        if($_SESSION['aggiuntaAccount'] == 1){
                        	echo 'Aggiunta avvenuta con successo';
                            $_SESSION['aggiuntaAccount']=0; }
                    ?>
                    </div>
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
