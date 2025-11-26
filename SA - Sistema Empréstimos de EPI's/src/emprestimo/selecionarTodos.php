<?php   
    require_once '../classBanco/BancoDeDados.php';

    try {
        $banco = new BancoDeDados();
        $sql = 'SELECT EMP.id_emprestimo
                    , EMP.qtd
                    , EMP.data_emprestimo
                    , EMP.data_prev_emprestimo
                    , EMP.obs
                    , EMP.data_devolucao
                    , C.nome AS colaborador
                    , C.cpf
                    , EQP.nome_equip AS equipamento
                FROM emprestimos EMP
                INNER JOIN colaboradores C ON C.idColaborador = EMP.colaborador
                INNER JOIN equipamentos EQP ON EQP.id_equipamento = EMP.equipamento';
        $emprestimos = $banco->consultar($sql, [], true);

        $sql_counts = 'SELECT COUNT(id_emprestimo) AS total
                            , COALESCE(SUM(CASE WHEN data_devolucao IS NULL THEN 1 ELSE 0 END), 0) AS ativos
                            , COALESCE(SUM(CASE WHEN data_devolucao IS NULL AND data_prev_emprestimo < CURDATE() THEN 1 ELSE 0 END), 0) AS vencidos
                            , COALESCE(SUM(CASE WHEN data_devolucao IS NULL AND data_prev_emprestimo >= CURDATE() THEN 1 ELSE 0 END), 0) AS a_vencer
                        FROM emprestimos';
        $counts = $banco->consultar($sql_counts, [], true);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $emprestimos,
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