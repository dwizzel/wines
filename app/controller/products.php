<?php
/*
@auth: dwizzel
@date: 17-01-2018
@info: products controller
*/

class Products {

    private $reg;
    private $model;
    private $menu;
            
	public function __construct(&$reg){
        //registry
        $this->reg = $reg;
        //get the data
        require_once(MODEL_PATH.'products.php');
        $this->model = new ProductsModel($this->reg);    
        require_once(MODEL_PATH.'menu.php');
        $this->menuModel = new MenuModel($this->reg);    
        }

    public function process(&$arrPath){
        //check the method
        switch($this->reg->get('req')->getMethod()){
            case 'POST':
                $this->createOne();        
                break;
            default:
                if(isset($arrPath[1])){
                    if(preg_match('/^[0-9]+/', $arrPath[1])){
                        if(isset($arrPath[2]) && preg_match('/^json$/', $arrPath[2])){
                            $this->showJson($arrPath[1]);
                            break;
                        }
                        $this->showOne($arrPath[1]);        
                        break;    
                    }else if(preg_match('/^new$/', $arrPath[1])){
                        $this->showForm();
                        break;
                    }
                }
                //none of the above
                $this->showAll();
                break;    
        }
    }

    private function showAll(){
        //title and other things
        $data = array(
            'title' => 'Wine List',
            'lang' => 'en'
        );
        //get the products listing
        $data['products'] = $this->model->getAll();
        //the basic path for the click
        $data['path-page'] = $this->reg->get('glob')->getArrValue('path', 'products');
        $data['path-new'] = $this->reg->get('glob')->getArrValue('path', 'product-new');
        //get the top menu
        $data['top-menu'] = $this->menuModel->getTopMenu(); 
        //set the default view
        require_once(VIEW_PATH.'products.php');

    }

    private function showOne($id){
        //title and other things
        $data = array(
            'lang' => 'en'
        );
        //get the product and title
        $data['product'] = $this->model->getOne($id);
        //if exist
        if($data['product'] !== false){
            $data['title'] = $data['product']->row['prodName'];
            //le json path 
            $data['path-json'] = $this->reg->get('glob')->getArrValue('path', 'products').$data['product']->row['prodID'].'/json/';
        }else{
            $data['title'] = "Product don't exist";
        }
        //get the top menu
        $data['top-menu'] = $this->menuModel->getTopMenu(); 
        //set the default view
        require_once(VIEW_PATH.'product.php');

    }

    private function showForm(){
        //title and other things
        $data = array(
            'title' => 'New Product',
            'lang' => 'en'
        );
        //get the top menu
        $data['top-menu'] = $this->menuModel->getTopMenu(); 
        $data['form'] = $this->productForm(); 
        //set the default view
        require_once(VIEW_PATH.'product-form.php');

    }

    private function showJson($id){
        $this->reg->get('resp')->puts($this->model->getOne($id)->row);
        $this->reg->get('resp')->addHeader('Content-Type: application/json; charset=utf-8');
        exit($this->reg->get('resp')->output());
    }

    private function createOne(){
        //the fields to know which are mandatory and type
        $arrFields = $this->productForm()['fields'];
        //the posted form values
        foreach($arrFields as $k=>$v){
            //we will not check type and mandatory and sanitization for now
            $value = $this->reg->get('req')->get($k);
            if($value !== false){
                if($arrFields[$k]['mandatory'] && $value == ''){
                    //todo
                }else{
                    $arrFields[$k]['value'] = $value;
                }
            }else{
                $arrValues[$k]['value'] = '';
            }
        }    
        $rtn = $this->model->createOne($arrFields);
        if($rtn === false){
            //todo problem check why
        }
        //since it's for test we wont check for errors and return directly to the listing
        $this->reg->get('resp')->redirect(
            $this->reg->get('glob')->getArrValue('path', 'products')
        );    
    }

    private function productForm(){
        return array(
            'method' => 'post',
            'path' => $this->reg->get('glob')->getArrValue('path', 'products'),
            'button' => array(
                'text' => 'save',
                'type' => 'submit'
            ),
            'fields' => array(
                'prodName' => array(
                    'label' => 'Name',
                    'value' => '',
                    'type' => 'text',
                    'mandatory' => true
                ),
                'prodColorID' => array(
                    'label' => 'ColorID',
                    'value' => '1',
                    'type' => 'text',
                    'mandatory' => true
                ),
                'prodPack' => array(
                    'label' => 'Pack',
                    'value' => '0',
                    'type' => 'text',
                    'mandatory' => true
                ),
                'prodQtyBuy' => array(
                    'label' => 'QtyBuy',
                    'value' => '0',
                    'type' => 'text',
                    'mandatory' => true
                ),
                'prodSoldOut' => array(
                    'label' => 'SoldOut',
                    'value' => '0',
                    'type' => 'text',
                    'mandatory' => true
                ),
                'prodAvailable' => array(
                    'label' => 'Available',
                    'value' => '0',
                    'type' => 'text',
                    'mandatory' => true
                )
            )
        );
    }

}


//END SCRIPT