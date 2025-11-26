<?php
    require '../classBanco/BancoDeDados.php';

    $id        = $_POST['id'] ?? null;
    $nome      = $_POST['nome'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $estoque   = $_POST['estoque'] ?? null;

    if (!$id || !$nome) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'Por favor, preencha os campos obrigatórios!'
        ];
        echo json_encode($resposta);
        exit;
    }

    try {
        $banco = new BancoDeDados();

        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            
            $diretorioDestino = '../../upload/equipamentos/';
            $extensao = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
            $novoNomeImagem = uniqid() . '.' . $extensao;

            if(move_uploaded_file($_FILES['img']['tmp_name'], $diretorioDestino . $novoNomeImagem)){
                $sql = "UPDATE equipamentos SET nome_equip = ?, desc_equip = ?, estoque = ?, img_equip = ? WHERE id_equipamento = ?";
                $parametros = [$nome, $descricao, $estoque, $novoNomeImagem, $id];

            } else {
                throw new Exception("Falha ao mover a imagem para a pasta de uploads.");
            }

        } else {
            $sql = "UPDATE equipamentos SET nome_equip = ?, desc_equip = ?, estoque = ? WHERE id_equipamento = ?";
            $parametros = [$nome, $descricao, $estoque, $id];
        }

        $banco->executarComando($sql, $parametros);

        $resposta = [
            'status' => 'sucesso',
            'msg'    => 'Equipamento atualizado com sucesso!'
        ];
        echo json_encode($resposta);

    } catch (Exception $erro) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'Erro ao atualizar: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }