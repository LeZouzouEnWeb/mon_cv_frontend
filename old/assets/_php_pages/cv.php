<?
//********REJET ACCÈS DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
// require($_SESSION['url']['controler'] . '/captcha.php');

?>
<div class="wrapper">
<div id="loader">
    <span class="loader"></span>
</div>
    <?php

    $experienceBt =
        $formationsBt =
        $expertiseBt =
        $softskillsBt =
        $polyvalenceBt = "";
    $experience =
        $formations =
        $expertise =
        $polyvalence =
        $softskills = "none";
    $l = $_GET['options'] ?? '';
    if ($l === "expertise") {
        $expertiseBt = "active";
        $expertise = "block";
    } elseif ($l === "polyvalence") {
        $polyvalenceBt = "active";
        $polyvalence = "block";
    } elseif ($l === "softskills") {
        $softskillsBt = "active";
        $softskills = "block";
    } elseif ($l === "formations") {
        $formationsBt = "active";
        $formations = "block";
    } else {
        $experienceBt = "active";
        $experience = "block";
    }


    $chgt = "<span class='loading'>Chargement en cours ...&nbsp;&nbsp;&nbsp;</span><span class='loader'></span>";
    $chgt2 = "<span class='loader2'></span>";
    ?>
    <br />
    <div>
        <div id="" class="cv font-sans">
            <? //= $chgt
            ?>
            <div class='cv_entete flex'>
                <div class='cv_img'>
                    <img decoding='async' width='796' height='1024' src='https://corbisier.fr/_fonc/_img/photo_cv.jpg'
                        class='attachment-large size-large wp-image-12' alt='' loading='lazy'>
                </div>

                <div class='flex flex-1'>
                    <div class='w-full grid grid-cols-2 gap-2 p-4'>
                        <div class='space-y-2'>
                            <span class='cv--name font-bold text-7xl'>Eric Corbisier</span>
                            <div class='space-y-1 p-2 border-2  hover:cursor-pointer border-transparent'>
                                <div class='font-bold uppercase'>Métier, poste</div>
                                <div>Développeur Web</div>
                            </div>
                            <div class='space-y-1 p-2 border-2  hover:cursor-pointer border-transparent'>
                                <div class='font-bold uppercase'>Description</div>
                                <div>
                                    <p class='whitespace-pre-line'>Fort de 30 ans de passion dans le développement, je
                                        souhaite en faire mon métier</p>
                                </div>
                            </div>
                        </div>
                        <div class='space-y-2'>
                            <!-- <div class='space-y-1 p-2 border-2  hover:cursor-pointer border-transparent'>
                                <div class='font-bold uppercase'>Formation</div>
                                <div>
                                    <ul class='space-y-1'>
                                        <li class='break-words'>Bac Pro Équipement Installation Électrique, 1997,
                                            Aubergenville</li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class='grid grid-cols-2 gap-2'>
                                <div class='space-y-1 p-2 border-2  hover:cursor-pointer border-transparent'>
                                    <div class='font-bold uppercase'>Mes Sites Web</div>
                                    <div>
                                        <p class='whitespace-pre-line'><a href='https://lescorbycats.fr'
                                                class='hover:underline' target='_blank'>lescorbycats.fr</a>
                                            <a href='https://corbisier.fr' class='hover:underline'
                                                target='_blank'>corbisier.fr</a>
                                        </p>
                                    </div>
                                </div>
                                <div class='space-y-1 p-2 border-2  hover:cursor-pointer border-transparent'>
                                    <div class='font-bold uppercase'>Divers</div>
                                    <div>
                                        <p class='whitespace-pre-line'>Permis B</p>
                                    </div>
                                </div>
                                <div class='space-y-1 p-2 border-2  hover:cursor-pointer border-transparent'>
                                    <div class='font-bold uppercase'>Contact</div>
                                    <div>
                                        <div>
                                            <div><a href='mailto: emploi@corbisier.fr'
                                                    class='hover:underline'>emploi@corbisier.fr</a></div>
                                            <div><a href='tel: 0650469120' class='hover:underline'>0650469120</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-row">
        <div class="w3-col l8">

            <div id="cv__onglet" class="onglet  font-sans">
                <button type="button" class="wptscribo__tab--links <?= $experienceBt ?>" data-info="experience"
                    onclick="open_wptscribo_options(event, '2', this)">Expérience</button>
                <button type="button" class="wptscribo__tab--links <?= $formationsBt ?>" data-info="formations"
                    onclick="open_wptscribo_options(event, '3', this)">Formations</button>
                <button type="button" class="wptscribo__tab--links <?= $expertiseBt ?>" data-info="expertise"
                    onclick="open_wptscribo_options(event, '4', this)">Expertise</button>
                <button type="button" class="wptscribo__tab--links <?= $polyvalenceBt ?>" data-info="polyvalence"
                    onclick="open_wptscribo_options(event, '5', this)">Polyvalence</button>
                <button type="button" class="wptscribo__tab--links <?= $softskillsBt ?>" data-info="softskills"
                    onclick="open_wptscribo_options(event, '6', this)">Soft Skills</button>


                <div id="wptscribo__2" class="wptscribo__tab--content wptscribo__tab "
                    style="display: <?= $experience ?>;">
                    <h2 class="noSelection font-bold uppercase">Expériences professionnelles</h2>
                    <div id="contenu2" class="space-y-4"><?= $chgt2 ?></div>
                </div>

                <div id="wptscribo__3" class="wptscribo__tab--content wptscribo__tab "
                    style="display: <?= $formations ?>;">
                    <h2 class="noSelection font-bold uppercase">Formations et Diplômes</h2>
                    <div id="contenu3" class="space-y-4"><?= $chgt2 ?></div>
                </div>

                <div id="wptscribo__4" class="wptscribo__tab--content wptscribo__tab "
                    style="display: <?= $expertise ?>;">
                    <h2 class="noSelection font-bold uppercase">Compétences techniques</h2>
                    <div id="contenu4" class="space-y-4"><?= $chgt2 ?></div>
                </div>

                <div id="wptscribo__5" class="wptscribo__tab--content wptscribo__tab "
                    style="display: <?= $polyvalence ?>;">
                    <h2 class="noSelection font-bold uppercase">Compétences transversales</h2>
                    <div id="contenu5" class="space-y-4"><?= $chgt2 ?></div>
                </div>
                <div id="wptscribo__6" class="wptscribo__tab--content wptscribo__tab "
                    style="display: <?= $softskills ?>;">
                    <h2 class="noSelection font-bold uppercase">Compétences Comportementale</h2>
                    <div id="contenu6" class="space-y-4"><?= $chgt2 ?></div>
                </div>
            </div>
        </div>



        <div class="w3-container w3-col l4 object">
            <div id="contenu7" class="" style="display: none;"><?= $chgt ?></div>
            <br>
            <div id="contenu8" class="wp-block-file"></div>
        </div>
        <div class="w3-container w3-col l12 object">
            <!-- <object class="wp-block-file__embed" data="https://corbtech.fr/cv/wp-content/uploads/2023/07/cv.pdf" type="application/pdf" aria-label="Contenu embarqué Mon CV.">
                </object> -->
            <iframe class="object" src="https://api-cv.corbisier.fr/wp-content/uploads/2025/02/CV_DW_2024_02_24.pdf"
                width="100%" height="500px">
                <p>Votre navigateur ne prend pas en charge les PDFs. Veuillez télécharger le PDF pour le voir.</p>
            </iframe>
            <br>
            <a href="https://api-cv.corbisier.fr/wp-content/uploads/2025/02/CV_DW_2024_02_24.pdf"
                class="cv--open w3-button w3-btn w3-round-large w3-khaki target=" _blank"">
                Ouvrir
            </a>
            <a href="https://api-cv.corbisier.fr/wp-content/uploads/2025/02/CV_DW_2024_02_24.pdf"
                class="cv--download w3-button w3-btn w3-round-large w3-khaki " download=""
                aria-describedby="wp-block-file--media-f2faccf3-7931-4f94-9be1-039bf987a6ae">
                Télécharger
            </a>
            </p>
        </div>
    </div>
    <div>
        <br>
        <p><b style="margin-left: 20px;">Mis à jour le 24/02/2025</b></p>
        <br>
    </div>

    <br>
</div>

<?