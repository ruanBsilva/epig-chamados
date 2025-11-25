<?php
    require '../classBanco/BancoDeDados.php';

    $form = [
        'id'                    => $_POST['id']                     ?? null,
        'colaborador'           => $_POST['colaborador']            ?? null,
        'equipamento'           => $_POST['equipamento']            ?? null,
        'qtd'                   => $_POST['qtd']                    ?? null,
        'data_emprestimo'       => $_POST['data_emprestimo']        ?? null,
        'data_prev_emprestimo'  => $_POST['data_prev_emprestimo']   ?? null,
        'obs'                   => $_POST['obs']                    ?? null,
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

        $banco->iniciarTransacao();

        $sql =  'INSERT INTO emprestimos (colaborador, equipamento, qtd, data_emprestimo, data_prev_emprestimo, obs) VALUE (?, ?, ?, ?, ?, ?)';
        $parametros = [
            $form['colaborador'],
            $form['equipamento'],
            $form['qtd'],
            $form['data_emprestimo'],
            $form['data_prev_emprestimo'],
            $form['obs']
        ];
        $banco->executarComando($sql, $parametros);

        $sql_equipamentos = 'UPDATE equipamentos SET estoque = estoque - ? WHERE id_equipamento = ?';
        $parametros_produto = [
            $form['qtd'],
            $form['equipamento']
        ];
        $banco->executarComando($sql_equipamentos, $parametros_produto);

        $banco->confirmarTransacao();

        $resposta = [
            'status'    => 'sucesso',
            'msg'       => 'Empréstimo realizado com sucesso'
        ];
        echo json_encode($resposta);
    } catch (PDOException $erro) {
        $banco->cancelarTransacao();
        
        $resposta = [
            'status'    => 'erro',
            'msg'       => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }