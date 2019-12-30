<?php
/**
*Account
*
*Questa classe rappresenta l'entità Account
*
*Author: Alessandro Kevin Barletta
*Version : 1.0
*2015 - Copyright by Pr.D Project - University of Salerno
*/

	class Account{
		private $username, $password, $foto, $matricola;
		
		public function __construct($username, $password, $foto, $matricola){
			//costruttore che setta tutte le variabili con i valori passati tramite parametro
			$this->username = $username;
			$this->password=$password;
			$this->foto=$foto;
			$this->matricola=$matricola;
		}
		
		//metodi getter che restituiscono il contenuto delle variabili
		public function getMatricola(){
			return $this->matricola;
		}
		
		public function getUsername(){
			return $this->username;
		}
		
		public function getPassword(){
			return $this->password;
		}
		
		public function getFoto(){
			return $this->foto;
		}
		
		
		//metodi setter che modificano il contenuto delle variabili con il valore passato tramite parametro
		public function setMatricola($matricola){
			return $this->matricola=$matricola;
		}
		
		public function setUsername($username){
			return $this->username=$username;
		}
		
		public function setPassword($password){
			return $this->password=$password;
		}
		
		public function setFoto($foto){
			return $this->foto=$foto;
		}
		
	}
?>