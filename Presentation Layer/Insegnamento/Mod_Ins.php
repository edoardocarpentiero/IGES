<!--
    Mod_Ins

	Questa classe implementa l'interfaccia grafica per la modifica delle informazioni di un insegnamento

 	Author: Stefano Cirillo, Alessandro Kevin Barletta, Edoardo Carpentiero, Gianmarco Mucciariello
 	Version : 1.0
 	2015 - Copyright by Pr.D Project - University of Salerno
-->
<!DOCTYPE html>
<html>
  <head>
  <?php
  	session_start();
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
            <small>Modifica Insegnamento</small>
            <p style="text-align: center;"><img alt="logoPRD" src="../dist/img/logo2.png"></p><p style="text-align: center;"><img alt="logoDIA" src="../dist/img/logoDIA2.png" width="400" height="79"></p>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Modifica Insegnamento</a></li>
          </ol>
        </section>

<!-- CORPO CENTRALE DEL SITO -->
        <!-- Main content -->
       	<section class="content">
       	  <div class="row">
 			<div class="col-xs-12">
              
<!--  TABELLA COMPLETA -->

<!-- LA TABELLA NEI MOCKUP MOSTRA SOLO 4 CAMPI. NELL'IMPLEMENTAZIONE SONO STATI AGGIUNTI TUTTI -->
<!-- ALLA SELEZIONE DELL'ESAME E AL CLICK DEL TASTO MODIFICA BISOGNA COLLEGARSI ALLA PAGINA MODIFICA (Pag_Mod_Ins.php)
	(CHE � UGUALE ALLA PAGINA DI AGGIUNTA TRANNE PER I TITOLI SOPRA)
-->
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Modifica Insegnamento</h3>
                  <div class="box-tools pull-right">
                  	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Denominazione</th>
                        <th>Tipologia Attivit&agrave Formativa</th>
                        <th>Tipologia Attivit&agrave</th>
                        <th>Modulo</th>
                        <th>Corso</th>
                      	<th>SSD</th>
                      	<th>CFU Frontali</th>
                        <th>CFU Laboratorio</th>
                        <th>Ore Corso</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    	require_once(dirname(__DIR__,2).'\Application Layer\GestioneInsegnamenti\GestioneInsegnamento.php');
                        $db=new GestioneInsegnamenti();
                        $result=$db->visualizzaInsegnamenti("","");
                        $n=count($result);
                    	for($i=0;$i<$n;$i++){
                        	$id=$result[$i]->getID();
                    		echo "<tr onclick=\"modifica('$result[$i]',$id)\">";
                            	echo"<td><a href='#modifica'>".$result[$i]->getDenominazione()."</a></td>";
                                echo"<td>".$result[$i]->getTipologiaAttivitaFormativa()."</td>";
                                echo"<td>".$result[$i]->getTipologiaLezione()."</td>";
                                if(intval($result[$i]->getModulo())==0)
                                	echo"<td></td>";
                                else
                                	echo"<td>".$result[$i]->getModulo()."</td>";
                                echo"<td>".$result[$i]->getCorso()."</td>";
                                echo"<td>".$result[$i]->getSSD()."</td>";
                                echo"<td>".$result[$i]->getCfuFrontale()."</td>";
                                echo"<td>".$result[$i]->getCfuLaboratorio()."</td>";
                                echo"<td>".$result[$i]->getDurataCorso()."</td>";
                            echo'</tr>';
                    	}
                    ?>
					</tbody>
                    <tfoot>
                      <tr>
                        <th>Denominazione</th>
                        <th>Tipologia Attivit&agrave Formativa</th>
                        <th>Tipologia Attivit&agrave</th>
                        <th>Corso</th>
                        <th>Corso</th>
                      	<th>SSD</th>
                      	<th>CFU Frontali</th>
                        <th>CFU Laboratorio</th>
                        <th>Ore Corso</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<!-- FINE TABELLA -->
            <div id="sezioneModifica" class="box">
                <div class="box-header">
                  <h3 class="box-title" id="titoloModifica">Modifica Insegnamento</h3>
                  <div class="box-tools pull-right">
                  	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                
                <div class="box-body" style="text-align: center;">
                	 <a name='modifica'></a>
                    <form id="modificaInformazioni" style="display:none;" action="">
                            <div><em>* Obbligatorio<br>
                            	** Obbligatorio se &egrave stato selezionato Laboratorio
                            </em></div><br><br>
                            <input type="hidden" value="1" id="tipo" name="tipo">
                            <input type="hidden" value="" id="id" name="id">
                            <input type="hidden" value="" id="modulo" name="modulo">
                            
                            <section class="col-lg-12">
                            <div style="float: none;">
                            	<section class="col-lg-3">&nbsp;</section>
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
                                        <select class="form-control" id="cfuInsegnamento" name="cfuInsegnamento" onchange="cambioCfu(this.value,0)">
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
                                    <section class="col-lg-2">
                                        <label for="ore">Ore</label>
                                        <div style="float: none;">
                                            <input style="border: none;" id="oreCorso" name="oreCorso" readonly size="6" placeholder="0 ore">               
                                        </div>
                                    </section>
                                </div>
                            </div>
                          </section>
                        <section class="col-lg-12">&nbsp;</section>
                            <section class="col-lg-4">
                                <div style="float: none;">
                                    <input type="checkbox" name="tipologia" id="tipologia" value="Laboratorio" onclick="abilita()">
                                        <label for="lab">Laboratorio</label> 
                                </div>
                            </section>
                            <section class="col-lg-3">
                                <div style="float: none;">
                                    <label for="CFUlab">**CFU Lab</label>
                                </div>
                                <div style="float: none;">
                                    <select class="form-control" id="cfuLaboratorio" name="cfuLaboratorio" onchange="cambioCfu(this.value,1)">
                                         <option selected value=0>Seleziona CFU</option>
                                         <script> 
                                            cfuLab=document.getElementById("cfuLaboratorio");
                                               for(var i=1;i<=12;i++)
                                                   cfuLab.add(new Option(i+" CFU", i, false, false));
                                         </script> 
                                    </select>
                                </div>
                            </section>
                            <section class="col-lg-2">
                                <div style="float: none;">
                                    <label for="orelab">Ore</label>
                                </div>
                                <div style="float: none;">
                                    <input style="border: none;" id="oreAttivitaLaboratorio" name="oreAttivitaLaboratorio" readonly size="6" placeholder="0 ore">
                                </div>
                            </section> 			

                            <div class="form-group">
                                <section class="col-lg-3">
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
                             </div>
                         <section class="col-lg-12">&nbsp;</section>
                         <section class="col-lg-12">&nbsp;</section>
                    </form>
                    <section class="col-lg-12">
                      <div class="box-footer" style="text-align: center;">
                              <button class="btn btn-default btn-lg" id="salva" onclick="salvaModifica()" disabled>Termina Modifica</button>
                              <button class="btn btn-default btn-lg" id="annulla" onclick="annullaModifica()" disabled>Annulla Modifica</button>
                      </div>
                    </section>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section>
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
  </body>
