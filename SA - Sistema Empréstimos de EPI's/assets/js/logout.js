function logout() {
    var confirmou = confirm('Deseja sair do sistema?');
    if (confirmou) {
        $.ajax({
            type: 'get',
            url: 'src/usuario/logout.php',
            success: function () {
                window.location.href = 'index.php';
            },
            error: function (erro) {
                alert('Houve um erro na requisição' + erro);
            }
        })
    }
}