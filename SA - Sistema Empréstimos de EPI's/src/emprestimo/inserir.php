<?php
    require '../class/BancoDeDados.php';

    $form['id-emprestimo'] = $_POST['txt-id-emprestimo'] ?? null;
    $form['colaborador'] = $_POST['list-colaborador'] ?? null;
    $form['equipamento'] = $_POST['list-equipamento'] ?? null;
    $form['qtd'] = $_POST['txt-qtd'] ?? null;
    $form['data-emprestimo'] = $_POST['data-emprestimo'] ?? null;
    $form['data-prev-devolucao'] = $_POST['data-prev-devolucao'] ?? null;
    $form['obs'] = $_POST['txt-obs'] ?? null;

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

        $sql_consulta = 'SELECT estoque FROM equipamentos WHERE id_equipamento = ?';
        $produto = $banco->consultar($sql_consulta, [$form['equipamento']], FALSE);
        
        if ($produto['estoque'] < $form['qtd']) {
            $resposta = [
                'status' => 'erro',
                'msg'    => "Estoque insuficiente! Disponível: " . $produto['estoque'] . ", Solicitado:" . $form['qtd']
            ];
            echo json_encode($resposta);
            exit;
        } else {
            $banco->iniciarTransacao();
            $sql =  'INSERT INTO emprestimos (colaborador, equipamento, qtd, data_emprestimo, data_prev_emprestimo, obs) VALUE (?, ?, ?, ?, ?, ?)';
            $parametros = [
                $form['colaborador'],
                $form['equipamento'],
                $form['qtd'],
                $form['data-emprestimo'],
                $form['data-prev-devolucao'],
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
        }        
    } catch (PDOException $erro) {
        $banco->cancelarTransacao();
        
        $resposta = [
            'status'    => 'erro',
            'msg'       => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }