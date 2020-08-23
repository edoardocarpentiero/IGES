<?php

if (!isset($_SESSION))
    session_start();

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>
<html>
  <head>
    <?php

    //ini_set('display_errors', 0);
    //error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if($_SESSION['logged']==false)
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
  <body class="hold-transition skin-blue sidebar-mini" onload='mostraCaricoDid("<?php echo $_SESSION['matricola'];?>")'>
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
                 <li><a href="Vis_ProgDid.php"><i class="fa fa-circle-o"></i> Visualizza Prog. Did.</a></li>
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
            <small>Carico Didattico Personale</small>
          </h1>

          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Carico Didattico</a></li>
          </ol>
        </section>
     
        <!-- IINIZO  -->
    <!-- corpo  -->
	<input type="hidden" id="matricolaDoc" value="<?php echo $_SESSION['matricola'];?>">
    
      <section class="content">
      
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body">
                <!-- tabella  -->
                <h3>Insegnamenti proposti - Programmazione didattica</h3><br><br>
				<div id="example1_wrapper" class=" table-responsive dataTables_wrapper form-inline dt-bootstrap">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Denominazione</th>
                    <th>CFU</th>
                    <th>Tipologia Attività</th>
                    <th>Ore Teoria</th>
                    <th>Ore Lab.</th>
                    <th>Corso</th>
                    <th>Classe</th>
                    <th>Anno</th>
                    <th>Semestre</th>
                    <th>SSD</th>
                    <th>Disponibilità</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      require_once(dirname(__DIR__,2).'\Application Layer\GestioneCaricoDidattico\GestioneCaricoDidattico.php');
                              $ges=new GestioneCaricoDidattico();
                              $gestionePrD=new GestioneProgrammazioneDidattica();
                              $insegnamentiAssociati=$ges->getInsegnamentiAssociatiAlDocente($_SESSION['matricola']);
                              $prdApprovate=$gestionePrD->getStatusPrd();
                              for($i=0;$i<count($prdApprovate);$i++){
                              	$ris=explode("&",$prdApprovate[$i]);
                              	echo "<tr class='bg-info'><td colspan='11'><h4>La Programmazione didattica <b>".$ris[2]."</b> del corso di <b>".$ris[0]."</b> del <b>".$ris[1]."</b> anno <b>".$ris[3]."</b>° semestre, è nello stato ".$ris[4]."!</h4></td></tr>";
                              }
                              for($i=0;$i<count($insegnamentiAssociati);$i++){
                                  //if(strcmp($docs[$i]->getCognome(), 'Fittizio')!=0){

                                      $insegnamento=$insegnamentiAssociati[$i]->getInsegnamento();
                                      $associazione=$insegnamentiAssociati[$i]->getAssociazione();
                                      $progDidattica=$insegnamentiAssociati[$i]->getProgrammazioneDidattica();

                                      $matricolaInsegnamento=$insegnamento->getID();
                                      $denominazione=$insegnamento->getDenominazione();
                                      $cfu=$insegnamento->getCfuLaboratorio()+$insegnamento->getCfuFrontale();
                                      $tipologiaAttivita=$insegnamento->getTipologiaLezione();
                                      $oreTeoria=$associazione->getOreTeoria();
                                      $oreLab=$associazione->getOreLab();
                                      $corso=$insegnamento->getCorso();
                                      $anno=$progDidattica->getAnnoCorso();
                                      $semestre=$progDidattica->getSemestre();
                                      $SSD=$insegnamento->getSSD();
                                      $status=$associazione->getStatus();

                                      $cfuLab=$insegnamento->getCfuLaboratorio();
                                      $cfuTeoria=$insegnamento->getCfuFrontale();
                                      $annoAccademico=$progDidattica->getAnnoAccademico();
                                      $classe=$associazione->getClasse();
                                      $oreTot=$insegnamento->getDurataCorso();

                                      $dati=$denominazione."&".$cfuLab."&".$cfuTeoria."&".$annoAccademico."&".$matricolaInsegnamento."&".$oreTot;


                                      $datiAssociazione=$matricolaInsegnamento."&".$classe."&".$progDidattica->getID()."&".$oreTeoria."&".$oreLab;


                                      $docentiAssociati=$ges->getInfoDocentiInsegnamento($_SESSION['matricola'],$matricolaInsegnamento,$classe,$progDidattica->getID());
                                      $datiDocente="";
                                      if(count($docentiAssociati)>0){
                                        for($j=0;$j<count($docentiAssociati);$j++)
                                              $datiDocente.=$docentiAssociati[$j]."&";
                                      }


                                  ?>

                                  <tr class="dati" >
                                  <td title="Clicca per info" onClick='infoInsegnamentoAssociato("<?php echo $dati;?>", "<?php echo $datiDocente;?>")' style="cursor:pointer; font-weight: 600;" data-toggle="modal" data-target="#modal-infoInsegnamento"><?php echo $denominazione; ?></td>

                                  <?php
                                          echo "<td>$cfu</td>";
                                          echo "<td>$tipologiaAttivita</td>";
                                          if($oreTeoria==0)
                                              echo "<td>-</td>";
                                          else
                                              echo "<td>$oreTeoria</td>";
                                          if($oreLab==0)
                                              echo "<td>-</td>";
                                          else
                                              echo "<td>$oreLab</td>";
                                          echo "<td>$corso</td>";
                                          echo "<td>$classe</td>";
                                          echo "<td>$anno</td>";
                                          echo "<td>$semestre</td>";
                                          echo "<td>$SSD</td>";
                                  ?> 

                                          <td>
                                                  <?php if(strcmp($status,"IN ATTESA")==0){?>
                                                  <span id='selezionaScelta<?php echo $i;?>'>
                                                  <div class='btn-group'>
                                                    <button type='button' title="L'insegnamento proposto dal presidente è in attesa di essere accettato/rifiutato." class='btn btn-warning btn-flat'>IN ATTESA</button>
                                                    <button type='button' class='btn btn-warning btn-flat dropdown-toggle' data-toggle='dropdown'>
                                                      <span class='caret'></span>
                                                      <span class='sr-only'>Toggle Dropdown</span>
                                                    </button>
                                                    <ul class='dropdown-menu' role='menu'>
                                                      <li><a onclick='aggiornaStatus(1,<?php echo $i;?>,"<?php echo $datiAssociazione;?>")'>Accetta</a></li>
                                                      <li><a onclick='aggiornaStatus(2,<?php echo $i;?>,"<?php echo $datiAssociazione;?>")'>Rifiuta</a></li>
                                                    </ul>
                                                  </div>
                                                 </span>
                                                <?php 
                                                }else if(strcmp($status,"ACCETTATO")==0){?>
                                                  <button title="L'insegnamento proposto dal Presidente è stato accettato." type='button' class='btn btn-success' disabled >ACCETTATO</button>
                                                <?php }else if(strcmp($status,"RIFIUTATO")==0){?>
                                                  <button title="L'insegnamento proposto dal Presidente è stato rifiutato." type='button' class='btn btn-danger' disabled >RIFIUTATO</button>
                                                <?php } else if(strcmp($status,"PROPOSTO")==0){?>
                                                  <button title="L'insegnamento è stato proposto al Presidente." type="button" class="btn btn-dark" disabled>PROPOSTO</button> 
                                                <?php } else if(strcmp($status,"ASSEGNATO")==0){?>
                                                  <button title="L'insegnamento proposto è stato approvato dal Presidente." type='button' class='btn btn-success' disabled>ASSEGNATO</button>
                                                <?php } ?>
                                          </tr>
                                  <?php } ?>     
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Matricola</th>
                      <th>Denominazione</th>
                      <th>CFU</th>
                      <th>Tipologia Attività</th>
                      <th>Ore Teria</th>
                      <th>Ore Lab.</th>
                      <th>Corso</th>
                      <th>Anno</th>
                      <th>Semestre</th>
                      <th>SSD</th>
                      <th>Disponibilità</th>
                    </tr>
                  </tfoot>
                </table>
                </div>
                <!-- fine tabella  -->
                <center><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#insegnamentiDisp">Proponi insegnamento</button></center>
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
	

      <!-- SEZIONE 2 PULSANTE E MONTE ORE -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body ">
                  <h4>Ruolo Ricoperto: <span id="ruoloRicoperto"><?php echo $_SESSION['ruolo'];?></span></h4><br>
                  <h4>Monte ore da coprire: (min: <span id="minDaCoprire"></span> / max: <span id="maxDaCoprire"></span>)</h4>
                  <h4 title="Clicca per info" style="font-weight: 900;" >Monte ore raggiunto: <span id="monteOreRaggiunto"></span> ore </h4>
              </div>
              <div class="box-body" >
                    <div class="row">
                      <div class="col-md-8" id="graficoDonut">
                          <h3 title="Clicca per info" data-toggle="modal" style="cursor:pointer;" data-target="#infoGrafico">Grafico provvisorio insegnamenti Associati</h3>
                          <div id="canvas-holder">
                          </div>
                      <script type="text/javascript">
                                var colori=["#FF0000","#FFBF00","#08E8DE","#00FF00","#FF4D00","#1560BD","#F400A1","#960018","#007BA7","#00A86B"];

                                function mostraCaricoDid(datipass){
                                    var user=datipass;
                                    var dati=new FormData();
                                    dati.append("matricolaDocente",user);
                                    dati.append("funzione","caricoDidattico");
                                    httpReq = new XMLHttpRequest();
                                    httpReq.onreadystatechange = creaGrafo;
                                    httpReq.open("POST","http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php",true);
                                    httpReq.send(dati);
                                }

                                function creaGrafo(){
                                    if(httpReq.readyState == 4 && httpReq.status == 200){
                                        if(httpReq.responseText!=-1){
                                            var doughnut = httpReq.responseText;
                                            disegna(doughnut);
                                        }
                                     }
                                }
                                var tela=0;      
                                function disegna(dati){
                                    var doughnutData = [];
                                    var spl=new Array();
                                    var spl=dati.split(",");
                                    var rgb=0;

                                    for(var i=0; i<spl.length; i+=4){
                                    	//alert(spl[i]+" "+spl[i+1]);
                                        doughnutData.push({value: spl[i], color: colori[rgb], highlight: colori[rgb], label: spl[i+1]+" -- Teoria:"+spl[i+2]+" <> Lab:"+spl[i+3]+" | Totale"});

                                        if(spl[i+1] != null && tela==0){
                                          var ul = document.getElementById("legend");
                                          var lis = document.createElement("li");
                                          var span = document.createElement("span");

                                          var ico = document.createElement("i");
                                          var att = document.createAttribute("class");      
                                          att.value = "fa fa-circle-o";
                                          ico.setAttributeNode(att);

                                          span.innerHTML = spl[i+1];
                                          lis.appendChild(ico);
                                          lis.appendChild(span);
                                          ul.appendChild(lis);
                                        }
                                        rgb++;
                                    }
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
                    </script>

                      </div><!-- /.col -->

      <!-- BISOGNA PASSARE I DATI DELLA LEGENDA -->
                      <div class="col-md-4">
                        <ul class="chart-legend clearfix" id="legend">
                        </ul>
                      </div><!-- /.col -->

                    </div><!-- /.row -->
                  </div><!-- /.box-body -->
            </div>
          </div>
        </div>
      </section>
	
  <!-- fine corpo -->
       


    <!-- INFO MONTE ORE MODAL -->
      <div class="modal fade" id="infoGrafico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Info grafico carico didattico</h4>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
   <!-- INSEGNAMENTI DISPONIBILI -->
  <div class="modal fade bd-example-modal-lg" id="insegnamentiDisp" aria-labelledby="exampleModalLongTitle" style="display: none;">
          <div class="modal-dialog modal-lg ">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Insegnamenti Disponibili</h4>
              </div>

              <div class="box-body table-responsive no-padding">
                <div class="modal-body">
                <table class="table table-bordered table-hover">
                <tr>
                  <th>Denominazione</th>
                  <th>CFU</th>
                  <th>Tipologia Attività</th>
                  <th>Ore Teoria</th>
                  <th>Ore Laboratorio</th>
                  <th>Corso</th>
                  <th>Anno</th>
                  <th>Classe</th>
                  <th>Semestre</th>
                  <th>SSD</th>
                  <th></th>
                </tr>
                <tbody >
                <?php 
                		$insegnamentiDisponibili=$ges->getInsegnamentiDisponibili();
                       	if(count($insegnamentiDisponibili)==0)
                        	  echo "<tr class='dati' ><td colspan='11'><h4>Nessun insegnamento disponibile!</h4></td></tr>";
						else{
                        	for($i=0;$i<count($insegnamentiDisponibili);$i++){
                                    $insegnamento=$insegnamentiDisponibili[$i]->getInsegnamento();
                                    $associazione=$insegnamentiDisponibili[$i]->getAssociazione();
                                    $progDidattica=$insegnamentiDisponibili[$i]->getProgrammazioneDidattica();
                            		
                                    $matricolaInsegnamento=$insegnamento->getID();
                                    $denominazione=$insegnamento->getDenominazione();
                                    $cfu=$insegnamento->getCfuLaboratorio()+$insegnamento->getCfuFrontale();
                                    $tipologiaAttivita=$insegnamento->getTipologiaLezione();
                                    $oreTeoria=$associazione->getOreTeoria();
                                    $oreLab=$associazione->getOreLab();
                                    $corso=$insegnamento->getCorso();
                                    $anno=$progDidattica->getAnnoCorso();
                                    $semestre=$progDidattica->getSemestre();
                                    $SSD=$insegnamento->getSSD();
                                	
                               		
                                    $cfuLab=$insegnamento->getCfuLaboratorio();
                                    $cfuTeoria=$insegnamento->getCfuFrontale();
                                    $annoAccademico=$progDidattica->getAnnoAccademico();
                                    $classe=$associazione->getClasse();
                                    $oreTot=$insegnamento->getDurataCorso();
							
									$dati=$denominazione."&".$cfuLab."&".$cfuTeoria."&".$annoAccademico."&".$matricolaInsegnamento."&".$oreTot;
                                    $datiAssociazione=$matricolaInsegnamento."&".$classe."&".$progDidattica->getID()."&".$oreTeoria."&".$oreLab."&".$corso;
                                	
                                    
                                    $docentiAssociati=$ges->getInfoDocentiInsegnamento("201515200",$matricolaInsegnamento,$classe,$progDidattica->getID());
                                    $datiDocente="";
                                    if(count($docentiAssociati)>0){
                                      for($j=0;$j<count($docentiAssociati);$j++)
                                            $datiDocente.=$docentiAssociati[$j]."&";
                                    }
                                    
                                     

								?>
								<tr class="dati" >
								<td title="Clicca per info" onClick='infoInsegnamentoAssociato("<?php echo $dati;?>", "<?php echo $datiDocente;?>")' style="cursor:pointer; font-weight: 600;" data-toggle="modal" data-target="#modal-infoInsegnamento"><?php echo $denominazione; ?></td>

                                <?php
										echo "<td>$cfu</td>";
										echo "<td>$tipologiaAttivita</td>";
                                        if($oreTeoria==0)
                                        	echo "<td>-</td>";
                                        else
                                        	echo "<td>$oreTeoria</td>";
                                        if($oreLab==0)
                                        	echo "<td>-</td>";
                                        else
                                        	echo "<td>$oreLab</td>";
                                        echo "<td>$corso</td>";
                                        echo "<td>$anno</td>";
                                        echo "<td>$classe</td>";
                                        echo "<td>$semestre</td>";
                                        echo "<td>$SSD</td>";
                                        ?>
                                        <td><button type='button' onclick='proponi("<?php echo $datiAssociazione;?>","<?php echo $denominazione;?>")' class='btn btn-info' title='Clicca per selezionare le ore'>Proponi</button></td></tr>
                                <?php
                                }}?> 
                
              </tbody>
                 </table>
               </div>
            </div>
              <div class="modal-footer">
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </div>

  <!-- MODAL INFO INSEGNAMENTO-->
  	<div class="modal fade bd-example-modal-lg" id="modal-infoInsegnamento" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titleModal"></h4>
              </div>
              <div class="box-body table-responsive no-padding">
              <div class="modal-body">
                	<table class="table table-bordered">
                    <tr>
                      <th>Anno Accademico</th>
                      <th>Matricola</th>
                      <th>CFU Teoria</th>
                      <th>CFU Laboratorio</th>
                      <th>Durata Corso</th>
                      <th>Possibili docenti Associati</th>
                    </tr>
                    <tbody>
                      <tr id="infoIns">
                      	<td id="ac"></td>
                        <td id="matr"></td>
                        <td id="cfuT"></td>
                        <td id="cfuL"></td>
                        <td id="oreCorso"></td>
                        <td>
                          <table class="table table-bordered table-hover">
                            <tr>
                              <th></th>
                              <th>Cognome</th>
                              <th>Nome</th>
                              <th>Ore Teoria</th>
                              <th>Ore Laboratorio</th>
                            </tr>
                            <tbody id="inf">
                            </tbody>
                          </table>
                        </td>
                     </tr>
                  </tbody>
                 </table>
              </div>
               
            </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </div>
  
   
  <!-- FINEEEEEEEEEEEEE -->

<!-- CORPO CENTRALE DEL SITO -->
       	
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
      
      $.fn.dataTable.ext.errMode = 'none';

    $('#example1').on( 'error.dt', function ( e, settings, techNote, message ) {
    console.log( 'An error has been reported by DataTables: ', message );
    } ) ;
      
    </script>
    <script type="text/javascript">
    					//setInterval(function(){ alert("Aggiorna la pagina!"); location.reload();}, 3000);
                        oreDaCoprire();            
                        
                        function oreDaCoprire(){
                        	ruolo=document.getElementById("ruoloRicoperto").innerHTML;
                            rangeOreDocente(ruolo);
                            oreRicoperte();
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
                        
                        function oreRicoperte(){
                        	dati=new FormData();                                      
                            dati.append("matricolaDocente",document.getElementById("matricolaDoc").value);
                            dati.append("funzione","oreRicoperte");
                            httpRequest = new XMLHttpRequest();
                            httpRequest.onreadystatechange = function(){
                            if(httpRequest.readyState == 4 && httpRequest.status == 200){
                                      var ore=httpRequest.responseText;
                                      if(ore>=0)//-1 se la prog nn esiste
                                      	document.getElementById("monteOreRaggiunto").innerHTML=ore;
                                      
                                 }
                            };
                            httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
                            httpRequest.send(dati);
                        }
                        
                        
                    
                    	function aggiornaStatus(status,numeroAssociazione,datiAssociazione){
                        	
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
                            	dati.append("matricolaIns",res[0]);
                                dati.append("classe",res[1]);
                                dati.append("progID",res[2]);
                                dati.append("oreT",res[3]);
                                dati.append("oreL",res[4]);
                                dati.append("funzione","cambiaStatus");
                                httpRequest = new XMLHttpRequest();
                                httpRequest.onreadystatechange = function(){
                                if(httpRequest.readyState == 4 && httpRequest.status == 200){
                                             var esito = httpRequest.responseText;
                                             if(esito==0)
                                             	location.reload();
                                      }
                                };
                                httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
                                httpRequest.send(dati);
                            }
                        }
                        
                        
                        function proponi(datiAssociazione, nomeInsegnamento){
                        	esitoOp = confirm("Vuoi proporre al Presidente l'insegnamento "+nomeInsegnamento+" ?");
                            if(esitoOp){
                            	var res=datiAssociazione.split("&");
                                dati=new FormData();
                                dati.append("matricolaIns",res[0]);
                                dati.append("classe",res[1]);
                                dati.append("progID",res[2]);
                                dati.append("oreTeoria",res[3]);
                                dati.append("oreLab",res[4]);
                                dati.append("funzione","proponiInsegnamento");
                                httpRequest = new XMLHttpRequest();
                                httpRequest.onreadystatechange = function(){
                                  if(httpRequest.readyState == 4 && httpRequest.status == 200){
                                               var esito = httpRequest.responseText;
                                               if(esito==0)
                                               		alert("Proposta insegnamento "+nomeInsegnamento+" effettuata con successo!");
                                               else
                                               		alert("L'insegnamento "+nomeInsegnamento+" gia è stato proposto!");
                                               location.reload();
                                        }
                                  };
                              httpRequest.open("POST", "http://localhost/IGES/Application%20Layer/GestioneCaricoDidattico/GestioneCaricoDidattico.php", true);
                              httpRequest.send(dati);
                            }
                        }
                        
                   		function infoInsegnamentoAssociato(dati,datiDocente){
                        
                        	var res=dati.split("&");
                            document.getElementById("titleModal").innerHTML="Info Insegnamento "+res[0];
                            var table=document.getElementById("infoIns");

                           	
                            document.getElementById("ac").innerHTML=res[3];
                            document.getElementById("matr").innerHTML=res[4];
                            document.getElementById("cfuT").innerHTML=res[2];
                            document.getElementById("cfuL").innerHTML=res[1];
                            document.getElementById("oreCorso").innerHTML=res[5]+" ore";
                            
                           	table=document.getElementById("inf");
                        	var docentiAss=datiDocente.split("&");
                            table.innerHTML="";
                            for(i=0;i<docentiAss.length-1;i++){
                                var datiDoc=docentiAss[i].split(".");
                                j=0;
                                table.innerHTML+="<tr><td><b>"+(i+1)+"</b></td><td>"+datiDoc[++j]+"</td><td>"+datiDoc[++j]+"</td><td>"+datiDoc[++j]+"</td><td>"+datiDoc[++j]+"</td></tr>";
                            }
                            
                        }  
                        
			</script>
  </body>
</html>
