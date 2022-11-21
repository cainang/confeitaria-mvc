function activateModalUser() {
  let botaoUsuario = document.querySelector(".button_usuario");

  async function getPedidosJson() {
    try {
      const dadosPedidos = await fetch("https://worthcakes.desenvolvimentolocal.ce.gov.br/pedidos").then((response) => response.json());

      return dadosPedidos;
    } catch (error) {
      console.log("Erro de solicitação", err);
      return "";
    }
  }

  async function ListarPedidos() {
    const HTMLContainer = document.querySelector(".modal#exampleModal .modal-body .cardsScroll");
    HTMLContainer.innerHTML =
      "<div style='width: 100%; height: 200px' class='flex_center_justifyed-row'><div class='loader '></div></div>";
    const parser = new DOMParser();
    const HTMLString = `
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
    const HTMLBlock = parser.parseFromString(HTMLString, "text/html");
    const dados = await getPedidosJson();
    HTMLContainer.innerHTML = "";
    console.log(HTMLBlock);
    for (const key in dados) {
      if (Object.hasOwnProperty.call(dados, key)) {
        const element = dados[key];
        HTMLBlock.body.querySelector(".card-header#id").innerHTML = "ID do pedido: " + element.id;
        HTMLBlock.body.querySelector(".card-body #desc").innerHTML = "Descrição: " + element.descricao;
        HTMLBlock.body.querySelector(".card-body #nome").innerHTML = "Nome do bolo: " + element.nomedobolo;
        HTMLBlock.body.querySelector(".card-body #cat").innerHTML = "Categoria: " + element.categoria;
        HTMLBlock.body.querySelector(".card-body #preco").innerHTML = "Preço: " + element.preco;
        HTMLBlock.body.querySelector(".card-footer #data").innerHTML = "Data de entrega: " + element.datadeentrega;

        HTMLContainer.innerHTML += HTMLBlock.body.innerHTML;
      }
    }
  }
  botaoUsuario.addEventListener("click", ListarPedidos);
}
function activateModalPostComments() {
  async function postPedidosJson(data) {
    try {
      const url = `https://worthcakes.desenvolvimentolocal.ce.gov.br/comentarios?texto=${data}`;
      const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
      };
      const retorno = await fetch(url, options).then((response) => response.json());
      return retorno;
    } catch (error) {
      console.log("Erro de solicitação", error);
      return "";
    }
  }

  async function formEvent(event) {
    event.preventDefault();
    let form = document.forms.comentarioUser;
    let formData = new FormData(form);
    let data = formData.get("comentarios");
    let reuturndata = await postPedidosJson(data);
    if (reuturndata != "Sucesso!") {
      document.querySelector("#rateUs .modal-footer").innerHTML = `<div class="alert alert-danger" role="alert">
        Algo deu errado
      </div>`;
      setTimeout(() => {
        location.reload(true);
      }, 200);
    }
    document.querySelector("#rateUs .modal-footer").innerHTML += `<div class="alert alert-warning" role="alert">
        Suscesso ao cadastrar!
      </div>`;
    setTimeout(() => {
      location.reload(true);
    }, 200);
  }

  document.forms.comentarioUser.addEventListener("submit", formEvent);
}
function activateModalGetComments() {
  async function postPedidosJson(data) {
    try {
      const url = `https://worthcakes.desenvolvimentolocal.ce.gov.br/comentarios`;
      const options = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };
      const retorno = await fetch(url, options).then((response) => response.json());
      return retorno;
    } catch (error) {
      console.log("Erro de solicitação", error);
      return "";
    }
  }

  async function formEvent(event) {
    event.preventDefault();
    let form = document.forms.comentarioUser;
    let formData = new FormData(form);
    let data = formData.get("comentarios");

    const HTMLContainer = document.querySelector(".modal#ratesUsers .modal-body .cardsScroll");
    HTMLContainer.innerHTML =
      "<div style='width: 100%; height: 200px' class='flex_center_justifyed-row'><div class='loader '></div></div>";
    const parser = new DOMParser();
    const HTMLString = `
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
    const HTMLBlock = parser.parseFromString(HTMLString, "text/html");
    let reuturndata = await postPedidosJson(data);
    console.log(reuturndata);
    HTMLContainer.innerHTML = "";
    console.log(HTMLBlock);

    for (const key in reuturndata) {
      if (Object.hasOwnProperty.call(reuturndata, key)) {
        const element = reuturndata[key];
        HTMLBlock.body.querySelector(".card-header#id").innerHTML = "id: " + element.ID;
        HTMLBlock.body.querySelector(".card-body #desc").innerHTML = "Descrição: " + element.texto;
        HTMLBlock.body.querySelector(".card-footer #data").innerHTML = "Data de comentário: " + element.data_emissao;

        HTMLContainer.innerHTML += HTMLBlock.body.innerHTML;
      }
    }
  }
  let botaoUsuario = document.querySelector("#ratesUsersBTN");
  botaoUsuario.addEventListener("click", formEvent);
}

activateModalUser();
activateModalPostComments();
activateModalGetComments();
