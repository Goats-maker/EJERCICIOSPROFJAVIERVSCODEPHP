<?php

function getDB(): PDO
{
    static $pdo = null;

    if ($pdo === null) {

        try {

            $pdo = new PDO(
                "mysql:host=localhost;dbname=indel_inventario;charset=utf8mb4",
                "root",
                "!Y)m_yxsccxz0B3l",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }

    }

    return $pdo;
}