<?php
class Departement extends Entity {
	public function __construct($id=0) {
		parent::__construct("departement", "dep_id",$id);
	}

	static public function listeDep() {
		$sql="select distinct dep_id,dep_nom,dep_code from departement,agence where age_departement=dep_id  ";
		return self::$link->query($sql);
	}
	static function listeDepartement($dep_id){
		
		return Entity::HTMLselect("select * from departement", "dep_id", "dep_nom", $dep_id);
	}
}
?>
