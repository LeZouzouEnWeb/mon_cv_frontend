// FONCTION HORLOGE
function date_heure() {
	var date = new Date();
	var heure = ('0' + date.getHours()).slice(-2);
	var minute = ('0' + date.getMinutes()).slice(-2);
	var seconde = ('0' + date.getSeconds()).slice(-2);


	if (window.innerWidth > 380) {
		var options = { weekday: "long", year: "numeric", month: "long", day: "2-digit" };
	} else if (window.innerWidth > 355) {
		var options = { weekday: "short", year: "2-digit", month: "long", day: "2-digit" };
	} else if (window.innerWidth > 320) {
		var options = { weekday: "short", year: "2-digit", month: "short", day: "2-digit" };
	} else {
		var options = "";//{weekday: "narrow", year: "2-digit", month: "short", day: "2-digit"};
	}
	var date_fr = date.toLocaleDateString("fr-FR", options);
	date_fr = Majuscule(date_fr);
	document.getElementById('compteur_jours').innerHTML = date_fr;
	document.getElementById('compteur_heures').innerHTML = "" + heure + ":" + minute + "'" + seconde + '';
	window.setTimeout("date_heure();", 1000);

};

//#####################################################
// ######### TOUTE LES REDIRECTIONS ###################
function redirection(nom_id, nom, fich, typ) {
	nom = nom.replace("'", "_");
	var compteur = document.getElementById(nom_id);
	s = duree;
	if (s >= 0) {
		if (typ == '0') {
			compteur.innerHTML = "Vous serez redirigé vers <a href='#' onclick=\"redir('" + fich + "','')\">" + nom.replace("_", "'") + "</a> dans  " + s + " seconde(s)";
		} else {
			compteur.innerHTML = "Le téléchargement commence dans  " + s + " seconde(s)";
		}
		if (document.getElementById('boite_attente').style.display = 'none') { duree = duree - 1; }

		window.setTimeout("t_red('" + nom_id + "','" + nom + "','" + fich + "','" + typ + "');", 1000);
	} else {
		document.location.href = fich;
		if (typ == '1') {
			duree = 2;
			t_red_dl();
		}
	}
}

// #################################################################
function redir($red, $para) {
	var $adr = $red + $para;
	document.location.href = $adr;
}

// #################################################################
// #################################################################
function redir_news($red, $para) {
	var $adr = $red + $para;
	window.location($adr);
}

// #################################################################
function t_red(nom_id, nom, fich, typ) {
	// typ = 0 : redirection
	// typ = 1 : téléchargement
	nom = nom.replace("'", "_");
	var compteur = document.getElementById(nom_id);
	s = duree;
	if (s >= 1) {
		if (typ == '0') {
			compteur.innerHTML = "Vous serez redirigé vers <b><a href='#' onclick=\"redir('" + fich + "','')\">" + nom.replace("_", "'") + "</a></b> dans <b>" + s + "</b> seconde(s)";
		} else {
			compteur.innerHTML = "Le téléchargement commence dans  <b>" + s + "</b> seconde(s)";
		}
		if (document.getElementById('boite_attente').style.display = 'none') { duree = duree - 1; }

		window.setTimeout("t_red('" + nom_id + "','" + nom + "','" + fich + "','" + typ + "');", 1000);
	} else {
		document.location.href = fich;
		if (typ == '1') {
			duree = 2;
			t_red_dl();
		}
	}
}
// ################################################################# 

function t_red_dl() {
	s = duree;
	if (s >= 0) {
		if (document.getElementById('boite_attente').style.display = 'none') { duree = duree - 1; }
		window.setTimeout("t_red_dl();", 15);
	} else {
		document.location.href = "index.php";
	}

}

// #################################################################
// #################################################################
// TEXTE
function Majuscule(a) { return (a + '').charAt(0).toUpperCase() + a.substr(1); }

//#####################################################
// RECUPER LE $_GET
function $_GET(param) {
	var vars = {};
	window.location.href.replace(location.hash, '').replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function (m, key, value) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if (param) {
		return vars[param] ? vars[param] : null;
	}
	return vars;
}



//#####################################################
// RECUPERE L'URL
function $_adress_URL(a = 1) {
	var url
	url = (a == 1) ? window.location.protocol + "//" + window.location.host + window.location.pathname : window.location.href;
	return url;
}
//console.log($_adress_URL(2));

//#####################################################
// AFFICHE TAILLE ECRAN
var $_GET = $_GET(),
	index = $_GET['index'];
taille_ecran(window.innerWidth, index);

function taille_ecran(taille_largeur, index) {
	// console.log(index);
	if ((taille_largeur != window.innerWidth) && (index == "he")) {
		document.location.reload(true);
	}
	document.getElementById('x_ecran').value = "Taille écran : " + window.innerWidth + " x " + window.innerHeight;
	taille_largeur = window.innerWidth;
	window.setTimeout("taille_ecran(" + taille_largeur + ",'" + index + "');", 2000);
}

//#####################################################
// info bulle
$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

//#####################################################
// LOGO SUR LE MENU
$(document).ready(function () {
	$(window).scroll(function () {
		var bodyRect = document.getElementById('div_information').getBoundingClientRect(),
			elemRect = document.getElementById('navwrapper').getBoundingClientRect(),
			offset = bodyRect.top - elemRect.top;

		if (offset < 50) {
			document.getElementById('span_menu_1').className = "newClass";
			document.getElementById('span_menu_2').className = "newClass";
			document.getElementById('wrapper_navbar').className = "wrapper_navbar newClass";
		}
		if (offset >= 50) {
			document.getElementById('span_menu_1').className = "";
			document.getElementById('span_menu_2').className = "";
			document.getElementById('wrapper_navbar').className = "wrapper_navbar";
		}
		// console.log('Element is ' + offset + ' vertical pixels from <body>');
	});
});

