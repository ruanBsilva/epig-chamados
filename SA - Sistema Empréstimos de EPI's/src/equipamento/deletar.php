<?php
    require '../classBanco/BancoDeDados.php';
    // Validação
    $id = $_POST['id'] ?? null;

    if(!$id) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'ID do equipamento inválido!'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Exclusão no Bando de Dados

    try {
        // Conectar no Banco de Dados
        $banco = new BancoDeDados;
        $sql = 'DELETE FROM equipamentos WHERE id_equipamento = ?';
        $banco->executarComando($sql, [$id]);
        $resposta = [
            'status' => 'sucesso',
            'msg'    => 'Equipamento deletado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getCode() == 23000 ? 'Este esquipamento não pode ser exluído pois está atrelado a um empréstimo' : $erro->getMessage()
        ];
        echo json_encode($resposta);
    }