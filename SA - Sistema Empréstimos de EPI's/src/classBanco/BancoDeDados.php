<?php  
    class BancoDeDados {
        private $conexao;
        private $dbHost = 'localhost';
        private $dbPorta = '3306';
        private $dbName = 'epig_seguros';
        private $dbUser = 'root';
        private $dbPassword = '';

        // Construtor
        public function __construct() {
            $this->conexao = new PDO('mysql:host=' . $this->dbHost . ';port=' . $this->dbPorta . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPassword);
        }

        // Método Executar comando
        public function executarComando($sql, $parametros = []) {
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute($parametros);
        }

        // Método consultar
        public function consultar($sql, $parametros = [], $fetchAll = false) {
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute($parametros);

            if ($fetchAll) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        
        public function ultimoIdInserido() {
            return $this->conexao->lastInsertId();
        }
        
        // Inicia a transação
        public function iniciarTransacao() {
            return $this->conexao->beginTransaction();
        }

        // Salva a transação
        public function confirmarTransacao() {
            return $this->conexao->commit();
        }

        // Desfaz a transação
        public function cancelarTransacao() {
            return $this->conexao->rollBack();
        }
    }
