<?php 
    require '../classBanco/BancoDeDados.php';
    // Validação
    $id = $_POST['idColaborador'] ?? null;

    if(!$id) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'ID do usuário inválido!'
        ];
        echo json_encode($resposta);
        exit;
    }

    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM colaboradores WHERE idColaborador = ?';
        $colaborador = $banco->consultar($sql, [$id], FALSE);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $colaborador
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }