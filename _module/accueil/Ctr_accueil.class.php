<?php
class Ctr_accueil extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("accueil", $action);
        $a = "a_$action";
        $this->$a();
    }

    function a_index()
    {
        //https://www.php.net/manual/fr/function.str-replace.php
        if (isset($_POST["chercher"])) {
            $loc_date_heure_debut = str_replace($loc_date_heure_debut, "T", " ");
            //var_dump($_POST);
            echo ($loc_date_heure_debut);
            extract($_POST);
            $_SESSION['cat_id'] = $cat_id;
            $_SESSION['dept'] = $dep_id;
            $_SESSION['age_arrive'] = $age_id_arrivee;
            $_SESSION['age_depart'] = $age_id_depart;
            $_SESSION['loc_date_heure_debut'] = $loc_date_heure_debut . " " . $heureDebut;
            $_SESSION['loc_date_heure_fin'] = $loc_date_heure_fin . " " . $heureFin;
            $_SESSION["heueDebut"] = $heureDebut;
            $_SESSION["heureFin"] = $heureFin;

            header("location:" . hlien("accueil", "chercher"));
        } else {
            echo "<p>Text a afficher</p>";
        }

        require $this->gabarit;
    }

    function a_ville()
    {
        if (isset($_GET["dept"])) {
            //var_dump($_GET["dept"]); 
            $dept = $_GET["dept"];
            echo  Agence::listeAgenceByDep($dept);
        }
    }

    function a_chercher()
    {
        if (isset($_POST["chercher"])) {
            $loc_date_heure_debut = str_replace($loc_date_heure_debut, "T", " ");
            var_dump($_POST);
            echo ($loc_date_heure_debut);
            extract($_POST);
            $_SESSION['cat_id'] = $cat_id;
            $_SESSION['dept'] = $dep_id;
            $_SESSION['age_arrive'] = $age_id_arrivee;
            $_SESSION['age_depart'] = $age_id_depart;
            $_SESSION['loc_date_heure_debut'] = $loc_date_heure_debut . " " . $heureDebut;
            $_SESSION['loc_date_heure_fin'] = $loc_date_heure_fin . " " . $heureFin;
            $_SESSION["heueDebut"] = $heureDebut;
            $_SESSION["heureFin"] = $heureFin;
            $result = Vehicule::vehiculeDispo($_SESSION["cat_id"], $_SESSION['age_depart'], $_SESSION['loc_date_heure_debut'], $_SESSION['loc_date_heure_fin']);
        } else {
            $result = Vehicule::vehiculeDispo($_SESSION["cat_id"], $_SESSION['age_depart'], $_SESSION['loc_date_heure_debut'], $_SESSION['loc_date_heure_fin']);
        }
        require $this->gabarit;
    }

    function a_reservation()
    {
        $result = Vehicule::vehiculeSelect($_SESSION["cat_id"], $_SESSION['age_depart'], $_SESSION['loc_date_heure_debut'], $_SESSION['loc_date_heure_fin'], $_GET['id']);
        $options = Entity::findAll("options");
        require $this->gabarit;
    }

    function a_edit()
    {
      
        if (isset($_POST["valider"])) {
              // insérer la résevation dans la table locations
            $l = new Locations();
            $l->chargerDepuisTableau($l->data);
            $l->data['loc_type'] = "en ligne";
            $l->data['loc_date_demande'] = date('Y-m-d H:i');
            $l->data['loc_date_maj'] = date('Y-m-d H:i');
            $l->data['loc_statut'] = "en cours";
            $l->data["loc_date_heure_debut"]=$_SESSION['loc_date_heure_debut'];
            $l->data["loc_date_heure_fin"]=$_SESSION['loc_date_heure_debut'];
            $l->data['loc_gestionnaire'] = 1;
            $l->data['loc_agence_depart'] = $_SESSION['age_depart'];
            $l->data['loc_agence_arrivee'] = $_SESSION['age_arrive'];
            $l->data['loc_client'] = $_SESSION['uti_id'];
            $l->data['loc_vehicule'] = $_SESSION['vehicule'];
            $l->sauver();
            //isertion de equiper
            //$options = Entity::findAll("options");
       foreach($_POST as $cle  => $valeur){
            $e = new Equiper();
            $e->chargerDepuisTableau($e->data);
            $e->data['equ_location'] =Locations::lastLoc_id();
            $e->data['equ_option']=Options::findOptionsByNom($cle);
            $e->sauver();
        }
          header("location:" . hlien("locations", "index"));
          $msg = "la réservation vient d'être effectuer";

            }
           // require $this->gabarit;
    }
}
