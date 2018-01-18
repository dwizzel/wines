<?php
/*
@auth:	dwizzel
@date:	17-01-2018
@info:	routing object
*/

class Routes{

    private $reg;

    public function __construct(&$reg){
        $this->reg = $reg;
    }

    public function route(){
        //we'll get the path from the request object
        $arrPath = explode('/', $this->reg->get('req')->get('path'));
        //minor check
        if(count($arrPath) >= 1){
            switch($arrPath[0]){
                case 'products':
                    require_once(CONTROLLER_PATH.'products.php');
                    $oCtrl = new Products($this->reg);
                    $oCtrl->process($arrPath);
                    break;
                default:
                    require_once(CONTROLLER_PATH.'home.php');
                    $oCtrl = new Home($this->reg);
                    $oCtrl->process();
                    break;
            }
        }else{
            //not suppose to, redirect to homepage
            $this->reg->get('resp')->redirect(
                $this->reg->get('glob')->getArrValue('path', 'home')
            );
        }        
    }

}

//END SCRIPT