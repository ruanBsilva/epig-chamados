<?php
    require 'src/classBanco/BancoDeDados.php';
?>

<div>
    <h2>Cadastro de Clientes</h2>
</div>

<form id="form-cliente" onsubmit="return false">
    <div>
        <label for="txt-id-cliente">ID</label>
        <input type="text" id="txt-id-cliente" value="NOVO" readonly required>
    </div>
    <div>
        <label for="txt-nome-cliente">Nome Completo</label>
        <input type="text" id="txt-nome-cliente" required>
    </div>
    <div>
        <label for="txt-email-cliente">Email</label>
        <input type="email" id="txt-email-cliente" required>
    </div>
    <div>
        <label for="txt-telefone-cliente">Telefone</label>
        <input type="text" id="txt-telefone-cliente" required>
    </div>
    <div>
        <label for="data-nasc-cliente">Data de nascimento</label>
        <input type="date" id="data-nasc-cliente" required>
    </div>

    <button onclick="salvarClientes()">Salvar</button>
    <button>Cancelar</button>

</form>
 
    <script src="vendor/jquery-3.7.1/jquery-3.7.1.min.js"></script>

<script>
    function salvarClientes(){
        var id = document.getElementById('txt-id-cliente').value;
        var nome = document.getElementById('txt-nome-cliente').value;
        var email = document.getElementById('txt-email-cliente').value;
        var telefone = document.getElementById('txt-telefone-cliente').value;
        var nascimento = document.getElementById('data-nasc-cliente').value;
        var destino = id === 'NOVO' ? 'src/cliente/inserir.php' : 'src/cliente/atualizar.php';
        
        $.ajax({
            type: 'post',
            url: destino,
            dataType: 'json',
            data: {
                'id' : id,
                'nome' : nome,
                'email' : email,
                'telefone' : telefone,
                'nascimento' : nascimento,
            },
            success: function(retorno){
                if (retorno.status === 'sucesso'){
                    alert(retorno.msg);
                }else{
                    alert(retorno.msg);
                }
            },
            error: function(erro){
                alert('Ocorreu um erro na requisição' + erro);
            },
        });
    }
</script>