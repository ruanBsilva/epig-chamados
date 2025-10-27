function inicializarColaboradores() {
    listarColaborador()
}
// Função que irá SALVAR os clientes. Irá puxar as info do formulário e enviar por AJAX para o PHP
function salvarColaboradores() {
    var id = document.getElementById('txt-id-colaborador').value;
    var nome = document.getElementById('txt-nome-colaborador').value;
    var cpf = document.getElementById('cpf-colaborador').value;
    var email = document.getElementById('txt-email-colaborador').value;
    var telefone = document.getElementById('txt-telefone-colaborador').value;
    var nascimento = document.getElementById('data-nasc-colaborador').value;
    var cargo = document.getElementById('txt-cargo').value;
    var destino = id === 'NOVO' ? 'src/colaborador/inserir.php' : 'src/colaborador/atualizar.php';

    $.ajax({
        type: 'post',
        url: destino,
        dataType: 'json',
        data: {
            'id': id,
            'cpf': cpf,
            'nome': nome,
            'email': email,
            'telefone': telefone,
            'nascimento': nascimento,
            'cargo': cargo,
        },
        success: function (retorno) {
            if (retorno.status === 'sucesso') {
                alert(retorno.msg);
                $('#meuModal').modal('hide');
                $('#form-colaborador')[0].reset();
            } else {
                alert(retorno.msg);
            }
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição' + erro);
        },
    });
}

function abrirModal() {
    $('#meuModal').modal('toggle')
}

function fecharModal() {
    $('#meuModal').modal('hide');
    $('#form-colaborador')[0].reset();
}


function listarColaborador() {
    $.ajax({
        type: 'post',
        url: 'src/colaborador/selectTodos.php',
        dataType: 'json',
        success: function (resposta) {
            var tabelaColaboradores = document.getElementById('tbody-Colaborador');
            tabelaColaboradores.innerHTML = '';
            var colaboradores = resposta.dados;

            console.log("Resposta do servidor:", resposta);

            colaboradores.forEach(function (colaborador) {
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${colaborador['id_colaborador']}</td>
                    <td>${colaborador['nome_colaborador']}</td>
                    <td>${colaborador['cpf']}</td>
                    <td>${colaborador['email']}</td>
                    <td>${colaborador['telefone']}</td>
                    <td>${colaborador['nascimento']}</td>
                    <td>${colaborador['cargo']}</td>
                    <td align="center">
                        <button class="btn" onclick="editarColaborador(${colaborador['id_colaborador']})">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button class="btn" onclick="deletarColaborador(${colaborador['id_colaborador']})">
                            <i class="text-danger bi bi-trash3-fill">
                        </i></button>
                    </td>
                `;

                tabelaColaboradores.appendChild(linha);
            });
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

