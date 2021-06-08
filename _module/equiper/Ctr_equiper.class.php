<?php

class Ctr_equiper extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("equiper", $action);
        $this->table="equiper";
        $this->classTable = "Equiper";
        $this->cle = "equ_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Equiper::listeEquiper();
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
			$u=new Equiper();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=equiper");
		} else {				
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u=new Equiper($id);
			extract($u->data);	
			require $this->gabarit;
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Equiper::supprimer("equiper","equ_id",$_GET["id"]);
		}
		header("location:index.php?m=equiper");
	}
}

?>