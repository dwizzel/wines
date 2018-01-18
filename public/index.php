<?php
/*
@auth: dwizzel
@date: 17-01-2018
@info: main entry file for public access
*/

//basic defined
require_once('define.php');

//basic file required
require_once(CORE_PATH.'registry.php');
require_once(CORE_PATH.'request.php');
require_once(CORE_PATH.'response.php');
require_once(CORE_PATH.'database.php');
require_once(CORE_PATH.'routes.php');
require_once(CORE_PATH.'json.php');
require_once(CORE_PATH.'globals.php');

//instanciate basic registry for passing one global args by ref
$oReg = new Registry();
$oReg->set('db', new Database(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, $oReg));

//minor check on db conn
if(!$oReg->get('db')->getStatus()){
    exit('ERR: NO DB CONNECTION');
    }

//we're set instanciate the rest
$oReg->set('req', new Request());
$oReg->set('resp', new Response(new Json()));
$oReg->set('routes', new Routes($oReg));
$oReg->set('glob', new Globals($oReg));
    
//set all basic routes path to global access ( name => path )
$oReg->get('glob')->set('path', array(
    'home' => '/',
    'products' => '/products/',
    'product-new' => '/products/new/',
    'suppliers' => '/',
    'regions' => '/',
));

//were done 
$oReg->get('routes')->route();

//END SCRIPT