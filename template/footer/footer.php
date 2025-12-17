<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
$maintenant = new DateTime();
$maintenant = $maintenant->format('Y');
?>
<footer class="noImprim">
    <div class="wrapper">
        <div id="footersmall" class="row-fluid">
            <div id="foot-sec1" class="span3 ">
                © Copyright <?= $maintenant; ?> corbtech.fr - Tous droits réservés. <input id="x_ecran" name="x_ecran" style="background-color:transparent; border:0; color:red">
            </div>
            <div id="foot-sec2" class="span3 ">
                <?
                // list($ville, $lev, $couch, $hl, $Pl, $hs, $Pm) = getSoleil();
                // echo "<div>Le soleil se lève à " . $lev . " et se couche à " . $couch . " sur " . $ville . "</div>";
                // // now try it
                // $ua = getBrowser();
                // echo "<div id='foot-info'><strong class='souligne'>Information</strong></div><div>" .
                //     "<b>Navigateur : </b>" . $ua['name'] . " " . $ua['version_min'] .
                //     "<br><b>OS Ordinateur : </b>" . $produit . " " . $ua['platform'] . " " . $detect->version('Android') .
                //     "<br>" . //$ua['userAgent'].
                //     "<b>Adresse IP : </b>" . $ua['ip'] . $BR;
                // $api_result = api_IP_result($ua['ip']);
                // echo
                // "<b>Opérateur : </b>" . $api_result['organisation'] . "<br>" .
                //     "<b>Pays : </b>" . $api_result['country_name'] . " - <img src='" . $api_result['flagUrl'] . "' alt='drapeau' width='20px'/><br>" .
                //     "<b>Région : </b>" . $api_result['region_name'] . "<br>" .
                //     "<b>Commune : </b>" . $api_result['zip_code'] . " " . $api_result['city'];
                // echo '</div>';
                ?>
                <!--<a href="https://developers.google.com/recaptcha/" target="_blank">
					<img src="<? //=$_SESSION['url']['img_global']; 
                                ?>/recaptcha.png" alt="Recaptcha V3" width="30px"/> Protéger par Recaptcha V3
				</a>-->
                <div id="foot-sec3" class="span3 ">
                    <div class='clignotant' style="text-align: right;">
                        <a href="index.php?index=_tos" id="lnkdfc5e39d">Termes &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

        <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/access/index.php"><img src="blank.gif" width="0.5px" height="0.5px" border="0" alt=""></a>

    </div>
</footer>
<!-- <div id="google_translate_element"></div>

// <script type="text/javascript">
// function googleTranslateElementInit() {
  // new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
// }
// </script>

// <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>    
    // <p>Vous pouvez traduire le contenu de cette page en sélectionnant une
 // langue dans le menu déroulant.</p>-->