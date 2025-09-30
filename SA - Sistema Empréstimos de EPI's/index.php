<?php
    // Controle de Sessão
    session_start();
    if(isset($_SESSION['logado'])) {
        header('location: sistema.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EPIg Seguros</title>
    <link href="assets/css/index.css" rel="stylesheet">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form onsubmit="return false">
            <img class="mb-4" src="assets/img/EPIG_LOGO.png">
            <h1 class="h3 mb-3 fw-normal text-center">Acesso ao Sistema</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="txt-usuario">
                <label for="txt-usuario">Usuário</label>
            </div>
            <div class="form-floating input-group mb-3">
                <input type="password" class="form-control" id="txt-senha">
                <label for="txt-senha">Senha</label>
                <button class="btn btn-outline-primary" type="button" id="btn-password" onclick="mostrarSenha()"><i class="bi bi-eye-fill"></i></button> 
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="true" id="check-lembrar">
                <label class="form-check-label" for="check-lembrar">Manter-me conectado</label>
            </div>
            <button class="btn btn-primary w-100 py-2" onclick="entrar()">Entrar</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2024</p>
        </form>
        </script>
    </main>

    <!-- JQuery -->
    <script src="vendor/jquery-3.7.1/jquery-3.7.1.min.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript -->
        <script>
        // Função para mostrar/esconder a senha
        function mostrarSenha() {
            var inputSenha  = document.getElementById('txt-senha');
            var botao       = document.getElementById('btn-password');
            if (inputSenha.type === "password") {
                inputSenha.type = "text";
                botao.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
            } else {
                inputSenha.type = "password";
                botao.innerHTML = "<i class='bi bi-eye-fill'></i>";
            }
        }

        // Função para entrar no sistema
        function entrar() {
            var usuario = document.getElementById('txt-usuario').value;
            var senha   = document.getElementById('txt-senha').value;
            var lembrar = document.getElementById('check-lembrar').value;

            // AJAX
            $.ajax({
                type: 'post',
                url: 'src/usuario/login.php',
                dataType: 'json',
                data: {
                    'usuario' : usuario,
                    'senha'   : senha,
                    'lembrar' : lembrar
                },
                success: function(retorno) {
                    if (retorno.status === "sucesso") {
                        window.location.href = "sistema.php";
                    } else {
                        alert(retorno.msg);
                    }
                },
                error: function(erro) {
                    alert('Ocorreu um erro na requisição: ' + erro);
                }
            });
        }
        </script>

</body>

</html>