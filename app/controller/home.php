<?php
/*
@auth: dwizzel
@date: 17-01-2018
@info: home controller
*/

class Home {

	private $reg;
	private $menu;
            
	public function __construct(&$reg){
        //registry
		$this->reg = $reg;
		require_once(MODEL_PATH.'menu.php');
        $this->menu = new MenuModel($this->reg); 
        }

    public function process(){
        //title and other things
        $data = array(
            'title' => 'Wines Homepage',
            'lang' => 'en',
			'content' => 'blablablabla...',
		);
		//get the top menu
        $data['top-menu'] = $this->menu->getTopMenu(); 
        //set the default view
        require_once(VIEW_PATH.'home.php');
    }

    
}


//END SCRIPT