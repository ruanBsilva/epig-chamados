function inicializarEmprestimos() {
    listarColaborador()
    listarEquipamento()
}

function listarColaborador(){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/colaborador/selectTodos.php',
        success: function(resposta){
            var listarColaboradores = document.getElementById('list-colaborador')
            listarColaboradores.innerHTML = '';

            var colaboradores = resposta['dados'];
            var opcao = "<option value=''>Selecione o colaborador...</option>";
            colaboradores.forEach(function(colaborador){
                opcao += `<option value='${colaborador['idColaborador']}'>${colaborador['nome']}</option>`;
            });
            listarColaboradores.innerHTML = opcao;

            console.log("aqui")
        },
        error: function(erro){
            alert("Ocorreu um erro: " + erro);
        }
    });
}

function listarEquipamento(){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/equipamento/selecionarTodos.php',
        success: function(resposta){
            var listarEquipamentos = document.getElementById('list-equipamento')
            listarEquipamentos.innerHTML = '';

            var equipamentos = resposta.dados;
            var opcao = "<option value=''>Selecione o equipamento...</option>";
            equipamentos.forEach(function(equipamento){
                opcao += `<option value='${equipamento['id_equipamento']}'>${equipamento['nome_equip']}</option>`;
            });
            listarEquipamentos.innerHTML = opcao;
        },
        error: function(erro){
            alert("Ocorreu um erro: " + erro);
        }
    });
}