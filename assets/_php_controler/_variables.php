<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************

/*  CONSTANTE */
// RACCOURCIS HTML
function _AFFICHAGE($txt="", $t = "p")
{
	
if ($t==='br') echo "<br />";
if ($t==='p') echo "<p>";
if ($t==='spp') echo "<p><span style='font-family:Calibri;'>";
if ($t==='sp') echo "<span style='font-family:Calibri;'>";
if ($t==='pre') echo "<pre>";
print_r($txt);
if ($t==='pre') echo "</pre>";
if ($t==='sp') echo "</span>";
if ($t==='spp') echo "</span></p>";
if ($t==='p') echo "</p>";
}
// ********************************** ARRAY DE BASE
/* ############### SESSION
CONNEXION : $_SESSION[$cle_session]
*/
// A AMELIORER DE MANIERE A AVOIR UNE CLE PAR PC 
define('cle_session', "ksLmdIL65bn0nbaizyAF39lM");
define('cle_cookies', "MliosPb51NVace128pwYU");

// **********************************
// **********************************
// **********************************
// **********************************
// **********************************

$date_time_new = new DateTime();
$date_time_new = $date_time_new->format('Y-m-d H:i:s');

// LETTRE EN FONCTUION DE SON NOMBRE DE REFERENCE
function lettre($nb){
	$l="";
	$alphabet=array('','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$d = floor($nb/27);
	$nb=$nb-(26*$d);
	echo $d. " / ".$nb." - ";
	$l=$alphabet[$d].$alphabet[$nb];
	return $l;
}
// VALEUR DES VARIALBLE ET CONSTANTE

define('TITRE1', "Curriculum");
define('TITRE2', "Vitae");

define('VERSION_STYLE',"1.0.01");

define('DIR_PAGES', DIR_ASSETS . "/_php_pages");
define('DIR_TEMPLATE', ABSOL . "/template");
define('DIR_LAYOUTS', ABSOL . "/layouts");


define('URL', $_SERVER['REQUEST_SCHEME'] . "://" .  $_SERVER['SERVER_NAME'] . $dossier);
define('URL_LAYOUTS', URL . "/layouts");
define('URL_IMG', URL_LAYOUTS . "/_img");
define('URL_ICO', URL_IMG . "/favicon");
// define('', "");

define('FONC_GLOBAL', "../_fonc");
define('FONT_GLOBAL', "../_fonc/_font");
define('PHP_GLOBAL', "../_fonc/_php");
define('CSS_GLOBAL', "https://www.corbisier.fr/_fonc/_css");
define('JS_GLOBAL', "https://www.corbisier.fr/_fonc/_js");
define('IMG_GLOBAL', "https://www.corbisier.fr/_fonc/_img");
define('ICO_GLOBAL', "https://www.corbisier.fr/_fonc/_img/_icone");
define('JQUERY_GLOBAL', "../_fonc/JQUERY");
define('TIPSO_GLOBAL', "../_fonc/TIPSO");
define('GLYPHI_GLOBAL', "../_fonc/GLYPHICONS");



$title = "Corbisier CV";
$title1 = "accueil";
$title1 = ($_GET['index'] === "cv")?"CV":$title1;














