<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - EPIg Seguros</title>
    
    <link href="assets/css/sistema.css" rel="stylesheet">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <a>EpigSeguros</a>
    </header>   
    <div class="container-fluid">
        <?php
            if($_SESSION['tipo'] === 'a'){
                echo "<li>
                    <a href='sistema.php?telas=equipamentos'>Equipamentos</a>
                </li>
                <li>
                    <a href='sistema.php?telas=usuarios'>Usuários</a>
                </li>
                <li>
                    <a href='sistema.php?telas=clientes'>Clientes</a>
                </li>";
            }
        ?>
    </div>
    <div>
        <?php
        $telas = isset($_GET['telas']) ? $_GET['telas'] : null;
        switch ($telas) {
            case 'clientes':
                include 'telas/clientes.php';
                break;
            case 'equipamentos':
                include 'telas/equipamentos.php';
                break;
            case 'usuarios':
                include 'telas/usuarios.php';
                break;
            default:
                echo "<h1>Bem vindo {$_SESSION['nome']}!</h1>";
                break;
        }
        ?>
    </div>
</body>