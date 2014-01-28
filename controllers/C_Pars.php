<?php
class C_Pars extends C_Base{
    private $data = array();
    private $path = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&start=1&q=site:";

    function __construct(){
    	parent::__construct();
    }

    protected function OnInput(){
		parent::OnInput();
        $model = new Main(sPDO::getConnection());
        $res = $model->getData();

        $rc = new RollingCurl(function($response, $info, $request){
            $res = json_decode($response, true);
            if( !empty($res['responseData']['results'])){
                $this->data[] = str_replace($this->path , "", $info['url']);
            }
        });
		$count = count($res);
        $rc->window_size = $count>100?100:$count;
        foreach ($res as $v) {
            $request = new RollingCurlRequest($this->path.$v['domain']);
            $rc->add($request);
        }
        $rc->execute();

        if(!empty($this->data)){
            $model->updateData($this->data);
        }
    }

    protected function OnOutput(){
    }
}