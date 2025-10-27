function inicializarUsuarios() {
    listarUsuarios();
}

function salvarUsuario() {
    var id = document.getElementById('txt-id-usuario').value;
    var nome = document.getElementById('txt-nome').value;
    var usuario = document.getElementById('txt-usuario').value;
    var email = document.getElementById('txt-email').value;
    var senha = document.getElementById('txt-senha').value;
    var tipo = document.getElementById('admin').checked ? 'a' : document.getElementById('operador').checked ? 'o' : 'v';
    var destino = id === 'NOVO' ? 'src/usuario/inserir.php' : 'src/usuario/alterar.php';

    $.ajax({
        type: 'post',
        url: destino,
        dataType: 'json',
        data: {
            'id': id,
            'nome': nome,
            'usuario': usuario,
            'email': email,
            'senha': senha,
            'tipo': tipo,
        },
        success: function (retorno) {
            if (retorno.status === 'sucesso') {
                alert(retorno.msg);
                document.getElementById('form-usuario').reset();
                listarUsuarios();
            } else {
                alert(retorno.msg);
                listarUsuarios();
            }
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição' + erro);
        },
    });
}

function listarUsuarios() {
    $.ajax({
        type: 'post',
        url: 'src/usuario/selecionarTodos.php',
        dataType: 'json',
        success: function (resposta) {
            var tabelaUsuarios = document.getElementById('tbody-usuario');
            tabelaUsuarios.innerHTML = ''; // limpar a tabela antes de inserir algo

            if (resposta.status === 'sucesso' && Array.isArray(resposta.dados)) {
                var usuarios = resposta.dados;
                var count = resposta.counts[0];

                usuarios.forEach(function (usuario) {
                    var linha = document.createElement('tr');
                    linha.innerHTML = `
                        <td>${usuario['nome']}</td>
                        <td>${usuario['usuario']}</td>
                        <td>${usuario['email']}</td>
                        <td>${usuario['tipo'] == 'a' ? 'Administrador' : usuario['tipo'] == 'o' ? 'Operador' : 'Visualizador'}</td>
                        <td>${usuario['data_cadastro']}</td>
                        <td align="center">
                            <button class="btn" onclick="alterarUsuario(${usuario['id_usuario']})">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <button class="btn" onclick="deletarUsuario(${usuario['id_usuario']})">
                                <i class="text-danger bi bi-trash3-fill"></i>
                            </button>
                        </td>
                    `;

                    tabelaUsuarios.appendChild(linha);
                });

                document.getElementById('qtd_usuarios').textContent = usuarios.length + ' usuário(s) encontrado(s)';
                document.getElementById('total-card').textContent = usuarios.length;
                document.getElementById('qtd-adm').textContent = count.admin;
                document.getElementById('qtd-operador').textContent = count.operador;
                document.getElementById('qtd-visualizador').textContent = count.visualizador;

            } else {
                // Caso não haja usuários
                tabelaUsuarios.innerHTML = '<tr><td colspan="6" class="text-center p-4 text-muted">Nenhum usuário encontrado.</td></tr>';
                document.getElementById('qtd_usuarios').textContent = '0 usuário(s) encontrado(s)';
                document.getElementById('qtd-adm').textContent = '0';
                document.getElementById('qtd-operadore').textContent = '0';
                document.getElementById('qtd-visualizador').textContent = '0';
            }
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

function alterarUsuario(idUsuario) {
    $.ajax({
        type: 'post',
        url: 'src/usuario/selecionarPorId.php',
        dataType: 'json',
        data: {
            'id': idUsuario
        },
        success: function (retorno) {
            if (retorno.status === 'sucesso') {
                var usuario = retorno.dados;
                document.getElementById('txt-id-usuario').value = usuario['id_usuario'];
                document.getElementById('txt-nome').value = usuario['nome'];
                document.getElementById('txt-usuario').value = usuario['usuario'];
                document.getElementById('txt-email').value = usuario['email'];
                if (usuario['tipo'] === 'a') {
                    document.getElementById('admin').checked = true;
                } else if (usuario['tipo'] === 'o') {
                    document.getElementById('operador').checked = true;
                } else {
                    document.getElementById('visualizador').checked = true;
                };
                document.getElementById('txt-senha').value = usuario['senha'];

                document.getElementById('novoUsuarioModalLabel').textContent = 'Alterar Usuário';
                document.querySelector('.btn-create-user').textContent = 'Salvar Alterações';
                $('#novoUsuarioModal').modal('show');

                listarUsuarios();
            } else {
                alert(retorno.msg);
                listarUsuarios();
            }
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}