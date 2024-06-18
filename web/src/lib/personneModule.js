import Handlebars from 'handlebars';
import { URL_API } from './config.js';


document.addEventListener('DOMContentLoaded', () => {
    fetchPersonnes();
});

export async function fetchPersonnes(personnes) {
    try {
        const response = await fetch(URL_API);
        const data = await response.json();
        personnes = data.data.personnes;

        displayPersonnes(personnes);
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
    }
}

function displayPersonnes(personnes) {
    const container = document.getElementById('personnes-container');
    container.innerHTML = '';

    const source = document.getElementById('personne-template').innerHTML;
    const template = Handlebars.compile(source);

    personnes.forEach(personne => {
        const html = template(personne);
        container.innerHTML += html;
    });
}