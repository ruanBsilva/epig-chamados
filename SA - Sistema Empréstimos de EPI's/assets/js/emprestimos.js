function inicializarEmprestimos() {
    listColaborador();
    listEquipamento();
    listarEmprestimos();
    
}

function listColaborador() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/colaborador/selectTodos.php',
        success: function (resposta) {
            var listarColaboradores = document.getElementById('list-colaborador')
            listarColaboradores.innerHTML = '';

            var colaboradores = resposta['dados'];
            var opcao = "<option value=''>Selecione o colaborador...</option>";
            colaboradores.forEach(function (colaborador) {
                opcao += `<option value='${colaborador['idColaborador']}'>${colaborador['nome']}</option>`;
            });
            listarColaboradores.innerHTML = opcao;
        },
        error: function (erro) {
            alert("Ocorreu um erro: " + erro);
        }
    });
}

function listEquipamento() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/equipamento/selecionarTodos.php',
        success: function (resposta) {
            var listarEquipamentos = document.getElementById('list-equipamento')
            listarEquipamentos.innerHTML = '';

            var equipamentos = resposta.dados;
            var opcao = "<option value=''>Selecione o equipamento...</option>";
            equipamentos.forEach(function(equipamento) {
                opcao += `<option value='${equipamento['id_equipamento']}'>${equipamento['nome_equip']}</option>`;
            });
            listarEquipamentos.innerHTML = opcao;
        },
        error: function (erro) {
            alert("Ocorreu um erro: " + erro);
        }
    });
}

function salvarEmprestimo() {

    var formulario = new FormData(document.getElementById('form-emprestimos'));

    console.log(formulario);
    $.ajax({
        type: 'post',
        url: 'src/emprestimo/inserir.php',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: formulario,
        success: function(resposta){
            alert(resposta['msg']);

            if(resposta['status'] === 'sucesso'){
                document.getElementById('form-emprestimos').reset();
                listarEmprestimos();
            }
        },
        error: function(erro){
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

function listarEmprestimos(){
    $.ajax({
        type: 'post',
        url: 'src/emprestimo/selecionarTodos.php',
        dataType: 'json',
        success: function (resposta){
            var tabelaEmprestimos = document.getElementById('tbody-emprestimos');
            tabelaEmprestimos.innerHTML = '';
            var emprestimos = resposta.dados;

            emprestimos.forEach(function(emprestimo){
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${emprestimo['id_emprestimo']}</td>
                    <td>${emprestimo['qtd']}</td>
                    <td>${emprestimo['data_emprestimo']}</td>
                    <td>${emprestimo['data_prev_emprestimo']}</td>
                    <td>${emprestimo['obs']}</td>
                    <td>
                        ${emprestimo['data_devolucao'] ? emprestimo['data_devolucao'] : 'Não devolvido' }
                    </td>
                    <td>${emprestimo['colaborador']}</td>
                    <td>${emprestimo['cpf']}</td>
                    <td>${emprestimo['equipamento']}</td>
                    <td align="center">
                        <button class="btn" onclick="devolucaoEmprestimo(${emprestimo['id_emprestimo']})">
                            <i class="bi bi-layer-backward"></i>
                        </button>
                    </td>
                `
                tabelaEmprestimos.appendChild(linha);
            });


            var count = resposta.counts[0];

            document.getElementById('ativos').textContent = count.ativos;
            document.getElementById('vencidos').textContent = count.vencidos;
            document.getElementById('a-vencer').textContent = count.vencer;
            document.getElementById('total').textContent = count.total;


        },
        error: function(erro){
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

function devolucaoEmprestimo(id){
    var confirmou = confirm('Deseja realmente marcar como devolvido?')
    if(confirmou){
        $.ajax({
            type: 'POST',
            url: 'src/emprestimo/devolver.php',
            dataType: 'json',
            data: {
                'id' : id
            },
            success: function(resposta){
                confirm()
                if(resposta.status === 'sucesso'){
                    alert(resposta.msg);
                    listarEmprestimos();
                }else{
                    alert(resposta.msg);
                }
            },
            error: function(error){
                alert('Deu erro ' + error)
            }
        })
    }

}