const btn = document.getElementById("btn-buscar");

const input = document.getElementById("input-nombre");

const resultado = document.getElementById("resultado");

btn.addEventListener("click", () => {

buscarPokemon(

input.value.trim().toLowerCase()

);

});

async function buscarPokemon(nombre){

if(nombre===""){

return;

}

resultado.innerHTML="<h2>Cargando...</h2>";

try{

const respuesta=await fetch(

`https://pokeapi.co/api/v2/pokemon/${nombre}`

);

if(!respuesta.ok){

throw new Error("Pokémon no encontrado");

}

const pokemon=await respuesta.json();

mostrarPokemon(pokemon);

}catch(error){

resultado.innerHTML=`

<h2>

❌ ${error.message}

</h2>

`;

}

}

function mostrarPokemon(p){

const imagen=p.sprites.other["official-artwork"].front_default;

const tipos=p.types.map(t=>t.type.name).join(" / ");

const stats=p.stats;

resultado.innerHTML=`

<div class="card">

<img src="${imagen}">

<h2>

${p.name.toUpperCase()}

</h2>

<p>

<strong>Tipo:</strong>

${tipos}

</p>

<p>

<strong>Altura:</strong>

${p.height/10} m

</p>

<p>

<strong>Peso:</strong>

${p.weight/10} kg

</p>

<div class="stats">

${stats.map(s=>`

<div>

${s.stat.name.toUpperCase()}<br>

${s.base_stat}

</div>

`).join("")}

</div>

</div>

`;

}