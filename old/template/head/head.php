<?
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
// GESTION DES COOKIES
if (PHP_VERSION_ID >= 70300) {
  session_set_cookie_params([
    'lifetime' => $cookie_timeout,
    'path' => '/',
    'domain' => $cookie_domain,
    'secure' => $session_secure,
    'httponly' => $cookie_httponly,
    'samesite' => 'Lax'
  ]);
} else {
  session_set_cookie_params(
    $cookie_timeout,
    '/; samesite=Lax',
    $cookie_domain,
    $session_secure,
    $cookie_httponly
  );
}
?>
<!--MAINTIENT DU MENU EN HAUT DE LA PAGE-->
<style>
  .affix {
    top: 0;
    width: 100%;
    z-index: 9999 !important;
    -webkit-transition: all .5s ease-in-out;
    transition: all .5s ease-in-out;
  }

  .affix-top {
    position: static;
    top: -35px;
  }

  .affix+.container-fluid {
    padding-top: 70px;
  }
</style>

<!--CAROUSSEL : STYLE SI PAGE ACCUEIL-->
<? if (preg_match('#accueil#', $_GET['index'])) { ?>
  <style>
    .carousel-inner>.item>img,
    .carousel-inner>.item>a>img {
      width: 70%;
      margin: auto;
    }
  </style>
<? } ?>
<!--GESTION SI JAVASCRIP EST DESACTIVE-->
<noscript>
  <meta http-equiv="refresh" content="0, URL=../nojs.php">
</noscript>
<meta charset="utf-8">
<!--TITRE de la page-->
<title><?= $title ?> | <?= $title1 ?></title>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="imagetoolbar" content="no">
<![endif]-->
<meta name="robots" content="noindex,nofollow">
<meta name="robots" content="noarchive">
<meta name="generator" content="Corbtech.fr">
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="google" content="notranslate">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">