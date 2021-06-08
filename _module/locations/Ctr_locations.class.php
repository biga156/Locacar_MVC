<?php

class Ctr_locations extends Ctr_controleur {

	public $classTable;

    public function __construct($action) {
        parent::__construct("locations", $action);
        $this->table="locations";
        $this->classTable = "Locations";
        $this->cle = "loc_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		
		if (isset($_SESSION["profil"]) and $_SESSION["profil"]  <= 2) {
		$result=Locations::listeAll();
		
		} else if (isset($_SESSION["profil"]) and $_SESSION["profil"] == 3) {
			$result=Locations::locationByAgeByStatut($_SESSION["agence"]);
		
		}else{
			$result=Locations::listeAllByUti($_SESSION["uti_id"]);			
		}
		require $this->gabarit;
	}
	function a_edit() {
        if (isset($_POST["btSubmit"])) {
				$l = new Locations();
				
                $_POST["loc_date_maj"] =date("Y-m-d H:i:s");
                $l->chargerDepuisTableau($_POST);
                $l->sauver();
                $_SESSION["message"] = "Votre inscription est validée";
                header("location:" . hlien("locations", "index"));
                exit;
        }else {
            extract($_GET);

            if ($id > 0)  //UPDATE
                $l = new Locations($id);
            else //INSERT
                $l = new Locations();

            extract($l->data);
        }

        require $this->gabarit;
    }
	

	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Locations::supprimer("locations","loc_id",$_GET["id"]);
		}
		header("location:index.php?m=locations");
    }
    
    function a_filter() {
        if (isset($_POST["loc_type"])) {
            var_dump($_POST);

            $result=Locations::filterBy('loc_type',$_POST["loc_type"]);
        
        }else if(isset($_POST["loc_statut"])) {
           
            $result=Locations::filterBy('loc_statut', $_POST["loc_statut"]);

        }else if(isset($_POST["loc_gestionnaire"])) {
            $result=Locations::filterBy('loc_gestionnaire',$_POST["loc_gestionnaire"]);
       
        }else if(isset($_POST["loc_client"])) {
           $result=Locations::filterBy('loc_client',$_POST["loc_client"]);
       
        }else if(isset($_POST["loc_agence_depart"])) {
           $result=Locations::filterBy('depart.age_id',$_POST["loc_agence_depart"]);
       
        }else if(isset($_POST["loc_agence_arrivee"])) {
            $result=Locations::filterBy('arrivee.age_id',$_POST["loc_agence_arrivee"]);
      
        }else if(isset($_POST["annuler"])) {
            header("location:index.php?m=locations");
        }
		require $this->gabarit;
	}
}
