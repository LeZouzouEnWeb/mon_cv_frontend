<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
?>


<a href="javascript:void(0);" onclick="redir('index.php','?index=accueil')" title="Accueil"><img
        src="https://corbisier.fr/images/icone/home_b.png"></a>

<a href="javascript:void(0);" onclick="redir('index.php','?cle_exists=<?= $cle_accept3; ?>&index=contact')"
    title="Contact"><img src="https://corbisier.fr/images/icone/email_b.png"></a>
<?
/*	
			<? if (isset($_SESSION['ogol_ruetasilitu'])){ ?>
<a href="javascript:void(0);" onclick="redir('index.php','?cle_exists=<?=$cle_accept3; ?>&index=deconnexion')"
    title="Déconnexion"><img src="https://corbisier.fr/images/icone/off_b.png"></a>

<? }
			if (!isset($_SESSION['ogol_ruetasilitu'])){ ?>
<a href="javascript:void(0);" onclick="document.getElementById('id01').style.display='block'" title="Se connecter"><img
        src="https://corbisier.fr/images/icone/on_b.png"></a>
<? } ?>
*/