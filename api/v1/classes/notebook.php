<?

class notebook extends functions{

	private $pdo;

	function __construct($pdo){
		$this->pdo = $pdo;
	}

	function view($params = array()){
		
		if(!functions::check_params($params)) return false;

		$user_id='';
		if(isset($params['id'])) $user_id=" AND id=" . intval($params['id']);

		$limit='';
		if(isset($params['limit'])) $limit=" LIMIT ".$params['limit'];

		$xSQL = "SELECT * FROM users WHERE 1=1 " . $user_id . " ORDER BY id desc" . $limit;
		$pdo = $this->pdo->query($xSQL);
		$result = $pdo->fetchAll(PDO::FETCH_ASSOC); 

		return functions::output(false, $result);
	}

	function add($params = array()){
		
		if(!functions::check_params($params)) return false;

		$xSQL = "INSERT INTO users(`name`, `company`, `phone`, `email`, `date_birth`) VALUES ( '". $params['name'] ."', '". $params['company'] ."', '". $params['phone'] ."', '". $params['email'] ."', '". $params['date_birth'] ."')";
		$this->pdo->query($xSQL);		

		if($id = $this->pdo->lastInsertId()){
			return functions::output(false, array('id'=>$id));
		}else{
			return functions::output(array('err_code'=>4,'text'=>'Произошла ошибка, попробуйте позже!','type'=>'error'));
		}

		return functions::output(false, $result);
	}

	function update($params = array()){
		
		if(!functions::check_params($params,'id')) return false;
		
		if(!functions::check_params($params)) return false;

		$id = $params['id'];
		unset($params['id']);
		
	    foreach ($params as $key => $value) {
	        $parts[] = "`" . $key . "` = '" . $value . "'";
	    }

		$xSQL = "UPDATE users SET ". implode(",", $parts) . " WHERE id=". $id;
		$this->pdo->query($xSQL);

		return functions::output(false, true);
	}

	function delete($params = array()){
		
		if(!functions::check_params($params,'id')) return false;
		
		$id = $params['id'];
		unset($params['id']);
		
		$xSQL = "DELETE FROM users WHERE id=" . $id;
		$this->pdo->query($xSQL);		

		return functions::output(false, true);
	}


function __destruct(){}

}
?>