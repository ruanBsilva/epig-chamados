function inicializarEquipamentos() {
    listarEquipamentos();
};


function salvarEquipamento() {
    var id = document.getElementById('txt-id-equip').value;
    if (id === 'NOVO') {
        executarSalvarEquipamento();
    }
}

function geraCodBarra() {
    var TOKEN = '22702|MGTYrO4axANaRBukOIxahqbWZAXCGwuS';
    var textoParaCodigo = document.getElementById('txt-id-equip').value;

    if (!textoParaCodigo) {
        alert("O ID do equipamento é necessário para gerar o Código de Barras.");
        return;
    }

    // 
    $.ajax({
        type: 'get',
        url: `https://api.invertexto.com/v1/barcode`,
        dataType: 'json',
        data: {
            token: TOKEN,
            text: textoParaCodigo,
            type: 'code128',
            base64: true
        },
        success: function (resposta) {
            var codBarra = resposta.image;
            executarSalvarEquipamento(codBarra);
        },
        error: function (erro) {
            alert('Ocorreu um erro ao gerar o Código de Barras. O equipamento não será salvo.');
            console.error(erro);
        }
    });
}

function executarSalvarEquipamento() {
    var id = document.getElementById('txt-id-equip').value;
    var nome = document.getElementById('txt-nome').value;
    var descricao = document.getElementById('txt-descricao').value;
    var estoque = document.getElementById('qtd').value;
    var destino = id === 'NOVO' ? 'src/equipamento/inserir.php' : 'src/equipamento/editar.php';

    // Cria o FormData e adiciona os campos
    var formData = new FormData();
    formData.append('id', id);
    formData.append('nome', nome);
    formData.append('descricao', descricao);
    formData.append('estoque', estoque);

    var imagem = document.getElementById('img').files[0];
    if (imagem) {
        formData.append('img', imagem);
    }

    $.ajax({
        type: 'post',
        url: destino,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (retorno) {
            if (retorno.status === 'sucesso') {
                alert(retorno.msg);
                listarEquipamentos();
                document.getElementById('form-equipamentos').reset();
            } else {
                alert(retorno.msg);
            }
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

function listarEquipamentos() {
    $.ajax({
        type: 'post',
        url: 'src/equipamento/selecionarTodos.php',
        dataType: 'json',
        success: function (resposta) {
            var tabelaEquipamentos = document.getElementById('tbody-equipamentos');
            tabelaEquipamentos.innerHTML = ''; // limpar a tabela antes de inserir algo
            if (resposta.status === 'sucesso' && Array.isArray(resposta.dados)) {
                var equipamentos = resposta.dados;
                var count = resposta.counts[0];

                equipamentos.forEach(function (equipamento) {
                    var linha = document.createElement('tr');
                    linha.innerHTML = `
                            <td>${equipamento['id_equipamento']}</td>
                            <td>${equipamento['nome_equip']}</td>
                            <td>${equipamento['desc_equip']}</td>
                            <td>${equipamento['estoque']}</td>
                            
                            <td class="text-center"> 
                                <button class="btn" 
                                    onclick="window.open('upload/equipamentos/${equipamento['img_equip']}', '_blank')">
                                    <i class="bi bi-file-earmark-image"></i>
                                </button>
                            </td>
                            
                            <td class="text-center">
                                <button class="btn" 
                                    onclick="window.open('upload/codbarras/${equipamento['codBarra']}', '_blank')">
                                    <i class="bi bi-upc-scan"></i>
                                </button>
                            </td>
                            
                            <td class="text-center">
                                <button class="btn me-2" onclick="alterarEquipamento(${equipamento['id_equipamento']})">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="btn" onclick="deletarEquipamento(${equipamento['id_equipamento']})">
                                    <i class="text-danger bi bi-trash3-fill"></i>
                                </button>
                            </td>
                        `;
                    tabelaEquipamentos.appendChild(linha);
                });

                document.getElementById('qtd_epi').textContent = equipamentos.length + ' EPI(s) encontrado(s)';
                document.getElementById('total-card-equip').textContent = count.total_equipamentos;
                document.getElementById('qtd-estoque').textContent = count.em_estoque;
                document.getElementById('qtd-sem-estoque').textContent = count.sem_estoque;
                // FALTA ADICIONAR AINDA document.getElementById('qtd-em-uso').textContent = count.em_uso;
            } else {
                tabelaEquipamentos.innerHTML = '<tr><td colspan="6" class="text-center p-4 text-muted">Nenhum equipamento encontrado.</td></tr>';
                document.getElementById('qtd_epi').textContent = '0 EPI(s) encontrado(s)';
                document.getElementById('total-card-equip').textContent = '0';
                document.getElementById('qtd-estoque').textContent = '0';   
                document.getElementById('qtd-sem-estoque').textContent = '0';
                document.getElementById('qtd-em-uso').textContent = '0';
            }


        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

function deletarEquipamento(idEquipamento) {
    var confirmou = confirm('Deseja realmente deletar esse produto?');
    if (confirmou) {
        $.ajax({
            type: 'post',
            url: 'src/equipamento/deletar.php',
            dataType: 'json',
            data: {
                'id': idEquipamento
            },
            success: function (retorno) {
                if (retorno.status === 'sucesso') {
                    alert(retorno.msg);
                    listarEquipamentos();
                } else {
                    alert(retorno.msg);
                }
            },
            error: function (erro) {
                alert('Ocorreu um erro na requisição: ' + erro);
            }
        });
    }
}

function alterarEquipamento(idEquipamento) {
    $.ajax({
        type: 'post',
        url: 'src/equipamento/selecionarPorId.php',
        dataType: 'json',
        data: {
            'id': idEquipamento
        },
        success: function (retorno) {
            if (retorno.status === 'sucesso') {
                var equipamento = retorno.dados;
                document.getElementById('txt-id-equip').value = equipamento['id_equipamento'];
                document.getElementById('txt-nome').value = equipamento['nome_equip'];
                document.getElementById('txt-descricao').value = equipamento['desc_equip'];
                document.getElementById('qtd').value = equipamento['estoque'];

                document.getElementById('novoEquipamentoModalLabel').textContent = 'Alterar Equipamento';
                document.querySelector('.btn-create-user').textContent = 'Salvar Alterações';
                $('#novoEquipamentoModal').modal('show');

                listarEquipamentos();
            } else {
                alert(retorno.msg);
                listarEquipamentos();
            }
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}