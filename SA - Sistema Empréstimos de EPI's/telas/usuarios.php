<div class="usuarios-container">
    <div class="usuarios-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gerenciamento de Usuários</h1>
        <button class="btn btn-primary new-user-btn" type="button" data-bs-toggle="modal" data-bs-target="#novoUsuarioModal">
            <i class="bi bi-plus-lg me-2"></i> Novo Usuário
        </button>
    </div>
    <p class="text-muted mb-4">Gerencie os usuários do sistema e suas permissões</p>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5 card-stats-row">
        <div class="col">
            <div class="card card-stat total-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Total</h6>
                        <i class="bi bi-person-fill fs-5"></i>
                    </div>
                    <div id="total-card" class="stat-value">4</div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card card-stat admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Administradores</h6>
                        <i class="bi bi-shield-fill fs-5"></i>
                    </div>
                    <div id="qtd-adm" class="stat-value">1</div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat operador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Operadores</h6>
                        <i class="bi bi-gear-fill fs-5"></i>
                    </div>
                    <div id="qtd-operador" class="stat-value">2</div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-stat visualizador-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="card-title text-uppercase mb-2">Visualizadores</h6>
                        <i class="bi bi-eye-fill fs-5"></i>
                    </div>
                    <div id="qtd-visualizador" class="stat-value">3</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 user-table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 20%;">Usuário</th>
                            <th scope="col" style="width: 10%;">Login</th>
                            <th scope="col" style="width: 20%;">Email</th>
                            <th scope="col" style="width: 20%;">Perfil</th>
                            <th scope="col" style="width: 10%;">Data de Cadastro</th>
                            <th scope="col" style="width: 10%; text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-usuario">
                        <!-- PUXARÁ POR AJAX -->
                        <!-- <tr>
                            <td colspan="4" class="text-center p-4 text-muted">
                                Nenhum usuário encontrado.
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Usuários do Sistema</small>
            <small class="text-muted" id='qtd_usuarios'></small>
        </div>
    </div>

    <div class="modal fade" id="novoUsuarioModal" tabindex="-1" aria-labelledby="novoUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content new-user-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="novoUsuarioModalLabel">Novo Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <p class="text-muted">Configure as informações e o perfil de acesso do usuário</p>

                    <form id="form-usuario" onsubmit="return false">
                        <div class="row mb-3">
                            <input type="hidden" id="txt-id-usuario" value="NOVO" readonly>
                            <div class="col-md-6 mb-3">
                                <label for="txt-nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="txt-nome" placeholder="Nome completo do usuário" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="txt-usuario" class="form-label">Nome de Usuário</label>
                                <input type="text" class="form-control" id="txt-usuario" placeholder="nome.usuario" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="txt-email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="txt-email" placeholder="usuario@epig.com" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="txt-senha" class="form-label">Senha Inicial</label>
                                <input type="password" class="form-control" id="txt-senha" placeholder="Senha temporária" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Perfil de Acesso</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="perfil-acesso" id="admin" value="a" required>
                                <label class="form-check-label" for="admin">Administrador</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="perfil-acesso" id="operador" value="o">
                                <label class="form-check-label" for="operador">Operador</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="perfil-acesso" id="visualizador" value="v">
                                <label class="form-check-label" for="visualizador">Visualizador</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary btn-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button onclick="salvarUsuario()" class="btn btn-dark btn-create-user">Criar Usuário</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        listarUsuarios();
    }

    function salvarUsuario() {
        var id          = document.getElementById('txt-id-usuario').value;
        var nome        = document.getElementById('txt-nome').value;
        var usuario     = document.getElementById('txt-usuario').value;
        var email       = document.getElementById('txt-email').value;
        var senha       = document.getElementById('txt-senha').value;
        var tipo        = document.getElementById('admin').checked ? 'a' : document.getElementById('operador').checked ? 'o' : 'v';
        var destino     = id === 'NOVO' ? 'src/usuario/inserir.php' : 'src/usuario/alterar.php';

        $.ajax({
            type: 'post',
            url: destino,
            dataType: 'json',
            data: {
                'id'      : id,
                'nome'    : nome,
                'usuario' : usuario,
                'email'   : email,
                'senha'   : senha,
                'tipo'    : tipo,
            },
            success: function(retorno){
                if (retorno.status === 'sucesso'){
                    alert(retorno.msg);
                    document.getElementById('form-usuario').reset();
                }else{
                    alert(retorno.msg);
                }
            },
            error: function(erro){
                alert('Ocorreu um erro na requisição' + erro);
            },
        });
    }

    function listarUsuarios() {
        $.ajax({
            type: 'post',
            url: 'src/usuario/selecionarTodos.php',
            dataType: 'json',
            success: function(resposta) {
                var tabelaUsuarios = document.getElementById('tbody-usuario');
                tabelaUsuarios.innerHTML = ''; // limpar a tabela antes de inserir algo

                if (resposta.status === 'sucesso' && Array.isArray(resposta.dados)) {
                    var usuarios = resposta.dados;
                    var count = resposta.counts[0];

                    usuarios.forEach(function(usuario) {
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
            error: function(erro) {
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
            } else {
                alert(retorno.msg);
            }
        },
        error: function (erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
    }
</script>