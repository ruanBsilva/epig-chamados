<?php
    require '../classBanco/BancoDeDados.php';
    // Validação
    $id = $_POST['id'] ?? null;

    if(!$id) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'ID do usuário inválido!'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Exclusão no Bando de Dados

    try {
        // Conectar no Banco de Dados
        $banco = new BancoDeDados;
        $sql = 'DELETE FROM usuarios WHERE id_usuario = ?';
        $banco->executarComando($sql, [$id]);
        $resposta = [
            'status' => 'sucesso',
            'msg'    => 'Usuário deletado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }