import Handlebars from 'handlebars';
import { URL_API_PERSONNES } from './config.js';

export async function fetchPersonnes() {
    try {
        const response = await fetch(URL_API_PERSONNES);
        const data = await response.json();
        const personnes = data.data.personnes;

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

async function filterByService(serviceId) {
    try {
        const response = await fetch(`/api/services/${serviceId}/personnes`, { credentials: 'include' });
        const personnes = await response.json();
        displayPersonnes(personnes);
    } catch (error) {
        console.error('Error fetching personnes:', error);
    }
}

function filterChange() {
    const selectedServices = Array.from(document.querySelectorAll('.service-checkbox:checked')).map(cb => cb.value);
    let filteredEntries = 

    displayEntries(filteredEntries);
}