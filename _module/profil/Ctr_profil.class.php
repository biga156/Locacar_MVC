<?php

class Ctr_profil extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("profil", $action);
        $this->table="profil";
        $this->classTable = "Profil";
        $this->cle = "pro_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Profil::findAll("profil");
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
			$u=new Profil();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=profil");
		} else {				
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u=new Profil($id);
			extract($u->data);	
			require $this->gabarit;
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Profil::supprimer("profil","pro_id",$_GET["id"]);
		}
		header("location:index.php?m=profil");
	}
}

?>