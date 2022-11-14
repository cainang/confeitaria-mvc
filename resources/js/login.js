let cadButton = document.querySelector('#cadastre-se');
let cadButtonResponsive = document.querySelector('#cadastro-hidden');
let container = document.querySelector('#container');
let recoveryButton = document.querySelector('#recuperacao');

cadButton.onclick = handleCadastro;
cadButtonResponsive.onclick = () => changeTo('cadastro', true);
recoveryButton.onclick = handleRecovery;

let content = [
    {
        titulo: 'ENTRAR',
        buttonActionLabel: 'ENTRAR',
        recoveryButton: 'Recuperar Senha',
        aside: {
            titulo: 'SEJA BEM VINDO',
            description: 'AINDA NÃO TEM UMA CONTA?',
            buttonActionLabel: 'CADASTRE-SE',
        }
    },
    {
        titulo: 'CADASTRAR',
        buttonActionLabel: 'CADASTRAR',
        aside: {
            titulo: 'SEJA BEM VINDO',
            description: 'JÁ TEM UMA CONTA?',
            buttonActionLabel: 'ENTRE',
        }
    },
    {
        titulo: 'RECUPERAÇÃO DE SENHA',
        description: 'UM EMAIL DE RECULPERAÇÃO SERÁ ENVIADO PARA',
        buttonActionLabel: 'ENVIAR EMAIL',
        recoveryButton: 'Já Recuperou? Entre na sua conta!',
        aside: {
            titulo: 'TENTE LOGAR NOVAMENTE',
            description: 'ENTRE NA SUA CONTA!',
            buttonActionLabel: 'ENTRE',
        }
    }
]

function toggleContainerContent() {
    let titulo = document.querySelector('#container h1');
    let rightContainerName = document.querySelector('#placeToName'); 
    let form = document.querySelector('form');  
    container = document.querySelector('#container');
    let inputSenha = document.querySelector('#senha');
    let labelSenha = document.querySelector('label[for="senha"]');
    form.onsubmit = () => {};

    inputSenha.style.display = 'inline-block';
    inputSenha.setAttribute('required', 'true');
    labelSenha.style.display = 'inline-block';

    if (document.querySelector('#descriptionRecovery')) {
        document.querySelector('#descriptionRecovery').remove()
    }

    if (container.getAttribute('data-togglelogin') == 'login') {
        changeTo('login');

        recoveryButton.style.display = 'inline-block';
        
        rightContainerName.style.display = 'none';
        form.setAttribute('action', '');
    } else if (container.getAttribute('data-togglelogin') == 'cadastro') {
        changeTo('cadastro');
        
        recoveryButton.style.display = 'none';
        rightContainerName.style.display = 'flex';
        form.setAttribute('action', '?cad');
    } else if (container.getAttribute('data-togglelogin') == 'recovery') {
        inputSenha.style.display = 'none';
        labelSenha.style.display = 'none';
        inputSenha.removeAttribute('required');
        form.setAttribute('action', '?recovery');

        let descriptionRecovery = document.createElement('span');
        descriptionRecovery.innerText = content[2].description;
        descriptionRecovery.id = 'descriptionRecovery';

        titulo.insertAdjacentHTML('afterend', descriptionRecovery.outerHTML);

        recoveryButton.style.display = 'none'

        changeTo('recovery');
        
        rightContainerName.style.display = 'none';
    }
}

function handleCadastro(){
    let leftContainer = document.querySelector('#left');
    let rightContainer = document.querySelector('#right');  

    if (container.getAttribute('data-togglelogin') == 'login') {
        container.setAttribute('data-togglelogin', 'cadastro');

        leftContainer.className = 'onAnimationToCadLeft';
        rightContainer.className = 'onAnimationToCadRight';
    } else if (container.getAttribute('data-togglelogin') == 'cadastro') {
        container.setAttribute('data-togglelogin', 'login');

        leftContainer.className = 'onAnimationToLoginLeft';
        rightContainer.className = 'onAnimationToLoginRight';
    } else if (container.getAttribute('data-togglelogin') == 'recovery') {
        container.setAttribute('data-togglelogin', 'login');
        toggleContainerContent();
    }
    setTimeout(() => {
        toggleContainerContent();
    }, 800);
    
}

function handleRecovery() {
    if (container.getAttribute('data-togglelogin') == 'recovery') {
        container.setAttribute('data-togglelogin', 'login');
    } else if (container.getAttribute('data-togglelogin') == 'login'){
        container.setAttribute('data-togglelogin', 'recovery');
    }
    toggleContainerContent();
}

function changeTo(target, responsive = false) {
    let titulo = document.querySelector('#container h1');
    let buttonAction = document.querySelector('#container #submit');
    let tituloAside = document.querySelector('#container #right h1');
    let descriptionAside = document.querySelector('#container #right span');
    let buttonActionAside = document.querySelector('#container #right button');
    
    let rightNameInput = document.querySelector('#placeToName input');  

    if(target == 'login') {
        titulo.innerHTML = content[0].titulo;
        buttonAction.value = content[0].buttonActionLabel;

        tituloAside.innerHTML = content[0].aside.titulo;
        descriptionAside.innerHTML = content[0].aside.description;
        buttonActionAside.innerHTML = content[0].aside.buttonActionLabel;
        recoveryButton.innerHTML = content[0].recoveryButton;

        cadButtonResponsive.innerHTML = 'CADASTRE-SE';
        container.setAttribute('data-togglelogin', 'login');
        rightNameInput.removeAttribute('required');
        responsive && (cadButtonResponsive.onclick = () => changeTo('cadastro', true));
    } else if(target == 'cadastro') {
        titulo.innerHTML = content[1].titulo;
        buttonAction.value = content[1].buttonActionLabel;
        
        tituloAside.innerHTML = content[1].aside.titulo;
        descriptionAside.innerHTML = content[1].aside.description;
        buttonActionAside.innerHTML = content[1].aside.buttonActionLabel;

        cadButtonResponsive.innerHTML = 'ENTRAR';
        container.setAttribute('data-togglelogin', 'cadastro');
        rightNameInput.setAttribute('required', 'true');
        responsive && (cadButtonResponsive.onclick = () => changeTo('login', true));
    } else if(target == 'recovery') {
        titulo.innerHTML = content[2].titulo;
        buttonAction.value = content[2].buttonActionLabel;

        tituloAside.innerHTML = content[2].aside.titulo;
        descriptionAside.innerHTML = content[2].aside.description;
        buttonActionAside.innerHTML = content[2].aside.buttonActionLabel;
        recoveryButton.innerHTML = content[2].recoveryButton;

        cadButtonResponsive.style.display = 'none';
        rightNameInput.removeAttribute('required');
    }
}

toggleContainerContent();
