<?php
/*
@auth: dwizzel
@date: 17-01-2018
@info: products model
*/

class ProductsModel {

    private $reg;
        
	public function __construct(&$reg){
        //registry
        $this->reg = $reg;
        }

    public function getAll(){
        $query = 'SELECT * FROM Products ORDER BY prodId;';
        $arr = $this->reg->get('db')->query($query);
        if($arr === false || !count($arr->rows)){
            return false;
        }
        return $arr->rows;
    }

    public function getOne($id){
        $id = intval($id);
        $query = "SELECT * FROM Products WHERE prodID = $id;";
        $arr = $this->reg->get('db')->query($query);
        if($arr === false || !count($arr->rows)){
            return false;
        }
        return $arr;
    }

    public function createOne($arr){
        $fields = '';
        $values = '';
        foreach($arr as $k=>$v){
            $fields .= '`'.$k.'`,';
            $values .= '"'.$this->reg->get('db')->escape($v['value']).'",';
        }
        $fields = substr($fields, 0, strlen($fields) - 1);
        $values = substr($values, 0, strlen($values) - 1);
        $query = 'INSERT INTO Products ('.$fields.') VALUES ('.$values.')';
        return  $this->reg->get('db')->query($query);
    }

}


//END SCRIPT