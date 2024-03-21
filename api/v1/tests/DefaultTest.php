<?php


include_once(dirname(__FILE__) . "/../config.php");

/**
 * @covers API
 */
class DefaultTest
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Делаем запрос API, возвращаем массив с данными
     *
     * @param $method
     * @param $data
     * @return int|mixed
     */
    public function call($method, $request_method = 'GET', $id = 0, $data=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request_method);

        $uri = "http://". MY_LOCAL_HOST ."/api/v1/". $method ."/" . (($id) ? $id . '/' : '');
        
        if($request_method == 'GET'){
	        $uri .= '?1=1';
	        foreach ($data as $key=>$value) {
	            $uri = $uri."&{$key}={$value}";
	        }
        }
        
        if($request_method == 'POST'){
        	curl_setopt($ch, CURLOPT_POST, TRUE);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        
        //print $uri;

        curl_setopt($ch, CURLOPT_URL, $uri);

        $response = curl_exec($ch);
        //print $response; exit;
        $curl_err = curl_errno($ch);
        curl_close($ch);

        if ($curl_err) return $curl_err;

        $raw = json_decode($response, true);
        if (array_key_exists("response", $raw)) return $raw["response"];
        return $raw;
    }

    /**
     * Запрос к базе данных
     *
     * @param $query
     * @return many
     */
    public function query($query)
    {
        return $this->pdo->query($query);
    }
    
   /**
     * Неизвестный метод
     */
    public function errorMethod()
    {
        return $this->call(null);
    }
         
    public function notebookViewAll($limit = 0)
    {
        return $this->call('notebook', 'GET', 0, array('limit' => $limit));
    }

    public function notebookViewID($id = 0)
    {
        return $this->call('notebook', 'GET', $id);
    }

    public function notebookAdd($params = array())
    {
        return $this->call('notebook', 'POST', 0, $params);
    }

    public function notebookUpdate($id = 0, $params = array())
    {
        return $this->call('notebook', 'POST', $id, $params);
    }
    
    public function notebookDelete($id = 0)
    {
        return $this->call('notebook', 'DELETE', $id);
    }    
}

$test = new DefaultTest($pdo);

print "Error:\n\n";

var_dump($test->errorMethod());

print "\n-----GET /api/v1/notebook/:\n\n";

var_dump($test->notebookViewAll(1));

print "\n-----GET /api/v1/notebook/<id>/:\n\n";

var_dump($test->notebookViewID(1));

print "\n-----POST /api/v1/notebook/:\n\n";

$params = array(
	'name' => 'name'.time(),
	'company' => 'company'.time(),
	'phone' => 'phone'.time(),
	'email' => 'email'.time(),
	'date_birth' => date("Y-m-d", time())
);

var_dump($test->notebookAdd($params));

print "\n-----POST /api/v1/notebook/<id>/:\n\n";

$params = array(
	'name' => 'upd_name'.time(),
	'company' => 'upd_company'.time(),
	'phone' => 'upd_phone'.time(),
	'email' => 'upd_email'.time(),
	'date_birth' => date("Y-m-d", time())
);

var_dump($test->notebookUpdate(1, $params));

print "\n-----DELETE /api/v1/notebook/<id>/:\n\n";

var_dump($test->notebookDelete(2));

?>