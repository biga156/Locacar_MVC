<?php

class Ctr_definir extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("definir", $action);
        $this->table="definir";
        $this->classTable = "Definir";
        $this->cle = "def_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Definir::listeAll();
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
			$u=new Definir();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=definir");
		} else {				
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u=new Definir($id);
			extract($u->data);	
			require $this->gabarit;
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Definir::supprimer("definir","def_id",$_GET["id"]);
		}
		header("location:index.php?m=definir");
	}
}

?>