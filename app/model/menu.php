<?php
/*
@auth: dwizzel
@date: 17-01-2018
@info: menu model
*/

class MenuModel {

    private $reg;
        
	public function __construct(&$reg){
        //registry
        $this->reg = $reg;
        }

    public function getTopMenu(){
        return array(
            'products' => array(
                'text' => 'Wine List',
                'path' => $this->reg->get('glob')->getArrValue('path', 'products')
            ),
            'suppliers' => array(
                'text' => 'Suppliers',
                'path' => $this->reg->get('glob')->getArrValue('path', 'suppliers')
            ),
            'regions' => array(
                'text' => 'Regions',
                'path' => $this->reg->get('glob')->getArrValue('path', 'regions')
            ),
        );
    }

    

}


//END SCRIPT