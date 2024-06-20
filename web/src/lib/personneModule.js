import Handlebars from 'handlebars';
import {URL_API_BASE, URL_API_PERSONNES} from './config.js';
import {addEventListnerDetailPersonne} from "./detailPersonne";
import {setPersonneTrie} from './sortPersonne.js';

// export function addSelectEventListener(){
//     const serviceSelect = document.getElementById('service-select');
//
//     serviceSelect.addEventListener('change', () => {
//         const selectedServiceId = serviceSelect.value;
//         if (selectedServiceId) {
//             filterByService(selectedServiceId);
//         }
//     });
// }

export async function fetchPersonnes() {
    try {
        const response = await fetch(URL_API_PERSONNES);
        const data = await response.json();


        const personnes = data.data.personnes;
        setPersonneTrie(personnes);

        displayPersonnes(personnes);
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
    }
}

export function displayPersonnes(personnesDisp) {
    // console.log(personnesDisp);
    const container = document.getElementById('personnes-list');
    container.innerHTML = '';

    const source = document.getElementById('personne-template').innerHTML;
    const template = Handlebars.compile(source);

    personnesDisp.forEach(personne => {
        const html = template(personne);
        container.innerHTML += html;
    });
    addEventListnerDetailPersonne();
}

// export async function filterByService(serviceId) {
//     try {
//         if(serviceId===-1){
//             await fetchPersonnes();
//             return;
//         }
//
//         const response = await fetch(`${URL_API_BASE}/api/services/${serviceId}/personnes`);
//         const resp = await response.json();
//         const personnes = resp.data.services[0].personnes
//         setPersonneTrie(personnes)
//         displayPersonnes(personnes);
//     } catch (error) {
//         console.error('Error fetching personnes:', error);
//     }
// }

export async function fetchServices() {
    try {
        const response = await fetch(`${URL_API_BASE}/api/services`);
        const services = await response.json();
        addServicesInSelect(services.data.services);
    } catch (error) {
        console.error('Error fetching services:', error);
    }
}

function addServicesInSelect(services) {
    const serviceSelect = document.getElementById('service-select');
    const serviceTemplateSource = document.getElementById('service-template').innerHTML;
    const serviceTemplate = Handlebars.compile(serviceTemplateSource);

    services.unshift({id: -1, libelle: "Not Selected"});
    // console.log(services);

    const html = serviceTemplate({services});
    serviceSelect.innerHTML = html;
}

