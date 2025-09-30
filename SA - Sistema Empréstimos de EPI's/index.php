<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EPIg Seguros</title>
    
    <link href="assets/css/index.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="login-container">
        <div class="logo-container text-center">
            <img src="assets/img/EPIG_LOGO.png" alt="Logo EPigSeguros" class="logo">
            <h1 class="h3 fw-bold mt-3">
                <span style="color: #ef922a;">EPig</span><span style="color: #39a04d;">Seguros</span>
            </h1>

            <p class="text-secondary">Sistema de Gestão de Equipamentos de Proteção Individual</p>
        </div>

        <main class="login-card">
            <form onsubmit="return false;">
                <div class="text-center mb-4">
                    <h2 class="h4 mb-1 fw-bold">Acesso ao Sistema</h2>
                    <p class="text-secondary small">Digite suas credenciais para acessar o sistema</p>
                </div>
                
                <div class="form-group mb-3">
                    <label for="txt-usuario" class="form-label">Nome de usuário</label>
                    <input type="text" class="form-control" id="txt-usuario" placeholder="Digite seu usuário">
                </div>
                
                <div class="form-group mb-3">
                    <label for="txt-senha" class="form-label">Senha</label>
                    <div class="password-wrapper">
                        <input type="password" class="form-control" id="txt-senha" placeholder="Digite sua senha">
                        <button type="button" id="btn-password" onclick="mostrarSenha()">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="form-check text-start mb-3">
                    <input class="form-check-input" type="checkbox" value="true" id="check-lembrar">
                    <label class="form-check-label" for="check-lembrar">Lembrar de mim</label>
                </div>
                
                <button class="btn btn-dark w-100 py-2" onclick="entrar()">Entrar</button>

            </form>
        </main>

        <footer class="footer mt-4">
            <p class="text-body-secondary">&copy; 2024 EPigSeguros - Sistema de Gestão de Segurança</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Função para mostrar/esconder a senha
        function mostrarSenha() {
            var inputSenha = document.getElementById('txt-senha');
            var botao = document.getElementById('btn-password');
            var icone = botao.querySelector('i'); // Seleciona o ícone dentro do botão
            if (inputSenha.type === "password") {
                inputSenha.type = "text";
                icone.classList.remove('bi-eye-fill');
                icone.classList.add('bi-eye-slash-fill');
            } else {
                inputSenha.type = "password";
                icone.classList.remove('bi-eye-slash-fill');
                icone.classList.add('bi-eye-fill');
            }
        }

        // Função para entrar no sistema (sua lógica AJAX permanece a mesma)
        function entrar() {
            var usuario = document.getElementById('txt-usuario').value;
            var senha = document.getElementById('txt-senha').value;
            var lembrar = document.getElementById('check-lembrar').checked; // Usar .checked para checkboxes

            // AJAX
            $.ajax({
                type: 'post',
                url: 'src/usuario/login.php',
                dataType: 'json',
                data: {
                    'usuario': usuario,
                    'senha': senha,
                    'lembrar': lembrar
                },
                success: function(retorno) {
                    if (retorno.status === "sucesso") {
                        window.location.href = "sistema.php";
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
</body>
</html>