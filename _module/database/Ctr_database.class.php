<?php
class Ctr_database extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("database", $action);
        $a = "a_$action";
        $this->$a();
    }

    public function a_creer()
    {
        $sql = Database::creer("../_sql/creation_base_locacar.sql");
        require $this->gabarit;
    }

    public function a_dataset()
    {
        $nbagence=Database::genererAgence(21);
        $nbutilisateur = Database::genererUtilisateur(200);
        $nbvehicule=Database:: genererVehicule(200,20);
        $nblocations=Database::genererLocation(100);
        $nbequiper=Database::genererEquiper(100);

        require $this->gabarit;
    }
}
