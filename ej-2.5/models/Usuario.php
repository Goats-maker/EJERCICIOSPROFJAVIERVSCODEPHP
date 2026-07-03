<?php
class Usuario {
    
    /**
     * Busca un usuario por su correo electrónico único.
     */
    public static function findByEmail($pdo, $email) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Registra un nuevo usuario encriptando la contraseña con password_hash.
     */
    public static function create($pdo, $nombre, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $email, $hash]);
    }
}