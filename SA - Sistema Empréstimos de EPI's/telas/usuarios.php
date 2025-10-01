<div class="container-gerenciamento">
    <header>
        <div class="header-info">
            <h1>Gerenciamento de Usuários</h1>
            <p>Gerencie os usuários do sistema e suas permissões</p>
        </div>
        <a href="#modal-novo-usuario" class="btn-novo-usuario">+ Novo Usuário</a>
    </header>

    <div class="tabela-container">
        <table>
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>E-mail / Login</th>
                    <th>Perfil</th>
                    <th>Departamento</th>
                    <th>Último Acesso</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                </tbody>
        </table>
    </div>
</div>

<div id="modal-novo-usuario" class="modal-overlay">
    <div class="modal-conteudo">
        <header class="modal-header">
            <h2>Novo Usuário</h2>
            <a href="#" class="fechar-modal">&times;</a>
        </header>
        <p class="modal-descricao">Configure as informações e permissões do usuário</p>

        <form onsubmit="return false;">
            
            <div class="form-row">
                <label for="nome-completo">Nome Completo</label>
                <input type="text" id="nome-completo" placeholder="Nome completo do usuário">
            </div>
            
            <div class="form-row form-half-row">
                <div class="form-group">
                    <label for="nome-usuario">Nome de Usuário</label>
                    <input type="text" id="nome-usuario" placeholder="nome.usuario">
                </div>
                <div class="form-group">
                    <label for="senha-inicial">Senha Inicial</label>
                    <input type="password" id="senha" placeholder="Senha temporária">
                </div>
            </div>

            <div class="form-row">
                <label>Perfil de Acesso</label>
                <div class="radio-group">
                    <input type="radio" id="perfil-adm" name="perfil-acesso" value="A" checked>
                    <label for="perfil-adm">Administrador</label>
                    
                    <input type="radio" id="perfil-operador" name="perfil-acesso" value="O">
                    <label for="perfil-operador">Operador</label>
                    
                    <input type="radio" id="perfil-visualizador" name="perfil-acesso" value="V">
                    <label for="perfil-visualizador">Visualizador</label>
                </div>
            </div>
            
            <footer class="modal-footer">
                <a href="#" class="btn-cancelar">Cancelar</a>
                <button onclick="salvarUsuario()" class="btn-criar">Criar Usuário</button>
            </footer>
        </form>
    </div>
</div>

</body>
</html>

<script>
function salvarUsuario() {
    var nome = document.getElementById('nome-completo').value;
    var usuario = document.getElementById('nome-usuario').value;
    var senha = document.getElementById('senha').value;
    var tipo = document.getElementById('perfil-adm').checked ? 'A' : document.getElementById('perfil-operador').checked ? 'O' : 'V';

    // AJAX
    $.ajax({
        type: 'post',
        url: 'src/usuario/inserir.php',
        dataType: 'json',
        data: {
            'nome': nome,
            'usuario': usuario,
            'senha': senha,
            'tipo' : tipo
        },
        success: function(retorno) {
            if (retorno.status === "sucesso") {
                alert(retorno.msg);
            } else {
                alert(retorno.msg);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Erro na requisição: ", textStatus, errorThrown);
            alert('Ocorreu um erro na requisição. Verifique o console para mais detalhes.');
        }
    });
}
</script>
