function carregarTela(tela) {
    $.ajax({
        type: 'post',
        url: 'telas/' + tela + '.php',
        dataType: 'html',
        success: function (retorno) {
            var elemento = document.getElementById('main');
            elemento.innerHTML = retorno;

            switch (tela) {
                case 'equipamentos':
                    inicializarEquipamentos();
                    break;
                case 'colaboradores':
                    inicializarColaboradores();
                    break;
                case 'usuarios':
                    inicializarUsuarios();
                    break;
                case 'emprestimos':
                    inicializarEmprestimos();
                    break;
            };
        },
        error: function (erro) {
            alert('Houve um erro na requisição' + erro);
        }
    });
}