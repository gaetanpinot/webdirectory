import { fetchPersonnes } from "./lib/personneModule";

serviceSelect.addEventListener('change', () => {
    const selectedServiceId = serviceSelect.value;
    if (selectedServiceId) {
        fetchPersonnes(selectedServiceId);
    }
});

fetchPersonnes();