<?php
// Configuración de la conexión a la Base de Datos mediante PDO
$host = '127.0.0.1';
$db   = 'indeel';
$user = 'root';
$pass = '!Y)m_yxsccxz0B3l'; 
$charset = 'utf8mb4';

$dsn = "mysql:host=localhost;dbname=indeel;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna arreglos asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva emulación para mayor seguridad nativa SQL
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Error crítico de conexión a la base de datos: " . $e->getMessage());
}
?>