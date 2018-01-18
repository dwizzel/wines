<?php
/*
@auth: dwizzel
@date: 17-01-2018
@info: request object
*/

class Request {
        
	private $arr;
	private $method;
	
	public function __construct(){
		$this->arr = $this->recursiveBuild($_GET, $this->arr);
		$this->arr = $this->recursiveBuild($_POST, $this->arr);	
		$this->method = $_SERVER['REQUEST_METHOD'];
		}

	private function recursiveBuild($postdata, $arr){
		foreach($postdata as $k=>$v){
			if(is_array($v)){
				$arr = recursiveBuildArray($v, $arr);
			}else{
				$arr[$k] = $v;
			}
		}
		return $arr;
	}	

	public function getMethod(){
		return $this->method;		
	}

	public function get($key){
		if(isset($this->arr[$key])){
			return $this->arr[$key];
		}
		return false;		
	}
	
	public function set($key, $value){
		$this->arr[$key] = $value;
	}

}


//END SCRIPT