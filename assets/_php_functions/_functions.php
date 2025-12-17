<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************

// JSON API WORDPRESS
function __get($ressource)
{
    $apiurl = 'https://api-cv.corbisier.fr/wp-json';
    $json = file_get_contents($apiurl . $ressource);
    $result = json_decode($json);
    return $result;
}

// REDIRECTION
function _redir_duree($duree=5){
echo "<div id='compteur_dur' class='message_4'></div> 
<script language='JavaScript'>redirection('compteur_dur','accueil','index.php','{$duree}')</script>";
}

function _redir($red,$para) {
	header("Location:".$red.$para) ;
}

function _redirhtml($red,$para) {
	//echo "URL=".$_SESSION['CONF']['CONFIG_ADRESSE_SITE']ono."/".$red.$para;
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=".$red.$para."\"/>";
}
function _redirscript($red,$para) {
	echo "<script>window.location.href='".$red.$para."';</script>";
}
function _redirhtml_blank($red,$para) {
	//echo "URL=".$_SESSION['CONF']['CONFIG_ADRESSE_SITE']ono."/".$red.$para;
	echo" <meta http-equiv=\"refresh\" content=\"0; URL=".$red.$para."\" target='_blank' />";
}


function _redirstop(){
	unset($_POST);
	_redir("","../access");
	exit;
	
}
//****************************************************
//****************************************************
//****************************************************

?>