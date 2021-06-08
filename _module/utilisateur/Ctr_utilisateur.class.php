<?php

class Ctr_utilisateur extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("utilisateur", $action);
        $this->table="utilisateur";
        $this->classTable = "Utilisateur";
        $this->cle = "uti_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Utilisateur::findAll("utilisateur");
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		if (isset($_POST["btSubmit"])) {
			$_POST['uti_passw']=password_hash($_POST['uti_passw'], PASSWORD_DEFAULT);
			$u=new Utilisateur();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=utilisateur");
		} else {				
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u=new Utilisateur($id);
			extract($u->data);	
			require $this->gabarit;
		}
	}
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Utilisateur::supprimer("utilisateur","uti_id",$_GET["id"]);
		}
		header("location:index.php?m=utilisateur");
	}
}

?>