<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
// try {
$api = __get('/');
$API_nom = $api->name;
$API_descrition = $api->description;
// } catch (\Throwable $th) {
    // echo "error";
	// exit;
// }



?>


<div id="navwrapper">
	<div id="wrapper_navbar" class="wrapper_navbar">

		<nav class="main-navigation">
			<div id="navbar" class="wrapperbox">
				<div id="nav-wrapper_principal" class="flexible_non">
					<span id="span_menu_1">
						<img src="<?= URL_IMG ?>/logo/200/logo_texte_arbre.png" alt="logo">
						<img src="<?= URL_IMG ?>/logo/200/logo_texte_court.png" alt="logo">
					</span>
					<span id="span_menu_2"></span>
					<? require_once DIR_TEMPLATE . "/header/header_menu_primary.php"; ?>
				</div>
				<input type="checkbox" id="navicon-checkbox" class="navicon-checkbox" />
				<label for="navicon-checkbox" class="navicon-label">
					<!--<span class="navicon"></span>-->
					<span class="navicon-box">
						<span class="navicon"></span>
						<span class="navicon"></span>
						<span class="navicon"></span>
					</span>
				</label>
				<div id="nav-wrapper_secondaire" class="navbar_menu">
					<!--id="menu-principal"-->

					<ul>
						<? require_once DIR_TEMPLATE . "/header/header_menu_secondary.php"; ?>
					</ul>
				</div>
			</div>
		</nav>

	</div>
</div>



<!--ON ERNREGISTRE LA TAILLE DE LA FENETRE-->
<div id="div_information" style="height:0px">
	<form name="calcul_fenetre" method="post" action="">
		<input id="largeur_fenetre" name="largeur_fenetre" value="<? echo $_SESSION['X']; ?>" hidden>
		<input id="largeur_fenetre_0" name="largeur_fenetre_0" value="0" hidden>
	</form>
</div>
<div id="wrapper-name" class="wrapperbox wrapper-name fond_multicolor">
	<span class="session-name effet_3d"><?= $API_descrition ?>
		<? //=$_TR['BIENVENUE']
		?>&nbsp;
		<? //=$_SESSION['ogol_ruetasilitu']['USER_PRENOM']; 
		?> !
	</span>
	<?
	if (!empty($_SESSION['session_']['nom_niveau'])) { ?>
		<div class="effet_3d">(<?= ucwords(strtolower($_SESSION['session_']['nom_niveau'])); ?>)</div>
	<? } ?>
</div>
<?
