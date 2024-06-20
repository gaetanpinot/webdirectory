import {displayPersonnes} from './personneModule.js';

let personnesTrie = [];

//stock les personnes actuellement affiché sur la page pour pouvoir les trier et les réaffichés
export function setPersonneTrie(personnes) {
    personnesTrie = personnes;
}

function sort(order) {
    if (order === 'asc')
        return personnesTrie.sort((a, b) => b.nom.localeCompare(a.nom));
    return personnesTrie.sort((a, b) => a.nom.localeCompare(b.nom));
}

// async function fetchAndSortPersons(order) {
//     try {
//         const response = await fetch(`${URL_API_BASE}/api/personnes?sort=nom-${order}`);
//         const data = await response.json();
//         return data.data.personnes;
//     } catch (error) {
//         console.error('Erreur lors de la récupération et du tri des personnes :', error);
//         return [];
//     }
// }

export function addSortEventListeners() {
    const sortAscButton = document.getElementById('sort-asc');
    const sortDescButton = document.getElementById('sort-desc');

    sortAscButton.addEventListener('click', async () => {
        try {
            // const personnes = await fetchAndSortPersons('asc');
            const personnes = sort('asc');
            displayPersonnes(personnes);
        } catch (error) {
            console.error('Erreur lors du tri ascendant :', error);
        }
    });

    sortDescButton.addEventListener('click', async () => {
        try {
            // const personnes = await fetchAndSortPersons('desc');
            const personnes = sort('desc');
            displayPersonnes(personnes);
        } catch (error) {
            console.error('Erreur lors du tri descendant :', error);
        }
    });
}
