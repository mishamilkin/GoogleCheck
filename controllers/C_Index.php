<?php
class C_Index extends C_Base{
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
    	$this->content = $this->View('index.php', array('data'=>$this->data));
        parent::OnOutput();
    }
}