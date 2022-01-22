/* global fetch, URLSearchParams, Jcrop */
const urlParams = new URLSearchParams(window.location.search);
const name = urlParams.get('name');
let url = 'https://informatica.ieszaidinvergeles.org:10007/pia/env/service.php?name=' + name;
fetch(url)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        console.log('Request succeeded with JSON response', data);
        processResponse(data);
    })
    .catch(function(error) {
        console.log('Request failed', error);
    });


let jcrop = Jcrop.attach('imagen', {
    shadeColor: 'black',
    multi: true
});

function processResponse(caras) {
    const imagen = document.getElementById('imagen');
    const width = imagen.width;
    const height = imagen.height;
    let rect;

    for (const cara of caras) {
        if (cara.low < 18) {
            rect = Jcrop.Rect.create(cara.left * width, cara.top * height, cara.width * width, cara.height * height);
            jcrop.newWidget(rect, {});
        }

    }

    function addInput(name, value, form) {
        let element = document.createElement('input');
        element.name = name + '[]';
        element.type = 'hidden';
        element.value = value
        form.appendChild(element);
    }

    let fblur = document.getElementById('fblur');
    fblur.addEventListener('submit', function() {
        for (const crop of jcrop.crops) {
            addInput('x', crop.pos.x, fblur)
            addInput('y', crop.pos.y, fblur)
            addInput('w', crop.pos.w, fblur)
            addInput('h', crop.pos.h, fblur)
        }
    })








}