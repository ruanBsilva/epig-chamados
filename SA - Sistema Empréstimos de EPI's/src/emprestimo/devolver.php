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
        $sql = 'UPDATE emprestimos SET data_devolucao = CURDATE() WHERE id_emprestimo = ?';
        $emprestimo = $banco->executarComando($sql, [$id], FALSE);

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