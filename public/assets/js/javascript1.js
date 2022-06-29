
//agrega color pickers
function funcion1() {
    const item = document.querySelector('.addColor');
    const colorsdiv = document.querySelector('.colors');
    let i = 1;

    item.addEventListener('click', function (e) {
        nuevocolor = document.createElement("input")
        nuevocolor.type = "color"
        nuevocolor.setAttribute("id", i + 1)
        colorsdiv.appendChild(nuevocolor)
        i++
    });
}

// guarda todos los colores en un imput hidden
function funcion2() {
    let objColores = []
    let inputcolores = document.querySelector('#imagenes_colores');
    const boton = document.querySelector('#imagenes_submit');
    boton.addEventListener('click', function (e) {
        objColores = []

        const all = document.querySelectorAll("input[type='color']")
        for (let e of all) {
            objColores.push(e.value.slice(1, 7))

        }

        console.log(objColores)
        inputcolores.value = ""
        inputcolores.value = objColores

    });

}


// agrega labels cuando cuambio distancia de color y cuando cambio colores en el picker al buscar .
function funcion3() {

    const distancia = document.querySelector('#buscar_distancia');
    const vdistancia = document.querySelector('#valordistancia');



    distancia.addEventListener('change', function (e) {
        console.log(distancia.value)
        vdistancia.innerHTML=distancia.value
    })

    const buscarcolor = document.querySelector('#buscar_color');
    const vcolor = document.querySelector('#valorcolor');

    buscarcolor.addEventListener('change', function (e) {
      
        vcolor.innerHTML=buscarcolor.value
    })


}



