<?php
    require '../classBanco/BancoDeDados.php';
    // Validação de dados
    $form = [
        'id'        =>      $_POST['id']        ?? null,
        'nome'      =>      $_POST['nome']      ?? null,
        'usuario'   =>      $_POST['usuario']   ?? null,
        'email'     =>      $_POST['email']     ?? null,
        'senha'     =>      $_POST['senha']     ?? null,
        'tipo'      =>      $_POST['tipo']      ?? null,
    ];

    if (in_array(null, $form)) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'Por favor, preencha todos os campos!'
        ];
        echo json_encode($resposta);
        exit;
    }

    try {
        // Conectar no Banco de Dados
        $banco = new BancoDeDados;

        // Definir o Comando
        $sql = 'UPDATE usuarios
                SET usuario = ?,
                    email = ?,
                    senha = ?,
                    nome = ?,
                    tipo = ?
                WHERE id_usuario = ?';
        $parametros_alterar = [
        $form['usuario'],
        $form['email'],
        $form['senha'],
        $form['nome'],
        $form['tipo'],
        $form['id']
        ];
        // Executar o Comando
        $banco->executarComando($sql, $parametros_alterar);
        $resposta = [
            'status' => 'sucesso',
            'msg'    => 'Usuário alterado com sucesso'
        ];
        echo json_encode($resposta);
        
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }