import { displayPersonnes } from './personneModule.js';

export async function filterByName(name) {
    try {
        const response = await fetch(`/api/personnes?nom=${name}`); 
        const personnes = await response.json();
        displayPersonnes(personnes);
    } catch (error) {
        console.error('Erreur lors de la recherche par nom :', error);
    }
}

export function setupSearchInput() {
    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        filterByName(searchTerm);
    });
}
