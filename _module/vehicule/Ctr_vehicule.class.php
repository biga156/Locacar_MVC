<?php

class Ctr_vehicule extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("vehicule", $action);
        $this->table="vehicule";
        $this->classTable = "Vehicule";
        $this->cle = "veh_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
	
		if (isset($_POST["chercher"])) {
			extract($_POST);
			$result = Vehicule::VehiculeParAgence($_POST["age_id"]);
			
		
		} else {
			$result=Vehicule::VehiculeAllAgence();
		}
		require $this->gabarit;
	
	}
	
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
			$u=new Vehicule();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=vehicule");
		} else {				
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u=new Vehicule($id);
			extract($u->data);	
			require $this->gabarit;
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Vehicule::supprimer("vehicule","veh_id",$_GET["id"]);
		}
		header("location:index.php?m=vehicule");
	}
}

?>