//#####################################################
// Ferme le menu en mode responsive ou le modal
const checked_box = document.getElementById("navicon-checkbox");

// Lorsque le DOM est entièrement chargé
document.addEventListener("DOMContentLoaded", function () {
	let type;
	type = 0;

	const scriboNavSecondaryNav = document.querySelector(".scribo-nav--secondary__nav");
	const naviconLabel = document.querySelector(".navicon__label");
	const body = document.querySelector("body");

	// Lorsque l'utilisateur clique sur ".scribo-nav--secondary__nav"
	scriboNavSecondaryNav.addEventListener("click", function () {
		type = 2; // Mettre le type à 2
	});

	// Lorsque l'utilisateur clique sur ".navicon__label"
	naviconLabel.addEventListener("click", function () {
		type = 2; // Mettre le type à 2
	});

	// Lorsque l'utilisateur clique n'importe où sur la page
	body.addEventListener("click", function () {
		if (!type) {
			checked_box.checked = false; // Décocher la case à cocher
		}
		if (type) {
			type = type - 1; // Diminuer le type de 1
		}
	});
});




//#####################################################
// VERIFICATION FORMULAIRES EN COURS D'ECRITURE

function MajMot(toFirstWord, champ) {
	var texte = champ.value;
	texte = texte.toLowerCase();
	var newText = (toFirstWord == true) ? texte.charAt(0).toUpperCase() : texte.charAt(0);
	for (var i = 0; i < texte.length - 1; i++) {
		if ((texte.charAt(i).match(/\s/) || (texte.charAt(i).match(/-/))) && texte.charAt(i + 1).match(/[a-z]/)) {
			newText += texte.charAt(i + 1).toUpperCase();
		} else {
			newText += texte.charAt(i + 1).toLowerCase();
		}
	}
	champ.value = newText;
}
//#####################################################	
function MajusculeMot(toFirstWord, champ) {
	var texte = champ.value;
	texte = texte.toUpperCase();
	champ.value = texte;
}
//#####################################################	
function MinusculeMot(toFirstWord, champ) {
	var texte = champ.value;
	texte = texte.toLowerCase();
	champ.value = texte;
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
// VERIFIE SI L'ELEMENT A ETE COLLER
function Verifier_colle(champ, event, id, mess = "0") {
	if (mess == "1") {
		document.getElementById('div_mess').style.display = 'block';
		return false;
	}
	return true;
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
// VERIFICATION DES FORMULAIRES
function verifierCar(champ, event) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);
	var caracteres = '';
	caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyz';
	caracteres = caracteres + 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	caracteres = caracteres + '01234567890123456789';
	caracteres = caracteres + '+-*/';
	caracteres = caracteres + '@_-';

	var caracteres_n = '<>;?';

	if (caracteres_n.indexOf(touche) >= 0) {

		return false
	} else {
		return true
	}
	return false;
}
//#####################################################
function verifierCarNom(champ, event, max = 50) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);
	var caracteres = '';
	var caracteres_sp = '';
	caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyzôïîèéçêù';
	caracteres = caracteres + 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	caracteres = caracteres + '0123456789';
	caracteres_sp = caracteres + '-_ ';

	if (((champ.value.length == 0) && (caracteres.indexOf(touche) == -1)) || ((caracteres_sp.indexOf(touche) == -1) || (champ.value.length >= max))) {

		return false
	} else {
		return true
	}
	return false;
}
//#####################################################
function verifierCarInput(champ, event, min = 1, max = 50) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);

	var caracteres = '';
	var caracteres_sp = '';
	caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyzôïîèéçêù';
	caracteres = caracteres + 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	caracteres = caracteres + '0123456789';
	caracteres_sp = caracteres + '-_ \()/\.\'';

	if (((champ.value.length == 0) && (caracteres.indexOf(touche) == -1)) || ((caracteres_sp.indexOf(touche) == -1) || (champ.value.length >= max))) {
		return false
	} else {
		return true
	}
	return false;
}
//#####################################################
function verifierCarLogin(champ, event, max = 16) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);

	var caracteres = '';
	var caracteres_sp = '';

	caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyz';
	caracteres = caracteres + 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	caracteres = caracteres + '01234567890123456789';
	caracteres_sp = caracteres + '-_.';

	if (((champ.value.length == 0) && (caracteres.indexOf(touche) == -1)) || ((caracteres_sp.indexOf(touche) == -1) || (champ.value.length >= max))) {
		return false
	} else {
		return true
	}
	return false;
}
//#####################################################
function verifierCarPWD(champ, event, max = 100) {



}
//#####################################################
function verifierCarTel(champ, event) {
	document.getElementById(champ.name).onpaste = function () {
		if (champ.value.substring(0, 1) !== "+") {
			return false;
		}
	}
	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);

	if (champ.value.length == 0) {
		var caracteres = '+0';
	}
	else {
		var caracteres = '0123456789';
	}
	if ((champ.value.length == 0) || ((champ.value.substring(0, 1) == "0") && (champ.value.length < 10)) || ((champ.value.substring(0, 1) == "+") && (champ.value.length < 12))) {
		if (caracteres.indexOf(touche) == -1) {
			return false
		} else {
			if ((caracteres.indexOf(touche) >= 0) && (champ.value.length == 0)) {
				champ.value = '+33';
				champ.focus();
				return false;
			}
			return true;
		}
	}
	return false;
}
//#####################################################
function verifierCarNdeclient(champ, event) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);
	if (champ.value.length == 0) {
		var caracteres = '12';
	} else {
		var caracteres = '0123456789';
	}
	if (champ.value.length < 7) {
		if (caracteres.indexOf(touche) == -1) {
			return false;
		} else {
			return true;
		}
	}
	return false;
}
//#####################################################
function verifierCarCP(champ, event) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);
	var caracteres_num = '0123456789';
	if ((champ.value.length < 5) && (caracteres_num.indexOf(touche) == -1)) {
		return false;
	} else if (champ.value.length >= 5) {
		return false;
	} else {
		return true;
	}
	return false;
}
//#####################################################
function verifierCarCP_auto(champ, event) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);
	var caracteres_num = '0123456789';
	var caracteres = '';

	caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyzôîïèéçêù';
	caracteres = caracteres + 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	caracteres = caracteres + '01234567890123456789';

	if ((champ.value.length == 0) && (caracteres.indexOf(touche) == -1)) {
		return false;
	} else if ((champ.value.length > 0) && (champ.value.length < 5) && (caracteres_num.indexOf(touche) == -1)) {
		return false;
	} else if (champ.value.length >= 5) {
		return false;
	} else {
		return true;
	}
	return false;
}
//#####################################################
function verifierCarEmail(champ, event, max = 128) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);
	var caracteres = '';
	if (champ.value.length == 0) {
		caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyz';
		caracteres = caracteres + '01234567890123456789';
	}
	else {
		var caracteres = '';
		caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyz';
		caracteres = caracteres + '01234567890123456789';
		//caracteres = caracteres+'+-*/';
		caracteres = caracteres + '@_-.';
	}
	var caracteres_n = '²"()=#{[|^]}¤€$*!:;,?./§%µ\$¤£+°<>\\\'';

	//if(caracteres_n.indexOf(touche) == -1) {
	if ((caracteres.indexOf(touche) == -1) || (champ.value.length >= max)) {
		return false
	} else {
		return true
	}
	return false;
}
//#####################################################
function verifierCarDate(champ, event) {
	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);

	if (champ.value.length == 0) {
		var caracteres = '';
		caracteres = caracteres + '0123';
	} else if (champ.value.length == 3) {
		var caracteres = '';
		caracteres = caracteres + '01';
	} else if ((champ.value.length == 1) || (champ.value.length == 4) || (champ.value.length == 8) || (champ.value.length == 9)) {
		var caracteres = '';
		caracteres = caracteres + '01234567890123456789';
	} else if (champ.value.length == 6) {
		var caracteres = '';
		caracteres = caracteres + '2';
	} else if (champ.value.length == 7) {
		var caracteres = '';
		caracteres = caracteres + '01';
	} else if ((champ.value.length == 2) || (champ.value.length == 5)) {
		var caracteres = '';
		caracteres = caracteres + '/';
	}

	if (champ.value.length >= 10) { return false; }
	if (caracteres.indexOf(touche) == -1) {
		return false
	} else {
		if (champ.value.length == 1) {
			champ.value = champ.value + touche + '/';
			champ.focus();
			return false;
		} else if (champ.value.length == 4) {
			champ.value = champ.value + touche + '/20';
			champ.focus();
			return false;
		}
		return true
	}
	return false;
}
//#####################################################
function verifierCarArea(champ, event) {

	var keyCode = event.which ? event.which : event.keyCode;
	var touche = String.fromCharCode(keyCode);
	if (keyCode == 13) { return true; }
	var caracteres = '';
	caracteres = caracteres + 'abcdefghijklmnopqrstuvwxyz';
	caracteres = caracteres + 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	caracteres = caracteres + '01234567890123456789';
	caracteres = caracteres + '+-*/';
	caracteres = caracteres + '@_-';

	var caracteres_n = '<>;';

	if (caracteres_n.indexOf(touche) >= 0) {

		return false
	} else {
		return true
	}
	return false;
}
//#####################################################
//#####################################################
//#####################################################
// VERIFCATION FORMULAIRE APRES VALIDATION
function nb_car(champ) {
	document.getElementById('nb_caractere').value = champ.value.length;
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//----------------VERIF CARACTERE
function VerifierNom(champ, nom = "Le nom", obligatoire = "1", min = 1, max = 50) {
	//alert('nom');
	max = max - 2;
	if (min > 2) min = min - 2;
	var regex = new RegExp("^[a-zA-Z]{1}[a-zA-Z0-9 -_\.]{" + min + "," + max + "}[a-zA-Z0-9]{1}$", "g");

	if ((champ.value == "") && (obligatoire == "1")) {
		listerreur(champ.name, champ, champ, nom + ' doit être renseigné !', false, 3);
		return false;
	} else if ((!regex.test(champ.value)) && (champ.value != "")) {
		listerreur(champ.name, champ, champ, nom + ' n\'est pas valide !', false, 3);
		return false;
	} else if (champ.value.length == 1) {
		listerreur(champ.name, champ, champ, nom + ' doit être composé de 2 caractère min. !', false, 3);
		return false;
	} else if (champ.value.length > (max + 2)) {
		listerreur(champ.name, champ, champ, nom + ' ne peut être composé que de 50 caractères maxi !', false, 3);
		return false;
	} else {
		listerreur(champ.name, champ, champ, '', true, 3);
	}

	return true;
}
function VerifierInput(champ, nom = "Le champ", obligatoire = "1", min = 1, max = 50) {
	max = max - 2;
	document.getElementById('nb_caractere').value = champ.value.length;
	if (min > 2) min = min - 2;
	var regex = new RegExp("^[a-zA-Z]{1}[a-zA-Z0-9 -\/_()\.]{" + min + "," + max + "}[a-zA-Z0-9-)]{1}$", "g");

	if ((champ.value == "") && (obligatoire == "1")) {
		listerreur(champ.name, champ, champ, nom + ' doit être renseigné !', false, 3);
		return false;
	} else if ((!regex.test(champ.value)) && (champ.value != "")) {
		listerreur(champ.name, champ, champ, nom + ' n\'est pas valide !', false, 3);
		return false;
	} else if (champ.value.length == 1) {
		listerreur(champ.name, champ, champ, nom + ' doit être composé de 2 caractères min. !', false, 3);
		return false;
	} else if (champ.value.length > (max + 2)) {
		listerreur(champ.name, champ, champ, nom + ' ne peut être composé que de 50 caractères maxi !', false, 3);
		return false;
	} else {
		listerreur(champ.name, champ, champ, '', true, 3);
	}

	return true;
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//----------------VERIF CARACTERE
function VerifierLogin(champ, oblige = 1, max = 16) {
	//var regex1 =new RegExp("^[a-zA-Z0-9]{1}$","g");
	// *	0 ou plusieurs répétitions	{0,}
	// +	1 ou plusieurs répétitions	{1,}
	// ?	0 ou 1 répétition	        {,1}
	// .	Absolument n'importe quel charactère
	// \w	[a-zA-Z0-9_]
	// \d	[0-9]
	// \n	Un retour à la ligne
	// \t	Une tabulation
	//	var regex =new RegExp("^[a-zA-Z0-9]{0,8}[\.-_]?[a-zA-Z0-9]{0,8}$","g");
	var regex = new RegExp("^[a-zA-Z]{1,16}[0-9]*([\.@_-]?[a-zA-Z0-9])*$", "g");
	//	var regex =new RegExp("^(?=.*[A-Za-z0-9]$)[A-Za-z\d]{0,19}$","g");
	if ((champ.value == "") && (oblige == '1')) {
		listerreur(champ.name, champ, champ, 'Le login ne peut être vide !', false, 3);
		return false;
	} else if ((champ.value == "") && (oblige == '0')) {
		listerreur(champ.name, champ, champ, '', true, 3);
		return true;
	} else if (!regex.test(champ.value) && (champ.value.length <= 16)) {
		listerreur(champ.name, champ, champ, 'Le login n\'est pas valide !', false, 3);
		return false;
	} else if (champ.value.length < 5) {
		listerreur(champ.name, champ, champ, 'Le login doit être composé de 5 caractères !', false, 3);
		return false;
	} else if (champ.value.length > max) {
		listerreur(champ.name, champ, champ, 'Le login doit être composé de ' + max + ' caractères maxi !', false, 3);
		return false;
	} else {
		listerreur(champ.name, champ, champ, '', true, 3);
	}

	return true;
}


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//----------------VERIF TELEPHONE
function VerifierTel(champ, oblige = '1') {

	var regex = new RegExp("^[+0-9]{1}[0-9]{2,12}$", "g");

	if ((champ.value == "") && (oblige == '1')) {
		listerreur(champ.name, champ, champ, 'Le téléphone doit être renseigné !', false, 3);
		return false;
	} else if ((champ.value == "") && (oblige == '0')) {
		listerreur(champ.name, champ, champ, '', true, 3);
		return true;
	} else if ((!regex.test(champ.value)) && (champ.value != "")) {
		listerreur(champ.name, champ, champ, 'Ce numéro de téléphone est composer de caractère non valide !', false, 3);
		return false;
	} else if (champ.value.length < 12) {
		listerreur(champ.name, champ, champ, 'Le téléphone doit être composé de 13 caractère !', false, 3);
		return false;
	} else {
		listerreur(champ.name, champ, champ, '', true, 3);
	}

	return true;
}

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//----------------VERIF CODE POSTALE
function VerifierCP(champ, oblige = '1') {
	//	//alert('cP');
	var regex = new RegExp("^[0-9]*$", "g");

	if ((champ.value == "") && (oblige == '1')) {
		listerreur(champ.name, champ, champ, 'Le code postal doit être renseigné !', false, 3);
		return false;
	} else if ((champ.value == "") && (oblige == '0')) {
		listerreur(champ.name, champ, champ, '', true, 3);
		return true;
	} else if ((!regex.test(champ.value)) && (champ.value != "")) {
		listerreur(champ.name, champ, champ, 'Ce code postal est composer de caractère non valide !', false, 3);
		return false;
	} else if ((champ.value.length < 5) || (champ.value.length > 5)) {
		listerreur(champ.name, champ, champ, 'Le code postale doit être composé de 5 caractère !', false, 3);
		return false;
	} else {
		listerreur(champ.name, champ, champ, '', true, 3);
	}

	return true;
}

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//----------------VERIF EMAIL
function VerifierMail(champ, oblige = '1') {
	var regex = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	var two = 0;
	if (document.getElementById("num_" + champ.name)) {
		var num_id = document.getElementById("num_" + champ.name);
		two = 1;
	}
	if ((champ.value == "") && (oblige == '1')) {
		if (champ.name == "froigre") {
			listerreur(champ.name, champ, champ, 'Le login sous forme d\'adresse email doit être renseignée !', false, 3);
		} else {
			listerreur(champ.name, champ, champ, 'L\'adresse email doit être renseignée !', false, 3);
		}
		return false;
	} else if ((champ.value == "") && (oblige == '0')) {
		listerreur(champ.name, champ, champ, '', true, 3);
		return true;
	} else if ((!regex.test(champ.value)) && (champ.value != "")) {
		if (champ.name == "froigre") {
			listerreur(champ.name, champ, champ, 'Le login doit être sous forme d\'une adresse email !', false, 3);
		} else {
			listerreur(champ.name, champ, champ, 'L\'email est actuellement non valide !', false, 3);
		}

		return false;
	} else if ((two == 1) && (num_id.value != champ.value)) {
		listerreur(champ.name, champ, champ, 'Les emails doivent être identique !', false, 3);
	} else {

		listerreur(champ.name, champ, champ, '', true, 3);
	}
	return true;
}

// SI MODIF PROFILS EST OUVERT 
function VerifierMail_two(champ, oblige = '1') {
	var regex = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	var name_champ = champ.name.replace('_two', '');
	var champ1 = document.getElementById(name_champ);
	var value_id = document.getElementById("value_" + name_champ);
	var modif_id = document.getElementById("num_" + name_champ);

	if ((champ.value == "") && (oblige == '1')) {
		listerreur(champ1.name, champ, champ, 'L\'adresse email doit être renseignée !', false, 3);
		return false;
	} else if ((champ.value == "") && (oblige == '0')) {
		listerreur(champ1.name, champ, champ, '', true, 3);
		return true;
	} else if ((!regex.test(champ.value)) && (champ.value != "")) {
		listerreur(champ1.name, champ, champ, 'L\'email est actuellement non valide !', false, 3);
		return false;
	} else if (champ1.value != champ.value) {
		listerreur(champ1.name, champ, champ, 'Les emails doivent être identique !', false, 3);
	} else {
		if (champ.value == value_id.value) {
			champ1.value = value_id.value;
			champ.value = "";
			champ1.disabled = true;
			champ.hidden = true;
			modif_id.value = "0";
		}
		listerreur(champ1.name, champ, champ, '', true, 3);
	}
	return true;
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//----------------MOT DE PASSE

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
//****************VERIFIER MOT DE PASSE
// ---------------VERIFIER SI MDP COLLER
function Verifier_onpaste(champ) {
	listerreur(champ.name, champ, champ, 'Cette information ne doit pas être copié/collé !', false, 4);

	return false;
}
//----------------VERIF CARACTERE
function Verifier_Mdp_init(champ, vide = 0) {
	// document.getElementById('errmdp').style.display='none';
	if (champ.value.length > 100) {
		listerreur(champ.name, champ, champ, 'Le mot de passe ne doit pas dépasser 100 caractères !', false, 3);
		return false;
	} else if ((champ.value == "") && (vide == 0)) {
		listerreur(champ.name, champ, champ, 'Le mot de passe ne peut être vide !', false, 3);
		return false;
	} else {
		listerreur(champ.name, champ, champ, '', true, 3);
	}
	return true;
}

function verifier_motdepasse(champ) {

	document.getElementById('msg_erreur_voesdor1').style.display = 'none';
	document.getElementById('passwordStrength').className = 'focus';
	document.getElementById('passwordStrength').style.display = 'none';
	document.getElementById('passwordStrength_ok').style.display = 'none';
	document.getElementById('passwordStrength_id').style.display = 'none';
	//document.getElementById('passwordStrength').innerHTML=champ.name;	
	// Must have capital letter, numbers and lowercase letters
	var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

	// Must have either capitals and lowercase letters or lowercase and numbers
	var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

	// Must be at least 8 characters long
	var okRegex = new RegExp("(?=.{8,}).*", "g");
	var nb_car = 100 - champ.value.length;
	var s;
	s = ((nb_car > -2) && (nb_car < 2)) ? "" : "s";
	document.getElementById('nb_caract_pwd').innerHTML = "Reste " + nb_car + " caractère" + s;
	if (champ.value.length > 100) {
		document.getElementById('passwordStrength').style.display = 'block';
		document.getElementById('passwordStrength_sp').innerHTML = 'Le mot de passe doit comporter maximum 100 caractères.';
		surlignepwd1(champ, true);
		surlignepwd(document.getElementById('voesdor2'))

		return false;
	} else if (okRegex.test(champ.value) === false) {
		// If ok regex doesn't match the password
		document.getElementById('passwordStrength').style.display = 'block';
		document.getElementById('passwordStrength_sp').innerHTML = 'Le mot de passe doit comporter minimum 8 caractères.';
		surlignepwd1(champ, true);
		surlignepwd(document.getElementById('voesdor2'))
		//form.motdepasse.focus();

		return false;
	} else if (strongRegex.test(champ.value)) {
		// If reg ex matches strong password
		document.getElementById('passwordStrength_ok').style.display = 'block';
		document.getElementById('passwordStrength_ok_sp').innerHTML = 'Mot de passe sécurisé';
		surlignepwd1(champ, false);
		surlignepwd(document.getElementById('voesdor2'))
		//form.motdepasse.focus();
	} else if (mediumRegex.test(champ.value)) {
		// If medium password matches the reg ex
		document.getElementById('passwordStrength').style.display = 'block';
		document.getElementById('passwordStrength_sp').innerHTML = 'Rendez votre mot de passe plus fort avec plus de majuscules, plus de chiffres et de caractères spéciaux!';
		surlignepwd1(champ, true);

		return false;
	} else {
		// If password is ok
		document.getElementById('passwordStrength').style.display = 'block';
		document.getElementById('passwordStrength_sp').innerHTML = 'Mot de passe faible, essayez d\'utiliser des chiffres et des majuscules.';
		surlignepwd1(champ, true);
		surlignepwd(document.getElementById('voesdor2'))
		//form.motdepasse.focus();

		return false;
	}
	surlignepwd(document.getElementById('voesdor2'))
	//form.motdepasse.focus();
	return true;
}

//********* SURLIGNE LES MOTS DE PASSE
function surlignepwd(champ) {
	//alert("pwd");
	motdepasse = document.getElementById('voesdor1');
	voesdor2 = document.getElementById('voesdor2');
	surligne(motdepasse, false);
	surligne(voesdor2, false);
	if ((motdepasse.value == "") && (voesdor2.value == "")) {
		surligne(motdepasse, true);
		surligne(voesdor2, true);
		document.getElementById('passwordStrength_id').style.display = 'none';
		document.getElementById('passwordStrength_id_sp').innerHTML = '';
		listerreur('voesdor1', motdepasse, champ, 'Le mot de passe ne peut être vide !', false, 3);
		return false;
	} else if (voesdor2.value !== motdepasse.value) {
		motdepasse.style.backgroundColor = "#F3F781";
		voesdor2.style.backgroundColor = "#fba";
		document.getElementById('passwordStrength_id').style.display = 'none';
		document.getElementById('passwordStrength_id_sp').innerHTML = '';
		listerreur('voesdor1', motdepasse, champ, 'Les mots de passe ne correspondent pas !', false, 3);
		//alert("correspondent");
		return false;
	} else {
		motdepasse.style.backgroundColor = "#FFFFFF";
		voesdor2.style.backgroundColor = "#FFFFFF";
		document.getElementById('passwordStrength_id').style.display = 'block';
		document.getElementById('passwordIdentic_id_sp').innerHTML = 'Mot de passe identique';
		listerreur('voesdor1', motdepasse, champ, '', true, 3);
		return true;
	}

}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
function surlignepwd1(champ, erreur) {
	if (erreur) {
		//champ.setAttribute('style','background: #fba; font-Weight: bold; border: 2px red inset;box-shadow: 6px 6px 6px #EA7C7C; !important');
		champ.setAttribute('style', 'background: #fff; border: 2px red inset;box-shadow: 6px 6px 6px #C8C8C8,-1px -1px 1px #EA7C7C ; !important');
	} else {
		//champ.setAttribute('style','background: #A9F5A9; font-Weight: normal; border: 0px; box-shadow: 6px 6px 6px #C8C8C8,-1px -1px 1px #484747 ; !important')
		champ.setAttribute('style', 'background: #fff; font-Weight: normal; border: 0px; box-shadow: 6px 6px 6px #C8C8C8,-1px -1px 1px #484747 ; !important');
	}
}
////////////////////////////////
function listerreur(champ, form, form2, messag, erreur, test_y) {
	var id_exist = 0;
	if (document.getElementById('msg_erreur_' + champ)) var id_exist = 1;
	if (erreur) {
		if (id_exist == 1) document.getElementById('msg_erreur_' + champ).style.display = 'none';
		if (form !== "") surligne(form, false);
		return true;
	} else {
		if (id_exist == 1) document.getElementById('msg_erreur_' + champ + '_sp').innerHTML = messag;
		if (id_exist == 1) document.getElementById('msg_erreur_' + champ).style.display = 'block';
		if (form !== "") {
			if (form2 !== "") { form2.focus(); }
			surligne(form, true);
		} else {
			document.getElementById(form2.name).focus();
		}
		if (test_y == 0) return false;
		if (test_y == 4) {
			document.activeElement.blur();
			document.getElementById(champ).value = "";
			document.getElementById(champ).focus();
		}
	}
}
///////////////////////////////////
function surligne(champ, erreur) {
	if (erreur) {
		champ.setAttribute('style', 'border-color: #FE0101;  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(254, 1, 1, 0.6); box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(254, 1, 1, 0.6);');
	} else {
		champ.setAttribute('style', '')
	}
}
/////////////////////////////////////
$(document).ready(function () {
	$(".reset").click(function () {
		$("#frm").trigger("reset");
	});
});

//###########################################################
// BOITE DE DIALOGUE
function confirme() {
	if (confirm("Press a button!")) {
		txt = "You pressed OK!";
	} else {
		txt = "You pressed Cancel!";
	}
};

var div_conf_y = document.getElementById('confirm_Yes');
var div_conf_n = document.getElementById('confirm_No');
var span_conf_y = document.getElementById('conf_y');
var span_conf_n = document.getElementById('conf_n');
var id_test = document.getElementById('tps_dialogue');
var dial_type_bt = 0;
var dial_url = 0;

function dialogue(message = "", type_bt = 2, affichage = 1, titre = "Information", id_form = "", validation = 0, img_alert = 0, url = 0, reserver = 0, id_hidden = "", value_hidden = "", temps_total = 5) {
	/* 
	affiche , titre, message, type de bouton, id formulaire, type validation, image alerte, a4 à  a6, reserver, 
	affichage : 1 = oui et 0 = non
	type_bt : bouton = 1 - oui/non  ; 2 - ok ; 3 - ok/Annul
	type validation : 1 - submit ; (valide le formulaire)
	img_alert :  defaut  - info (glyphicon-info-sign) ; 1 - danger (glyphicon-warning-sign) ; 2 - exclamation (glyphicons-exclamation-sign) ; 3 - Stop (glyphicons-ban-circle)
	url = 0 => pas de redirection
	url = 1 => redirection vers accueil
	url = index... => redirection ou souhaité
	id_hidden : si il existe un input hidden pour valider le passage par javascript
	*/
	// INITIALISATION DE LA BOITE

	dial_url = (url == "") ? 0 : url;
	dial_type_bt = type_bt;
	var affich_display = (affichage == 1) ? "block" : "none";
	message = replaceAll("\'", "&apos;", message);
	titre = replaceAll("\'", "&apos;", titre);

	classe_icon = (img_alert == 1) ? "icone_danger" : "icone_info";
	classe_icon = (img_alert == 2) ? "icone_alert" : classe_icon;
	classe_icon = (img_alert == 3) ? "icone_stop" : classe_icon;

	document.getElementById('icone_info').style.display = "none";
	document.getElementById('icone_alert').style.display = "none";
	document.getElementById('icone_danger').style.display = "none";
	document.getElementById('icone_stop').style.display = "none";
	document.getElementById(classe_icon).style.display = "block";

	classe_glyphi = (img_alert == 1) ? "glyphicon-warning-sign " : "glyphicon-info-sign ";
	classe_glyphi = (img_alert == 2) ? "glyphicon-exclamation-sign " : classe_glyphi;
	classe_glyphi = (img_alert == 3) ? "glyphicon-remove-circle " : classe_glyphi;

	document.getElementById('glyphicon').className = "glyphicon " + classe_glyphi + "dialogue_stop";

	// controle.value=0;
	// controle_test.value=0;

	document.getElementById('boite_theme').innerHTML = titre;
	document.getElementById('boite_question').innerHTML = message;

	if (type_bt == "1") { // Oui-Non
		div_conf_y.style.display = "block";
		div_conf_n.style.display = "block";
		span_conf_y.innerHTML = "Oui";
		span_conf_n.innerHTML = "Non";
	} else if (type_bt == "2") { // Ok - Annuler
		div_conf_y.style.display = "block";
		div_conf_n.style.display = "block";
		span_conf_y.innerHTML = "Ok";
		span_conf_n.innerHTML = "Annuler";
	} else if (type_bt == "3") { // Ok
		div_conf_y.style.display = "block";
		div_conf_n.style.display = "none";
		span_conf_y.innerHTML = "Ok";
	};
	console.log("affichage : " + affichage);
	if (affichage == 1) {
		$("#boite_de_dialogue").fadeIn(500);
	} else {
		$("#boite_de_dialogue").fadeOut(200);
	};

	dialogue_time(temps_total);
}

function dialogue_time(temps_total) {
	var vs = "', '";
	var cpt;
	var cpt_s;
	var cpt_v;
	var temps = temps_total * 10;

	cpt = Number(id_test.value) + 1;
	cpt_s = Math.round((temps - cpt) / 10) + 1;
	cpt_v = " (" + cpt_s + ")";
	id_test.value = cpt;

	if (cpt_s > 0) {
		window.setTimeout("dialogue_time('" + temps_total + "')", 100);
		if (dial_type_bt == "1") { // Oui-Non
			span_conf_n.innerHTML = "Non" + cpt_v;
		} else if (dial_type_bt == "2") { // Ok - Annuler
			span_conf_n.innerHTML = "Annuler" + cpt_v;
		} else if (dial_type_bt == "3") { // Ok
			span_conf_y.innerHTML = "Ok" + cpt_v;
		};
	} else {
		id_test.value = 0;
		$("#boite_de_dialogue").fadeOut(200);
	};

}

$(document).ready(function () {
	$("#btn-close").click(function () {
		$("#boite_de_dialogue").fadeOut(200);
	});
	$("#btn-conf_y").click(function () {
		id_test.value = 99999999999999999999999;
		if (dial_type_bt == "1") { // Oui-Non

		} else if (dial_type_bt == "2") { // Ok - Annuler

		} else if (dial_type_bt == "3") { // Ok

		};
		dialogue_close();
	});
	$("#btn-conf_n").click(function () {
		id_test.value = 99999999999999999999999;
		if (dial_type_bt == "1") { // Non

		} else if (dial_type_bt == "2") { // Annuler

		};
		dial_url = 0;
		dialogue_close();
	});
});


function replaceAll(recherche, remplacement, chaineAModifier) {
	var chaine = chaineAModifier.replace("/[.*+?^${}()|[]\]/g", "\$&");
	var re = new RegExp(recherche, 'g');
	return chaine.replace(re, remplacement);
};

function dialogue_close() {
	if (dial_url != 0) {
		if (dial_url == 1) {
			redir('index.php', '');
		} else {
			redir(dial_url, '');
		}
	}
}




function dialogue_ouvert(block, titre, message, bt, annul, id_form, validation, img_alert, url, a5, a6, reserver, id_hidden = "", value_hidden = "", temps_total = 4) {
	// affiche , titre, message, type de bouton, bouton annu, id formulaire, type validation, image alerte, a4 à  a6, reserver, 
	// bouton : 1 - oui/non  ; 2 - ok ; 3 - ok/Annul
	// type validation : 1 - submit ; (valide le formulaire)
	// img_alert :  defaut  - info (glyphicon-info-sign) ; 1 - danger (glyphicon-warning-sign) ; 2 - exclamation (glyphicons-exclamation-sign) ; 3 - Stop (glyphicons-ban-circle)
	// id_hidden : si il existe un input hidden pour valider le passage par javascript
	// url = 0 => pas de redirection
	// url = 1 => redirection vers accueil
	// url = index... => redirection ou souhaité
	url = (url == "") ? 0 : url;

	var affiche = (block == "1") ? "block" : "none";
	var controle = document.getElementById('resultat_dialogue');
	var controle_test = document.getElementById('test_dialogue');
	var compteur;
	var compteur_s;
	var classe_icon;
	var affiche_compteur;
	var id_compteur;
	var temps = temps_total * 10;
	message = replaceAll("\'", "&apos;", message);
	titre = replaceAll("\'", "&apos;", titre);

	compteur = Number(controle_test.value) + 1;
	compteur_s = "(" + (Math.round((temps - compteur) / 10) + 1) + "s)";
	controle_test.value = compteur; //Number(controle_test.value)+1;
	if (compteur == (temps + 6)) {
		dialogue_close(url);
		return false;
	};

	affiche_compteur = "<span>";
	affiche_compteur = affiche_compteur + compteur_s;
	affiche_compteur = affiche_compteur + "</span>";
	id_compteur = 'temps_restant';
	var ext = "";
	ext = (bt == "1") ? "no" : ext;
	ext = (bt == "2") ? "ok" : ext;
	ext = (annul == "1") ? "annul" : ext;
	document.getElementById(id_compteur + "_" + ext).innerHTML = affiche_compteur;
	// document.getElementsByClassName(id_compteur).innerHTML=affiche_compteur;

	if (reserver != '1') {
		classe_icon = (img_alert == 1) ? "icone_danger" : "icone_info";
		classe_icon = (img_alert == 2) ? "icone_alert" : classe_icon;
		classe_icon = (img_alert == 3) ? "icone_stop" : classe_icon;

		document.getElementById('icone_info').style.display = "none";
		document.getElementById('icone_alert').style.display = "none";
		document.getElementById('icone_danger').style.display = "none";
		document.getElementById('icone_stop').style.display = "none";
		document.getElementById(classe_icon).style.display = "block";

		classe_glyphi = (img_alert == 1) ? "glyphicon-warning-sign " : "glyphicon-info-sign ";
		classe_glyphi = (img_alert == 2) ? "glyphicon-exclamation-sign " : classe_glyphi;
		classe_glyphi = (img_alert == 3) ? "glyphicon-remove-circle " : classe_glyphi;

		document.getElementById('glyphicon').className = "glyphicon ";
		document.getElementById('glyphicon').className += classe_glyphi;
		document.getElementById('glyphicon').className += "dialogue_stop";

		controle.value = 0;
		controle_test.value = 0;

		document.getElementById('boite_theme').innerHTML = titre;
		document.getElementById('boite_question').innerHTML = message;
		if (block == 1) {
			$("#boite_de_dialogue").slideDown();
		} else {
			$("#boite_de_dialogue").slideUp();
		};
		if (bt == "1") {
			document.getElementById('confirm_Yes').style.display = "block";
			document.getElementById('confirm_No').style.display = "block";
			document.getElementById('confirm_Ok').style.display = "none";
		} else if (bt == "2") {
			document.getElementById('confirm_Yes').style.display = "none";
			document.getElementById('confirm_No').style.display = "none";
			document.getElementById('confirm_Ok').style.display = "block";
		};
		if (annul == "1") {
			document.getElementById('confirm_Annuler').style.display = "block";
		} else {
			document.getElementById('confirm_Annuler').style.display = "none";
		};
	};

	function replaceAll(recherche, remplacement, chaineAModifier) {
		var chaine = chaineAModifier.replace("/[.*+?^${}()|[]\]/g", "\$&");
		var re = new RegExp(recherche, 'g');
		return chaine.replace(re, remplacement);
	};

	if (controle.value == '0') {
		window.setTimeout("dialogue_ouvert('" + block + "','" + titre + "','" + message + "','" + bt + "','" + annul + "','" + id_form + "','" + validation + "','" + img_alert + "','" + a4 + "','" + a5 + "','" + a6 + "','1','" + id_hidden + "','" + value_hidden + "','" + temps_total + "');", 100);
	} else if (controle.value == '1') {

		if (validation == "1") {
			if (id_hidden != "") document.getElementById(id_hidden).value = value_hidden;
			document.getElementById(id_form).submit();

		};

		dialogue_close(url);

	} else if (controle.value == '2') {
		dialogue_close(url);

	} else if (controle.value == '3') {

		if ((validation == "1") & (annul == "1")) {
			if (id_hidden != "") document.getElementById(id_hidden).value = value_hidden;
			document.getElementById(id_form).submit();

		};
		dialogue_close(url);

	} else if (controle.value == '4') {
		dialogue_close(url);

	} else if (controle.value == '50') {
		dialogue_close(url);

	};
};
