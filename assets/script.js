//ABRIR O MODAL CADASTRAR-SE
function showModalCadastrar(idModal){ 
    //IDMODAL: é usado para avisar que há um parâmetro lá no html, o texto pode ser qualquer coisa avisando que o parâmetro será um texto.
    const modal = document.querySelector(idModal)
    modal.style.display = "flex"
}

//ESCONDER O MODAL/OCULTAR A DIV DO MODAL
function hideModalCadastrar(idModal, event) {
    if(event.target.className === 'modal'){
        const modal = document.querySelector(idModal)
        modal.style.display = 'none'
    }
}

//FORÇAR O FECHAMENTO APÓS RECEBER A MSG DE ALERTA
function closeAllModalCadastrar() {
    const modais = document.querySelectorAll('.modal')
    modais.forEach(modal => {
        modal.style.display = 'none'
    })
}

//APÓS INSERIR DADOS NO insertCadastro.php 
async function insertCadastro(event) {
    //EVENT.PREVENTDEFAULT(): tira a forma padrão do carregamento, ou seja, o delay quando algo é adicionado na tela dando um flesh não acontecerá mais.
    event.preventDefault() 
    const formData = new FormData(event.target)
    const response = await fetch('../backend/insertCadastro.php', {
        method: 'POST',
        body: formData
    })
    const result = await response.json()
    if (result?.success) {
        alert('Seu cadastro foi efetuado com sucesso!');
        loadEventos();
    }
}

//APÓS INSERIR DADOS NO insertEventos.php, todas as respostas através do servidor que está o BDD
async function insertEventos(event) {
    //EVENT.PREVENTDEFAULT(): tira a forma padrão do carregamento, ou seja, o delay quando algo é adicionado na tela dando um flesh não acontecerá mais.
    event.preventDefault()
    const formData = new FormData(event.target)
    const response = await fetch('../backend/insertEventos.php', {
        method: 'POST',
        body: formData
    })
    const result = await response.json()
    if (result?.success) {
        alert('Seu evento '+result.data.nome+' foi cadastrado com sucesso!');
        loadEventos();
    }
}

async function insertParticipantes(event) {
    //EVENT.PREVENTDEFAULT(): tira a forma padrão do carregamento, ou seja, o delay quando algo é adicionado na tela dando um flesh não acontecerá mais.
    event.preventDefault()
    const formData = new FormData(event.target)
    const response = await fetch('../backend/insertParticipantes.php', {
        method: 'POST',
        body: formData
    })
    const result = await response.json()
    if (result?.success) {
        alert('Participante '+result.data.nomeP+' cadastrado com sucesso!');
        loadEventos();
    }
    window.location.replace("Eventos_Cadastrados.php")
}

async function insertSlide(event) {
    //EVENT.PREVENTDEFAULT(): tira a forma padrão do carregamento, ou seja, o delay quando algo é adicionado na tela dando um flesh não acontecerá mais.
    const formData = new FormData(event.target)
    const response = await fetch('../backend/insertSlide.php', {
        method: 'POST',
        body: formData
    })
    const result = await response.json()
    if (result?.success) {
        alert('Sua imagem do evento '+ result.data.titulo+' foi cadastrada com sucesso!');
        loadPage();
    }
}

async function loadSlide() {
    const response = await fetch('backend/list_slide.php')
    const result = await response.json()
    if (result?.success) {
        const slide = document.querySelector('#carrossel')
        slide.innerHTML = '';
        const divSlide = result.data
        divSlide.map((fotos) => {
            slide.innerHTML += `<div class="carousel-item">
            <img src="${fotos.capa}" alt="" class="img-fluid d-block">
            <div class="carousel-caption d-none d-block">
              <h3>${fotos.titulo}</h3>
              <p class="d-none d-sm-block">${fotos.descricao}</p>
            </div>
          </div>`
        })
    }else{
        alert('Erro ao cadastrar a imagem')
    }  //if
}//funcao;

