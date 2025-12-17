<!-- jQuery first, then Popper.js, then Bootstrap JS-->
<?php
//********REJET ACCES DIRECT********
defined('CORBTECH_SECUR_ROOT_PATH') or die("°_°'");
//**********************************
?>
<script src="<?= JQUERY_GLOBAL ?>/external/jquery/jquery.js"></script>
<script src="<?= JQUERY_GLOBAL ?>/jquery-ui.js"></script>
<!--  TIPSO TOOLTIPS -->
<script src="<?= TIPSO_GLOBAL ?>/tipso.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('form').attr('autocomplete', 'off');
        // Show - Hide Tipso on Click
        jQuery('.show-hide').tipso({
            // background: 'tomato',
            // useTitle: true,
            titleContent: "Important !",
            size: 'defaut',
            position: 'top',
            background: 'rgba(0,0,0,0.8)',
            titleBackground: 'tomato',
            // titleContent: 'Some title',
            useTitle: false,
            tooltipHover: true,
            animationIn: 'swing',
            animationOut: 'bounceOut',
            hideDelay: 0
        })
        var initial;
        $('.show-hide-tipso').hover(function() {
            // le curseur passe sur l'élément
            clearTimeout(initial);
            initial = setTimeout(function() {
                jQuery('.show-hide').tipso('hide');
            }, 5000);
        }, function() {
            // le curseur sort de l'élément
        });
        // jQuery('.show-hide').tipso('hide');
        jQuery('.show-hide-tipso').on('click', function(e) {
            jQuery('.show-hide').tipso('hide');
            // if(jQuery(this).hasClass('clicked')){
            // jQuery(this).removeClass('clicked');
            // jQuery('.show-hide').tipso('hide');
            // } else {
            // jQuery(this).addClass('clicked');
            // jQuery('.show-hide').tipso('show');
            // }
            e.preventDefault();
        });
    });
</script>
<!--================================================== -->
<!--OUVERTURE DU SCRIPT CAPTCHA-->
<? //if ($_CAPTCHA==true) { 
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $clé_site; ?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?= $clé_site; ?>', {
            action: 'contact'
        }).then(function(token) {
            var recaptcha = document.getElementById('recaptcha');
            recaptcha.value = token;
        });
    });
</script>
<? //} 
?>