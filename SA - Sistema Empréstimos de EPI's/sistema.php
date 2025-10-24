<?php
session_start();
$telas = isset($_GET['telas']) ? $_GET['telas'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - EPIgSeguros</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="assets/css/sistema.css" rel="stylesheet"> 
    <link href="assets/css/usuarios.css" rel="stylesheet"> 
    <link href="assets/css/colaboradores.css" rel="stylesheet"> 

    <script src="assets/js/colaborador.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-3.7.1/jquery-3.7.1.min.js"></script>
    
</head>
<body>
    <div class="main-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="sistema.php" class="sidebar-logo">
                    <img src="assets/img/EPIG_LOGO.png" alt="Logo EPIgSeguros"> <div class="logo-text">
                        <span><span class="logo-part-1">EPIg</span><span class="logo-part-2">Seguros</span></span>
                        <small>Gestão de Segurança</small>
                    </div>
                </a>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <?php
                        echo "<li class='" . ($telas === 'dashboard' ? 'active' : '') . "'>
                                <a href='sistema.php'><i class='bi bi-grid-1x2-fill'></i> Dashboard</a>
                            </li>";

                        if($_SESSION['tipo'] === 'a'){
                            echo "<li class='" . ($telas === 'equipamentos' ? 'active' : '') . "'>
                                    <a href='sistema.php?telas=equipamentos'><i class='bi bi-shield-check'></i> Equipamentos</a>
                                </li>
                                <li class='" . ($telas === 'colaboradores' ? 'active' : '') . "'>
                                    <a href='sistema.php?telas=colaboradores'><i class='bi bi-people-fill'></i> Colaboradores</a>
                                </li>
                                <li class='" . ($telas === 'usuarios' ? 'active' : '') . "'>
                                    <a href='sistema.php?telas=usuarios'><i class='bi bi-person-gear'></i> Usuários</a>
                                </li>
                                <li class='" . ($telas === 'emprestimos' ? 'active' : '') . "'>
                                    <a href='sistema.php?telas=emprestimos'><i class='bi bi-arrow-left-right'></i> Empréstimos</a>
                                </li>";
                        }
                    ?>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-details">
                        <span class="user-name"><?php echo $_SESSION['nome']; ?></span>
                        <span class="user-role">
                            <?php
                                $tipo = $_SESSION['tipo'] ?? 'o';

                                if ($tipo === 'a') {
                                    echo 'Administrador';
                                } elseif ($tipo === 'o') {
                                    echo 'Operador';
                                } elseif ($tipo === 'v') {
                                    echo 'Visualizador';
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <a href="/logout.php" class="logout-link">
                    <i class="bi bi-box-arrow-right"></i> Sair do Sistema
                </a>
            </div>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="header-title">
                    <h2><?php echo ucfirst($telas); ?></h2> 
                </div>
                </header>

            <div class="content-area">
                <?php
                switch ($telas) {
                    case 'colaboradores':
                        include 'telas/colaboradores.php';
                        break;
                    case 'equipamentos':
                        echo "Página de Equipamentos em construção.";
                        break;
                    case 'usuarios':
                        include 'telas/usuarios.php';
                        break;
                    case 'emprestimos':
                        include 'telas/emprestimos.php';
                        echo "Página de Empréstimos em construção.";
                        break;
                    default:
                        echo "<h1>Bem vindo {$_SESSION['nome']}!</h1>";
                        echo "<p>Selecione uma opção no menu ao lado para começar.</p>";
                        break;
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>