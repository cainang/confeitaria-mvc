let decrementButton = document.querySelector('#content #desc #bottom #right #decrement');
let incrementButton = document.querySelector('#content #desc #bottom #right #increment');
let andaresIndicator = document.querySelector('#content #desc #bottom #right #controlls p');
let filCompButton = document.querySelector('#content #desc #bottom #right #fil_compra');

decrementButton.onclick = handleDecrement;
incrementButton.onclick = handleIncrement;
filCompButton.onclick = handleFilComp;

function handleDecrement() {
    let andares = parseInt(andaresIndicator.innerText);
    let andaresDecremented = andares - 1;
    if (andaresDecremented == 0) {
        return false;
    }

    andaresIndicator.innerText = andaresDecremented;
    changeDataPrevisao();
}

function handleIncrement() {
    let andares = parseInt(andaresIndicator.innerText);
    let andaresDecremented = andares + 1;
    if (andaresDecremented > 4) {
        return false;
    }
    
    andaresIndicator.innerText = andaresDecremented;
    changeDataPrevisao();
}

function addHandleIngredientes() {
    let ingredientes = document.querySelectorAll('#content #desc #ingredientes #ingCards .ingCard');
    ingredientes.forEach((ingrediente) => {
        ingrediente.onclick = handleIngredientes;
    });
    changeDataPrevisao();
}

function changeDataPrevisao() {
    let tempo = parseInt(document.querySelector('main').getAttribute('data-tempo'));
    let andares = parseInt(andaresIndicator.innerText);
    let tempoPrevisto = Math.floor(tempo + ((andares - 1) * (tempo / (tempo + 2))));
    let date = new Date();

    let dateSpan = document.querySelector('#content #desc #bottom #left #data span');

    date.setTime(date.getTime() + (tempoPrevisto * 24 * 60 * 60 * 1000));

    dateSpan.innerText = date.toLocaleDateString('pt-BR');
}

function handleIngredientes() {
    if(this.getAttribute('data-selected') == 'true') {
        this.setAttribute('data-selected', 'false');
    } else if(this.getAttribute('data-selected') == 'false') {
        this.setAttribute('data-selected', 'true');
    }
}

function handleFilComp() {
    let id_bolo = document.querySelector('main').getAttribute('data-idbolo');
    let data_prevista = document.querySelector('#content #desc #bottom #left #data span').innerText;
    let form = document.querySelector('.modal.endereco #form_modal');

    let ingredientes = [];
    let ingredientesElement = document.querySelectorAll('#content #desc #ingredientes #ingCards .ingCard[data-selected="true"]');
    
    ingredientesElement.forEach((ingrediente) => {
        ingredientes.push(ingrediente.getAttribute('data-ingid'));
    });

    console.log(ingredientes);
    console.log(id_bolo);
    console.log(data_prevista);

    data_prevista = data_prevista.split('/')[2] + '-' + data_prevista.split('/')[1] + '-' + data_prevista.split('/')[0];

    form.setAttribute('action', `?id=${id_bolo}&dataentrega=${data_prevista}&ingredientes=${JSON.stringify(ingredientes)}&andares=${parseInt(andaresIndicator.innerText)}`);

}

addHandleIngredientes();