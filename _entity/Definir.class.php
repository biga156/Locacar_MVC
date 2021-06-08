<?php
class Definir extends Entity {
	public function __construct($id=0) {
		parent::__construct("definir", "def_id",$id);
	}

	static public function listeAll()
	{
		$sql = "select * 
		from definir, plage_horaire, categorie 
		where def_plage_horaire=plg_id and def_categorie=cat_id order by def_id";
		return self::$link->query($sql);
	}

	
	static function listeCat($def_categorie){
		return Entity::HTMLselect("select * from categorie ", "cat_id", "cat_nom", $def_categorie);
	}	

	static function listePlg($def_plage_horaire){
		return Entity::HTMLselect("select * from plage_horaire ", "plg_id", "plg_id", $def_plage_horaire);
	}	
}
?>
