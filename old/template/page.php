<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
?>
<!DOCTYPE html>
<html lang="fr" translate="no">

<head>
    <?
    if ($_GET['cron'] != "vilondre290oloneux96HY549") {
        require_once DIR_TEMPLATE  . '/head/head.php';
        require_once DIR_TEMPLATE  . '/head/_head_icon.php';
        require_once DIR_TEMPLATE  . '/head/_head_css.php';
        require_once DIR_TEMPLATE  . '/head/_head_js.php';
    }
    ?>
</head>

<body class="body_class">
    <img src="" id="fondecran" class="fondecran">
    <div id="cercle"></div>
    <header class="wrapperbox">
        <?
        // _AFFICHAGE("En raison d'une panne serveur, le site est en reconstruction !", "spp")
        if ($_GET['cron'] != "vilondre290oloneux96HY549") {
            require_once DIR_TEMPLATE  .  "/header/header_logo.php";
        }
        ?>
    </header>
    <?
    require_once DIR_TEMPLATE  .  "/header/header_menu.php";
    ?>
    <div class="wrapperbox">
        <? //=$content_boite
        ?>
        <? //=$content_message
        ?>

        <div class="div_body">
            <?= $content ?>
        </div>
        <div>

        </div>
        <?
        _AFFICHAGE("footer");
        ?>
        <?

        require_once DIR_TEMPLATE  . '/footer/_footer_js.php';
        // _AFFICHAGE("Bon re-test")
        ?>
    </div>
</body>

</html>