//FUNÇÃO CHAMADA QUANDO ATUALIZA O SITE, USADA PARA ADICIONAR OS EVENTOS QUE ESTÃO LISTADOS LÁ NO list-eventos.php
async function loadEventos() {
    const response = await fetch('backend/listar-ev-par.php')
    const result = await response.json()
    if (result?.success) {
        const listaClientes = document.querySelector('#festas')
        const listaClientes2 = document.querySelector('#palestras')
        const listaClientes3 = document.querySelector('#halloween')
        const listaClientes4 = document.querySelector('#standUP')
        const listaClientes5 = document.querySelector('#workshops')
        listaClientes.innerHTML = ''
        listaClientes2.innerHTML = ''
        listaClientes3.innerHTML = ''
        listaClientes4.innerHTML = ''
        listaClientes5.innerHTML = ''
        const clientes = result.data
        clientes.map((eventos) => {
            const card =  `
            <div class="wrapper1 col-lg-3 col-md-4">
                <div class="card">
                    <div class="card-header col text-center p-2">${eventos.categoria}</div>
                    <img src="${eventos.capa}" class="card-img-top">
                    <div class="card-body card-body1">
                        <h5 class="card-title">${eventos.nome}</h5>
                        <h6 class="card-sub-title mb-2 text-muted">${eventos.descricao}</h6>
                        <h5 class="card-title">Mais Informações</h5>
                     <ul class="list-group">
                            <li class="list-group-item">Dia: ${eventos.dia}</li>
                            <li class="list-group-item">Horário: ${eventos.horario}</li>
                            <li class="list-group-item">Local: ${eventos.endereco}</li>
                            <li class="list-group-item">Município: ${eventos.municipio}</li>
                            <li class="list-group-item">UF: ${eventos.uf}</li>
                     </ul>
                    </div>
                    
                    <div class="card-body card-body2 p-2">
                        <div style="display: flex; justify-content: space-between;">
                            <p>Limite de Pessoas: <span class="limiteP" style="color: black;">${eventos.limiteP}</span></p>
                            <button class="vaga" onclick="limiteP(this)">Separar Vaga</button>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;"
                            <p>Participantes:</p>
                            <!-- Botão que irá abrir o modal -->
                            <button type="button" class="verMais btn btn-success btn-lg mt-2 ml-2" data-toggle="modal" data-target="#meuModal${eventos.id}">Ver mais</button>

                            <!-- Modal -->
                            <div id="meuModal${eventos.id}" class="modal fade" role="dialog" style="position:fixed">
                                <div class="modal-dialog">
                                    <!-- Conteúdo do modal-->
                                    <div class="modal-content">

                                        <!-- Cabeçalho do modal -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Participantes: ${eventos.nome}</h4>
                                        </div>

                                        <!-- Corpo do modal -->
                                        <div class="modal-body col-12">
                                            <table style="border: 1px solid black; padding: 5px;">
                                                <tr style="border: 1px solid black; padding: 5px;">
                                                    <th style="border: 1px solid black; padding: 5px;">Nome:</th>
                                                    <th style="border: 1px solid black; padding: 5px;">Descrição:</th>
                                                </tr>
                                                <tr style="border: 1px solid black; padding: 5px;">
                                                    <td style="border: 1px solid black; padding: 5px;">${eventos.nomeP}</   td>
                                                    <td style="border: 1px solid black; padding: 5px;">${eventos.  descricaoP}</td>
                                                </tr>
                                            </table><br>
                                          </div>

                                        <!-- Rodapé do modal-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</  button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right card-rodape-empresa text-muted">
                        NOSSO SITE
                    </div>
                </div><!--card-->
            </div><!--col do car--> 
        `
            if (eventos.categoria === 'festas') {
                listaClientes.innerHTML += card;       
            } else if (eventos.categoria === 'palestras') {
                listaClientes2.innerHTML += card;
            } else if (eventos.categoria === 'halloween') {
                listaClientes3.innerHTML +=  card
         
            } else if (eventos.categoria === 'standUP') {
                listaClientes4.innerHTML += card 
            } else {
                listaClientes5.innerHTML += card 
            }
        })
    }else{
        alert('Erro ao cadastrar a função')
    }       
}

