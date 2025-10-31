<?php

    require '../classBanco/BancoDeDados.php';

    $form = [
        'id'            => $_POST['id']             ?? null,
        'nome'          => $_POST['nome']           ?? null,
        'cpf'            => $_POST['cpf']            ?? null,
        'email'         => $_POST['email']          ?? null,
        'telefone'      => $_POST['telefone']       ?? null,
        'nascimento'    => $_POST['nascimento']     ?? null,
        'cargo'         => $_POST['cargo']          ?? null,
        
    ];

    if(in_array(null, $form)){
        $resposta = [
            'status'    => 'erro',
            'msg'       => 'Por favor, preencha todos os campos!',
        ];
        echo json_encode($resposta);
        exit;
    }

    try {
        $banco = new BancoDeDados;

        $sql = 'UPDATE colaboradores SET nome = ?, cpf = ?, email = ?, telefone = ?, nascimento = ?, cargo = ? WHERE idColaborador = ?';
        $parametros_inserir = [
            $form['nome'],
            $form['cpf'],
            $form['email'],
            $form['telefone'],
            $form['nascimento'],
            $form['cargo'],
            $form['id']
        ];
        $banco->executarComando($sql, $parametros_inserir);
        $resposta = [
            'status'    => 'sucesso',
            'msg'       => 'Colaborador atualizado com sucesso'
        ];
        echo json_encode($resposta);

    } catch (PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'msg'       => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
