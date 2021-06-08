<?php
class Options extends Entity {
	public function __construct($id=0) {
		parent::__construct("options", "opt_id",$id);
	}

    
    static public function findOptionsByNom($opt_nom) {
        $sql="select * from options where opt_nom='$opt_nom'";
       $result=self::$link->query($sql);
               foreach($result as $row ){
               extract($row);
            $optID=$row["opt_id"]; }
        return $optID;
    }

    }
  
