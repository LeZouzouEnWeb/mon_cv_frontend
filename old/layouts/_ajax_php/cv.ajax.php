<?php
session_start();
	define('CORBTECH_SECUR_ROOT_PATH', './');
require_once "commun.php";

// Recherche page ou posts sur corbtech cv
function str_li($num, $fa = "", $ele = "pages")
{
    if ($ele !== "pages" && $ele !== "posts")
        return;
    // return $ele;
    $articl = __get('/wp/v2/' . $ele . '/' . $num);
    $articl =  $articl->content->rendered;
    if (!empty($fa))
        $articl = str_replace("<li>", "<li><i aria-hidden='true' class='fas $fa'></i>&nbsp;", $articl);
    return $articl;
}

$contenus = [
    1 => [],
    2 => ['content' => str_li(128, 'fa-check', 'posts')],
    3 => ['content' => str_li(153, 'fa-check', 'posts')],
    4 => ['content' => str_li(126, 'fa-check', 'posts')],
    5 => ['content' => str_li(121, 'fa-check', 'posts')],
    6 => ['content' => str_li(130, 'fa-check', 'posts')],
    7 => ['content' => str_li(74, 'fa-check', 'posts')],
    8 => ['content' => str_li(134, 'fa-check', 'posts')],
];

// Renvoyer le contenu au format JSON
header('Content-Type: application/json');
echo json_encode($contenus);