</html>


<script src="controlliInsegnamento.js" ></script>
<script>
		
      function annullaModifica(){
          document.getElementById("modificaInformazioni").style.display = "none";
          document.getElementById("salva").disabled=true;
          document.getElementById("annulla").disabled=true;
          document.getElementById("titoloModifica").innerHTML="Modifica Insegnamento";
      }

      function salvaModifica(){
      				
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
                    dati=new FormData(document.getElementById("modificaInformazioni"));
                    var httpRequest = new XMLHttpRequest(); 
                    httpRequest.open("POST","http://localhost/IGES/Application%20Layer/GestioneInsegnamenti/getDati.php", true);
                    httpRequest.send(dati);
                    httpRequest.onreadystatechange=function(){
                              if (httpRequest.readyState==4 && httpRequest.status==200){
                                    result=httpRequest.responseText;
                                     if(parseInt(result)==0){
                                          alert("Insegnamento modificato con successo!");
                                          location.reload();
                                      }
                                      else
                                          alert("Modifiche non salvate!\nEsiste gia' un insegnamento con le stesse informazioni!");
                                }
                    };
          }
          else
          		alert("Campi Obbligatori!");
      }

      function modifica(dati,id){
          if(document.getElementById("modificaInformazioni").style.display=="none")
              document.getElementById("modificaInformazioni").style.display = "block";
          infInsegnamenti=dati.split(".");
          
          setCampi(infInsegnamenti,id);
          
          titolo=document.getElementById("titoloModifica");
          insegnamento="Modifica Insegnamento"+" - "+infInsegnamenti[0];
          titolo.innerHTML=insegnamento;
      }
      
      function setCampi(datiInsegnamento,id){
            if(document.getElementById("corso1").value==datiInsegnamento[3])
                document.getElementById("corso1").checked = true;
            else
                document.getElementById("corso2").checked = true;
			
            document.getElementById("modulo").value=datiInsegnamento[4];
            document.getElementById("denominazione").value=datiInsegnamento[0];
            document.getElementById("SSD").value=datiInsegnamento[5];
            document.getElementById("cfuInsegnamento").value=parseInt(datiInsegnamento[7]);
            
            
            if(parseInt(datiInsegnamento[6])!=0){
                document.getElementById("tipologia").checked = true;
                document.getElementById("cfuLaboratorio").disabled = false;
                document.getElementById("cfuLaboratorio").value=datiInsegnamento[6];
                cambioCfu(parseInt(datiInsegnamento[6]),1);
                document.getElementById("oreCorso").value=parseInt(datiInsegnamento[8])-parseInt(document.getElementById("oreAttivitaLaboratorio").value);
            }
            else{
            	resettaCampiLab();
                document.getElementById("tipologia").checked = false;
                document.getElementById("cfuLaboratorio").disabled = true;
                document.getElementById("oreCorso").value=parseInt(datiInsegnamento[8]);
            }

            document.getElementById("tipologiaAttivitaFormativa").value=datiInsegnamento[1];
            document.getElementById("id").value=id;
            
            document.getElementById("salva").disabled=false;
            document.getElementById("annulla").disabled=false;
      }
      
</script>