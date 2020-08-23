<?php

if(!isset($_SESSION))
{
    session_start();
}
/**
*GestioneAccount
*
*Questa classe implementa le funzionalità che riguardano la gestione di un account
*
*Author: Alessandro Kevin Barletta
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/

require_once(dirname(__DIR__,2).'\Storage Layer\Database.php');
include("Account.php");

class GestioneAccount{
	private $database;
	
	public function __construct()
    {
		$this->database=new Database();
		$this->database->connettiDB();
	}
	
	public function aggiungiAccount($account)
    {   
    	$query= "SELECT Username FROM Account WHERE Username='".$_POST['username']."'";
		$risultatoQuery=$this->database->eseguiQuery($query);
		  
		if(mysqli_num_rows($risultatoQuery)>0)
        {
			$_SESSION['aggiuntaAccount'] = 3;
            $_SESSION['accountEsistente'] = $_POST['username'];
    	}
        else
        {
		$queryA="INSERT INTO Account (Username, Password, Foto, Matricola) VALUES ('".$account->getUsername()."','".$account->getPassword()."','".$account->getFoto()."','".$account->getMatricola()."')";
		return $this->database->eseguiQuery($queryA);
        }
	}
    
    public function getAccount($id, $user)
    { 
    	if($id == 0){
          $query= "SELECT d.Nome, d.Cognome, a.Username FROM Docente d join Account a on (a.Matricola = d.Matricola) WHERE Username='".$user."'";
          $risultatoQuery=$this->database->eseguiQuery($query);
        }
        else{
          $query= "SELECT d.Nome, d.Cognome, a.Username FROM Docente d join Account a on (a.Matricola = d.Matricola)";
          $risultatoQuery=$this->database->eseguiQuery($query);
        }
        return $risultatoQuery;
    }
    
    public function removeAccount($user){
    	$query="DELETE FROM Account WHERE Username='".$user."'";
    	$risultatoQuery=$this->database->eseguiQuery($query);
        echo $risultatoQuery;
    }
    
}
    
//Questo Controllo intercetta la funzione da eseguire e richiama il metodo giusto
if(isset($_POST["funzione"])){
	$gestioneAccount=new GestioneAccount();
	switch($_POST["funzione"]){
		case "aggiungiaccount":
			$account=new Account($_POST["username"], $_POST["password"], "http://localhost/IGES/Presentation%20Layer/dist/img/ImmaginiProfilo/avatar.jpg", $_POST["matricola"]);
			$risultato=$gestioneAccount->aggiungiAccount($account);
                if($risultato)
                {
					$_SESSION['aggiuntaAccount']=1;
                    header("location:http://localhost/IGES/Presentation%20Layer/Account/Add_Acc.php");
                }
				else { 
                	if( $_SESSION['aggiuntaAccount'] == 3)
                    	header("location:http://localhost/IGES/Presentation%20Layer/Account/Add_Acc.php");
                    else {
                    $_SESSION['aggiuntaAccount']=2;
					header("location:http://localhost/IGES/Presentation%20Layer/Account/Add_Acc.php");
                    } 
                }
		break;
        case "deleteAccount":
        	$risultato=$gestioneAccount->removeAccount($_POST['username']);
             if($risultato)
             	header("location:http://localhost/IGES/Presentation%20Layer/Account/Del_Acc.php");
        break;
}
}