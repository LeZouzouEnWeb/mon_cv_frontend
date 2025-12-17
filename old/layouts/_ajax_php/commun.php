<?
ini_set("display_errors", 1);
$urlGet = explode("?",$_SERVER['REQUEST_URI']);
$urlSansLeGet = $urlGet[0];
$dossier =  "/" ; //substr($urlSansLeGet,0,-1);

define('ABSOL', $_SERVER['DOCUMENT_ROOT']. $dossier);
define('DIR_ASSETS', ABSOL . "/assets");
	
// ON OUVRE LES SESSIONS NECESSAIRES
require_once DIR_ASSETS . "/_php_controler/_session.php";