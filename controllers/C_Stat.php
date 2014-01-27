<?php
class C_Stat extends C_Base{
    private $data;

    function __construct(){
    	parent::__construct();
    }

    protected function OnInput(){
		parent::OnInput();
        $model = new Main(sPDO::getConnection());
        $this->data = $model->getStat();
    }

    protected function OnOutput(){
    	echo $this->data;
    }
}