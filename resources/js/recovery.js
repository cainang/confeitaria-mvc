let cadbutton = document.querySelector('#cadastro-hidden');
let novasenha = document.querySelector('#email');
let confirmasenha = document.querySelector('#senha');
console.log(novasenha, confirmasenha);

let valuenovasenha = "";
let valueconfirmasenha = "";

novasenha.onkeypress = (e) => {
    valuenovasenha = e.target.value;

    if (valuenovasenha != valueconfirmasenha) {
        confirmasenha.style.border = '1px solid red';
    } else {
        confirmasenha.style.border = 'none';
    }
}

confirmasenha.onkeypress = (e) => {
    valueconfirmasenha = e.target.value;
    if (valuenovasenha != valueconfirmasenha) {
        confirmasenha.style.border = '1px solid red';
    } else {
        confirmasenha.style.border = 'none';
    }
}

cadbutton.onclick = () => {
    let url = window.location.protocol + '//';

    let urlArray = window.location.href.split('?')[0].split('/');
    urlArray.shift();
    urlArray.shift();

    urlArray.forEach((term, index) => {
        url += (index < urlArray.length - 1 ? term : 'login') + (index < urlArray.length - 1 ? '/' : '');
    })
    window.location.href = url;
}