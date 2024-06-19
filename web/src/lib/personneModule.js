import Handlebars from 'handlebars';
import { URL_API_PERSONNES } from './config.js';
import { URL_API_BASE } from './config.js';
import {addEventListnerDetailPersonne} from "./detailPersonne";

export function addSelectEventListener(){
    const serviceSelect = document.getElementById('service-select');

    serviceSelect.addEventListener('change', () => {
        const selectedServiceId = serviceSelect.value;
        if (selectedServiceId) {
            filterByService(selectedServiceId);
        }
    });
}

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

export function displayPersonnes(personnes) {
    console.log(personnes);
    const container = document.getElementById('personnes-list');
    container.innerHTML = '';

    const source = document.getElementById('personne-template').innerHTML;
    const template = Handlebars.compile(source);

    personnes.forEach(personne => {
        const html = template(personne);
        container.innerHTML += html;
    });
    addEventListnerDetailPersonne();
}

export async function filterByService(serviceId) {
    try {
        console.log(serviceId)
        const response = await fetch(`${URL_API_BASE}/api/services/${serviceId}/personnes`);
        const personnes = await response.json();
        console.log(personnes);
        displayPersonnes(personnes.data.services[0].personnes);
    } catch (error) {
        console.error('Error fetching personnes:', error);
    }
}

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

    const html = serviceTemplate({ services });
    serviceSelect.innerHTML = html;
}

