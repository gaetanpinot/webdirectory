import { fetchPersonnes, filterByService } from "./lib/personneModule";
import { init } from "./lib/personneModule";


const serviceSelect = document.getElementById('service-select');

serviceSelect.addEventListener('change', () => {
    const selectedServiceId = serviceSelect.value;
    if (selectedServiceId) {
        filterByService(selectedServiceId);
    }
});

init();