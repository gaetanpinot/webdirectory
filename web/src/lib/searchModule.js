import {URL_API_BASE} from "./config";
import {displayPersonnes} from "./personneModule";
import {setPersonneTrie} from "./sortPersonne";

let searchBar;
let selectService;

export function addSearchEventListener() {
    searchBar = document.querySelector('#search-input');
    searchBar.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            rechercheHandler();
        }
    })
    document.querySelector('#boutonRecherche').addEventListener('click', (e) => {
        rechercheHandler();
    })
    selectService = document.querySelector('#service-select');
}


//recupère les paramètres de recherche, fait la recherche et l'affiche
async function rechercheHandler() {
    // on recupère la valeur de la recherche
    let termeRecherche = searchBar.value;
    // on recupère l'id du service sélléctionné
    let idServiceSelect = selectService.value;

    // console.log(termeRecherche);
    // console.log(idServiceSelect);

    let listePersonnes;
    if (Number(idServiceSelect) === -1) {
        //on fait une recherche de personnes sans specifier le service,
        listePersonnes = await searchName(termeRecherche);
    } else {
        // on fait une recherche de personnes en sepcifiant un service
        listePersonnes = await searchNameAndService(idServiceSelect, termeRecherche);
    }

    displayPersonnes(listePersonnes);
    setPersonneTrie(listePersonnes);
}

async function searchName(nom) {
    try {
        let response = await
            fetch(`${URL_API_BASE}/api/personnes/search?q=${nom}`);
        let data = await response.json();
        let personnes = data.data.personnes;
        return personnes;
    } catch (e) {
        console.error('erreur de fetch des personnes avec nom');
        return ([]);
    }
}

async function searchNameAndService(idService, nom) {
    try {
        let response = await
            fetch(`${URL_API_BASE}/api/services/${idService}/personnes?search-name=${nom}`);
        let data = await response.json();
        let personnes = data.data.services[0].personnes;
        return personnes;
    } catch (e) {
        console.error('erreur de fetch des personnes de service avec nom');
        return ([]);
    }
}

// export async function filterByName(name) {
//     try {
//
//         const response = await fetch(`${URL_API_BASE}/api/personnes`);
//         const data = await response.json();
//         const personnes = data.data.personnes.filter(personne => {
//             return personne.nom.toLowerCase().startsWith(name);
//         });
//         setPersonneTrie(personnes);
//         displayPersonnes(personnes);
//     } catch (error) {
//         console.error('Erreur lors de la recherche par nom :', error);
//     }
// }
