import { fetchPersonnes } from "./lib/personneModule";

const serviceSelect = document.getElementById('service-select');

serviceSelect.addEventListener('change', () => {
    const selectedServiceId = serviceSelect.value;
    if (selectedServiceId) {
        fetchPersonnes(selectedServiceId);
    }
});

fetchPersonnes();