<?php
abstract class Controller{

	function __construct(){}

	public function Request()
	{
		$this->OnInput();
		$this->OnOutput();
	}
	
	protected function OnInput(){}
	protected function OnOutput(){}

	protected function View($fileName, $vars = array()){
		foreach ($vars as $k => $v) 
		$$k = $v;
	
		ob_start(); 
		include(Config::PATH."/".$fileName);
		return ob_get_clean(); 	
	}	
}
