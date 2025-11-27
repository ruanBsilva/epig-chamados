<?php   
    require '../classBanco/BancoDeDados.php';
    // Validação
    $id = $_POST['id'] ?? null;

    if(!$id) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'ID do empréstimo inválido!'
        ];
        echo json_encode($resposta);
        exit;
    }

    try {
        $banco = new BancoDeDados;
        $sql_consulta = 'SELECT equipamento, qtd FROM emprestimos WHERE id_emprestimo = ?';
        $resultado_consulta = $banco->consultar($sql_consulta, [$id]);

        $sql_update_estoque = 'UPDATE equipamentos SET estoque = estoque + ? WHERE id_equipamento = ?';
        $parametros_estoque = [
            $resultado_consulta['qtd'],
            $resultado_consulta['equipamento']
        ];
        $banco->executarComando($sql_update_estoque, $parametros_estoque);

        $sql = 'UPDATE emprestimos SET data_devolucao = CURDATE() WHERE id_emprestimo = ?';
        $emprestimo = $banco->executarComando($sql, [$id]);

        $resposta = [
            'status' => 'sucesso',
            'msg'    => 'Equipamento devolvido com sucesso!'  
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }