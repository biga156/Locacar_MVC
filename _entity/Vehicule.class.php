<?php
class Vehicule extends Entity {
	public function __construct($id=0) {
		parent::__construct("vehicule", "veh_id",$id);
	}

	static function VehiculeParAgence($age_id){

		$sql = "SELECT DISTINCT veh_model, veh_id, veh_agence,veh_categorie, veh_immatriculation, cat_nom, age_nom,dep_nom,age_departement
		from vehicule, agence, categorie,departement 
		where veh_agence=$age_id
		AND veh_categorie=cat_id
		AND veh_agence=age_id
		AND age_departement=dep_id";
		
		return self::$link->query($sql);
		

	}

	static function VehiculeAllAgence(){
	$sql="SELECT  DISTINCT veh_model, veh_id, veh_agence,veh_categorie,veh_site, veh_immatriculation, cat_nom, age_nom,dep_nom,age_departement,loc_agence_depart,loc_agence_arrivee
	FROM vehicule, agence, categorie,departement,locations 
	WHERE veh_categorie=cat_id
	AND loc_agence_depart=age_id
	AND age_departement=dep_id
	AND veh_agence=age_id
	AND loc_agence_arrivee=age_id


	ORDER BY veh_id";
			return self::$link->query($sql);

	}

	static function vehiculeDispo($cat_id,$age_id,$fin,$debut) {
		

		$sql="select def_tarif*timestampdiff(hour, '$fin', '$debut') prix, veh_id, veh_model, 
		cat_id, cat_nom, age_id, age_nom 
		from definir, vehicule, categorie, agence 
		where def_categorie=cat_id ";
		
		if($cat_id <> "all"){
			$sql .= " and cat_id=$cat_id ";
		}

		$sql .= " and age_id=$age_id 
		and veh_categorie=cat_id 
		and veh_agence=age_id  
		and veh_id not in (select distinct loc_vehicule from locations 
		where (loc_date_heure_debut < '$fin' and loc_date_heure_fin > '$debut'))";

	
		
		
		return self::$link->query($sql);
	}

	static function vehiculeSelect($cat_id,$age_id,$fin,$debut, $veh_id) {
		$sql="select def_tarif*timestampdiff(hour, '$fin', '$debut') prix, veh_id, veh_model, cat_id, cat_nom, age_id, age_nom 
		from definir, vehicule, categorie, agence 
		where veh_id=$veh_id 
		and def_categorie=cat_id 
		and cat_id=$cat_id 
		and age_id=$age_id 
		and veh_categorie=cat_id 
		and veh_agence=age_id  
		and veh_id not in (select distinct loc_vehicule from locations 
		where (loc_date_heure_debut < '$fin' and loc_date_heure_fin > '$debut'))";
		return self::$link->query($sql);
	}

	static function findVehiculeByCategorie($model)
	{
		$sql = "select * from vehicule where veh_model = :model";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":model", $model, PDO::PARAM_STR);
		if (!$statement->execute())
			exit; //erreur d'execution
		return $statement->fetch();
	}
	
	
	
}
?>
