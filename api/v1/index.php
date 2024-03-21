<?php

/*
+ 1.1. GET /api/v1/notebook/ - view
1.2. POST /api/v1/notebook/ - add
+ 1.3. GET /api/v1/notebook/<id>/ - view id
1.4. POST /api/v1/notebook/<id>/ - update id
1.5. DELETE /api/v1/notebook/<id>/ delete id
*/

include_once(dirname(__FILE__) . "/config.php");
include_once(dirname(__FILE__) . "/1.0.php");
include_once(dirname(__FILE__) . '/classes/notebook.php');

$api = new functions();

///print_r($_SERVER); exit;

//Разбор URL 
$method_temp = explode('/', $_SERVER['REQUEST_URI']);
//print_r($method_temp); exit;
$REQUEST_METHOD = strtolower($_SERVER['REQUEST_METHOD']);

$method = array('', '');
if(count($method_temp) == 6 && (int)$method_temp[array_key_last($method_temp)-1]){
	
	if($REQUEST_METHOD == 'get'){
		$method[0] = $method_temp[array_key_last($method_temp)-2];
		$method[1] = 'view';
		$_REQUEST['id'] = $method_temp[array_key_last($method_temp)-1];
	}
	
	if($REQUEST_METHOD == 'post'){
		$method[0] = $method_temp[array_key_last($method_temp)-2];
		$method[1] = 'update';
		$_REQUEST['id'] = $method_temp[array_key_last($method_temp)-1];
	}	
	
	if($REQUEST_METHOD == 'delete'){
		$method[0] = $method_temp[array_key_last($method_temp)-2];
		$method[1] = 'delete';
		$_REQUEST['id'] = $method_temp[array_key_last($method_temp)-1];
	}	
}

if(count($method_temp) == 5){
	
	if($REQUEST_METHOD == 'get'){
		$method[0] = $method_temp[array_key_last($method_temp)-1];
		$method[1] = 'view';
	}
	
	if($REQUEST_METHOD == 'post'){
		$method[0] = $method_temp[array_key_last($method_temp)-1];
		$method[1] = 'add';
	}	
}

//
// Проверяем существование вызываемого метода
//
if(method_exists($method[0], $method[1])){
	$api = new $method[0]($pdo);
}else{
	$api = new functions($pdo);
	$api->output(array('err_code'=>998, 'text'=>_('Неизвестный метод'), 'type'=>'error'));
	die($api->response);
}

//
// Вызываем методы API после проверки на область видимости метода
//
if(is_callable(array($api, $method[1]))){
	$method = (string)$method[1];
	$api->$method($_REQUEST);
	die($api->response);
	
}else{
	$api->output(array('err_code'=>999, 'text'=>_('Неизвестный метод'), 'type'=>'error'));
	die($api->response);
}
