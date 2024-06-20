import {URL_API_BASE} from './config';
import Handlebars from "handlebars";

const templatePersonneDetail = Handlebars.compile(
    document.querySelector("#templateDetailPersonne").innerHTML);

async function getDetailPersonne(uri) {
    let urlDetailPersonne = URL_API_BASE + uri;
    let response = await fetch(urlDetailPersonne);
    if (response.status === 200) {
        let personne = await response.json();
        document.querySelector('#detailPersonne').innerHTML
            = templatePersonneDetail(personne.data.personne);

    }


}

export function addEventListnerDetailPersonne() {
    document.querySelectorAll(".personne").forEach((e) => {
        e.addEventListener('click', () =>
            getDetailPersonne(e.querySelector('input').value)
        );
    })
}