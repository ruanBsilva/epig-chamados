<?php

require '../classBanco/BancoDeDados.php';

$form = [
    'id' => $_POST['id'] ?? null,
    'nome' => $_POST['nome'] ?? null,
    'email' => $_POST['email'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'nascimento' => $_POST['nascimento'] ?? null,
];

if(in_array(null, $form)){
    $resposta = [
        'status' => 'erro',
        'msg' => 'Por favor, preencha todos os campos!',
    ];
    echo json_encode($resposta);
    exit;
}

try {
    $banco = new BancoDeDados;

    $sql = 'INSERT INTO clientes (nome, email, telefone, nascimento) VALUES (?,?,?,?)';
    $parametros_inserir = [
        $form['nome'],
        $form['email'],
        $form['telefone'],
        $form['nascimento']
    ];
    $banco->executarComando($sql, $parametros_inserir);
    $resposta = [
        'status' => 'sucesso',
        'msg' => 'Cliente cadastrado com sucesso'
    ];
    echo json_encode($resposta);

} catch (PDOException $erro) {
    $resposta = [
        'status' => 'erro',
        'msg'=> $erro->getMessage()
    ];
    echo json_encode($resposta);
}

?>