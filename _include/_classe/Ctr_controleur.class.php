<?php
//liste des utilisateurs
class Ctr_controleur {
	public $module;
    public $action;
    public $gabarit;
    public $vue;
	
	public function __construct($module, $action, $gabarit="gabarit.php") {
        $this->module = $module;
        $this->action = $action;
        $this->gabarit ="../_include/$gabarit";
        $this->vue = "../_module/{$module}/vue_{$module}_{$action}.php";
    }
}