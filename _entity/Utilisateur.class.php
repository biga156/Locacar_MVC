<?php
class Utilisateur extends Entity {
	public function __construct($id=0) {
		parent::__construct("utilisateur", "uti_id",$id);
	}

	static public function findUserByUsername($uti_username) {
		$sql="select * from utilisateur, profil where uti_username='$uti_username' and uti_profil=pro_id ";
		$result=self::$link->query($sql);
		return $result->fetchAll();		
	}

	static public function inscription($row) {
		extract($row);
		$sql="insert into utilisateur values (null,'$uti_nom','$uti_prenom','$uti_mail','$uti_adresse','$uti_username','$uti_passw',$uti_profil,$uti_agence)";				
		return self::$link->query($sql);
	}
}
?>
