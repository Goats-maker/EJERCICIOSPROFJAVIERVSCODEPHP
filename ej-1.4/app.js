// =========================
// ARREGLO PRINCIPAL
// =========================

const materias = [];

// =========================
// REFERENCIAS DEL DOM
// =========================

const form = document.getElementById("form-materia");
const tbody = document.querySelector("tbody");
const resultado = document.getElementById("resultado");
const estado = document.getElementById("estado");

// =========================
// EVENTO DEL FORMULARIO
// =========================

form.addEventListener("submit", function (e) {

    e.preventDefault();

    const datos = new FormData(form);

    agregarMateria(

        datos.get("nombre"),

        parseFloat(datos.get("nota")),

        parseFloat(datos.get("peso"))

    );

});

// =========================
// AGREGAR MATERIA
// =========================

function agregarMateria(nombre, nota, peso) {

    if (nota < 0 || nota > 10) {

        alert("La nota debe estar entre 0 y 10.");

        return;

    }

    let sumaPesos = materias.reduce((suma, m) => suma + m.peso, 0);

    if (sumaPesos + peso > 100) {

        alert("La suma de los porcentajes no puede ser mayor a 100%.");

        return;

    }

    materias.push({

        nombre,

        nota,

        peso

    });

    console.log(materias);

    form.reset();

    renderizar();

}

// =========================
// RENDERIZAR TABLA
// =========================

function renderizar() {

    tbody.innerHTML = "";

    materias.forEach((materia, indice) => {

        tbody.innerHTML += `

        <tr>

            <td>${materia.nombre}</td>

            <td>${materia.nota.toFixed(1)}</td>

            <td>${materia.peso}%</td>

            <td>

                <button class="btnEliminar"

                onclick="eliminar(${indice})">

                Eliminar

                </button>

            </td>

        </tr>

        `;

    });

    calcularPromedio();

}

// =========================
// CALCULAR PROMEDIO
// =========================

function calcularPromedio() {

    if (materias.length === 0) {

        resultado.textContent = "0.00";

        estado.textContent = "Sin datos";

        estado.style.color = "black";

        return;

    }

    let sumaNotas = 0;

    let sumaPesos = 0;

    materias.forEach((materia) => {

        sumaNotas += materia.nota * materia.peso;

        sumaPesos += materia.peso;

    });

    let promedio = sumaNotas / sumaPesos;

    resultado.textContent = promedio.toFixed(2);

    if (promedio >= 6) {

        estado.textContent = "✅ APROBADO";

        estado.style.color = "green";

    } else {

        estado.textContent = "❌ REPROBADO";

        estado.style.color = "red";

    }

}

// =========================
// ELIMINAR
// =========================

function eliminar(indice) {

    if (confirm("¿Desea eliminar esta materia?")) {

        materias.splice(indice, 1);

        renderizar();

    }

}