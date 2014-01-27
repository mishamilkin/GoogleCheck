<?php
class C_Add extends C_Base{
    private $data;
    function __construct(){
    	parent::__construct();
    }
    protected function OnInput(){
		parent::OnInput();
        $file = new SplFileObject('./db/domains.txt');
        $arr = array();
        while (!$file->eof()) {
            $arr[]=trim($file->fgets());
        }
        $model = new Main(sPDO::getConnection());
        $this->data = $model->addStat($arr);
    }

    protected function OnOutput(){
        if($this->data)
            echo "Complet";
    }
}