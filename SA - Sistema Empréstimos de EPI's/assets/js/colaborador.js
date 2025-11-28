
function inicializarColaboradores() {
    listarColaborador()
}

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

            listarColaborador();
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição' + erro);
        },
    });
}

function abrirModalNovo() {
    $('#meuModal').modal('toggle')
    $('#form-colaborador')[0].reset()
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

            if (resposta.status === 'sucesso' && resposta.dados.length > 0) {
                var colaboradores = resposta.dados;
                var count = resposta.counts[0];

                colaboradores.forEach(function (colaborador) {
                    var linha = document.createElement('tr');
                    linha.innerHTML = `
                        <td>${colaborador['idColaborador']}</td>
                        <td>${colaborador['nome']}</td>
                        <td>${colaborador['cpf']}</td>
                        <td>${colaborador['cargo']}</td>
                        <td>${colaborador['email']}</td>
                        <td>${colaborador['telefone']}</td>
                        <td>${colaborador['nascimento']}</td>
                        <td align="center">
                            <button class="btn" onclick="editarColaborador(${colaborador['idColaborador']})">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <button class="btn" onclick="deletarColaborador(${colaborador['idColaborador']})">
                                <i class="text-danger bi bi-trash3-fill">
                            </i></button>
                        </td>
                    `;

                    tabelaColaboradores.appendChild(linha);
                });
                document.getElementById('qtd_colaboradores').textContent = colaboradores.length + ' colaborador(s) encontrado(s)';
                document.getElementById('total-cards').textContent = count.total;
                document.getElementById('sem-epis').textContent = count.sem_epi;
                document.getElementById('com-epis').textContent = count.com_epi;
            } else {
                tabelaColaboradores.innerHTML = '<tr><td colspan="8" class="text-center p-4 text-muted">Nenhum colaborador encontrado.</td></tr>';
                document.getElementById('qtd_colaboradores').textContent = '0 colaborador(s) encontrado(s)';
                document.getElementById('total-cards').textContent = '0';
                document.getElementById('sem-epis').textContent = '0';
                document.getElementById('com-epis').textContent = '0';
            }
            
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}



function editarColaborador(idColaborador) {
    $.ajax({
        type: 'POST',
        url: 'src/colaborador/selecionarPorID.php',
        dataType: 'JSON',
        data: {
            'idColaborador': idColaborador
        },
        success: function (resposta) {
            var colaborador = resposta.dados
            document.getElementById('txt-id-colaborador').value = colaborador['idColaborador'],
                document.getElementById('txt-nome-colaborador').value = colaborador['nome'],
                document.getElementById('cpf-colaborador').value = colaborador['cpf'],
                document.getElementById('txt-email-colaborador').value = colaborador['email'],
                document.getElementById('txt-telefone-colaborador').value = colaborador['telefone'],
                document.getElementById('data-nasc-colaborador').value = colaborador['nascimento'],
                document.getElementById('txt-cargo').value = colaborador['cargo'],
                abrirModal()
        },
        error: function (erro) {
            console.log('deu erro')
        }
    });

}

function deletarColaborador(idColaborador) {
    var confirmou = confirm('Deseja realmente deletar esse colaborador?');
    if (confirmou) {
        $.ajax({
            type: 'POST',
            url: 'src/colaborador/excluir.php',
            dataType: 'JSON',
            data: {
                'idColaborador': idColaborador
            },
            success: function (resposta) {
                confirm()
                if (resposta.status === 'sucesso') {
                    alert(resposta.msg);
                    listarColaborador();
                } else {
                    alert(resposta.msg);
                }
            },
            error: function (error) {
                alert('Deu erro ' + error)
            }
        })
    }
}


