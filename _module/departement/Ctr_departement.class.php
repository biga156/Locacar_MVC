<?php

class Ctr_departement extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("departement", $action);
        $this->table="departement";
        $this->classTable = "Departement";
        $this->cle = "dep_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Departement::findAll("departement");
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
			$u=new Departement();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=departement");
		} else {				
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u=new Departement($id);
			extract($u->data);	
			require $this->gabarit;
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Departement::supprimer("departement","dep_id",$_GET["id"]);
		}
		header("location:index.php?m=departement");
	}
}

?>