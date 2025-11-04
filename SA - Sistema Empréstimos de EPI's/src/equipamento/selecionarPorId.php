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

    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM equipamentos WHERE id_equipamento = ?';
        $equipamento = $banco->consultar($sql, [$id], FALSE);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $equipamento
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }