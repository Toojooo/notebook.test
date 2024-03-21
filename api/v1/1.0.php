<?php

class functions{
	
	public $input, $response;

	public function __construct(){
	}

//
// Выводит данные в json
// Если сообщение из БД ошибка, то возвращает false
//
	function output()
	{
		@list($msg,$data) = func_get_args();

		if(!is_array($msg))
		{
			if(empty($data)) $msg=array('err_code'=>4,'text'=>_('Нет данных'),'type'=>'notice');
			else $msg=array('err_code'=>0,'text'=>'OK','type'=>'message');
		}

		if(!$this->input) $this->input=&$_REQUEST;

		$response = '{"response":{';
		$response .= '"msg":'.json_encode($msg);
		$response .= ',"data":'.json_encode($data);
		$response .= '}}';

		$this->response = &$response;
		unset($this->input);

		if($msg['type']=='message') return true;
		else return false;
	}

	protected function check_params(){
		$params = func_get_args();
		$args = array_shift($params);
		$this->input = &$args;
		foreach($params as $param){
			if(!isset($args[$param]) OR $args[$param]===''){
				return $this->output(array('err_code'=>3,'text'=>_('Заданы не все необходимые параметры'),'type'=>'error'));
			}
		}

		return true;
	}
}

?>
