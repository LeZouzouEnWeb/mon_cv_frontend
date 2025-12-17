<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
?>
<div id="logo_nav" class="wrapper">
	<!--AFFICHAGE DES TITRES-->
	<? if ($_GET['index'] == "accueil") { ?>

	<? } ?>
	<div id="Global" class="flexible_non">
		<div id="logo-im">
			<a href="<?= URL ?>"><img src="<?= URL_IMG . "/logo/500/logo_large.png"; ?>" alt="logo"></a>
		</div>

		<div id="logo-info" class="w3-container w3-cell w3-cell-middle w3-cell-center flexible_oui">
			<div class="w3-container w3-cell w3-cell-center flexible_oui">
				<div id="logo-3" class="logo noir text_3d" style="width:100%"><?= TITRE1 ?>
				</div>
				<div id="logo-1" class="logo bleu_fonce text_3d"><?= TITRE2 ?></div>

			</div>
		</div>
	</div>
	<!--AFFICHAGE DE L'HEURE ET JOUR ACTUEL-->
	<div id="Logo_info" class="flexible_oui noImprim">
		<span id="compteur_jours" class="compteur_jours">Lundi 01 Janvier 1901</span>
		<span class="compteur-"> - </span>
		<span id="compteur_heures" class="compteur_heures">00h00:00</span>

	</div>
</div>