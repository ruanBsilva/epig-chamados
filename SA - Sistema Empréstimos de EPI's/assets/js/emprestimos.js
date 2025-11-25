function inicializarEmprestimos() {
    listColaborador();
    listEquipamento();
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
            equipamentos.forEach(function (equipamento) {
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
    var id = document.getElementById('txt-id-emprestimo').value;
    var colaborador = document.getElementById('list-colaborador').value;
    var equipamento = document.getElementById('list-equipamento').value;
    var qtd = document.getElementById('txt-qtd').value;
    var data_emprestimo = document.getElementById('data-emprestimo').value;
    var data_prev_emprestimo = document.getElementById('data-prev-devolucao').value;
    var obs = document.getElementById('txt-obs').value;

    var formulario = new FormData();
    formulario.append('id', id);
    formulario.append('colaborador', colaborador);
    formulario.append('equipamento', equipamento);
    formulario.append('qtd', qtd);
    formulario.append('data_emprestimo', data_emprestimo);
    formulario.append('data_prev_emprestimo', data_prev_emprestimo);
    formulario.append('obs', obs);
    
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


