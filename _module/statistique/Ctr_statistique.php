<?php

class Ctr_statistique extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("statistique", $action);
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Agence::caByAge(); 
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
		} else {				
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			//Categorie::supprimer("equiper","equ_id",$_GET["id"]);
		}
		header("location:index.php?m=accueil");
	}
}