function clearFormEvento(idModal) {
    const nome = document.querySelector(`${idModal} input [name=nome]`)
    nome.value=''
    const capa = document.querySelector(`${idModal} input [name=capa]`)
    capa.value=''
    const categoria = document.querySelector(`${idModal} select [name=categoria]`)
    categoria.value=''
    const limiteP = document.querySelector(`${idModal} input [name=limiteP]`)
    limiteP.value=''
    const dia = document.querySelector(`${idModal} input [name=dia]`)
    dia.value=''
    const horario = document.querySelector(`${idModal} input [name=horario]`)
    horario.value=''
    const endereco = document.querySelector(`${idModal} input [name=endereco]`)
    endereco.value=''
    const municipio = document.querySelector(`${idModal} input [name=municipio]`)
    municipio.value=''
    const uf = document.querySelector(`${idModal} select [name=uf]`)
    uf.value=''
    const descricao = document.querySelector(`${idModal} textarea [name=descricao]`)
    descricao.value=''
}

function botoes(){
    var paragraf = document.getElementById('numero');
    var num = parseFloat(paragraf.textContent) + 1;
    if (num == 2) {
        paragraf.textContent = num;
    }
    else if (num == 3) {
        paragraf.textContent = num;
    }
    else if (num == 4) {
        paragraf.textContent = num;
    } else if (num == 5) {
        var texto = document.getElementById('cx');
        paragraf.textContent = num;
        texto.textContent = "Seu limite de cadastro acabou, só é permitido cinco :(";
    } else if (num > 5) {
        window.location.href = "../index.html";
    }
}  

function limiteP() {
    var paragraf = document.querySelector('.limiteP');
    var btn = document.querySelector('.vaga'); 
    var num = parseFloat(paragraf.textContent) - 1;
    paragraf.textContent = '' ;
    var text = String(paragraf.textContent) + 'Acabou as vagas';

    paragraf.textContent = num;
    
    if (num == 0) {
        paragraf.textContent = text;
        paragraf.style.color="red";  
        btn.style.display="none";       
    }
}

async function deleteEvento(id) {
    const response = await fetch('deleteEvento.php?id='+id)
    const result = await response.json()               
    if (result?.success) {
        alert('Seu Cliente foi excluido com sucesso!');
        loadEventosPainel();
    }
}

async function loadClienteData(id) {
    const response = await fetch('get-evento-by-id.php?id='+id)
    const result = await response.json()               
    if (result?.success) {
        showModalCadastrar('#modal-editar')
        const nome = document.querySelector('#modal-editar input[name=nome]')
        nome.value = result.data.nome

        const capa = document.querySelector('#modal-editar input[name=capa]')
        capa.value = result.data.capa

        const categoria = document.querySelector('#modal-editar select[name=categoria]')
        categoria.value = result.data.categoria

        const limiteP = document.querySelector('#modal-editar input[name=limiteP]')
        limiteP.value = result.data.limiteP

        const dia = document.querySelector('#modal-editar input[name=dia]')
        dia.value = result.data.dia

        const horario = document.querySelector('#modal-editar input[name=horario]')
        horario.value = result.data.horario

        const endereco = document.querySelector('#modal-editar input[name=endereco]')
        endereco.value = result.data.endereco

        const municipio = document.querySelector('#modal-editar input[name=municipio]')
        municipio.value = result.data.municipio

        const uf = document.querySelector('#modal-editar select[name=uf]')
        uf.value = result.data.uf

        const descricao = document.querySelector('#modal-editar textarea[name=descricao]')
        descricao.value = result.data.descricao

        const nomeP = document.querySelector('#modal-editar input[name=nomeP]')
        nomeP.value = result.data.nomeP

        const descricaoP = document.querySelector('#modal-editar textarea[name=descricaoP]')
        descricaoP.value = result.data.descricaoP

        const cpf = document.querySelector('#modal-editar input[name=cpf]')
        cpf.value = result.data.cpf

        const sexo = document.querySelector('#modal-editar select[name=sexo]')
        sexo.value = result.data.sexo

        const id = document.querySelector('#modal-editar input[name=id]')
        id.value = result.data.id
    }
}

