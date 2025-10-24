<?php
    require '../classBanco/BancoDeDados.php';
    // Validação de dados
    $form = [
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
        $sql = 'INSERT INTO usuarios (usuario, email, senha, nome, tipo) VALUES (?, ?, ?, ?, ?)';
        $parametros_inserir = [
            $form['usuario'],
            $form['email'],
            $form['senha'],
            $form['nome'],
            $form['tipo']
        ];
        // Executar o Comando
        $banco->executarComando($sql, $parametros_inserir);
        $resposta = [
            'status' => 'sucesso',
            'msg'    => 'Usuário cadastrado com sucesso'
        ];
        echo json_encode($resposta);
        
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }