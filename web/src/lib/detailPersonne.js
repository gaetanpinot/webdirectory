import {URL_API_BASE} from './config';
import Handlebars from "handlebars";

const templatePersonneDetail = Handlebars.compile(
    document.querySelector("#templateDetailPersonne").innerHTML);

async function getDetailPersonne(uri) {
    document.querySelector('#detailPersonne').innerHTML = `<div class="spinner"><img class="spin" src="./img/loading.png"></div>`;

    let urlDetailPersonne = URL_API_BASE + uri;

    fetch(urlDetailPersonne)
    .then( (resp) => resp.json( ))
    .then( (data)=>{ 
        document.querySelector('#detailPersonne').innerHTML
        = templatePersonneDetail(data.data.personne); 
    });
}

export function addEventListnerDetailPersonne() {
    document.querySelectorAll(".personne").forEach((e) => {
        e.addEventListener('click', () =>
            getDetailPersonne(e.querySelector('input').value)
        );
    })
}