<?php
    require '../classBanco/BancoDeDados.php';
    // Validação
    $usuario        = isset($_POST['usuario'])    ? $_POST['usuario']     : null;
    $senha          = isset($_POST['senha'])      ? $_POST['senha']       : null;
    $lembrar_login  = isset($_POST['lembrar'])    ? true                  : false;

    if(empty($usuario) || empty($senha)) {
        $resposta = [
            'status' => 'erro',
            'msg'    => 'Por favor, preencha todos os campos!'
        ];
        echo json_encode($resposta);
        exit;
    } 

    try {
        // Banco de Dados
        $banco = new BancoDeDados;
        // Definir o Comando
        $sql = 'SELECT id_usuario
                    , nome
                    , tipo
                FROM usuarios 
                WHERE usuario = ? AND senha = ?';
        // Parâmetros
        $parametros = [
            $usuario,
            $senha,
        ];
        $dados_usuario = $banco->consultar($sql, $parametros);
        // Login
        if($dados_usuario) {
            session_start();
            $_SESSION['logado']         = true;
            $_SESSION['id_usuario']     = $dados_usuario['id_usuario'];    
            $_SESSION['nome']           = $dados_usuario['nome'];
            $_SESSION['tipo']           = $dados_usuario['tipo'];

            $resposta = [
                'status' => 'sucesso'
            ];
            echo json_encode($resposta);
        } else {
            $resposta = [
                'status' => 'erro',
                'msg'    => 'Usuário ou senha incorretos. Por favor, revise!'
            ];
            echo json_encode($resposta);
            exit;
        }
    } catch (PDOException $erro) {
        $resposta = [
            'status'   => 'erro',
            'msg' => $erro->getMessage()
        ];
        echo json_encode($resposta);
    }

?>