<?php
class Database

{
    static public function creer(string $sqlfile): string
    {
        $sql = file_get_contents($sqlfile);
        Entity::$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
        Entity::$link->exec($sql);
        return $sql;
    }

    static public function genererUtilisateur(int $nbuser): int
    {
        $sql = "insert into utilisateur values ";
        $data = [];
        $countage = 2;
        for ($i = 1; $i <= $nbuser; $i++) {
            $uti_nom = "nom" . $i;
            $uti_prenom = "prenom" . $i;
            $uti_mail = "$uti_nom" . "." . "$uti_prenom" . "@gmail.com";
            $uti_adresse = "adresse" . $i;
            $uti_username = "$uti_nom" . "." . "$uti_prenom";
            $passw = "12345678";
            $uti_passw = password_hash($passw, PASSWORD_DEFAULT);
            if ($i == 1) {
                $uti_profil = 1;
                $uti_agence = 1;
            } else if ($i > 1 && $i <= 11) {
                $uti_profil = 2;
                $uti_agence = 1;
            } else if ($i > 11 && $i <= 51) {
                $uti_profil = 3;

                if ($countage > 21) {
                    $countage = 2;
                }
                $uti_agence = $countage;
                ++$countage;
            } else {
                $uti_profil = 4;
                $uti_agence = "NULL";
            }

            $data[] = "(null,'$uti_nom','$uti_prenom','$uti_mail','$uti_adresse','$uti_username','$uti_passw',$uti_profil,$uti_agence)";
        }

        return Entity::$link->exec($sql . implode(",", $data));
    }


    static public function genererAgence(int $nbagence): int
    {
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

        return Entity::$link->exec($sql . implode(",", $data));
    }


    static public function genererVehicule(int $nbvehicule, $nbagence): int
    {
        $chaine = ["Renault", "Peugeot", "Citroën", "volkswagen", "Mercedes", "Audi", "Škoda", "SEAT", "BMW", "Mazda", "Kia"];
        $sql = "insert into vehicule values ";
        $countage = 2;
        $data = [];
        for ($j = 1; $j <= $nbvehicule; $j++) {
            if ($countage > $nbagence) {
                $countage = 2;
            }
            $veh_site = $countage;
            $veh_agence = rand(2, 21);
            $veh_immatriculation = "78$j-54$j-AA";
            $veh_categorie = rand(1, 6);
            shuffle($chaine);
            $veh_modele = $chaine[0];
            ++$countage;

            $data[] = "(null,'$veh_immatriculation','$veh_modele','$veh_site', '$veh_agence', '$veh_categorie')";
        }

        return Entity::$link->exec($sql . implode(",", $data));
    }

    static public function genererLocation(int $nblocation)
    {
        $sql = "insert into locations values";
        $type = ['telephone', 'internet', 'en agence'];
        $data = [];

        for ($i = 1; $i <= $nblocation; $i++) {
            $loc_type=shuffle($type);        
            $loc_type = $type[0];
            $timestamp = time();
            $loc_date_maj =  date("Y-m-d H:i:s");
            $ts_debut = mktime(rand(8, 20), 0, 0, rand(1, 12), rand(1, 30), 2019);   //date-heure debut (timestamp)
            $demande = rand(1, 336) * 3600;       //calcue: date-heur demande -> max 2 semain avant depart
            $duree_loc = rand(1, 720) * 3600;     //calcule: date-heure duree (ts)
            $ts_fin = $ts_debut + $duree_loc;        //date-heur arrivee (ts)
            $ts_dem = $ts_debut - $demande;       //date-heure demande

            $loc_date_heure_debut = date("Y-m-d H:i:s", $ts_debut);
            $loc_date_heure_fin = date("Y-m-d H:i:s", $ts_fin);
            $loc_date_demande = date("Y-m-d H:i:s", $ts_dem);
            $loc_client = rand(1, 200);
            $loc_agence_depart = rand(2, 21);
            $loc_agence_arrivee = rand(2, 21);
            if ($loc_type == "en agence") {
                $sql = "select * from utilisateur where uti_agence='$loc_agence_depart'";
                //$utilisateur = $link->query($sql)->fetchAll();
                 //$loc_gestionnaire=$utilisateur['uti_id'];
                $res = Entity::$link->query($sql);
                while ($row = $res->fetch()) {
                    $loc_gestionnaire = $row['uti_id'];
                }
            } else {
                $loc_gestionnaire = rand(2, 11);
            }

            if ($ts_fin < $timestamp) {
                $loc_statut = "terminee";
            } else if ($ts_debut < $timestamp && $ts_fin > $timestamp) {
                $loc_statut = "validee";
            } else {
                $loc_statut = "initialisee";
            }
            $sql = "select * from vehicule where veh_agence=$loc_agence_depart ";
            // $veh_disponible = $link->query($sql)->fetchAll();
            // $loc_vehicule= $veh_disponible[0]['ve_id'];
            $veh_disponible = Entity::$link->query($sql);
            while ($row = $veh_disponible->fetch()) {
                $loc_vehicule = $row['veh_id'];
            }
		
	
            $data[] = "(null,'$loc_type', '$loc_date_demande', '$loc_date_maj', '$loc_statut', '$loc_date_heure_debut', '$loc_date_heure_fin', '$loc_gestionnaire', '$loc_agence_depart', '$loc_agence_arrivee', '$loc_client', '$loc_vehicule')";
	
       // var_dump($data);
        }
    
    
       return Entity::$link->exec($sql . implode(",", $data));   
    }
  }