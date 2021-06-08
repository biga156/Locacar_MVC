<?php
class Equiper extends Entity {
	public function __construct($id=0) {
		parent::__construct("equiper", "equ_id",$id);
	}

	static public function listeEquiper()
	{
		$sql = "select * 
		from equiper, locations,options 
		where equ_location=loc_id and equ_option=opt_id order by loc_id";
		return self::$link->query($sql);
	}

	static function listeLoc($equ_location){
		return Entity::HTMLselect("select * from equiper ", "equ_location", "equ_location", $equ_location);
	}	

	static function listeOpt($equ_option){
		return Entity::HTMLselect("select * from options ", "opt_id", "opt_nom", $equ_option);
	}	

}
?>
