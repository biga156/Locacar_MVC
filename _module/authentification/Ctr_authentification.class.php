<?php

class Ctr_authentification extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("authentification", $action);
        $a = "a_$action";
        $this->$a();
    }
   
    public function a_connexion()
    {
        if (isset($_POST["btsubmit"])) {
            $user = Utilisateur::findUserByUsername($_POST['uti_username']);
            var_dump($user);
            if (array_key_exists(0, $user) && $user[0]['uti_id'] > 0) {
                if(password_verify($_POST["uti_passw"],$user[0]['uti_passw'])){
              
                $u = new Utilisateur($user[0]['uti_id']);
                if (isset($u->data["uti_id"])) {
                    $_SESSION["utilisateur"] = $u->data["uti_username"];
                    $_SESSION["uti_id"] = $u->data["uti_id"];
                    $_SESSION["nom"] = $u->data["uti_nom"];
                    $_SESSION["prenom"] = $u->data["uti_prenom"];
                    $_SESSION["profil"] = $u->data["uti_profil"];
                    $_SESSION["agence"]= $u->data["uti_agence"];
                    $p = new Profil($_SESSION["profil"]);
                    $_SESSION["profil_name"] = $p->data["pro_nom"];
                    header("location:" . hlien("locations", "index"));
                } else {
                    $message = "Identifiant inconnu";
                    require $this->gabarit;
                }
            } else {
                $message = "Wrong password";
               require $this->gabarit;
            }

            } else {
                $message = "Wrong username";
                require $this->gabarit;
            }
        } else {
            require $this->gabarit;
        } //end of POST

    } //end of function
/************************************************ */
    public function a_deconnexion()
    {
        session_destroy();
        header("location:index.php");
    }
}