async function editEvento(event) {
    event.preventDefault()
    const formData = new FormData(event.target)
    const response = await fetch('editEventos.php?',{
        method: 'POST',
        body: formData
    })
    const result = await response.json()
    if (result?.success) {
        closeAllModalCadastrar()
        alert('Seu evento ' + result.data.nome + ' foi editado com sucesso!');
        loadEventosPainel()
    }
}

async function loadSlidePainel() {
    const response = await fetch('listSlidePainel.php')
    const result = await response.json()
    if (result?.success) {
        const slide = document.querySelector('#carrossel')
        slide.innerHTML = '';
        const divSlide = result.data
        divSlide.map((fotos) => {
            slide.innerHTML += `<div class="carousel-item">
            <img src="${fotos.capa}" alt="" class="img-fluid d-block">
            <div class="carousel-caption d-none d-block">
                <h3>${fotos.titulo}</h3>
                <p class="d-none d-sm-block">${fotos.descricao}</p>
                <button class="editar" onclick="loadSlideData(${fotos.id})">Editar</button>
                
                <button class="apagar" onclick="deleteSlide(${fotos.id})">Apagar</button>  
            </div>
          </div> 
          `
        })
    }else{
        alert('Erro ao cadastrar a imagem')
    }  //if
}//funcao;

async function loadSlideData(id) {
    const response = await fetch('get-slide-by-id.php?id='+id)
    const result = await response.json()               
    if (result?.success) {
        showModalCadastrar('#modal-editarSlide')

        const capa = document.querySelector('#modal-editarSlide input[name=capa]')
        capa.value = result.data.capa

        const titulo = document.querySelector('#modal-editarSlide input[name=titulo]')
        titulo.value = result.data.titulo

        const descricao = document.querySelector('#modal-editarSlide textarea[name=descricao]')
        descricao.value = result.data.descricao

        const id = document.querySelector('#modal-editarSlide input[name=id]')
        id.value = result.data.id
    }
}

async function editSlide(event) {
    const formData = new FormData(event.target)
    const response = await fetch('editSlide.php?',{
        method: 'POST',
        body: formData
    })
    const result = await response.json()
    if (result?.success) {
        closeAllModalCadastrar()
        alert('Seu slide ' + result.data.titulo + ' foi editado com sucesso!');
        loadPage()
    }
}

async function deleteSlide(id) {
    const response = await fetch('deleteSlide.php?id='+id)
    const result = await response.json()               
    if (result?.success) {
        alert('Seu Slide foi excluido com sucesso! Por favor recarregue a página');
        loadPage();
    }
}

