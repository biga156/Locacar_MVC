<?php

class Ctr_agence extends Ctr_controleur
{

	public $classTable;

	public function __construct($action)
	{
		parent::__construct("agence", $action);
		$this->table = "agence";
		$this->classTable = "Agence";
		$this->cle = "age_id";
		$a = "a_$action";
		$this->$a();
	}

	function a_index()
	{
		if (isset($_POST["chercher"])) {
			extract($_POST);
			$result = Agence::listeAgenceByDep($_POST["dep_id"]);
		} else {
			$result = Agence::findAll("agence");
		}
		require $this->gabarit;
	}

	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		if (isset($_POST["btSubmit"])) {
			$_POST["age_departement"]= strval($_POST["age_departement"]); 
			$u = new Agence();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=agence");
		} else {
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u = new Agence($id);
			extract($u->data);
			require $this->gabarit;
		}
	}


	//param GET id 
	function a_del()
	{
		if (isset($_GET["id"])) {
			Agence::supprimer("agence", "age_id", $_GET["id"]);
		}
		header("location:index.php?m=agence");
	}
}
