<?php

class Ctr_categorie extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("categorie", $action);
        $this->table="categorie";
        $this->classTable = "Categorie";
        $this->cle = "cat_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Categorie::findAll("categorie");
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
			$u=new Categorie();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=categorie");
		} else {				
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u=new Categorie($id);
			extract($u->data);	
			require $this->gabarit;
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Categorie::supprimer("categorie","cat_id",$_GET["id"]);
		}
		header("location:index.php?m=categorie");
	}
}

?>