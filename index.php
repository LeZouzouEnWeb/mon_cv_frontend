<? session_start();
// error_reporting(E_ALL);
ini_set("display_errors", 1);
// ON TEST SI C'EST UN ROBOT
if ($_SESSION['isRobot'] == True) {
	// require('info.php');
	// require($chemin_err . '/err.php');
	exit;
} else {
	// ON VALIDE L'ACCES AUX AUTRE PHP PAR UNE CONSTANTE
	define('CORBTECH_SECUR_ROOT_PATH', './');
	
	
	$dossier =  "/";
	
	
	define('ABSOL', $_SERVER['DOCUMENT_ROOT']. $dossier);
	define('DIR_ASSETS', ABSOL . "/assets");
}

// ON OUVRE LES SESSIONS NECESSAIRES
require_once DIR_ASSETS . "/_php_controler/_session.php";
// OUPS EST UN TOKEN ANTI ROBOT
// $token = $_SESSION['url']['alert'] . "/oups.php";

//  ************************** ON ACTIVE LA PAGE PRINCIPALE
ob_start();
if (($_GET['index'] === "cv")) {
	require_once DIR_PAGES . "/cv.php";
} else {
	unset($_POST);
	_redirscript(URL,"/?index=cv");
	exit;
}
$content = ob_get_clean();
require_once DIR_TEMPLATE . '/page.php';
// phpinfo();