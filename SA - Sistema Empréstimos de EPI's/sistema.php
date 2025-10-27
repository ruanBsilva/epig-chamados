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

    <script src="assets/js/carregarTela.js"></script>
    <script src="assets/js/logout.js"></script>
    <script src="assets/js/colaborador.js"></script>
    <script src="assets/js/usuario.js"></script>
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
                    <li class="nav-item">
                        <a><i class='bi bi-grid-1x2-fill'></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link d-flex align-items-center gap-2 bi bi-shield-check" onclick="carregarTela('equipamentos')">Equipamentos</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link d-flex align-items-center gap-2 bi bi-people-fill" onclick="carregarTela('colaboradores')">Colaboradores</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link d-flex align-items-center gap-2 bi bi-person-gear" onclick="carregarTela('usuarios')">Usuários</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link d-flex align-items-center gap-2 bi bi-arrow-left-right" onclick="carregarTela('emprestimos')">Empréstimos</button>
                    </li>
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
                <button onclick="logout()" class="logout-link">
                    <i class="bi bi-box-arrow-right"></i> Sair do Sistema
                </button>
            </div>
        </aside>

        <main id="main" class="main-content">
            <!-- Aqui irá puxar toooodo o conteúdo das telas, usando a função JS carregarTela -->
        </main>
    </div>
</body>
</html>