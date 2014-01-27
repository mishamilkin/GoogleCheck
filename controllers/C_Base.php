<?php
abstract class C_Base extends Controller{
	private $start_time;
	function __construct(){}
	
	protected function OnInput(){
		$this->start_time = microtime(true);
	}

	protected function OnOutput(){
		$page = $this->content;
        $time = microtime(true) - $this->start_time;
        $page .= "<!-- Время генерации страницы: $time сек.-->";
        echo $page;
	}
}
