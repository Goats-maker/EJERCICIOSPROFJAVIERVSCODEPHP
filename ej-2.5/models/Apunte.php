<?php
class Apunte {

    /**
     * PUNTO CRÍTICO DE SEGURIDAD: Obtiene única y exclusivamente los apuntes del usuario autenticado.
     */
    public static function getAllByUser($pdo, $usuario_id) {
        $stmt = $pdo->prepare("SELECT * FROM apuntes WHERE usuario_id = ? ORDER BY actualizado DESC");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }

    /**
     * PUNTO CRÍTICO DE SEGURIDAD: Obtiene un apunte específico validando estrictamente que pertenezca al usuario.
     */
    public static function getByIdAndUser($pdo, $id, $usuario_id) {
        $stmt = $pdo->prepare("SELECT * FROM apuntes WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $usuario_id]);
        return $stmt->fetch();
    }

    /**
     * Crea un nuevo apunte asignándolo al usuario en sesión.
     */
    public static function create($pdo, $usuario_id, $titulo, $materia, $contenido) {
        $stmt = $pdo->prepare("INSERT INTO apuntes (usuario_id, titulo, materia, contenido) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$usuario_id, $titulo, $materia, $contenido]);
    }

    /**
     * PUNTO CRÍTICO DE SEGURIDAD: Actualiza un apunte verificando que el usuario en sesión sea el dueño legítimo.
     */
    public static function update($pdo, $id, $usuario_id, $titulo, $materia, $contenido) {
        $stmt = $pdo->prepare("UPDATE apuntes SET titulo = ?, materia = ?, contenido = ? WHERE id = ? AND usuario_id = ?");
        return $stmt->execute([$titulo, $materia, $contenido, $id, $usuario_id]);
    }

    /**
     * PUNTO CRÍTICO DE SEGURIDAD: Elimina un apunte asegurando que el ID pertenezca al usuario autenticado.
     */
    public static function delete($pdo, $id, $usuario_id) {
        $stmt = $pdo->prepare("DELETE FROM apuntes WHERE id = ? AND usuario_id = ?");
        return $stmt->execute([$id, $usuario_id]);
    }
}