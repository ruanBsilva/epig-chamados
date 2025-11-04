<?php
    $TOKEN_COD_BARRA = '22702|MGTYrO4axANaRBukOIxahqbWZAXCGwuS';
    
    require '../classBanco/BancoDeDados.php';
    // Validação de dados
    $form = [
    'id'          => $_POST['id']        ?? null,
    'nome'        => $_POST['nome']      ?? null,
    'descricao'   => $_POST['descricao'] ?? null,
    'estoque'     => $_POST['estoque']   ?? null,
    ];

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $nome_imagem = uniqid() . '.png';
        $destino     = '../../upload/equipamentos/' . $nome_imagem;
        $origem      = $_FILES['img']['tmp_name'];
        if (!move_uploaded_file($origem, $destino)) {
             // Caso o upload falhe, retorne o erro
            $resposta = [
                'status' => 'erro', 
                'msg' => 'Erro ao mover arquivo de imagem.'
            ];
            echo json_encode($resposta);
            exit;
        }
    } else {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'A imagem do produto é obrigatória!'
        ];
        echo json_encode($resposta);
        exit;
    }

    $nome_codbarra = 'vazio';

    try {
        $banco = new BancoDeDados;

        $sql = 'INSERT INTO equipamentos (nome_equip, desc_equip, estoque, img_equip, codBarra) VALUES (?, ?, ?, ?, ?)';
        $parametros_inserir = [
            $form['nome'],
            $form['descricao'],
            $form['estoque'],
            $nome_imagem,
            $nome_codbarra
        ];
        // Executar o Comando
        $banco->executarComando($sql, $parametros_inserir);
        

        $ultimo_id = $banco->ultimoIdInserido();

        if ($ultimo_id) {
            $api_url = "https://api.invertexto.com/v1/barcode?token={$TOKEN_COD_BARRA}&text={$ultimo_id}&type=code128&base64=true";
            $resposta_api = @file_get_contents($api_url); 
            $data_api = $resposta_api ? json_decode($resposta_api, true) : null;

            if ($data_api && isset($data_api['image'])) {
                $base64 = $data_api['image'];
                $data = str_replace('data:image/png;base64,', '', $base64);
                $data = str_replace(' ', '+', $data); 
                $data_decode = base64_decode($data);

                if ($data_decode !== false) {
                    $nome_codbarra = uniqid('codbarra_') . '.png';
                    $destino_codbarra = '../../upload/codbarras/' . $nome_codbarra;
                    
                    if (file_put_contents($destino_codbarra, $data_decode)) {
                        $sql_update = 'UPDATE equipamentos SET codBarra = ? WHERE id_equipamento = ?';
                        $parametros_update = [$nome_codbarra, $ultimo_id];
                        $banco->executarComando($sql_update, $parametros_update);
                    }
                }
            } 
        }


        $resposta = [
        'status' => 'sucesso',
        'msg'    => 'Equipamento cadastrado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
?>