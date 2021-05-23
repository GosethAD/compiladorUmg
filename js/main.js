let analizar = document.getElementById("analizar");

analizar.addEventListener("click", function (e) {
    let codigo = document.getElementById("codigo").value.trim();
    let datos = {
        "codigo": codigo
    }
    postData('http://localhost/compilador/analizar.php', datos)
        .then(data => {
            //agregamos en la tabla de simbolos la lista de tokens encontrados
            var tablaSimbolos = document.getElementById("tablaSimbolos");
            var tablaSimbolosBody = tablaSimbolos.querySelector("tbody");
            var tablaResultado = document.getElementById("tablaResultado");
            var tablaResultadoBody = tablaResultado.querySelector("tbody");
            tablaSimbolosBody.innerHTML = "";
            tablaResultadoBody.innerHTML = "";
            var nuevaFilaToken = "";
            var nuevaFilaError = "";
            contador = 1;
            console.log(data); // JSON data parsed by `data.json()` call

            data.tokens.forEach(function(data) {
                nuevaFilaToken += '<tr>';
                nuevaFilaToken += `<td>${data.tipo}</td>`;
                nuevaFilaToken += `<td>${data.valor}</td>`;
                nuevaFilaToken += '</tr>';
            });
            tablaSimbolosBody.innerHTML = nuevaFilaToken;

            data.errores.forEach(function(data) {
                nuevaFilaToken += '<tr>';
                nuevaFilaError += `<td>${contador}</td>`;
                nuevaFilaError += `<td>${data.linea}</td>`;
                nuevaFilaError += `<td>${data.tipo}</td>`;
                nuevaFilaError += `<td>${data.error}</td>`;
                nuevaFilaError += '</tr>';
                contador ++;
            });
            tablaResultadoBody.innerHTML = nuevaFilaError;
        });
});

async function postData(url = '', data = {}) {
    // Opciones por defecto estan marcadas con un *
    const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}