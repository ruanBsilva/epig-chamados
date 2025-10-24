<?php   
    require '../classBanco/BancoDeDados.php';
    try {
        $banco = new BancoDeDados;
        $sql_usuarios = 'SELECT * FROM usuarios';
        $usuarios = $banco->consultar($sql_usuarios, [], true);

        $sql_counts = "SELECT COUNT(*) AS total
                        , SUM(CASE WHEN tipo = 'a' THEN 1 ELSE 0 END) AS admin 
                        , SUM(CASE WHEN tipo = 'o' THEN 1 ELSE 0 END) AS operador
                        , SUM(CASE WHEN tipo = 'v' THEN 1 ELSE 0 END) AS visualizador
                        FROM usuarios";
        $counts = $banco->consultar($sql_counts , [], true);

        $resposta = [
            'status' => 'sucesso',
            'dados'  => $usuarios,
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