//FUNÇÃO CHAMADA QUANDO ATUALIZA O SITE, USADA PARA ADICIONAR OS EVENTOS QUE ESTÃO LISTADOS LÁ NO list-eventos.php
async function loadEventosPainel() {
    const response = await fetch('listar-ev-par.php')
    const result = await response.json()
    if (result?.success) {
        const listaClientes = document.querySelector('#festas')
        const listaClientes2 = document.querySelector('#palestras')
        const listaClientes3 = document.querySelector('#halloween')
        const listaClientes4 = document.querySelector('#standUP')
        const listaClientes5 = document.querySelector('#workshops')
        listaClientes.innerHTML = ''
        listaClientes2.innerHTML = ''
        listaClientes3.innerHTML = ''
        listaClientes4.innerHTML = ''
        listaClientes5.innerHTML = ''
        const clientes = result.data
        clientes.map((eventos) => {
            const card2 = `<div class="wrapper1 col-lg-3 col-md-4">
            <div class="card">
                <div class="card-header col text-center p-2">${eventos.categoria}</div>
                <img src="${eventos.capa}" class="card-img-top">
                <div class="card-body card-body1">
                    <h5 class="card-title">${eventos.nome}</h5>
                    <h6 class="card-sub-title mb-2 text-muted">${eventos.descricao}</h6>
                    <h5 class="card-title">Mais Informações</h5>
                 <ul class="list-group">
                        <li class="list-group-item">Dia: ${eventos.dia}</li>
                        <li class="list-group-item">Horário: ${eventos.horario}</li>
                        <li class="list-group-item">Local: ${eventos.endereco}</li>
                        <li class="list-group-item">Município: ${eventos.municipio}</li>
                        <li class="list-group-item">UF: ${eventos.uf}</li>
                 </ul>
                </div>
                
                <div class="card-body card-body2 p-2">
                    <div style="display: flex; justify-content: space-between;">
                        <p>Limite de Pessoas: <span class="limiteP" style="color: black;">${eventos.limiteP}</span></p>
                        <div>
                        <a href="#modal-editar">
                            <img src="../img/edit.svg" alt="Editar" onclick="loadClienteData(${eventos.id})"></a>
                            <img src="../img/delete.svg" alt="Apagar" onclick="deleteEvento(${eventos.id})">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;"
                        <p>Participantes:</p>
                        <!-- Botão que irá abrir o modal -->
                        <button type="button" class="verMais btn btn-success btn-lg mt-2 ml-2" data-toggle="modal" data-target="#meuModal${eventos.id}">Ver mais</button>

                        <!-- Modal -->
                        <div id="meuModal${eventos.id}" class="modal fade" role="dialog" style="position:fixed">
                            <div class="modal-dialog">
                                <!-- Conteúdo do modal-->
                                <div class="modal-content">

                                    <!-- Cabeçalho do modal -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Participantes: ${eventos.nome}</h4>
                                    </div>

                                    <!-- Corpo do modal -->
                                    <div class="modal-body col-12">
                                        <table style="border: 1px solid black; padding: 5px;">
                                            <tr style="border: 1px solid black; padding: 5px;">
                                                <th style="border: 1px solid black; padding: 5px;">Nome:</th>
                                                <th style="border: 1px solid black; padding: 5px;">Descrição:</th>
                                            </tr>
                                            <tr style="border: 1px solid black; padding: 5px;">
                                                <td style="border: 1px solid black; padding: 5px;">${eventos.nomeP}</   td>
                                                <td style="border: 1px solid black; padding: 5px;">${eventos.  descricaoP}</td>
                                            </tr>
                                        </table><br>
                                      </div>

                                    <!-- Rodapé do modal-->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</  button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right card-rodape-empresa text-muted">
                    NOSSO SITE
                </div>
            </div><!--card-->
        </div><!--col do car--> 
    `
            if (eventos.categoria === 'festas') {
                listaClientes.innerHTML +=  card2;       
            } else if (eventos.categoria === 'palestras') { 
                listaClientes2.innerHTML += card2;  
            } else if (eventos.categoria === 'halloween') {
                listaClientes3.innerHTML += card2;  
            } else if (eventos.categoria === 'standUP') {
                listaClientes4.innerHTML += card2;  
            } else {
                listaClientes5.innerHTML += card2;  
            }
        })
    }else{
        alert('Erro ao cadastrar a função')
    }       
}

function imagem_slide() {
    var pagar = document.querySelector('#pagar');
    document.querySelector('#cadastrar-img').disabled=false;
    var cadastro = document.querySelector('#cadastrar-img');
    
    pagar.style.display="none";
    cadastro.style.backgroundColor="#308f19";
    cadastro.style.border="1px solid #288b28";
}

function loadPage() {
    loadEventosPainel();
    loadSlidePainel();
}
   
