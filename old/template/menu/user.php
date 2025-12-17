<!--4-->
<? 
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************fa-bolt
//if (return_crypt($_SESSION['ogol_ruetasilitu']['acces'],60,2)){
?>
<li>
    <a href="javascript:void(0);" onclick="" title="Utilisateurs">
		<div class="flexible_non">
			<div><i class="fa fa-user" aria-hidden="true"></i></div>
			<div>Utilisateurs</div>
			<div><i class="fa fa-caret-down" aria-hidden="true"></i></div>
		</div>
	</a>
	<ul>
<?if (!isset($_SESSION['ogol_ruetasilitu'])){ ?>
		<?
		/*<li>
			<a href="javascript:void(0);" onclick="document.getElementById('id02').style.display='block'" title="Inscription">
				<div class="flexible_non">
					<div><i class="fa fa-id-card-o"></i></div>
					<div>Inscription</div>
				</div>
			</a>
		</li>
		*/
		?>
		<!--<hr>-->
		<li>
			<a href="javascript:void(0);" onclick="document.getElementById('id01').style.display='block'" title="Se connecter">
				<div class="flexible_non">
					<div><i class="fa fa-power-off"  aria-hidden="true" color="green"></i></div>
					<div>Connexion</div>
				</div>
			</a>
		</li>		
<? } else if (isset($_SESSION['ogol_ruetasilitu'])){ ?>
		<li class="nav_title"><?=$_SESSION['session_']['nom_niveau'];?></li>
		<li>
			<a href="javascript:void(0);" onclick="redir('index.php','?cle_exists=<? echo $cle_accept3; ?>&index=user&mode=amendment#navwrapper')" title="Modifier mes informations personnelles">
				<div class="flexible_non">
					<div><i class="fa fa-address-card"></i></div>
					<div>Mon Profil</div>
				</div>
			</a>
		</li>	
		<li>
			<a href="javascript:void(0);" onclick="redir('index.php','?cle_exists=<? echo $cle_accept1; ?>&index=log_user#navwrapper')" title="Journal">
				<div class="flexible_non">
					<div><i class="fa fa-file-text" color="red"></i></div>
					<div>Journal</div>
				</div>
			</a>
		</li>		
		<!--<hr>-->
		<li>
			<a href="javascript:void(0);" onclick="redir('index.php','?cle_exists=<? echo $cle_accept3; ?>&index=deconnexion')" title="Déconnexion">
				<div class="flexible_non">
					<div><i class="fa fa-power-off " color="red"></i></div>
					<div>Déconnexion</div>
				</div>
			</a>
		</li>
			
		
			<? } ?>
	</ul>
</li>
<? //} 