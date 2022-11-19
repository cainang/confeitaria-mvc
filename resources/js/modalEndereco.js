let cepField = document.querySelector('#cep');
let bairroField = document.querySelector('#bairro');
let enderecoField = document.querySelector('#endereco');
let finComp = document.querySelector('#fin_comp');

finComp.onclick = () => {
    let form = document.querySelector('.modal.endereco #form_modal');
    let cep = document.querySelector('.modal.endereco #cep').value;
    let bairro = document.querySelector('.modal.endereco #bairro').value;
    let endereco = document.querySelector('.modal.endereco #endereco').value;

    let formAction = form.getAttribute('action');

    form.setAttribute('action', `${formAction}&cep=${cep}&bairro=${bairro}&endereco=${endereco}`);
}

cepField.onblur = async () => {
    if (cepField.value.length == 9) {
        let newvalue = cepField.value.replace('-', '');
        try {
            const dadosPedidos = await fetch(`https://viacep.com.br/ws/${newvalue}/json/`)
                .then(response => response.json())
            
            bairroField.value = dadosPedidos.bairro;
            enderecoField.value = dadosPedidos.logradouro;
            enderecoField.setAttribute('disabled', 'true');
            bairroField.setAttribute('disabled', 'true');
        } catch (error) {
            console.log('Erro de solicitação', err)
            return '';
        }
    }
}

cepField.onkeypress = (e) => {
    let newValue = e.target.value.replace('-', '');
    let left = newValue.substring(0, 5);
    let right = newValue.substring(5, 8);

    if (newValue.length < 5) {
        cepField.value = `${left}`;
    } else {
        cepField.value = `${left}-${right}`;
    }
}