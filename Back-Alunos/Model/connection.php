
<?php
class Connection {
    private static $pdo = null;

    public static function getPDO() {
        if (self::$pdo === null) {
            // Ajuste estes valores quando for rodar:
            $host    = 'localhost';   // ou 127.0.0.1
            $db      = 'techfit';     // nome do banco
            $user    = 'root';        // usuário
            $pass    = '';            // senha (XAMPP geralmente vazio)
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            try {
                self::$pdo = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                // Em produção, troque por log:
                die('Erro na conexão PDO: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
