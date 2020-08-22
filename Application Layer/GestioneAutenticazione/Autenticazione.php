<?php

/**
*Autenticazione
*
*Questa classe implementa le funzionalità che riguardano l'accesso al sito, ovvero Login, Logout e Password
*
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/
//echo realpath(dirname(__FILE__));
require(dirname(__DIR__,2).'\Storage Layer\Database.php');
session_start();
class Autenticazione{
private $database; //variabile per il DB

public function __construct(){
		$this->database=new Database();
		$this->database->connettiDB();
}// End Construct

function login()
{

    $username = $_POST['username']; //prelevo i dati
    $password = $_POST['password'];

    //Componi Query avente user e pass date in input ed esegui
    $query= "SELECT Username, Password, a.Matricola, Foto, Ruolo FROM Account as a join Docente as d on (a.Matricola=d.Matricola) WHERE Username='".$username."' AND Password='".$password."'";
    $risultatoQuery=$this->database->eseguiQuery($query);
    $number = mysqli_num_rows($risultatoQuery);
    $row = mysqli_fetch_array($risultatoQuery, MYSQLI_ASSOC);

    if($number > 0)
    {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['presidente'] = false;
        $_SESSION['matricola'] = $row['Matricola'];
        $_SESSION['fotoProfilo'] = $row['Foto'];
        $_SESSION['logged'] = true;
        $_SESSION['ruolo'] = $row['Ruolo'];
        $curpage = $_POST['nomepagina'];
        if($row["Username"] == "Presidente")
            $_SESSION['presidente'] = true;
        header('Refresh: 0; url=http://localhost/IGES/Presentation%20Layer/index.php');
       // header('Location: http://localhost/IGES/Presentation%20Layer/index.php');
    }
    else{
        $_SESSION['presidente'] = false;
        $_SESSION['logged'] = false;
        header('http://localhost/IGES/Presentation%20Layer/index.php');
        }
    }//chiudi funzione Login


    function logout()
    {
        $_SESSION['logged']= false;
        $_SESSION['presidente'] = false;
        session_destroy();
        //prendo la pagina corrente e la aggiorno
        $curpage = $_POST['nomepagina'];
    header("Location: http://localhost/IGES/Presentation%20Layer/index.php");
    }// Chiudi Logout
}//Chiudi Class

        
        
if(isset($_POST["funzione"])){
	$aut = new Autenticazione();
    switch($_POST["funzione"]){
        case "login":
            $aut -> login();
            break;
        case "modpassword":
        	$aut -> modificaPassword();
            break;
        case "logout":
        	$aut -> logout();
            break;}//end Switch
}//end ciclo

?>