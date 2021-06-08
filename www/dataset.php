<?php
//composer require fzaninotto/faker
require "../_include/inc_config.php";
require_once '../vendor/autoload.php';
// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create("fr_FR");

$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$dateMois = date("m");

$nbagence = "21";
$nbvehicule = "200";
$nbgestionnaire = "51";
$nbclient = "200";

//passw
$caract = "abcdefghijklmnopqrstuvwyxz0123456789";
$nb_caract = 4;
?>
<!DOCTYPE html>
<html>

<head>
    <?php require "../_include/inc_head.php" ?>
</head>

<body>
    <header>
        <?php require "../_include/inc_entete.php" ?>
    </header>
    <nav>
        <?php require "../_include/inc_menu.php"; ?>
    </nav>
    <div id="contenu">
        <h1>Génération du jeu de données</h1>
        <?php

        //création des clients
        echo "<h1>Création des clients</h1>";
        $sql = "insert into client values ";
        $data = [];
        for ($i = 1; $i <= $nbclient; $i++) {
            $cl_nom = $faker->lastname;
            $cl_prenom = $faker->firstname;
            $cl_adresse = $faker->address(100);
            $cl_mail = $faker->email;
            $cl_username = $cl_nom . "." . $dateMois;
            $passw = [];
            for ($j = 1; $j <= $nb_caract; ++$j) {
                $nbr = strlen($caract);
                $nbr = mt_rand(0, ($nbr - 1));
                $passw[$j] = $nbr;
            }
            $cl_passw = password_hash(implode($passw), PASSWORD_DEFAULT);
            $data[] = "(null,'$cl_nom','$cl_prenom','$cl_mail','$cl_adresse','$cl_username','$cl_passw')";
        }

        $link->query($sql . implode(",", $data));


        //création des categories        
        echo "<h1>Création des categories</h1>";
        $chaine = "petit, moyen, grand, utilitaire, prestige, camping car";
        $tarif["cat1"]=["8","7","3"];
        $categorie = explode(",", $chaine);
        $sql = "insert into categorie values ";
        $data = [];
        foreach ($categorie as $nom) {
            $data[] = "(null,'$nom')";
        }
        $link->query($sql . implode(",", $data));


        //création des options        
        $option["nom"] =    ["Climatisation", "GPS", "pneus neige", "lecteur viedeo", "minibar"];
        $option["tarif"] = ["10", "7", "23", "5", "15"];
        echo "<h1>Création des option</h1>";
        $sql = "insert into options values ";
        $data = [];
        for ($i = 0; $i < count($option["nom"]); ++$i) {
            $nom = $option["nom"][$i];
            $tarif = $option["tarif"][$i];
            $data[] = "(null,'$nom','$tarif')";
        }

        $link->query($sql . implode(",", $data));

        //création des agences
        echo "<h1>Création des agences</h1>";
        $sql = "insert into agence values ";
        $data = [];
        for ($i = 1; $i <= $nbagence; ++$i) {
            if ($i == 1) {
                $nom = "Service de Réservation Centrale";
                $dep = rand(1, 95);
            } else {
                $nom = "Locacar $i";
                $dep = rand(1, 95);
            }

            $data[] = "(null,'$nom','$dep')";
        }

        $link->query($sql . implode(",", $data));

        //création des gestionnaire
        echo "<h1>Création des gestionnaire</h1>";
        $sql = "insert into gestionnaire values ";
        $ag = 1;
        $data = [];
        for ($i = 1; $i <= $nbgestionnaire; $i++) {
            $ges_nom = $faker->firstname;
            if ($i == 1) {
                $ges_profil = "admin";
            } else if ($i > 1 && $i <= 11) {
                $ges_profil = "SRC";
            } else {
                $ges_profil = "gestAgence";
            }

            if ($ges_profil == "gestAgence") {
                $ges_agence = $ag;
                ++$ag;
                if ($ag > 20) {
                    $ag = 1;
                }
            } else {
                $ges_agence = 'null';
            }

            $ges_username = $ges_nom . "." . $dateMois;
            $passw = [];
            for ($j = 1; $j <= $nb_caract; ++$j) {
                $nbr = strlen($caract);
                $nbr = mt_rand(0, ($nbr - 1));
                $passw[$j] = $nbr;
            }
            $ges_passw = password_hash(implode($passw), PASSWORD_DEFAULT);
            $data[] = "(null,'$ges_nom','$ges_profil','$ges_username','$ges_passw',$ges_agence)";
        }

        //var_dump($data);
        $link->query($sql . implode(",", $data));



        //creation plage horaire
        echo "<h1>creation de la plage horaire</h1>";
        $nb_pl = 3;
        $sql = "insert into plage_horaire values";
        $data = [];

        for ($i = 1; $i <= $nb_pl; $i++) {
            if ($i == 1) {
                $plg_hmin = 1;
                $plg_hmax = 12;
            } else if ($i == 2) {
                $plg_hmin = 13;
                $plg_hmax = 24;
            } else if ($i == 3) {
                $plg_hmin = 25;
                $plg_hmax = 720;
            }

            $data[] = "(null,'$plg_hmin','$plg_hmax')";
        }

        $link->query($sql . implode(",", $data));

        // creation de la table definir
        echo "<h1>creation de la table definir</h1>";
        $sql="insert into definir values";
        $data=[];
        $cat ["voiture"]= ["petit", "moyen", "grand", "utilitaire"," prestige", "camping car"];
        $tarif["plage1"]=["8","10","14","6","27","35"];
        $tarif["plage2"]=["7","9","12","5","24","34"];
        $tarif["plage3"]=["6","8","10","4","20","30"];
    

        for($i=1; $i<=6; $i++){
                $i=$def_categorie;
                $tarif["plage1"][$i];
                $tarif["plage2"][$i];
                $tarif["plage3"][$i];
              
            }

            $data[]="(null,'$def_tarif','$def_plage_horaire','$def_categorie)";

        }

        


        ?>
    </div>
    <hr>
    <footer>
        <?php require "../_include/inc_pied.php"; ?>
    </footer>
</body>

</html>