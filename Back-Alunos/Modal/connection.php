<?php 

class Connection {
    private static $instance = null; 

    public static function getInstance() {
        if (!self::$instance) {
            try {
                
                $host = 'localhost';
                $user = 'root';
                $senha = 'senaisp';
                $dbname = 'TechFit';

                // 1) Conecta sem banco para criar o DB
                $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $senha);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // 2) Cria DB se não existir
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

                // 3) Conecta no DB correto
                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8",
                    $user,
                    $senha
                );

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Erro ao conectar: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}

?>
