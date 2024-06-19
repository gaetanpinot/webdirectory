import { URL_API_BASE } from './config.js';
import { displayPersonnes } from './personneModule.js';
// import Handlebars from 'handlebars';

// const templatePersonneDetail = Handlebars.compile(
//     document.querySelector("#templateDetailPersonne").innerHTML
// );

export async function fetchAndSortPersons(order) {
    try {
        const response = await fetch(`${URL_API_BASE}/api/personnes?sort=nom-${order}`);
        const data = await response.json();
        return data.data.personnes;
    } catch (error) {
        console.error('Erreur lors de la récupération et du tri des personnes :', error);
        return [];
    }
}

export function addSortEventListeners() {
    const sortAscButton = document.getElementById('sort-asc');
    const sortDescButton = document.getElementById('sort-desc');

    sortAscButton.addEventListener('click', async () => {
        try {
            const personnes = await fetchAndSortPersons('asc');
            displayPersonnes(personnes);
        } catch (error) {
            console.error('Erreur lors du tri ascendant :', error);
        }
    });

    sortDescButton.addEventListener('click', async () => {
        try {
            const personnes = await fetchAndSortPersons('desc');
            displayPersonnes(personnes);
        } catch (error) {
            console.error('Erreur lors du tri descendant :', error);
        }
    });
}
