let botaoUsuario = document.querySelector('.button_usuario');

async function getPedidosJson(){
    try {
        const dadosPedidos = await fetch('http://localhost:8083/confeitaria-mvc/pedidos')
            .then(response => response.json())
        
        return dadosPedidos
    } catch (error) {
        console.log('Erro de solicitação', err)
        return '';
    }
}
async function ListarPedidos(){
    const dados = await getPedidosJson();
    const parser = new DOMParser();
    const HTMLString =
        `
        <div class="card bg-light mb-3">
            <div class="card-header" id="id"></div>
            <div class="card-body">
                <p class="card-text"><small class="text-muted" id="nome"></small></p>
                <p class="card-text" id="desc"></p>
                <p class="card-text" id="cat"></p>
                <h5 class="card-text" id="preco"></h5>
            </div>
            <div class="card-footer text-muted">
                <p class="card-text" id="data"></p>
            </div>
        </div>
        `;
    const HTMLBlock = parser.parseFromString(HTMLString, 'text/html');
    const HTMLContainer = document.querySelector(".modal .modal-body .cardsScroll");

    console.log(HTMLBlock);
    for (const key in dados) {
        if (Object.hasOwnProperty.call(dados, key)) {
            const element = dados[key];
            HTMLBlock.body.querySelector(".card-header#id").innerHTML = 'ID do pedido: ' + element.id;
            HTMLBlock.body.querySelector(".card-body #desc").innerHTML = 'Descrição: ' + element.descricao;
            HTMLBlock.body.querySelector(".card-body #nome").innerHTML = 'Nome do bolo: ' + element.nomedobolo;
            HTMLBlock.body.querySelector(".card-body #cat").innerHTML = 'Categoria: ' + element.categoria;
            HTMLBlock.body.querySelector(".card-body #preco").innerHTML = 'Preço: ' + element.preco;
            HTMLBlock.body.querySelector(".card-footer #data").innerHTML = 'Data de entrega: ' + element.datadeentrega;

            HTMLContainer.innerHTML += HTMLBlock.body.innerHTML;
        }
    }
}

botaoUsuario.addEventListener("click", ListarPedidos);