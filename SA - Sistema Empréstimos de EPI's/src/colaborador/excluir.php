<?php

require '../classBanco/BancoDeDados.php';

$id = $_POST['idColaborador'] ?? null;

if(!$id){
    $resposta = [
        'status' => 'erro',
        'msg' => 'ID do Colaborador Inválido!'
    ];
    echo json_encode($resposta);
    exit;
}

try {
    $banco = new BancoDeDados;
    $sql = 'DELETE FROM colaboradores WHERE idColaborador = ?';
    $banco -> executarComando($sql, [$id]);
    $resposta = [
        'status' => 'sucesso',
        'msg' => 'Colaborador deletado com sucesso!'
    ];
    echo json_encode($resposta);

} catch (PDOException $erro) {
    $resposta = [
        'status' => 'erro',
        'msg'    => $erro->getCode() == 23000 ? 'Este cliente não pode ser exluído pois está atrelado a uma venda' : $erro->getMessage()
    ];
    echo json_encode($resposta);
}


?>