<?php   
    require '../classBanco/BancoDeDados.php';
    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM equipamentos';
        $equipamentos = $banco->consultar($sql, [], true);

        $sql_counts = 'SELECT COUNT(id_equipamento) AS total_equipamentos
                            , COALESCE(SUM(CASE WHEN estoque > 0 THEN 1 ELSE 0 END), 0) AS em_estoque
                            , COALESCE(SUM(CASE WHEN estoque = 0 THEN 1 ELSE 0 END), 0) AS sem_estoque
                        FROM equipamentos'; // FALTA ADICIONAR JOIN COM ESMPRESTIMOS PARA EQUIP EM USO
        $counts = $banco->consultar($sql_counts, [], true);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $equipamentos,
            'counts'  => $counts,
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }