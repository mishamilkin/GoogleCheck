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
			$path = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&start=1&q=site:";
            $res = json_decode($response, true);
			$data = array();
            if( !empty($res['responseData']['results'])){
                $data[] = str_replace($path , "", $info['url']);
				$model = new Main(sPDO::getConnection());
				$model->updateData($data);
				unset($model);
            }
        });
		$count = count($res);
        $rc->window_size = $count>100?100:$count;
        foreach ($res as $v) {
            $request = new RollingCurlRequest($this->path.$v['domain']);
            $rc->add($request);
        }
        $rc->execute();
    }

    protected function OnOutput(){
    }
}