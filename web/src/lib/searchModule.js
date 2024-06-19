document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        filterByName(searchTerm);
    });
});

async function filterByName(name) {
    try {
        const response = await fetch(`${URL_API_BASE}/api/personnes`);
        const data = await response.json();
        const personnes = data.data.personnes.filter(personne => {
            return personne.nom.toLowerCase().startsWith(name);
        });
        displayPersonnes(personnes);
    } catch (error) {
        console.error('Erreur lors de la recherche par nom :', error);
    }
}
