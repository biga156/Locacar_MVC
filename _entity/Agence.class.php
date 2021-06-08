<?php
class Agence extends Entity
{
	public function __construct($id = 0)
	{
		parent::__construct("agence", "age_id", $id);
	}

	//menu agence : liste des agence (ne rien faire pour la vue index)
	static public function listeAgence()
	{
		$sql = "select * 
		from agence,departement 
		where age_departement=dep_id order by age_id";
		return self::$link->query($sql);
	}

	//menu agence : liste déroulante des départements (vue_agence_index  créer le formulaire)


	static public function listeAgenceByDep($dep_id)
{
$chaine = "";
$sql = "select *
from agence, departement
where age_departement=dep_id and age_departement=$dep_id";
$statement = Entity::$link->prepare($sql);
$statement->execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
extract($row);
$chaine .= "<option value='$age_id'>$age_nom</option>";
}
return $chaine;
}

	//menu agence : vue_agence_index  -> lise des véhicules dispo
	// par agence 
	static function listeVehDispo($age_id)
	{
		$sql = "select * from vehicule,agence,location,categorie where cat_id=veh_categorie and age_id=:id and loc_vehicule=veh_id and veh_agence=age_id and veh_id not in (select loc_vehicule from location where now() between loc_date_heure_debut and loc_date_heure_fin)";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $age_id, PDO::PARAM_INT);
		$statement->execute();
		$row = $statement->fetchAll();
		return $row;
		//return self::$link->query($sql);
	}

	//menu agence : vue_agence_index -> ajouter un champs nos véhicules -> lise des véhicules dispo
	// pour toutes les agences 
	static function listeAllVehDispo()
	{
		$sql = "select * from vehicule,agence,location,categorie where cat_id=veh_categorie and loc_vehicule=veh_id and veh_agence=age_id and veh_id not in (select loc_vehicule from location where now() between loc_date_heure_debut and loc_date_heure_fin)";
		return self::$link->query($sql);
	}

	static function caByAge()
	{
		$sql = " select age_id, age_nom, count(loc_id) nb, sum(prixsansoptions + prixopt) total
	    from loc_option, loc_tarif, agence 
		where equ_location=loc_id and age_id=loc_agence_depart order by age_id; ";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}
}
