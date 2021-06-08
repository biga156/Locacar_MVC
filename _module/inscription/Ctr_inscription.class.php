<?php

class Ctr_inscription extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("inscription", $action);
        $a = "a_$action";
        $this->$a();
    }

    public function a_edit()
    {
        if (isset($_POST["btsubmit"])) {
            $u = new Utilisateur();

            $_POST["uti_profil"]=4;
            $_POST["uti_agence"]=null;
            $_POST["uti_passw"] = password_hash($_POST["uti_passw"], PASSWORD_DEFAULT);
            $u->chargerDepuisTableau($_POST);
            $u->sauver();
            $_SESSION["message"] = "Votre inscription est validée";
            header("location:" . hlien("accueil", "index"));
            exit;
        } else {
            extract($_GET);

            if ($id > 0)  //UPDATE
                $u = new Utilisateur($id);
            else //INSERT
                $u = new Utilisateur();

            extract($u->data);
        }

        require $this->gabarit;
    }
}
