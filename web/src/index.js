import {fetchPersonnes, fetchServices} from "./lib/personneModule";
import {addSearchEventListener} from "./lib/searchModule";
import {addSortEventListeners} from "./lib/sortPersonne";

//init
(function () {
    fetchServices();
    fetchPersonnes();
    addSortEventListeners();
    addSearchEventListener();
})();
