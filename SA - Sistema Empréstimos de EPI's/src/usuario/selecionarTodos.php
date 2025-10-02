<?php   
    require '../classBanco/BancoDeDados.php';
    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM usuarios';
        $usuarios = $banco->consultar($sql, [], true);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $usuarios
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }