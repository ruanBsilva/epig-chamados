<?php
    session_start();
    // Função nativa PHP que destroe a sessão
    session_destroy();

    header('location: ../index.php');