<?php   
    require '../class/BancoDeDados.php';
    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM colaboradores';
        $clientes = $banco->consultar($sql, [], true);

        $sql_count = 'SELECT COUNT(DISTINCT C.idColaborador) AS total
                    , COUNT(DISTINCT CASE WHEN E.colaborador IS NULL THEN C.idColaborador END) AS sem_epi
                    , COUNT(DISTINCT E.colaborador) AS com_epi
                        FROM colaboradores C
                        LEFT JOIN emprestimos E on C.idColaborador = E.colaborador AND E.qtd > 0;';
        $counts = $banco->consultar($sql_count, [],true);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $clientes,
            'counts' => $counts
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }