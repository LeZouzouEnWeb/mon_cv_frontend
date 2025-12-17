function open_wptscribo_options(evt, wptscribo_options, btElement) {
    // console.log(wptscribo_options)
    // MENU ADMIN ONGLET
    let i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("wptscribo__tab--content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    };
    tablinks = document.getElementsByClassName("wptscribo__tab--links");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    };
    document.getElementById('wptscribo__' +
        wptscribo_options).style.display = "block";
    evt.currentTarget.className += " active"; //
    console.log(btElement.dataset.info);
    let value = texte_url(btElement.dataset.info, indice = '-');
    let stateObj = {
        id: "100"
    };
    window.history.pushState(stateObj, "Page " + btElement.dataset.info, "index.php?index=cv&options=" +
        encodeURI(value) + "#cv__onglet");
};

function texte_url(value, indice = '') {
    let result = value.toLowerCase();
    result = result.replace(/\s/g, indice);
    result = result.replace(' ', indice);
    // alert(result)
    return result;
}



// Fonction pour récupérer les données JSON via AJAX et remplir les divs
async function remplirDivs() {
    try {
        const response = await fetch(' ./layout/_ajax_php/cv.ajax.php');
        if (!response.ok) {
            throw new
                Error('Erreur lors de la récupération des données.');
        }
        const data = await response.json();
        // document.getElementById('contenu1').innerHTML = data[1].content || 'Contenu non disponible';
        document.getElementById('contenu2').innerHTML = data[2].content || 'Contenu non disponible';
        document.getElementById('contenu3').innerHTML = data[3].content || 'Contenu non disponible';
        document.getElementById('contenu4').innerHTML = data[4].content || 'Contenu non disponible';
        document.getElementById('contenu5').innerHTML = data[5].content || 'Contenu non disponible';
        document.getElementById('contenu6').innerHTML = data[6].content || 'Contenu non disponible';
        document.getElementById('contenu7').innerHTML = data[7].content || 'Contenu non disponible';
        document.getElementById('contenu8').innerHTML = data[8].content || 'Contenu non disponible';

        document.getElementById('loader').style.display = "none";
        // ... remplir les
        // autres divs ici...
    } catch (error) {
        console.error(error);
    }
} // Appeler la fonction au chargement de la page
remplirDivs();