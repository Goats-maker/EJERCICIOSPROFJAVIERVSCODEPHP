<?php
function getDB() {
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=indel_inventario;charset=utf8",
            "root",
            "!Y)m_yxsccxz0B3l"
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}