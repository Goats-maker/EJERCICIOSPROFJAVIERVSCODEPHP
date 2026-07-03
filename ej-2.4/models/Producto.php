<?php
class Producto {

    public function todos() {
        return getDB()->query("SELECT * FROM productos ORDER BY id DESC")->fetchAll();
    }

    public function buscar($id) {
        $stmt = getDB()->prepare("SELECT * FROM productos WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crear($data) {
        $stmt = getDB()->prepare("INSERT INTO productos(nombre, descripcion, precio, stock) VALUES (?,?,?,?)");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['precio'],
            $data['stock']
        ]);
    }

    public function actualizar($id, $data) {
        $stmt = getDB()->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=? WHERE id=?");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['precio'],
            $data['stock'],
            $id
        ]);
    }

    public function eliminar($id) {
        $stmt = getDB()->prepare("DELETE FROM productos WHERE id=?");
        return $stmt->execute([$id]);
    }
}