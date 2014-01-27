<?php
set_include_path(get_include_path().PATH_SEPARATOR.'controllers'.PATH_SEPARATOR.'models');
function __autoload($class){
	require_once $class.'.php';
}
$_GET['c'] = isset($_GET['c'])?$_GET['c']:"index";
switch ($_GET['c']){
    case 'stat':
        $controller = new C_Stat();
        break;
	case 'add':
		$controller = new C_Add();
		break;
    case 'pars':
        $controller = new C_Pars();
        break;
	default:
		$controller = new C_Index();
}
$controller->Request();
