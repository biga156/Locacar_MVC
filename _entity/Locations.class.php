<?php
class Locations extends Entity
{
	public function __construct($id = 0)
	{
		parent::__construct("locations", "loc_id", $id);
	}

	static public function listeAll()
	{
		$sql = "select depart.age_id agedepartid, depart.age_nom agedepart, arrivee.age_id agefinid, arrivee.age_nom agefin, gest.uti_username gestionnaire,client.uti_username client,loc_id,loc_date_heure_debut,loc_date_heure_fin,loc_agence_depart,loc_agence_arrivee,loc_statut,loc_client,loc_type,loc_gestionnaire,loc_date_demande,loc_date_maj,loc_vehicule,veh_id,veh_immatriculation,cat_nom
		from agence depart,agence arrivee,utilisateur client, utilisateur gest, profil,locations,categorie, vehicule
		where loc_agence_depart=depart.age_id
		and loc_agence_arrivee=arrivee.age_id
		and loc_client=client.uti_id 
		and loc_gestionnaire=gest.uti_id
		and loc_vehicule=veh_id
		and veh_categorie=cat_id";
		return self::$link->query($sql);
	}

	static public function listeAllByUti($uti_id)
	{	
		$sql = "select loc_id,loc_type,loc_date_demande,loc_date_maj,loc_statut,loc_date_heure_debut,loc_date_heure_fin,
		loc_agence_depart,loc_agence_arrivee
		from locations
		where loc_client=$uti_id
		order by loc_date_maj";
		

		return self::$link->query($sql);
	}

	static function montantByLocation($loc_id)
	{
		$sql = "select loc_id, def_tarif*duree prix_hors_option from loc_duree, plage_horaire, definir where loc_id=$loc_id and veh_categorie=def_categorie and pla_id=def_plage_horaire and duree between plg_hmin and plg_hmax";
		return self::$link->query($sql);
	}

	static function montantByClient($uti_id)
	{
		$sql = "select * from locations,utilisateur, categorie , vehicule, agence where uti_id=loc_client and loc_client=$uti_id and loc_categorie=cat_id and loc_vehicule=veh_id and veh_agence=age_id ";
		return self::$link->query($sql);
	}

	static function locationActuelle($uti_id)
	{
		$sql = "select * from locations,utilisateur, categorie, vehicule where uti_id=loc_client and loc_client=$uti_id and loc_categorie=cat_id and veh_id=loc_vehicule and now() between loc_date_heure_debut and  loc_date_heure_fin ";
		return self::$link->query($sql);
	}

	static function locationPasse($uti_id)
	{
		$sql = "select * from locations,utilisateur, categorie , vehicule, agence where uti_id=loc_client and loc_client=$uti_id and loc_categorie=cat_id and loc_vehicule=veh_id and veh_agence=age_id and loc_date_heure_fin<now() ";
		return self::$link->query($sql);
	}

	static function locationByAgeByStatut($age_id)
	{
		$sql = "select *
			from locations, agence
			where loc_agence_depart=age_id and  loc_agence_depart=$age_id
			order by loc_date_maj";

		return self::$link->query($sql);
	}

	static function listeClient($loc_client){
		return Entity::HTMLselect("select distinct loc_client, uti_username from locations, utilisateur where loc_client=uti_id", "loc_client", "uti_username", $loc_client);
	}

	static function listeGest($loc_gestionnaire){
		return Entity::HTMLselect("select distinct loc_gestionnaire, uti_username from locations, utilisateur where loc_gestionnaire=uti_id", "loc_gestionnaire", "uti_username", $loc_gestionnaire);
	}

	static function listeStatut($loc_statut){
		return Entity::HTMLselect("select distinct loc_statut from locations", "loc_statut", "loc_statut", $loc_statut);
	}

	static function listeType($loc_type){
		return Entity::HTMLselect("select distinct loc_type from locations", "loc_type", "loc_type", $loc_type);
	}

	static function listeAgeDep($loc_agence_depart){
		return Entity::HTMLselect("select distinct loc_agence_depart, age_nom from locations, agence where loc_agence_depart=age_id", "loc_agence_depart", "age_nom", $loc_agence_depart);
	}

	static function listeAgeArr($loc_agence_arrivee){
		return Entity::HTMLselect("select distinct loc_agence_arrivee, age_nom from locations, agence where loc_agence_arrivee=age_id", "loc_agence_arrivee", "age_nom", $loc_agence_arrivee);
	}

	static public function filterBy($filtrer, $id)
	{
		$sql = "select depart.age_id agedepartid, depart.age_nom agedepart, arrivee.age_id agefinid, arrivee.age_nom agefin, gest.uti_username gestionnaire,client.uti_username client,loc_id,loc_date_heure_debut,loc_date_heure_fin,loc_agence_depart,loc_agence_arrivee,loc_statut,loc_client,loc_type,loc_gestionnaire,loc_date_demande,loc_date_maj,loc_vehicule,veh_id,veh_immatriculation,cat_nom, loc_type
		from agence depart,agence arrivee,utilisateur client, utilisateur gest, profil,locations,categorie, vehicule
		where loc_agence_depart=depart.age_id
		and loc_agence_arrivee=arrivee.age_id
		and loc_client=client.uti_id 
		and loc_gestionnaire=gest.uti_id
		and loc_vehicule=veh_id
		and veh_categorie=cat_id and $filtrer='$id'";
		return self::$link->query($sql);
	}
    
    static public function lastLoc_id()
    {
        $sql="SELECT  MAX(loc_id) FROM locations";
       $result=self::$link->query($sql);
        foreach($result as $row ){
        extract($row);
        $lastID=$row["MAX(loc_id)"]; }
    
    return $lastID;
    
    }
    
    
        
    }
