import { fetchPersonnes, filterByService, fetchServices } from "./lib/personneModule";
import { filterByName } from "./lib/searchModule";
import { addSortEventListeners } from "./lib/sortPersonne";
import { addSelectEventListener } from "./lib/personneModule";
import { addSearchEventListener } from "./lib/searchModule";

//init
(function (){
    fetchServices();
    fetchPersonnes();
    addSortEventListeners();
    addSelectEventListener();
    addSearchEventListener();
})();