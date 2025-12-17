<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
$nb_fichier = 0;
$absolute_menu = DIR_TEMPLATE . "/menu";
if($dossier = opendir($absolute_menu)) {
	while(false !== ($fichier = readdir($dossier)))
		{
			if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
			{
				$nb_fichier++; // On incrémente le compteur de 1
				//$file    = fopen($absolute_menu.'/'.$fichier, "r" );
				$file    = fopen($absolute_menu.'/'.$fichier, "r" );
				$contents = fgets($file, 7);
				$contents = intval(substr($contents, 4, 2));  // retourne "abcde"
				$name_fichier[$contents]=$absolute_menu.'/'.$fichier;
				fclose($file);
				//echo '<li><a href=$absolute_menu.'/'. $fichier . '">' . $fichier . '</a></li>';
			} // On ferme le if (qui permet de ne pas afficher index.php, etc.)
		 
		} // On termine la boucle

	closedir($dossier);
	ksort($name_fichier);
	foreach($name_fichier as $element)
		{
			include($element); // affichera $prenoms[0], $prenoms[1] etc.
		}
} else {
     echo 'Le dossier n\' a pas pu être ouvert';
}