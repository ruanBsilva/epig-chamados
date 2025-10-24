<?php   
    require '../classBanco/BancoDeDados.php';
    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM colaboradores';
        $clientes = $banco->consultar($sql, [], true);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $clientes
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }